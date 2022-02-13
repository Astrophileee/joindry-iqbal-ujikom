<?php

namespace Database\Seeders;

use App\Models\Outlet;
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
        Outlet::create([
            'nama' => 'Outlet Pusat',
            'tlp' =>'081287940769',
            'alamat' =>'Jl. Siliwangi No.41, Sawah Gede, Kec. Cianjur, Kabupaten Cianjur, Jawa Barat'
        ]);
        
        User::create([
            'nama' => 'Admin Laundry',
            'email' => 'iqbal@gmail.com',
            'password' => bcrypt('iqbal123'),
            'id_outlet'=>1,
            'role' => 'admin',
        ]);

        \App\Models\Member::factory(10)->create();
        \App\Models\Outlet::factory(10)->create();
        \App\Models\Paket::factory(10)->create();
        \App\Models\User::factory(10)->create();
    }
}
