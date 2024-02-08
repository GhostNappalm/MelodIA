<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ChartHistory;
use App\Models\Game;
use App\Models\Aitool;


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

    public function favGame_flag(Request $request)
    {
        $user = Auth::user();
        $game_id = $request->input('game_id');
        $game = Game::find($game_id);

            if ($user->favgames()->find($game_id)) {
                $user->favGames()->detach($game);
                return response()->json(['message' => 'Game removed from favorites','state' => '1']);
            } else {
                $user->favGames()->attach($game);
                return response()->json(['message' => 'Game added to favorites','state' => '0']);
            }

    }

    public function favAitool_flag(Request $request)
    {
        $user = Auth::user();
        $aitool_id = $request->input('aitool_id');
        $aitool = Aitool::find($aitool_id);

            if ($user->favAitools()->find($aitool_id)) {
                $user->favAitools()->detach($aitool);
                return response()->json(['message' => 'Game removed from favorites','state' => '1']);
            } else {
                $user->favAitools()->attach($aitool);
                return response()->json(['message' => 'Game added to favorites','state' => '0']);
            }

    }
}
