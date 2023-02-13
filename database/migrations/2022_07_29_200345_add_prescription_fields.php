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
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->string('plus_rate', 100)->nullable();
            $table->string('temperature', 100)->nullable();
            $table->string('problem_description', 100)->nullable();
            $table->string('test', 100)->nullable();
            $table->string('advice', 100)->nullable();
            $table->string('next_visit_qty', 100)->nullable();
            $table->string('next_visit_time', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            //
        });
    }
};
