<?php

use Illuminate\Support\Facades\Route;

// upgrade to v7.0.0
Route::get('/upgrade-to-v7-0-0', function () {
    Artisan::call('db:seed', ['--class' => 'FrontSettingTableSeeder', 'force' => true]);
});

// migration routes
Route::get('/upgrade/database', function () {
    if (config('app.upgrade_mode')) {
        Artisan::call('migrate', ['--force' => true]);
    }

    // upgrade-to-v8-0-0
//    Artisan::call('migrate',
//        [
//            '--force' => true,
//            '--path'  => 'database/migrations/2021_06_07_104022_change_patient_foreign_key_type_in_appointments_table.php',
//        ]);
//    Artisan::call('migrate',
//        [
//            '--force' => true,
//            '--path'  => 'database/migrations/2021_06_08_073918_change_department_foreign_key_in_appointments_table.php',
//        ]);
//    Artisan::call('migrate',
//        [
//            '--force' => true,
//            '--path'  => 'database/migrations/2021_06_21_082754_update_amount_datatype_in_bills_table.php',
//        ]);
//    Artisan::call('migrate',
//        [
//            '--force' => true,
//            '--path'  => 'database/migrations/2021_06_21_082845_update_amount_datatype_in_bill_items_table.php',
//        ]);

    // upgrade-to-v8-1-0
//    Artisan::call('migrate',
//        [
//            '--force' => true,
//            '--path'  => 'database/migrations/2021_05_10_000000_add_uuid_to_failed_jobs_table.php',
//        ]);
//    Artisan::call('migrate',
//        [
//            '--force' => true,
//            '--path'  => 'database/migrations/2021_05_29_103036_add_conversions_disk_column_in_media_table.php',
//        ]);

    // upgrade-to-v9-5-0
//    Artisan::call('migrate',
//        [
//            '--force' => true,
//            '--path'  => 'database/migrations/2022_02_18_101938_add_darkmode_to_users_table.php',
//        ]);

    // upgrade-to-v10.1.0
//    Artisan::call('migrate',
//        [
//            '--force' => true,
//            '--path'  => 'database/migrations/2022_04_09_064645_change_doctor_foreign_in_operation_reports_table.php',
//        ]
//    );

    // upgrade-to-v10-1-0
//    Artisan::call('migrate',
//        [
//            '--force' => true,
//            '--path' => 'database/migrations/2022_04_09_064645_change_doctor_foreign_in_operation_reports_table.php',
//        ]);
//    Artisan::call('migrate',
//        [
//            '--force' => true,
//            '--path' => 'database/migrations/2022_05_16_104947_add_default_length_in_table.php',
//        ]);
});

// upgrade to v9.2.0
Route::get('/upgrade-to-v9-2-0', function () {
    Artisan::call('db:seed', ['--class' => 'FrontSettingHomeTableSeeder', '--force' => true]);
    Artisan::call('db:seed', ['--class' => 'FrontServiceSeeder', '--force' => true]);
    Artisan::call('db:seed', ['--class' => 'AddDoctorFrontSettingTableSeeder', '--force' => true]);
    Artisan::call('db:seed', ['--class' => 'AddSocialSettingTableSeeder', '--force' => true]);
    Artisan::call('db:seed', ['--class' => 'AddHomePageBoxContentSeeder', '--force' => true]);
    Artisan::call('db:seed', ['--class' => 'AddAppointmentFrontSettingTableSeeder', '--force' => true]);
});

// new appointment migration
Route::get('/upgrade-to-v8-0-0', function () {
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path' => 'database/migrations/2021_06_07_104022_change_patient_foreign_key_type_in_appointments_table.php',
        ]);
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path' => 'database/migrations/2021_06_08_073918_change_department_foreign_key_in_appointments_table.php',
        ]);
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path' => 'database/migrations/2021_06_21_082754_update_amount_datatype_in_bills_table.php',
        ]);
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path' => 'database/migrations/2021_06_21_082845_update_amount_datatype_in_bill_items_table.php',
        ]);
});

Route::get('/upgrade-to-v8-1-0', function () {
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path' => 'database/migrations/2021_05_10_000000_add_uuid_to_failed_jobs_table.php',
        ]);
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path' => 'database/migrations/2021_05_29_103036_add_conversions_disk_column_in_media_table.php',
        ]);
});

Route::get('/upgrade-to-v9-5-0', function () {
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path' => 'database/migrations/2022_02_18_101938_add_darkmode_to_users_table.php',
        ]);
});

Route::get('/upgrade-to-v10.1.0', function () {
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path' => 'database/migrations/2022_04_09_064645_change_doctor_foreign_in_operation_reports_table.php',
        ]
    );
});

Route::get('/upgrade-to-v10-1-0', function () {
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path' => 'database/migrations/2022_04_09_064645_change_doctor_foreign_in_operation_reports_table.php',
        ]);
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path' => 'database/migrations/2022_05_16_104947_add_default_length_in_table.php',
        ]);
});
