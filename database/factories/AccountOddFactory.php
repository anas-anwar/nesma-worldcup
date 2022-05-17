<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AccountOdd;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountOdd>
 */
class AccountOddFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccountOdd::class;
  
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $team_one = rand(1,10);
        $team_two = rand(1,10) != $team_one;
        $vote =[$team_one, $team_two];
        return [
            'name' => $this->faker->name(),
            'match_id' => rand(1,10),
            'account_id' => rand(1,10),
            'vote' => $vote[rand(0,1)],
        ];
    }
}
