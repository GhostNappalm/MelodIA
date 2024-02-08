<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ChartHistory;
use App\Models\User;
use App\Models\Game;



class UserController extends Controller
{
    public function history()
    {
        return view('history',['charts'=> Auth::user()->chartHistory]);
    }

    public function downloadChart($id)
    {
        // Trova il chart dal database
        $chart = ChartHistory::findOrFail($id);

        // Ottieni il percorso del file dal database (assumendo che 'file' contenga il percorso)
        $filePath = public_path('charts\\' . $chart->file_name);

        // Restituisci una risposta di download con il file
        //echo $filePath;
        return response()->download($filePath, $chart->file_name);
    }

    public function fav_flag(Request $request)
    {
        $user = Auth::user();
        $game_id = $request->input('game_id');
        $game = Game::findOrFail($game_id);

        // Controlla se il gioco è già nei preferiti dell'utente
        if ($user->favgames()->find($game_id)) {
            $user->favGames()->detach($game);
            return response()->json(['message' => 'Game removed from favorites']);
        } else {
            $user->favGames()->attach($game);
            return response()->json(['message' => 'Game added to favorites']);
        }    
    }
}
