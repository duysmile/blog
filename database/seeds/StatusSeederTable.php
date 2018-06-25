<?php

use Illuminate\Database\Seeder;

class StatusSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ArticleStatus::create([
            'status_code' => 0,
            'name' => 'Draft',
        ]);
        \App\ArticleStatus::create([
            'status_code' => 1,
            'name' => 'Public preparation',
        ]);
        \App\ArticleStatus::create([
            'status_code' => 2,
            'name' => 'Public',
        ]);
        \App\ArticleStatus::create([
            'status_code' => 3,
            'name' => 'Not Public',
        ]);
    }
}
