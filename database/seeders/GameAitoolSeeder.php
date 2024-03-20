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
        $Stepmania = Game::find(1);
        $osu = Game::find(2);
        $ITG = Game::find(3);
        $osuTaiko = Game::find(4);

        $Stepmania->aiTools()->attach(Aitool::find(1));
        $Stepmania->aiTools()->attach(Aitool::find(2));
        $Stepmania->aiTools()->attach(Aitool::find(6));

        $osu->aiTools()->attach(Aitool::find(3));
        $osu->aiTools()->attach(Aitool::find(4));
        $osu->aiTools()->attach(Aitool::find(5));

        $ITG->aiTools()->attach(Aitool::find(1));
        $ITG->aiTools()->attach(Aitool::find(2));
        $ITG->aiTools()->attach(Aitool::find(6));


        $osuTaiko->aiTools()->attach(Aitool::find(3));
        $osuTaiko->aiTools()->attach(Aitool::find(4));
        $osuTaiko->aiTools()->attach(Aitool::find(5));




    }
}
