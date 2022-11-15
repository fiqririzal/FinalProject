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
        User::create([
            'name' => 'Fiqri Rizal Zulmi',
            'email' => 'Fiqririzal@gmail.com',
            'password' => Hash::make('admin'),
        ])->assignRole('Admin')->userDetails()->create([
            'phone' => '081234567',
            'photo_profile'=>'',
            'photo_id'=>'',
            // 'status'=>'',
        ]);

        User::create([
            'name' => 'Adri Ganteng',
            'email' => 'dray@gmail.com',
            'password' => Hash::make('admin'),
        ])->assignRole('Admin')->userDetails()->create([
            'phone' => '081234567',
            'photo_profile'=>'',
            'photo_id'=>'',
            // 'status'=>'',
        ]);
        User::create([
            'name' => 'M Asef',
            'email' => 'asef@gmail.com',
            'password' => Hash::make('admin'),
        ])->assignRole('Admin')->userDetails()->create([
            'phone' => '081234567',
            'photo_profile'=>'',
            'photo_id'=>'',
            // 'status'=>'',
        ]);
        User::create([
            'name' => 'Fadli Tampan Dan Berani',
            'email' => 'fadli@gmail.com',
            'password' => Hash::make('admin'),
        ])->assignRole('Admin')->userDetails()->create([
            'phone' => '081234567',
            'photo_profile'=>'',
            'photo_id'=>'',
            // 'status'=>'',
        ]);

        User::create([
            'name' => 'Wanda Soleh',
            'email' => 'wanda@gmail.com',
            'password' => Hash::make('admin'),
        ])->assignRole('Admin')->userDetails()->create([
            'phone' => '081234567',
            'photo_profile'=>'',
            'photo_id'=>'',
            // 'status'=>'',
        ]);

    }

}
