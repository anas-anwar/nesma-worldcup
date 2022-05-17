<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\TypeOfEvent;

class TypeOfEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeOfEvent::insert([
            [
                'name'=>'Red Card', 
                'slug'=> Str::slug('Red Card', '-')
            ],
            [
                'name'=>'Yellow Card',
                'slug'=> Str::slug('Yellow Card', '-')
            ],
        ]);
    }
}
