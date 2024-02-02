<?php

namespace App\Http\Controllers;
use App\Models\Game;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function Games()
    {
        return view('games',['games'=> Game::all()]);
    }
}
