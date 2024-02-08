<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Game;

class GameUserSeeder extends Seeder
{
    public function run(): void
    {
        $game1 = Game::find(1);
        $game2 = Game::find(2);

        $user1 = User::find(1);
        $user2 = User::find(2);
        
        $user1->favGames()->attach($game1);
        $user1->favGames()->attach($game2);

        $user2->favGames()->attach($game2);

        $user3 = User::find(11);
        $user3->favGames()->attach($game2);
        $user3->favGames()->attach($game1);
    }
}
