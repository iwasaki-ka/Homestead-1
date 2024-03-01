<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthKintaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('month_kintai', function (Blueprint $table) {
            $table->increments('id');
            $table->string('syain_number');
            $table->string('month');
            $table->decimal('total_work_hours', 8, 2)->default(0);
            $table->integer('total_work_days');
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
        Schema::dropIfExists('month_kintai');
    }
}
