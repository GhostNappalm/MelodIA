<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChartHistory extends Model
{
    protected $table = 'charthistory';

    protected $fillable =[
        'user_id',
        'aitool_id',
        'file_name',
        'fileb64',
        'inputs',
        'created_at'
    ];

    protected $casts = [
        'inputs' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
