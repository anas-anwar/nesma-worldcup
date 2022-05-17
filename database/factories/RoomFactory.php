<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;
  
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = ['Single Room', 'Twin Room', 'Double Room', 'Triple Room', 'Quad Room', 'Studio Room'];
        return [
            'type'=> $type[rand(0,5)],
            'Price' => rand(1000,100000),
            'url' => $this->faker->url(),
            'hotel_id' => rand(1,10),
        ];
    }
}
