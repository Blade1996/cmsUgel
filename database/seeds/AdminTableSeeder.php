
<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            [
                'id' => 1,
                'name' => 'Ichu',
                'type' => 'admin',
                'email' => 'admin@ugel.com',
                'password' => '$2y$10$1YE0fji.pxz.g4S./hIRdOHUvVN7RYvD.vaAHWaC4qzFE3JbK8CUu',
                'image' => '',
                'activated' => 1,
            ],
        ];

        DB::table('admins')->insert($adminRecords);
    }
}
