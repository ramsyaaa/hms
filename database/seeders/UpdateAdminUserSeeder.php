<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class UpdateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('id', 1)->first();
        if ($user) {
            $admin = admin::where('user_id', $user->id)->first();
            if ($admin) {
                admin::where('user_id', $user->id)->update(['is_default' => 1]);
            } else {
                $input = [
                    'user_id' => $user->id,
                    'is_default' => 1,
                ];
                admin::create($input);
            }
        }
    }
}
