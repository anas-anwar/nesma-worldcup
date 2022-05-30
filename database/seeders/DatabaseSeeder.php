<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::insert(
//             'username' => 'admin',
// 'email' => 'dev.anas.anwar',
// 'password' => ,
// 'type' => 
//         );
        \App\Models\Account::factory(10)->create();
        \App\Models\Hotel::factory(10)->create();
        \App\Models\Restaurant::factory(10)->create();
        \App\Models\Stadium::factory(10)->create();
        \App\Models\Group::factory(10)->create();
        \App\Models\Team::factory(10)->create();
        \App\Models\Player::factory(10)->create();
        \App\Models\Round::factory(10)->create();
        \App\Models\MatchModel::factory(10)->create();
        // \App\Models\TypeOfEvent::factory(10)->create();
        \App\Models\TypeOfEvent::insert([
            [
                'name'=>'Red Card', 
                'slug'=> Str::slug('Red Card', '-')
            ],
            [
                'name'=>'Yellow Card',
                'slug'=> Str::slug('Yellow Card', '-')
            ],
            [
                'name'=>'Goal',
                'slug'=> Str::slug('Goal', '-')
            ],
        ]);
        \App\Models\LineUp::factory(10)->create();
        \App\Models\Event::factory(10)->create();
        \App\Models\Room::factory(10)->create();
        \App\Models\Image::factory(10)->create();
        \App\Models\AccountOdd::factory(10)->create();
    }
}
