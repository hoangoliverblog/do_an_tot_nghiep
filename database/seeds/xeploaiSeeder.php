<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class xeploaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('xeploais')->insert([
            'pr_id'=>1,
            'level'=>'5'
        ]);
        DB::table('xeploais')->insert([
            'pr_id'=>2,
            'level'=>'4'
        ]);
        DB::table('xeploais')->insert([
            'pr_id'=>3,
            'level'=>'2'
        ]);
    }
}
