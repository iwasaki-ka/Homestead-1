<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKintaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kintai', function (Blueprint $table) {
            $table->increments('id');
            $table->string('syain_number');
            $table->date('date');
            $table->datetime('start_time');
            $table->datetime('end_time')->nullable();
            $table->timestamps();

            $table->foreign('syain_number')->references('syain_number')->on('syain');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kintai');
    }
}
