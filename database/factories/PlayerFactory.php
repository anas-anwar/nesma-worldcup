<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Player;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Player::class;
  
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'nationality' => $this->faker->country(),
            'birthdate' => $this->faker->date(),
            'height' => $this->faker->randomFloat(null, 160, 200),
            'weight' => $this->faker->randomFloat(null, 60, 100),
            'team_id' => rand(1,10),

        ];
    }
}
