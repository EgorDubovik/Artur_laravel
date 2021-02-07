<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('id_prefix')->nullable();
            $table->float('price')->nullable();
            $table->integer('id_service')->nullable();
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
        Schema::dropIfExists('list_service');
    }
}
