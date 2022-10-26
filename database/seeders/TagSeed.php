<?php

namespace Database\Seeders;

use DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TagSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {

            DB::table('tags')->insert([
                'url' => "https://" . $faker->word() . ".com",
                'label' => $faker->word,
            ]);
        }
    }
}
