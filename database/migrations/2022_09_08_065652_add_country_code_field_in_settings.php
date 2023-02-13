<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryCodeFieldInSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $checkKey = Setting::where('key', 'country_code')->exists();
        if (! $checkKey) {
            Setting::create([
                'key'       => 'country_code',
                'value'     => '+91',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Setting::where('key','country_code')->delete();
    }
}
