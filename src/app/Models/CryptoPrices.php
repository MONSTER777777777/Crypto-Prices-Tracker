<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoPrices extends Model
{
    protected $table = 'crypto_prices';

    protected $fillable = [
        'coin_id',
        'symbol',
        'name',
        'image',
        'current_price',
        'market_cap',
        'market_cap_rank',
        'total_volume',
        'high_24h',
        'low_24h',
        'price_change_percentage_1h',
        'price_change_percentage_24h',
        'last_updated'
    ];

    protected $casts = [
        'current_price'                 => 'decimal:8',
        'market_cap'                    => 'integer',
        'total_volume'                  => 'integer',
        'high_24h'                      => 'decimal:8',
        'low_24h'                       => 'decimal:8',
        'price_change_percentage_1h'    => 'decimal:4',
        'price_change_percentage_24h'   => 'decimal:4',
        'last_updated'                  => 'datetime',
    ];
}
