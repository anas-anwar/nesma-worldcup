<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MatchModel;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MatchModel>
 */
class MatchModelFactory extends Factory
{
    protected $model = MatchModel::class;
  
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $starts_at = Carbon::create($this->faker->time()) ;

        $ends_at= Carbon::create($starts_at)->addHours(2);

        return [
            'date' => $this->faker->date(),
            'star' => $starts_at,
            'end' => $ends_at,
            // 'round_id' => rand(1,10),
            // 'stadium_id' => rand(1,10),
            // 'localteam_id' => rand(1,10),
            // 'visitorteam_id' => rand(1,10),
        ];
    }
}
