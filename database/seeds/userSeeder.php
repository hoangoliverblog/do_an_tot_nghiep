<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
           'name'=>'admin',
           'email'=>'hoang682681@gmail.com',
           'password'=>password_hash('adminadmin',PASSWORD_DEFAULT),
           'role_id'=> 1,
           'address'=> 'so 19 ngo 449 co nhue 2 Bac tu liem',
           'phone'=> '0354613983',
           'status'=>'active',
           'gioitinh'=>'nam',
           'otp'=> 999999,
           'created_at'=>new DateTime()
       ]);
       DB::table('users')->insert([
        'name'=>'user',
        'email'=>'hoang681682@gmail.com',
        'password'=>password_hash('adminadmin',PASSWORD_DEFAULT),
        'role_id'=> 1,
        'address'=> 'My dinh nam tu liem ha noi',
        'phone'=> '098776996',
        'status'=>'nonactive',
        'gioitinh'=>'nam',
        'otp'=> 999998,
        'created_at'=>new DateTime()
    ]);
    }
}
