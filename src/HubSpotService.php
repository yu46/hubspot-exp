<?php

namespace App;

use Cake\Core\Configure;

class HubSpotService
{
    public \HubSpot\Discovery\Discovery $hubspot;

    public function __construct()
    {
        $token = Configure::read('HubSpot.access_token');
        $this->hubspot = \HubSpot\Factory::createWithAccessToken($token);
    }

    public function createContact($properties)
    {
        $contactInput = new \HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput(['properties' => $properties]);

        return $this->hubspot->crm()->contacts()->basicApi()->create($contactInput);
    }

    public function deleteContact($contactId)
    {
        $this->hubspot->crm()->contacts()->basicApi()->archive($contactId);
    }

    public function readContact($contactId)
    {
        return $this->hubspot->crm()->contacts()->basicApi()->getById($contactId);
    }

    public function updateContact($id, $properties)
    {
        $contactInput = new \HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput(['properties' => $properties]);

        return $this->hubspot->crm()->contacts()->basicApi()->update($id, $contactInput);
    }
}