<?php

namespace Database\Factories;

use App\Models\ExpenseTypes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->realText(20),
            'value' => $this->faker->randomDigitNotNull(),
            'type_id' => ExpenseTypes::all()->random(1)[0]->id,
            'is_archived' => $this->faker->boolean(),
            'month' => $this->faker->unique()->numberBetween(1, 12),
            'deadline' => $this->faker->date(),
            'user_id' => User::all()->random(1)[0]->id
        ];
    }
}
