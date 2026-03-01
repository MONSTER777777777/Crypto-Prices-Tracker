<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cryptos extends Model
{
    protected $table = 'cryptos';

    protected $fillable = [
        'symbol',
        'name',
    ];

    
}
