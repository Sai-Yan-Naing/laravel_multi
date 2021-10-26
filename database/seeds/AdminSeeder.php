<?php

use Illuminate\Database\Seeder;
use App\Admin;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     Admin::create([
    //         'name' => 'Admin',
    //         'email' => 'admin@gmail.com',
    //         'password' => bcrypt('welcome123!'),
    //     ]);
    // }
    public function run()
    {
        $data = [
            ['name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('welcome123!'),]

        ];
        DB::table('admins')->insert($data);
    }
}
