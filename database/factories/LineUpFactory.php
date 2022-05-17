<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LineUp;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LineUp>
 */
class LineUpFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LineUp::class;
  
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $substitution = ['Basic', 'Reserve'];
        return [
            'substitution' => $substitution[rand(0,1)],
            'match_id' => rand(1,10),
            'player_id' => rand(1,10),
            'team_id' => rand(1,10),
        ];
    }
}
