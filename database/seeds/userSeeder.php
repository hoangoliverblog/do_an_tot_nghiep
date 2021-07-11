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
           'image'  => '1617259535_IMG_2517.jpg',
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
        'image'  => '1617259535_IMG_2517.jpg',
        'phone'=> '098776996',
        'status'=>'noneactive',
        'gioitinh'=>'nam',
        'otp'=> 999998,
        'created_at'=>new DateTime()
        ]);

        $faker = Faker\Factory::create();
        for ($i=0; $i < 5; $i++) { 
            DB::table('users')->insert([
                'name'=>$faker->userName,
                'email'=>$faker->freeEmail,
                'password'=>password_hash($faker->password,PASSWORD_DEFAULT),
                'role_id'=> 2,
                'address'=> $faker->address,
                'image'  => $faker->numberBetween($min = 1, $max = 10).'_user.jpg',
                'phone'=> $faker->phoneNumber,
                'status'=>'active',
                'gioitinh'=>'nam',
                'otp'=> $faker->numberBetween($min = 100000, $max = 999999),
                'created_at'=>new DateTime()
                ]);
        
        }

    }
}
