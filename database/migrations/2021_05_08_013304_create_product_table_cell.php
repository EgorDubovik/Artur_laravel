<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTableCell extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_table_cell', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('line_id');
            $table->integer('field_id');
            $table->string('title');

            $table->foreign('line_id')
                ->references('id')
                ->on('product_table_lines')
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
        Schema::dropIfExists('product_table_cell');
    }
}
