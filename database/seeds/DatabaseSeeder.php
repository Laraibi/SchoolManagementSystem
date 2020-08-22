<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
       // DB::table('parents')->truncate();
        // factory(App\StudentParent::class,10)->create();
        factory(App\teacher::class,10)->create();
    }
}
 