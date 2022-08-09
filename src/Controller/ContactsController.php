<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\ContactsForm;
use App\HubSpotService;
use Cake\Collection\Collection;

/**
 * Contacts Controller
 *
 */
class ContactsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $hsService = new HubSpotService();
        $response = $hsService->hubspot->crm()->contacts()->basicApi()->getPage();
        $responseJson = (string)$response;
        //json_encodeされた値をdecodeして配列にする
        $responseArray = json_decode($responseJson, true);
        $collection = new Collection($responseArray['results']);
        $contacts = $collection->extract('properties')->toArray();

        $this->set(compact('contacts'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(string $id)
    {
        $contact = $this->_getContact($id);
        if (! $contact) {
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('contact'));
    }

    private function _getContact(string $id): ?object
    {
        try {
            $hsService = new HubSpotService();
            $apiResponse = $hsService->readContact($id);
            \Cake\Log\Log::write('error', '---api resposne----');
            \Cake\Log\Log::write('error', print_r($apiResponse, true));
        } catch (\Exception $e) {
            \Cake\Log\Log::write('error', '---error message----');
            \Cake\Log\Log::write('error', $e->getMessage());
            $this->Flash->error($e->getMessage());

            return null;
        }

        $responseJson = (string)$apiResponse;
        //json_encodeされた値をdecodeして配列にする
        $responseArray = json_decode($responseJson, true);

        return  (object)$responseArray['properties'];
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $form = new ContactsForm();

        $result = false;
        if ($this->request->is(['post'])) {
            $data = $this->request->getData();
            if ($form->execute($data)) {
                $properties = $this->getProperties();
                $hsService = new HubSpotService();
                try {
                    $apiResponse = $hsService->createContact($properties);
                    \Cake\Log\Log::write('error', '---api resposne----');
                    \Cake\Log\Log::write('error', print_r($apiResponse, true));
                    $result = true;
                    $this->Flash->success('success');
                } catch (\Exception $e) {
                    \Cake\Log\Log::write('error', '---message----');
                    \Cake\Log\Log::write('error', $e->getMessage());
                    $this->Flash->error($e->getMessage());
                }
            }
        }
        if ($result) {
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('form'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contact = $this->_getContact($id);
        $data = [
            'first_name' => $contact->firstname ?? '',
            'last_name' => $contact->lastname ?? '',
            'email' => $contact->email ?? '',
        ];
        $form = new ContactsForm();
        $form->setData($data);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $result = false;
            if ($form->execute($this->request->getData())) {
                $properties = $this->getProperties();
                $hsService = new HubSpotService();
                try {
                    $apiResponse = $hsService->updateContact($id, $properties);
                    $result = true;
                    $this->Flash->success('success');
                } catch (\Exception $e) {
                    $this->Flash->error($e->getMessage());
                }
            }
            if ($result) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('form'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        try {
            $hsService = new HubSpotService();
            $hsService->deleteContact($id);
        } catch (\Exception $e) {
            $this->Flash->error($e->getMessage());
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        $properties = [];
        $properties['firstname'] = $this->request->getData('first_name');
        $properties['lastname'] = $this->request->getData('last_name');
        $properties['email'] = $this->request->getData('email');

        return $properties;
    }
}
