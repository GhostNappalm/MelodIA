<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\AItool;

class GameAitoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $game1 = Game::find(1);
        $game2 = Game::find(2);

        $aitool1 = AItool::find(1);
        $aitool2 = AItool::find(2);
        echo "cipolla";
        $game1->aitools()->attach($aitool1);

        /*$game1->aitools()->attach($aitool2);

        $game2->aitools()->attach($aitool2);*/
    }
}
