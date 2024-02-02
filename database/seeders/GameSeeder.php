<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Game::create([
            'name' => 'StepMania',
            'image_path' => 'SM_img.jpg' 
        ]);

        Game::create([
            'name' => 'osu!',
            'image_path' => 'osu!_img.png' 
        ]);

        Game::create([
            'name' => 'InTheGroove 3',
            'image_path' => 'ITG3_img.png' 
        ]);

        Game::create([
            'name' => 'osu!taiko',
            'image_path' => 'osu!taiko_img.jpg' 
        ]);
    }
}
