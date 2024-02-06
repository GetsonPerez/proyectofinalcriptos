<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserBilletera;
use Illuminate\Database\Seeder;

class UserBilleterasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        UserBilletera::truncate();

        foreach (User::all() as $index => $user) {

            $criptomonedas = \App\Models\Criptomoneda::all();

//            foreach ($criptomonedas as $key => $cipto) {
//                UserBilletera::factory()->count(1)->create([
//                    'user_id' => $user->id,
//                    'criptomoneda_id' => $cipto->id,
//                    'saldo' => 0,
//                ]);
//            }

        }

    }
}
