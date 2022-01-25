<?php

use App\InterestLink;
use Illuminate\Database\Seeder;

class InterestLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(InterestLink::class, 10)->create();
    }
}
