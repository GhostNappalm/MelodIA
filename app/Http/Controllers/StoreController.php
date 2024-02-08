<?php

namespace App\Http\Controllers;
use App\Models\ChartHistory;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function store(Request $request)
{
    // Esempio: salvare un nuovo ChartHistory con file e dati JSON
    $chartHistory = new ChartHistory();
    $chartHistory->user_id = auth()->user()->id;
    $chartHistory->aitool_name = $request->aitool_name;
    $chartHistory->file = $request->file('file')->store('files'); // Salva il file nel percorso 'storage/app/files'
    $chartHistory->inputs = json_encode($request->inputs);
    $chartHistory->save();

    /* Restituisci una risposta o reindirizza come necessario 
    Assicurati di utilizzare l'attributo enctype="multipart/form-data" nel tuo modulo HTML quando si inviano file binari tramite POST.
    */
}
}
