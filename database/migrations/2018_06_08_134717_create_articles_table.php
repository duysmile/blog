<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->string('summary');
            $table->integer('id_author');
            $table->integer('id_status')->default(0);
            $table->integer('views')->default(0);
            $table->dateTime('time_public');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE articles ADD FULLTEXT fulltext_index (title, content)');
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
