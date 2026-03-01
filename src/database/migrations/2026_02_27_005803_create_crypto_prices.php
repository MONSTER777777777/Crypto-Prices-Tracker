<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crypto_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coin_id')->references('id')->on('cryptos')->onDelete('cascade');
            $table->string('symbol');
            $table->string('name', 255);
            $table->string('image')->nullable();
            $table->decimal('current_price', 30, 8);
            $table->decimal('market_cap', 30, 8);
            $table->integer('market_cap_rank')->nullable();
            $table->decimal('total_volume', 30, 8);
            $table->decimal('high_24h', 30, 8);
            $table->decimal('low_24h', 30, 8);
            $table->decimal('price_change_percentage_1h', 10, 4)->nullable();
            $table->decimal('price_change_percentage_24h', 10, 4)->nullable();
            $table->timestamp('last_updated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_prices');
    }
};
