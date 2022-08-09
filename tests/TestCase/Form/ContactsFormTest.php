<?php
declare(strict_types=1);

namespace App\Test\TestCase\Form;

use App\Form\ContactsForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\ContactsForm Test Case
 */
class ContactsFormTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Form\ContactsForm
     */
    protected $Contacts;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->Contacts = new ContactsForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Contacts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Form\ContactsForm::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
