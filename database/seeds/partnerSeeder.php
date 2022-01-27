<?php

use Illuminate\Database\Seeder;

class partnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Partner::class, 4)->create();
    }
}
