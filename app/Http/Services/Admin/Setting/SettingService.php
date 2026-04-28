<?php

namespace App\Http\Services\Admin\Setting;

use App\Models\Setting;

class SettingService{
    public function get(){
        return [
            'phone' => Setting::where('var','phone')->first()->value,
            'whatsapp' => Setting::where('var','whatsapp')->first()->value,
            'email' => Setting::where('var','email')->first()->value,
            'map' => Setting::where('var','map')->first()->value,
        ];
    }

    public function update($data){
        $phone = Setting::where('var','phone')->update([
            'value'=>$data['phone']
        ]);
        $whatsapp = Setting::where('var','whatsapp')->update([
            'value'=>$data['whatsapp']
        ]);
        $email = Setting::where('var','email')->update([
            'value'=>$data['email']
        ]);
        $map = Setting::where('var','map')->update([
            'value'=>$data['map']
        ]);

        return $phone && $whatsapp && $email && $map;
    }
}