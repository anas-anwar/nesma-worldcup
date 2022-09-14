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
        $services = ['coffee', 'Wifi', 'delevery'];
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(20),
            'phone' => $this->faker->phoneNumber(),
            'rate' => rand(1,5),
            'latitude' => $this->faker->latitude($min = -90, $max = 90),
            'longtude' => $this->faker->longitude($min = -180, $max = 180),
            'address' => $this->faker->address(),
            //'services' => $services[rand(0,2)],
            'hotel_url' => $this->faker->url(),
        ];
    }
}
