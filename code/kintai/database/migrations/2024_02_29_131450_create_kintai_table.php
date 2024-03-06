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

            for ($i = 1; $i <= 31; $i++) {
                $table->datetime("day{$i}_start_time")->nullable();
                $table->datetime("day{$i}_end_time")->nullable();
                $table->integer("day{$i}_break_time")->nullable();
            }

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
