<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Stadium;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stadium>
 */
class StadiumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stadium::class;
  
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'phone' => $this->faker->phoneNumber(),
            'capacity' => rand(90000, 95000),
            'address' => $this->faker->address(),
            'lattude' => $this->faker->latitude($min = -90, $max = 90),
            'longtude' => $this->faker->longitude($min = -180, $max = 180),
        ];
    }
}
