<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_enterprise');
            $table->string('title_post_course');
            $table->text('content_post_course');
            $table->string('file_attach_course');
            $table->boolean('accept')->default(0);

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
        Schema::dropIfExists('post_courses');
    }
}
