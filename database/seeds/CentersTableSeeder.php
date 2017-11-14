<?php

use Illuminate\Database\Seeder;
use App\Center;

class CentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Center::class, 20)->create();
    }
}
