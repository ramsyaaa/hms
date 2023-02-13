<?php

namespace Database\Seeders;

use App\Models\FrontSetting;
use Illuminate\Database\Seeder;

class AddAppointmentFrontSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontSetting::create([
            'key' => 'appointment_title',
            'value' => 'Contact Now and Get the Best Doctor Service Today',
            'type' => FrontSetting::APPOINTMENT,
        ]);
        FrontSetting::create([
            'key' => 'appointment_description',
            'value' => 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit consequat ipsum nec sagittis.',
            'type' => FrontSetting::APPOINTMENT,
        ]);
    }
}
