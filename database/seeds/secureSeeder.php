<?php

use Illuminate\Database\Seeder;

class secureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Secure', 3)->create();
    }
}
