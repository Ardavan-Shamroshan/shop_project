<?php

namespace Database\Seeders;

use App\Models\Setting\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            SettingSeeder::class
        ]);
        User::query()->create([
            'first_name' => 'ardavan',
            'last_name'  => 'shamroshan',
            'email'      => 'ardavan2000.ashr@gmail.com',
            'password'   => bcrypt('password'),
            'status'     => 1,
            'user_type'  => 1,
            'activation' => 1,
        ]);
    }
}
