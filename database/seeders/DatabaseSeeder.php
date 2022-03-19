<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Kategori;
use App\Models\Wilayah;
use App\Models\Riset;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
        	'name' => 'admin',
        	'email' => 'admin@bps.go.id',
        	'username' => 'admin',
        	'password' => bcrypt('coba'),
        	'role_id' => '1',
        	'photo' => 'profil/avatar-4.png',
        	'is_active' => '1',
            'wilayah_id' => '1'
        ]);

        User::create([
        	'name' => 'admin kesbangpol',
        	'email' => 'admin.kesbang@gmail.com',
        	'username' => 'admin.kesbang',
        	'password' => bcrypt('coba'),
        	'role_id' => '4',
        	'photo' => 'profil/avatar-1.png',
        	'is_active' => '1',
            'wilayah_id' => '1'
        ]);

        User::create([
            'name' => 'admin kesbangpol kab. Gorontalo Utara',
            'email' => 'admin.kesbang7505@gmail.com',
            'username' => 'admin.kesbang7505',
            'password' => bcrypt('coba'),
            'role_id' => '4',
            'photo' => 'profil/avatar-1.png',
            'is_active' => '1',
            'wilayah_id' => '6'
        ]);

        User::create([
        	'name' => 'operator kesbang',
        	'email' => 'operator.kesbang@gmail.com',
        	'username' => 'operator.kesbang',
        	'password' => bcrypt('coba'),
        	'role_id' => '5',
        	'photo' => 'profil/avatar-3.png',
        	'is_active' => '1',
            'wilayah_id' => '1'
        ]);

        User::create([
            'name' => 'operator kesbang kab. Gorontalo Utara',
            'email' => 'operator.kesbang7505@gmail.com',
            'username' => 'operator.kesbang7505',
            'password' => bcrypt('coba'),
            'role_id' => '5',
            'photo' => 'profil/avatar-3.png',
            'is_active' => '1',
            'wilayah_id' => '6'
        ]);

        User::create([
        	'name' => 'admin bapppeda',
        	'email' => 'admin.bapppeda@gmail.com',
        	'username' => 'admin.bapppeda',
        	'password' => bcrypt('coba'),
        	'role_id' => '2',
        	'photo' => 'profil/avatar-2.png',
        	'is_active' => '1',
            'wilayah_id' => '1'
        ]);

        User::create([
            'name' => 'admin bapppeda kab. Gorontalo Utara',
            'email' => 'admin.bapppeda7505@gmail.com',
            'username' => 'admin.bapppeda7505',
            'password' => bcrypt('coba'),
            'role_id' => '2',
            'photo' => 'profil/avatar-2.png',
            'is_active' => '1',
            'wilayah_id' => '6'
        ]);

        User::create([
        	'name' => 'operator bapppeda',
        	'email' => 'operator.bapppeda@gmail.com',
        	'username' => 'operator.bapppeda',
        	'password' => bcrypt('coba'),
        	'role_id' => '3',
        	'photo' => 'profil/avatar-4.png',
        	'is_active' => '1',
            'wilayah_id' => '1'
        ]);

        User::create([
            'name' => 'operator bapppeda kab. Gorontalo Utara',
            'email' => 'operator.bapppeda7505@gmail.com',
            'username' => 'operator.bapppeda7505',
            'password' => bcrypt('coba'),
            'role_id' => '3',
            'photo' => 'profil/avatar-4.png',
            'is_active' => '1',
            'wilayah_id' => '6'
        ]);

        User::create([
        	'name' => 'pengguna',
        	'email' => 'coba@coba.com',
        	'username' => 'coba',
        	'password' => bcrypt('coba'),
        	'role_id' => '6',
        	'photo' => 'profil/avatar-5.png',
        	'is_active' => '1',
            'wilayah_id' => '1'
        ]);

        User::create([
            'name' => 'pengguna',
            'email' => 'coba7505@coba.com',
            'username' => 'coba7505',
            'password' => bcrypt('coba'),
            'role_id' => '6',
            'photo' => 'profil/avatar-5.png',
            'is_active' => '1',
            'wilayah_id' => '6'
        ]);


        User::factory(50)->create();

        Setting::create([
        	'site_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        	'login_pict' => 'login_pict/login-bg.jpg',
            'site_title' => 'Database Kelitbangan',
            'site_tagline' => 'Gorontalo, Indonesia',
            'site_logo' => 'logo/_Logo.png',
            'site_favicon' => 'favicon/_favicon.png'
        ]);

        Role::create([
        	'name' => 'super_admin',
        	'display_name' => 'Super Admin',
        	'is_super' => 1
        ]);

        Role::create([
        	'name' => 'admin_bapppeda',
        	'display_name' => 'Admin Bapppeda',
        	'description' => 'Admin Badan Perencanaan Pembangunan dan Percepatan Provinsi Gorontalo',
        	'is_super' => 0
        ]);

        Role::create([
        	'name' => 'operator_bapppeda',
        	'display_name' => 'Operator Bapppeda',
        	'description' => 'Operator Badan Perencanaan Pembangunan dan Percepatan Provinsi Gorontalo',
        	'is_super' => 0
        ]);

        Role::create([
        	'name' => 'admin_kesbang',
        	'display_name' => 'Admin Kesbang',
        	'description' => 'Admin Badan Kesatuan Bangsa Provinsi Gorontalo',
        	'is_super' => 0
        ]);

        Role::create([
        	'name' => 'operator_kesbang',
        	'display_name' => 'Operator Kesbang',
        	'description' => 'Operator Badan Kesatuan Bangsa Provinsi Gorontalo',
        	'is_super' => 0
        ]);

        Role::create([
            'name' => 'pengguna',
            'display_name' => 'Pengguna',
            'description' => 'Pengguna Aplikasi Database Kelitbangan',
            'is_super' => 0
        ]);

        Wilayah::create([
            'kode' => '7500',
            'wilayah' => 'Provinsi Gorontalo'
        ]);

        Wilayah::create([
            'kode' => '7501',
            'wilayah' => 'Kabupaten Boalemo'
        ]);

        Wilayah::create([
            'kode' => '7502',
            'wilayah' => 'Kabupaten Gorontalo'
        ]);

        Wilayah::create([
            'kode' => '7503',
            'wilayah' => 'Kabupaten Pohuwato'
        ]);

        Wilayah::create([
            'kode' => '7504',
            'wilayah' => 'Kabupaten Bone Bolango'
        ]);

        Wilayah::create([
            'kode' => '7505',
            'wilayah' => 'Kabupaten Gorontalo Utara'
        ]);

        Wilayah::create([
            'kode' => '7571',
            'wilayah' => 'Kota Gorontalo'
        ]);

        Kategori::create([
            'name' => 'Geografi',
            'description' => 'Geografi'
        ]);

        Kategori::create([
            'name' => 'Iklim',
            'description' => 'Iklim'
        ]);

        Kategori::create([
            'name' => 'Kemiskinan dan Ketimpangan',
            'description' => 'Kemiskinan dan Ketimpangan'
        ]);

        Kategori::create([
            'name' => 'Kependudukan',
            'description' => 'Kependudukan'
        ]);

        Kategori::create([
            'name' => 'Kesehatan',
            'description' => 'Kesehatan'
        ]);

        Kategori::create([
            'name' => 'Pemerintahan',
            'description' => 'Pemerintahan'
        ]);

        Kategori::create([
            'name' => 'Pendidikan',
            'description' => 'Pendidikan'
        ]);

        Kategori::create([
            'name' => 'Politik dan Keamanan',
            'description' => 'Politik dan Keamanan'
        ]);

        Kategori::create([
            'name' => 'Ketenagakerjaan',
            'description' => 'Ketenagakerjaan'
        ]);

        Kategori::create([
            'name' => 'Energi',
            'description' => 'Energi'
        ]);

        Kategori::create([
            'name' => 'Industri',
            'description' => 'Industri'
        ]);

        Kategori::create([
            'name' => 'Keuangan',
            'description' => 'Keuangan'
        ]);

        Kategori::create([
            'name' => 'Pariwisata',
            'description' => 'Pariwisata'
        ]);

        Kategori::create([
            'name' => 'PDRB',
            'description' => 'Produk Domestik Regional Bruto'
        ]);

        Kategori::create([
            'name' => 'Transportasi',
            'description' => 'Transportasi'
        ]);

        Kategori::create([
            'name' => 'Kehutanan',
            'description' => 'Kehutanan'
        ]);

        Kategori::create([
            'name' => 'Perikanan',
            'description' => 'Perikanan'
        ]);

        Kategori::create([
            'name' => 'Peternakan',
            'description' => 'Peternakan'
        ]);

        Kategori::create([
            'name' => 'Perkebunan',
            'description' => 'Perkebunan'
        ]);

        Kategori::create([
            'name' => 'Tanaman Pangan',
            'description' => 'Tanaman Pangan'
        ]);

        Kategori::create([
            'name' => 'Hortikultura',
            'description' => 'Hortikultura'
        ]);


        Riset::factory(50)->create();
    }
}
