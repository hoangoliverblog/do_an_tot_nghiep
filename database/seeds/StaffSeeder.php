<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Staff')->insert([
            'name'=>'nhân viên 1',
            'address'=> 'so 19 ngo 449 co nhue 2 Bac tu liem',
            'image'  => '1617259535_IMG_2517.jpg',
            'phone'=> '0354613983',
            'gioitinh'=>'nam',
            'otp'=> 999999,
            'status'=>'active',
            'email'=>'hoanganh123@gmail.com',
            'password'=>password_hash('adminadmin',PASSWORD_DEFAULT),
            'created_at'=>new DateTime()
        ]);
    }
}
