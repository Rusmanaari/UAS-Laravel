<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVidiosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vidios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vidio_title', 100);
            $table->text('vidio_desc')->nullable();
            $table->string('vidio_src');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('vidios');
    }
}
