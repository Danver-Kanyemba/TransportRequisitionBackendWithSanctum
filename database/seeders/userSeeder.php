<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Danver Kanyemba',
            'email' => '23@gmail.com',
            'cell' => '07784 017 784',
            'group_id' => '1',
            'cell' => '1',
            'department_id' => '1',
            'password' => Hash::make('Danver'),



        ]);
    }
}
