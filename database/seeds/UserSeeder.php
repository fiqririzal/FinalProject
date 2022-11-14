<?php

use App\User;
use App\UserDetail;
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
        $id = User::create([
            'name' => 'fiqri',
            'email' => 'Fiqririzal@gmail.com',
            'password' => Hash::make('admin'),
        ])->assignRole('Admin')->userDetails()->create([
            'address' => 'jalan babakan desa01/01',
            'phone' => '081234567',
            'photo_profile'=>'',
            'photo_id'=>'',
        ]);

    }

}
