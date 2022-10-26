<?php

namespace Database\Seeders;

use DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ArticleTagSeed extends Seeder
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

            DB::table('article_tag')->insert([
                'article_id' => $index++,
                'tag_id' => rand(1, 10),
            ]);
        }
    }
}
