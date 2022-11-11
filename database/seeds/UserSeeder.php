<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'fiqri',
            'email' => 'Fiqririzal@gmail.com',
            'password' => Hash::make('admin'),
            // 'phone' => '082319858335',
        ]);
        $admin->assignRole('Admin');
    }

}
