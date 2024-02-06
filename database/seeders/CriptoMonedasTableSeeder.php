<?php

namespace Database\Seeders;

use App\Models\CriptoMoneda;
use Illuminate\Database\Seeder;

class CriptoMonedasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        CriptoMoneda::firstOrCreate([
            'nombre' => 'Bitcoin',
            'simbolo' => 'BTC'
        ]);

        CriptoMoneda::firstOrCreate([
            'nombre' => 'Ethereum',
            'simbolo' => 'ETH'
        ]);

        CriptoMoneda::firstOrCreate([
            'nombre' => 'Tether',
            'simbolo' => 'USDT'
        ]);

        CriptoMoneda::firstOrCreate([
            'nombre' => 'Binance Coin',
            'simbolo' => 'BNB'
        ]);
    }
}
