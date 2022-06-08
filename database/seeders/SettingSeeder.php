<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
          'title' => 'عنوان سایت',
          'description' => 'توضیحات سایت',
          'keywords' => 'کلمات کلیدی سایت',
          'email' => 'example@email.com',
          'mobile' => '12345678912',
          'phone1' => '061 - 12345678',
          'phone2' => '061 - 12345678',
          'address' => 'آدرس',
          'copyright' => 'کپی رایت',
          'logo' => 'logo.png',
          'icon' => 'icon.png',
        ]);
    }
}
