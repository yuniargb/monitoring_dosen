<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'nama'  => 'admin',
            'role' => 1,
            'username' => 'superadmin',
            'email' => 'ygbachri@gmail.com',
            'no_telp' => '082134971243',
            'password'  => Hash::make('admin')
        ]);
    }
}
