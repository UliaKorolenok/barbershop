<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCosmeticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cosmetics', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->float('price');
            $table->text('description');
            $table->text('fullDescription');
            $table->string('img');
            $table->string('keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cosmetics');
    }
}
