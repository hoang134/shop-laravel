<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'logo' => 'setting/logo.jpg',
            'company' => 'Tmdt',
            'address' => 'admin@gmail.com',
            'hotline' => '0333333333',
            'phone' => '0333333333',
            'email' => 'admin@gmail.com',
            'facebook_url' => 'https://facebook.com',
            'information_services' => 'Thông tin dịch vụ',
            'information_bank' => 'Thông tin ngân hàng',
        ]);
    }
}
