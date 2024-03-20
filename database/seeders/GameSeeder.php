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
            'description' => 'Stepmania is a rhythm game inspired by Dance Dance Revolution. Developed by Chris Danford and Glenn Maynard, it was first released in 2001. Players use a dance pad or keyboard to hit arrows in time with the music, following various patterns.',
            'image_path' => 'SM_img.jpg' 
            
        ]);

        Game::create([
            'name' => 'osu!standard',
            'description' => 'osu! is a rhythm game developed by Dean Herbert, also known as "peppy". It was first released in 2007. In osu!standard mode, players click circles, slide sliders, and spin spinners in time with the music, following various beatmaps created by the community or themselves.',
            'image_path' => 'osu!_img.png' 
        ]);

        Game::create([
            'name' => 'InTheGroove 3',
            'description' => '
            In The Groove 3 is a rhythm video game, originally developed by Roxor Games and released in 2009. It\'s part of the In The Groove series, which is similar to Dance Dance Revolution but with a stronger emphasis on challenging gameplay and customizability. Players use a dance pad to hit arrows scrolling on the screen in sync with the music, following complex patterns and rhythms. In The Groove 3 features a diverse selection of songs and difficulty levels, providing an immersive and energetic experience for rhythm game enthusiasts.',
            'image_path' => 'ITG3_img.png' 
        ]);

        Game::create([
            'name' => 'osu!taiko',
            'description' => '
            osu!taiko is a rhythm game mode within the osu! series, developed by Dean Herbert. It was introduced as a part of the osu! game in 2007. In osu!taiko, players hit drum notes that appear on the screen in time with the music, following various beatmaps created by the community or themselves.',
            'image_path' => 'osu!taiko_img.jpg' 
        ]);
    }
}
