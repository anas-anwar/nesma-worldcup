<?php

namespace Database\Seeders;

use App\Models\AccountOdd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountOddSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountOdd::factory()->count(10)->create();
        
    }
}
