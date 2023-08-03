<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMastersRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masters_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_id')->unsigned()->default(1);
            $table->foreign('master_id')->references('id')->on('masters');
            $table->integer('mark');
            $table->text('ipAddress');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masters_ratings');
    }
}
