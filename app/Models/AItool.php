<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aitool extends Model
{
    protected $table = 'aitools';

    protected $fillable =[
        'name',
        'authors',
        'description',
        'inputs',
        'method',
        'endpoint',
        'out_file_ext'
    ];

    protected $casts = [
        'inputs' => 'array',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_aitool');
    }
}
