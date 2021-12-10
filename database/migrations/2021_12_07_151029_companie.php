<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Companie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id('id')->index();
            $table->string('name')->unique();
            $table->longText('url')->unique();
            $table->double('latitude', 15, 5);
            $table->double('longitude', 15, 5);
            $table->json('software_skils');
            $table->string('blacklisted');
            $table->string('email')->unique();
            $table->string('postal_code')->unique();
            $table->string('street');
            $table->integer('address_number');
            $table->string('province');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
