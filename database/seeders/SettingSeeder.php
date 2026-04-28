<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'var'=>'phone',
            'value'=>'+201061171316'
        ]);
        Setting::create([
            'var'=>'whatsapp',
            'value'=>'+201061171316'
        ]);
        Setting::create([
            'var'=>'email',
            'value'=>'ahmedsamye777@gmail.com'
        ]);
        Setting::create([
            'var'=>'map',
            'value'=>'https://maps.com/test'
        ]);
    }
}
