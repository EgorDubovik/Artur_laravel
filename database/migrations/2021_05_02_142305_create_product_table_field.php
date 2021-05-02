<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTableField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_table_field', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->boolean('is_writeable')->default(0);
            $table->unsignedBigInteger('table_id');

            $table->foreign('table_id')
                ->references('id')
                ->on('product_table')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_table_field');
    }
}
