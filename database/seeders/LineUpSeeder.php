<?php

namespace Database\Seeders;

use App\Models\LineUp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LineUp::factory()->count(10)->create();
        
    }
}
