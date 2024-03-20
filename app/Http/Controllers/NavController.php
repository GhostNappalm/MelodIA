<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Aitool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function Games()
    {   if(Auth::user())
        {
            $userId = Auth::id(); // Ottieni l'ID dell'utente loggato

            $games = Game::leftJoin('game_user', function($join) use ($userId) {
                $join->on('games.id', '=', 'game_user.game_id')
                     ->where('game_user.user_id', '=', $userId);
            })
            ->select('games.*') // Seleziona tutte le colonne della tabella games
            ->orderByRaw('ISNULL(game_user.game_id) ASC') // Ordina i giochi per la presenza di corrispondenze
            ->orderBy('games.created_at', 'desc') // Ordina i giochi per data di creazione
            ->get();

            return view('games', ['games' => $games]);
        }
        else return view('games',['games'=> Game::all()]);
    }

    public function AiTools()
    {
        if(Auth::user())
        {
            $userId = Auth::id(); // Ottieni l'ID dell'utente loggato

            $aitools = Aitool::leftJoin('aitool_user', function($join) use ($userId) {
                $join->on('aitools.id', '=', 'aitool_user.aitool_id')
                     ->where('aitool_user.user_id', '=', $userId);
            })
            ->select('aitools.*') // Seleziona tutte le colonne della tabella games
            ->orderByRaw('ISNULL(aitool_user.aitool_id) ASC') // Ordina i giochi per la presenza di corrispondenze
            ->orderBy('aitools.created_at', 'desc') // Ordina i giochi per data di creazione
            ->get();

            return view('aitools', ['aitools' => $aitools,'game'=>'0']);
        }
        else return view('aitools',['aitools'=> Aitool::all(), 'game'=>'0']);
    }

    public function GameAiTools($name)
    {
        // Trova il gioco con il nome specificato
        $game = Game::where('name', $name)->first();
        
        // Verifica se il gioco esiste
        if (!$game) {
            abort(404, 'Game not found');
        }
        
        // Recupera tutti gli AItool collegati al gioco
        $aitools = $game->aitools();

        if(Auth::check()) {
            $userId = Auth::id(); // Ottieni l'ID dell'utente loggato
            
            $aitools = $aitools->leftJoin('aitool_user', function($join) use ($userId) {
                $join->on('aitools.id', '=', 'aitool_user.aitool_id')
                    ->where('aitool_user.user_id', '=', $userId);
            })
            ->select('aitools.*')
            ->orderByRaw('ISNULL(aitool_user.aitool_id) ASC')
            ->orderBy('aitools.created_at', 'desc')
            ->get();
        } else {
            $aitools = $aitools->orderBy('aitools.created_at', 'desc')->get();
        }

        return view('aitools', ['aitools' => $aitools, 'game' => $game]);
    }


    public function AiTool($aitool_name)
    {   
        $decodedName = urldecode($aitool_name);
        // Trova il gioco con l'ID specificato
        $aitool = Aitool::where('name',$decodedName)->first();
        // Verifica se il gioco esiste
        if (!$aitool) {
            // Gestisci il caso in cui il gioco non esiste
            abort(404, 'AiTool not found');
        }
        // Passa gli AItool alla vista
        return view('aitool', ['aitool' => $aitool]);
    }
}
