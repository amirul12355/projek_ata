<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan create() untuk memasukkan data terus melalui model User
        User::create([
            'name' => 'Kasim',
            'email' => 'kasim@mohe.gov.my',
            'ic_number' => '920101-01-1234',
            'password' => Hash::make('Password@123'), // hash password
            'kategori' => 'KPT', // kategori pengguna
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'amirul',
            'email' => 'amirul@mohe.gov.my',
            'ic_number' => '920101-14-1234',
            'password' => Hash::make('Password@123'), // hash password
            'kategori' => 'PUO', // kategori pengguna
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

