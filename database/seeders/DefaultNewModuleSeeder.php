<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class DefaultNewModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'name' => 'Employee Bills',
                'is_active' => 1,
                'route' => 'employee.bills.index',
            ],
            [
                'name' => 'Employee Bills Show',
                'is_active' => 1,
                'route' => 'employee.bills.show',
            ],
            [
                'name' => 'Employee Noticeboard',
                'is_active' => 1,
                'route' => 'employee.noticeboard',
            ],
            [
                'name' => 'Employee Patient Diagnosis Test Pdf',
                'is_active' => 1,
                'route' => 'employee.patient.diagnosis.test.pdf',
            ],
        ];
        foreach ($input as $data) {
            $module = Module::whereName($data['name'])->first();
            if ($module) {
                $module->update(['route' => $data['route']]);
            } else {
                Module::create($data);
            }
        }
    }
}
