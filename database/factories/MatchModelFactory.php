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

        $team_one = rand(1,10);
        while( in_array( ($n = rand(1,10)), array($team_one) ) );
        $team_two = $n;

        return [
            'date' => $this->faker->date(),
            'start' => $starts_at,
            'end' => $ends_at,
            'round_id' => rand(1,10),
            'stadium_id' => rand(1,10),
            'localteam_id' => $team_one,
            'visitorteam_id' => $team_two,
        ];
    }
}
