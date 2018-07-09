<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // bang doanh nghiep
        Schema::create('enterprises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_enterprise');
            $table->string('address_enterprise');
            $table->string('name_president_enterprise');
            $table->string('phone_number_enterprise');
            $table->text('introduce_enterprise');
            $table->string('avatar_enterprise',400);
            $table->integer('id_user');
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
        Schema::dropIfExists('enterprises');
    }
}
