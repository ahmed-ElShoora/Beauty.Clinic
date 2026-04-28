<?php

namespace App\Http\Services\Web;

use App\Models\Contact;
use App\Models\Schedule;

class ContactUsService{
    public function get(){
        return Schedule::with('slots')
            ->get()
            ->keyBy('day_of_week');
    }

    public function store($data){
        $contact = Contact::create([
            'name'=>$data['name'],
            'phone'=>$data['phone'],
            'message'=>$data['message']
        ]);

        return (bool) $contact;
    }
}