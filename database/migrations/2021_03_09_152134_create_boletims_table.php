<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletims', function (Blueprint $table) {
            $table->id();
            $table->string('cover')->nullable();
            $table->string('title');
            $table->date('date');
            $table->string('short_text');
            $table->string('file')->nullable();
            $table->integer('user_id');
            $table->integer('call')->default(0);
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
        Schema::dropIfExists('boletims');
    }
}
