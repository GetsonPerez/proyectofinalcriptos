<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        //Usuario admin
//        User::factory(1)->create([
//            "username" => "dev",
//            "name" => "Developer",
//            "password" => bcrypt("admin")
//        ])->each(function (User $user){
//            $user->syncRoles([Role::DEVELOPER]);
//            $user->options()->sync(Option::pluck('id')->toArray());
//            $user->shortcuts()->sync([3,4,5,6]);
//        });

        User::factory(1)->create([
            "username" => "gperez",
            "name" => "Getson Perez",
            "password" => bcrypt("123")
        ])->each(function (User $user){

            $user->syncRoles(Role::SUPERADMIN);

            $user->options()->sync(Option::pluck('id')->toArray());

            $user->shortcuts()->sync(Option::pluck('id')->toArray());

        });

        User::factory(1)->create([
            "username" => "user1",
            "name" => "Amilcar Montejo",
            "password" => bcrypt("123")
        ])->each(function (User $user){

            $user->syncRoles(Role::USER);

            $user->options()->sync([13]);

            $user->shortcuts()->sync([13]);

        });


        User::factory(1)->create([
            "username" => "user2",
            "name" => "Juanito perez",
            "password" => bcrypt("123")
        ])->each(function (User $user){

            $user->syncRoles(Role::USER);

            $user->options()->sync([13]);

            $user->shortcuts()->sync([13]);

        });



    }
}
