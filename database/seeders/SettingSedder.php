<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name'      => 'Nizar Logistics',
            'phone'     => '88888888',
            'email'     => 'nizarlogistic@gmail.com',
            'address'   => 'Saudi Arabia',
            'logo'       => 'logo.png',
            'favicon'   => 'favicon.png',
        ]);
    }
}
