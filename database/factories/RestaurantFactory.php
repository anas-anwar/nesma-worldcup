<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Restaurant;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;
  
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $hour_open = Carbon::create($this->faker->time()) ;

        $hour_close= Carbon::create($hour_open)->addHours(12); 

        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'rate' => rand(0,10),
            'hour_open' => $hour_open,
            'hour_close' => $hour_close,
            'lattude' => $this->faker->latitude($min = -90, $max = 90),
            'longtude' => $this->faker->longitude($min = -180, $max = 180),
            'address' => $this->faker->address(),
        ];
    }
}
