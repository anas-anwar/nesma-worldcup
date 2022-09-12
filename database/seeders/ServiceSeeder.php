<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Service::insert([
            [
                'name' => 'Car rental services',
                'image' => ''
            ],
            [
                'name' => 'Catering services',
                'image' => ''
            ],
            [
                'name' => 'Concierge services',
                'image' => ''
            ],
            [
                'name' => 'Courier services',
                'image' => ''
            ],
            [
                'name' => 'Doctor on call',
                'image' => ''
            ],
            [
                'name' => 'Dry cleaning',
                'image' => ''
            ],
            [
                'name' => 'Excursions and guided tours',
                'image' => ''
            ],
            [
                'name' => 'Flower arrangement',
                'image' => ''
            ],
            [
                'name' => 'Ironing service',
                'image' => ''
            ],
            [
                'name' => 'Laundry and valet service',
                'image' => ''
            ],
            [
                'name' => 'Mail services',
                'image' => ''
            ],
            [
                'name' => 'Massages',
                'image' => ''
            ],
            [
                'name' => 'Room service (24-hour)',
                'image' => ''
            ],
            [
                'name' => 'Shoeshine service',
                'image' => ''
            ],
            [
                'name' => 'Ticket service',
                'image' => ''
            ],
            [
                'name' => 'Transfer and chauffeur driven limousine services',
                'image' => ''
            ],
            [
                'name' => 'Turndown service',
                'image' => ''
            ],
            [
                'name' => 'Valet parking',
                'image' => ''
            ],
            [
                'name' => 'Waiter service',
                'image' => ''
            ],
            [
                'name' => 'Chinese banquet service',
                'image' => ''
            ],
            [
                'name' => 'Buffet service',
                'image' => ''
            ],
            [
                'name' => 'Self-service',
                'image' => ''
            ],
            [
                'name' => 'Semi-self service',
                'image' => ''
            ],
        ]);
    }
}
