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
        Schema::table('employee_payrolls', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('advanced_payments', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('bills', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('beds', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('blood_issues', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('patient_cases', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('incomes', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('expenses', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('charges', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('doctor_opd_charges', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('ipd_charges', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('ipd_payments', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('opd_patient_departments', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('item_stocks', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('medicines', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('pathology_tests', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('radiology_tests', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('insurances', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('services', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
        Schema::table('ambulance_calls', function (Blueprint $table) {
            $table->string('currency_symbol', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
