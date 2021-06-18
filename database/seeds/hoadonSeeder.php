<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class hoadonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hoadons')->insert([
            'pr_id'  =>1,
            'user_id'=>1,
            'email'  => 'user1@gmail.com',
            'phone'  => '0354613983',
            'address'=> 'so 1 ngo 446',
            'city'   => 'Ha Noi',
            'zipcode'=> '100000',
            'sum'    => 0,
            'created_at'=>new DateTime()
        ]);
        DB::table('hoadons')->insert([
            'pr_id'  =>2,
            'user_id'=>1,
            'email'  => 'user2@gmail.com',
            'phone'  => '0354613983',
            'address'=> 'so 1 ngo 446',
            'city'   => 'Ha Noi',
            'zipcode'=> '100000',
            'sum'    => 0,
            'created_at'=>new DateTime()
        ]);
        DB::table('hoadons')->insert([
            'pr_id'  =>1,
            'user_id'=>2,
            'email'  => 'user3@gmail.com',
            'phone'  => '0354613983',
            'address'=> 'so 1 ngo 446',
            'city'   => 'Ha Noi',
            'zipcode'=> '100000',
            'sum'    => 0,
            'created_at'=>new DateTime()
        ]);
    }
}