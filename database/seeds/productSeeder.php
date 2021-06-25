<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 100; $i++) { 
            DB::table('products')->insert([
                'name'=>$faker->name,
                'id_loaisp'=>'3',
                'price'=>$faker->numberBetween($min = 1000, $max = 900000),
                'soluong'=>$faker->numberBetween($min = 1, $max = 900),
                'img'=>"7_nuoc-hoa-ban-chay-nhat.png",
                'thongtin'=>$faker->text,
                'desc'=>$faker->text,
                'coupe'=>$faker->password,
                'sale'=>$faker->numberBetween($min = 0, $max = 90),
                'created_at'=>new DateTime()
            ]);
        }
    }
}
