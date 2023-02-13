<?php

namespace Database\Factories;

use App\Models\currency_setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class currency_settingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = currency_setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'currency_name' => $this->faker->word(),
            'currency_icon' => $this->faker->word(),
            'currency_code' => $this->faker->word(),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
