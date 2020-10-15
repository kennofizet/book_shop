<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->string('slug',255)->nullable();
            $table->string('file',255)->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('view')->nullable();
            $table->integer('like')->nullable();
            $table->longText('title_content')->nullable();
            $table->longText('content')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('blog_post');
    }
}
