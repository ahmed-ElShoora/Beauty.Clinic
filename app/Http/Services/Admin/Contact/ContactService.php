<?php

namespace App\Http\Services\Admin\Contact;

use App\Models\Contact;

class ContactService
{
    public function getAllContacts()
    {
        return Contact::orderBy('created_at', 'desc')->get();
    }

    public function getContactById($id)
    {
        return Contact::find($id);
    }

    public function hideContact($data)
    {
        $contact = $this->getContactById($data['id']);
        if (!$contact) {
            return false;
        }
        $contact->delete();
        return true;
    }
}