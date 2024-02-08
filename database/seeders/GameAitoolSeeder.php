<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Aitool;

class GameAitoolSeeder extends Seeder
{
    public function run(): void
    {
        $game1 = Game::find(1);
        $game2 = Game::find(2);

        $aitool1 = Aitool::find(1);
        $aitool2 = Aitool::find(2);
        
        $game1->aiTools()->attach($aitool1);
        $game1->aiTools()->attach($aitool2);

        $game2->aiTools()->attach($aitool2);
    }
}
