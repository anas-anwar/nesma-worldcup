<?php

namespace Database\Seeders;

use App\Models\MatchModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MatchModel::factory()->count(10)->create();
        
    }
}
