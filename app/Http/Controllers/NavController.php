<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Aitool;
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

    public function AiTools()
    {
        return view('aitools',['aitools'=> Aitool::all(), 'game'=>'0']);
    }

    public function GameAiTools($name)
    {
        // Trova il gioco con l'ID specificato
        $game = Game::where('name', $name)->first();
        // Verifica se il gioco esiste
        if (!$game) {
            // Gestisci il caso in cui il gioco non esiste
            abort(404, 'Game not found');
        }
    
        // Recupera tutti gli AItool collegati al gioco
        $aitools = $game->aitools;
       
        // Passa gli AItool alla vista
        return view('aitools', ['aitools' => $aitools, 'game' => $game]);
    }
}
