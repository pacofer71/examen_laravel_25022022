<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auto>
 */
class AutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       $ids=User::pluck('id')->toArray();
        return [
            'modelo'=>ucfirst($this->faker->word),
            'marca'=>random_int(1,8),
            'kms'=>$this->faker->numberBetween(3000, 99999),
            'user_id'=>$this->faker->optional()->randomElement($ids),
        ];
    }
}
