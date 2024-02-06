<?php

namespace Database\Factories;

use App\Models\UserBilletera;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Criptomoneda;
use App\Models\User;

class UserBilleteraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserBilletera::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        return [
            'user_id' => User::all()->random()->id,
            'criptomoneda_id' => Criptomoneda::all()->random()->id,
            'saldo' => $this->faker->randomFloat(6, 0, 10.999999),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
