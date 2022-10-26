<?php

namespace Database\Seeders;

use DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ArticleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {

            DB::table('articles')->insert([
                'thumbnail' => $faker->imageUrl(1920, 1080, true),
                'title' => $faker->text(5),
                'fulltext' => $faker->text(200),
                'likes' => rand(1, 10),
                'views' => rand(1, 10),
                'created_at' => $faker->dateTimeBetween('-4 week', '+4 week'),
            ]);
        }
    }
}
