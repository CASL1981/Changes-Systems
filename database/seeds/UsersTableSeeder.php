<?php

use App\Center;
use App\Position;
use App\User;
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
        factory(App\User::class)->create([
                'firstname'   => 'Carlos',
                'lastname'    => 'Sibaja',
                'email'       => 'carlos@yahoo.es',
                'password'    => bcrypt('admin'),
                'area'        => 'administracion',
                'role'        => 'admin',
                'position_id' => 1,
                'center_id'	  => 1
            ]);

        factory(App\User::class, 20);
    }
}
