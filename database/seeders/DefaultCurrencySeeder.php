<?php

namespace Database\Seeders;

use App\Models\CurrencySetting;
use Illuminate\Database\Seeder;

class DefaultCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *å
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'currency_name' => 'United states dollar',
                'currency_icon' => '$',
                'currency_code' => 'USD',
            ],
            [
                'currency_name' => 'Indian rupee',
                'currency_icon' => '₹',
                'currency_code' => 'INR',
            ],
        ];

        foreach ($input as $data) {
            CurrencySetting::create($data);
        }
    }
}
