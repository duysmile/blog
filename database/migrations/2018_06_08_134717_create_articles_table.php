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
            $table->string('title', 256);
            $table->string('title-en', 256);
            $table->text('content');
            $table->text('summary');
            $table->boolean('top')->default(false);
            $table->integer('id_author')->unsigned()->references('id')->on('users');
            $table->integer('id_status')->unsigned()->references('status_code')->on('article_status')->default(0);
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
