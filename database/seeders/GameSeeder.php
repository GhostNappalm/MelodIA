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
            'description' => 'Game description',
            'image_path' => 'SM_img.jpg' 
            
        ]);

        Game::create([
            'name' => 'osu!',
            'description' => 'Game description',
            'image_path' => 'osu!_img.png' 
        ]);

        Game::create([
            'name' => 'InTheGroove 3',
            'description' => 'Game description',
            'image_path' => 'ITG3_img.png' 
        ]);

        Game::create([
            'name' => 'osu!taiko',
            'description' => 'Game description',
            'image_path' => 'osu!taiko_img.jpg' 
        ]);
    }
}
