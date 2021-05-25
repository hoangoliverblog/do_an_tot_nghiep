<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->insert([
            'role_name'=>'admin'
        ]);
        DB::table('role_users')->insert([
            'role_name'=>'user'
        ]);
    }
}
