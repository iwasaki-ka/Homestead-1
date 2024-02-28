<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syain', function (Blueprint $table) {
            $table->integer('syain_number')->unique();
            $table->string('name');
            $table->string('syozoku');
            $table->string('user_type');
            $table->timestamps();

            
            $table->primary('syain_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('syain');
    }
}
