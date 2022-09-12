<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EntityService>
 */
class EntityServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $model_type = ['App\Models\Hotel', 'App\Models\Restaurant'];
        return [
            'service_id' => rand(1, 23),
            'model_type' => $model_type[rand(0, 1)],
            'model_id' => rand(1, 10)
        ];
    }
}
