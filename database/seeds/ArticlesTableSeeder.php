<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1, 5) as $index){
            \App\Article::create([
               'title' => $faker->sentence($words = 10, $varWords = true),
                'content' => $faker->paragraph($sentences = 10, $varSentences = true),
                'summary' => $faker->paragraph($sentences = 2, $varSentences = true),
                'time_public' => date('Y-m-d', time()),
                'id_author' => 1
            ]);
        }
    }
}
