<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class cartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carts')->insert([
                    'hd_id'=>2,
                    'user_id'=>2,
                    'name'=> 'san pham ',
                    'soluong'=>44,
                    'sum'=>10000,
                    'status'=>'chưa thanh toán',
                    'created_at'=>new DateTime()
                ]);
        $faker = Faker\Factory::create();
        for ($i=0; $i < 50; $i++) { 
            DB::table('carts')->insert([
                'hd_id'=>2,
                'user_id'=>2,
                'name'=> $faker->name,
                'soluong'=>$faker->numberBetween($min = 10, $max = 2000),
                'sum'=>$faker->randomNumber($nbDigits = NULL, $strict = false),
                'status'=>'chưa thanh toán',
                'created_at'=>new DateTime()
            ]);
        }
    }
}
