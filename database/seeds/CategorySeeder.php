<?php

use App\Category;
use Faker\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        for ($i=0; $i < 10; $i++) {
            $name = $faker->sentence();

            Category::create([
                'name'    => $name,
                'detail'  => $faker->paragraph(10),
                'slug'   => Str::slug($name),
            ]);
        }
    }
}
