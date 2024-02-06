<?php

namespace Database\Factories;

use App\Models\CriptomonedaTransaccion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\CriptoMoneda;
use App\Models\User;

class CriptomonedaTransaccionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CriptomonedaTransaccion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $criptomoneda = CriptoMoneda::all()->random();

        $preciosCriptomondesa = [
            'BTC' => '41436.11',
            'ETH' => '2161.00',
            'USDT' => '1',
            'BNB' => '238.20',
        ];

        $cantida = $this->faker->randomFloat(2, 0, 10);
        $precioUsd = $cantida * $preciosCriptomondesa[$criptomoneda->simbolo];
        $precioQuetzal =  $precioUsd * 7.75;

        return [
            'criptomoneda_id' => $criptomoneda->id,
            'user_id' => User::all()->random()->id,
            'tipo' => $this->faker->randomElement([CriptomonedaTransaccion::TIPO_VENTA, CriptomonedaTransaccion::TIPO_COMPRA]),
            'cantidad' => $cantida,
            'precio_usd' => $precioUsd,
            'precio_quetzal' => $precioQuetzal,
            'created_at' => Carbon::now()->addDays(rand(-15, 15)),
            'updated_at' => null
        ];
    }
}
