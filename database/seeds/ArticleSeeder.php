<?php

use App\Article;
use App\Category;
use Faker\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
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

            Article::create([
                'id_category'    => Category::all()->random()->id,
                'title'  => $name,
                'slug'   => Str::slug($name),
                'body'   => $faker->paragraph(10),
                'image'   => $faker->imageUrl(100,70,'cats'),
                'author' => $faker->paragraph(10),
            ]);
        }   //
    }
}
