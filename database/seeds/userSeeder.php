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
           'email'=>'hoang6826812@gmail.com',
           'password'=>password_hash('adminadmin',PASSWORD_DEFAULT),
           'role_id'=> 1,
           'address'=> 'so 19 ngo 449 co nhue 2 Bac tu liem',
           'image'  => '1617259535_IMG_2517.jpg',
           'phone'=> '0354613983',
           'status'=>'active',
           'gioitinh'=>'nam',
           'otp'=> 999999,
           'created_at'=>new DateTime()
       ]);
       DB::table('users')->insert([
        'name'=>'user',
        'email'=>'hoang6816822@gmail.com',
        'password'=>password_hash('adminadmin',PASSWORD_DEFAULT),
        'role_id'=> 1,
        'address'=> 'My dinh nam tu liem ha noi',
        'image'  => '1617259535_IMG_2517.jpg',
        'phone'=> '098776996',
        'status'=>'noneactive',
        'gioitinh'=>'nam',
        'otp'=> 999998,
        'created_at'=>new DateTime()
    ]);
    }
}
