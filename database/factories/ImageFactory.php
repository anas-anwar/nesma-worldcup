<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;
  
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $model_type = ['App\Models\Hotel', 'App\Models\Restaurant', 'App\Models\Stadium'];
        return [
            'image_url' => $this->faker->imageUrl(),
            'name' => $this->faker->image(),
            'model_type' => $model_type[rand(0,2)],
            'model_id' => rand(1,10),
        ];
    }
}
