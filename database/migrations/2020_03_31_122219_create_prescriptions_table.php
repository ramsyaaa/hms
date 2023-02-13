<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('food_allergies', 100)->nullable();
            $table->string('tendency_bleed', 100)->nullable();
            $table->string('heart_disease', 100)->nullable();
            $table->string('high_blood_pressure', 100)->nullable();
            $table->string('diabetic', 100)->nullable();
            $table->string('surgery', 100)->nullable();
            $table->string('accident', 100)->nullable();
            $table->string('others', 100)->nullable();
            $table->string('medical_history', 100)->nullable();
            $table->string('current_medication', 100)->nullable();
            $table->string('female_pregnancy', 100)->nullable();
            $table->string('breast_feeding', 100)->nullable();
            $table->string('health_insurance', 100)->nullable();
            $table->string('low_income', 100)->nullable();
            $table->string('reference', 100)->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('doctor_id')->references('id')->on('doctors')
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
        Schema::drop('prescriptions');
    }
};
