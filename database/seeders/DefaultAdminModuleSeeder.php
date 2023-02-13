<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class DefaultAdminModuleSeeder extends Seeder
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
                'name' => 'Admin',
                'is_active' => 1,
                'route' => 'admins.index',
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
