<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Setting;

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

        User::create([
        	'name' => 'admin',
        	'email' => 'admin@bps.go.id',
        	'username' => 'admin',
        	'password' => bcrypt('coba'),
        	'role_id' => '1',
        	'photo' => 'profil/avatar-4.png',
        	'is_active' => '1'
        ]);

        User::create([
        	'name' => 'admin kesbangpol',
        	'email' => 'admin.kesbang@gmail.go.id',
        	'username' => 'admin.kesbang',
        	'password' => bcrypt('coba'),
        	'role_id' => '4',
        	'photo' => 'profil/avatar-1.png',
        	'is_active' => '1'
        ]);

        User::create([
        	'name' => 'operator kesbang',
        	'email' => 'operator.kesbang@gmail.go.id',
        	'username' => 'operator.kesbang',
        	'password' => bcrypt('coba'),
        	'role_id' => '5',
        	'photo' => 'profil/avatar-3.png',
        	'is_active' => '1'
        ]);

        User::create([
        	'name' => 'admin bapppeda',
        	'email' => 'admin.bapppeda@gmail.go.id',
        	'username' => 'admin.bapppeda',
        	'password' => bcrypt('coba'),
        	'role_id' => '2',
        	'photo' => 'profil/avatar-2.png',
        	'is_active' => '1'
        ]);

        User::create([
        	'name' => 'operator bapppeda',
        	'email' => 'operator.bapppeda@gmail.go.id',
        	'username' => 'operator.bapppeda',
        	'password' => bcrypt('coba'),
        	'role_id' => '3',
        	'photo' => 'profil/avatar-4.png',
        	'is_active' => '1'
        ]);

        User::create([
        	'name' => 'pengguna',
        	'email' => 'coba@coba.com',
        	'username' => 'coba',
        	'password' => bcrypt('coba'),
        	'role_id' => '6',
        	'photo' => 'profil/avatar-5.png',
        	'is_active' => '1'
        ]);

        Setting::create([
        	'about' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        	'login_pict' => 'login_pict/login-bg.jpg'
        ]);
    }
}
