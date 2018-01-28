<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pic_id')->nullable();
            $table->string('title');
            $table->string('contributor');
            $table->text('body');
            $table->integer('category');
            $table->string('tag');
            $table->string('fig_name')->nullable();
            $table->string('fig_mime')->nullable();
            $table->string('delete_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
