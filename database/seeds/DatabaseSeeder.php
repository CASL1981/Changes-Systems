<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CentersTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(DocumentsTableSeeder::class);
        $this->call(SolicitudesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
