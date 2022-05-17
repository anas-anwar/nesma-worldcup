<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hotel::class;
  
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'phone' => $this->faker->phoneNumber(),
            'rate' => rand(1,10),
            'lattude' => $this->faker->latitude($min = -90, $max = 90),
            'longtude' => $this->faker->longitude($min = -180, $max = 180),
            'address' => $this->faker->address(),
            'hotelurl' => $this->faker->url(),
        ];
    }
}
