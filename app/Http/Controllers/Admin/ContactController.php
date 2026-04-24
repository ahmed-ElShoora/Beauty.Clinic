<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HideContactRequest;
use App\Http\Services\Admin\Contact\ContactService;

class ContactController extends Controller
{
    public function __construct(
        private ContactService $contactService
    ){}

    public function contacts(){
        $contacts = $this->contactService->getAllContacts();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function hideContact(HideContactRequest $request){
        $result = $this->contactService->hideContact($request->validated());
        if (!$result) {
            return redirect()->back()->withErrors(['error' => 'Failed to hide contact. Please try again.']);
        }
        return redirect()->back()->with('success', 'Contact hidden successfully.');
    }
}
