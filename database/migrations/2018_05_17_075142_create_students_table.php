<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name_student');
            $table->string('last_name_student');
            $table->string('address_student');
            $table->string('email_address_student');
            $table->string('introduce_student');
            // phần giới thiệu bản thân -- Sẽ cho người dùng tự ghi
            $table->string('id_user');
            $table->string('avatar_student');
            $table->integer('id_department');
            $table->string('salary');
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
        Schema::dropIfExists('students');
    }
}
