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
        // bài viết tuyển dụng
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_enterprise');
            $table->string('title_post');
            $table->dateTime('time_start_post');
            $table->dateTime('time_end_post');
            $table->string('description_post');
            $table->text('content_post');
            $table->string('file_attach_post');
            $table->boolean('accept')->default(false);
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
