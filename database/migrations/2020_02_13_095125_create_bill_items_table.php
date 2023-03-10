<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name');
            $table->unsignedInteger('bill_id');
            $table->integer('qty')->unsigned();
            $table->double('price', 8, 2);
            $table->double('amount', 8, 2);
            $table->timestamps();

            $table->foreign('bill_id')->references('id')->on('bills')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_items');
    }
};
