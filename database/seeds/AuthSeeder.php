<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Artisan;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'guard_name'=>'web'
        ]);
        Role::create([
            'name' => 'Pabrik',
            'guard_name'=>'web'
        ]);
        Role::create([
            'name' => 'Toko',
            'guard_name'=>'web'
        ]);
        Artisan::call('passport:install');
    }

}
