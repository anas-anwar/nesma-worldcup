<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Service;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;
  
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $model_type = ['App\Models\Hotel', 'App\Models\Restaurant'];

        if ($model_type[0]) {
            foreach(config('constance.Services.Hotel_Services') as $hotel_services){
                $type = $hotel_services;
            }
        }else{
            foreach(config('constance.Services.Restaurant_Services') as $restaurant_services){
                $type = $restaurant_services;
            }
        }
        return [
            'model_type' => $model_type[rand(0,1)],
            'model_id' => rand(1,10),
            'type' => $type
        ];
    }
}
