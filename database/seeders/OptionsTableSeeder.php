<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \DB::table('options')->delete();

        \DB::table('options')->insert(array (
            0 =>
            array (
                'id' => 1,
                'option_id' => NULL,
                'nombre' => 'Dashboard',
                'ruta' => 'admin.dashboard',
                'descripcion' => NULL,
                'icono_l' => 'fa-chart-line',
                'icono_r' => NULL,
                'orden' => 0,
                'color' => 'text-fuchsia',
                'dev' => 0,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2023-12-18 10:23:32',
                'deleted_at' => '2023-12-18 10:23:32',
            ),
            1 =>
            array (
                'id' => 2,
                'option_id' => NULL,
                'nombre' => 'Admin',
                'ruta' => '',
                'descripcion' => NULL,
                'icono_l' => 'fa-tools',
                'icono_r' => NULL,
                'orden' => 3,
                'color' => 'text-maroon',
                'dev' => 0,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2023-12-18 10:21:15',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'option_id' => 2,
                'nombre' => 'Usuarios',
                'ruta' => 'users.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-users',
                'icono_r' => NULL,
                'orden' => 4,
                'color' => 'text-navy',
                'dev' => 0,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2023-12-18 10:21:15',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'option_id' => 2,
                'nombre' => 'Roles',
                'ruta' => 'roles.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-user-tag',
                'icono_r' => NULL,
                'orden' => 5,
                'color' => 'text-olive',
                'dev' => 0,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2023-12-18 10:21:15',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'option_id' => 2,
                'nombre' => 'Permisos',
                'ruta' => 'permissions.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-key',
                'icono_r' => NULL,
                'orden' => 6,
                'color' => 'text-maroon',
                'dev' => 0,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2023-12-18 10:21:15',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'option_id' => 2,
                'nombre' => 'Configuraciones',
                'ruta' => 'profile.business',
                'descripcion' => NULL,
                'icono_l' => 'fa-cogs',
                'icono_r' => NULL,
                'orden' => 7,
                'color' => 'text-teal',
                'dev' => 0,
                'created_at' => '2021-03-14 21:17:37',
                'updated_at' => '2023-12-18 10:21:15',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'option_id' => NULL,
                'nombre' => 'Developer',
                'ruta' => 'x',
                'descripcion' => NULL,
                'icono_l' => 'fa-file-code',
                'icono_r' => NULL,
                'orden' => 8,
                'color' => 'text-orange',
                'dev' => 1,
                'created_at' => '2021-03-14 21:11:34',
                'updated_at' => '2023-12-18 10:21:15',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'option_id' => 7,
                'nombre' => 'Prueba API\'S',
                'ruta' => 'dev.prueba.api',
                'descripcion' => NULL,
                'icono_l' => 'fa-check-circle',
                'icono_r' => NULL,
                'orden' => 11,
                'color' => 'text-lime',
                'dev' => 1,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2023-12-18 10:21:15',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'option_id' => 7,
                'nombre' => 'Configuraciones',
                'ruta' => 'dev.configurations.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-cogs',
                'icono_r' => NULL,
                'orden' => 10,
                'color' => 'text-navy',
                'dev' => 1,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2023-12-18 10:21:15',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'option_id' => 7,
                'nombre' => 'Clientes Passport',
                'ruta' => 'dev.passport.clients',
                'descripcion' => NULL,
                'icono_l' => 'fa-passport',
                'icono_r' => NULL,
                'orden' => 12,
                'color' => 'text-olive',
                'dev' => 1,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2023-12-18 10:21:15',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'option_id' => 7,
                'nombre' => 'Menu',
                'ruta' => 'options.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-list',
                'icono_r' => NULL,
                'orden' => 9,
                'color' => 'text-fuchsia',
                'dev' => 1,
                'created_at' => '2020-08-26 11:46:42',
                'updated_at' => '2023-12-18 10:21:15',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'option_id' => NULL,
                'nombre' => 'Catálogo Criptomonedas',
                'ruta' => 'criptoMonedas.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-brands fa-bitcoin',
                'icono_r' => NULL,
                'orden' => 2,
                'color' => NULL,
                'dev' => 0,
                'created_at' => '2023-12-18 10:07:29',
                'updated_at' => '2023-12-18 10:21:15',
                'deleted_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'option_id' => NULL,
                'nombre' => 'Histórico de simulaciones',
                'ruta' => 'transacciones.index',
                'descripcion' => NULL,
                'icono_l' => 'fa-right-left',
                'icono_r' => NULL,
                'orden' => 1,
                'color' => NULL,
                'dev' => 0,
                'created_at' => '2023-12-18 10:15:16',
                'updated_at' => '2023-12-18 10:21:25',
                'deleted_at' => NULL,
            ),
        ));

        $this->genraColoresIcons();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

    public function genraColoresIcons()
    {

        foreach (Option::all() as $index => $item) {

            $colores = [
                'text-indigo',
                'text-lightblue',
                'text-navy',
                'text-purple',
                'text-fuchsia',
                'text-pink',
                'text-maroon',
                'text-orange',
                'text-lime',
                'text-teal',
                'text-olive',
            ];

            $item->color = array_random($colores);
            $item->save();
        }

    }
}
