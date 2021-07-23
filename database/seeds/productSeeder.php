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
        DB::table('products')->insert([
                    'name'=> 'san pham 1',
                    'id_loaisp'=>'1', 
                    'price'=> 88000,
                    'soluong'=>100,
                    'img'=>"7_nuoc-hoa-ban-chay-nhat.png",
                    'thongtin'=>'san pham tot nhat',
                    'desc'=> 'khong có mo ta',
                    'coupe'=>'hadgakga',
                    'sale'=>5,
                    'viewcount'=>0,
                    'producer'=> 'chanel',
                    'created_at'=>new DateTime()
                ]);
                DB::table('products')->insert([
                    'name'=> 'san pham 2',
                    'id_loaisp'=>'2', 
                    'price'=> 88000,
                    'soluong'=>100,
                    'img'=>"7_nuoc-hoa-ban-chay-nhat.png",
                    'thongtin'=>'san pham tot nhat',
                    'desc'=> 'khong có mo ta',
                    'coupe'=>'hadgakga',
                    'sale'=>5,
                    'viewcount'=>0,
                    'producer'=> 'chanel',
                    'created_at'=>new DateTime()
                ]);
                DB::table('products')->insert([
                    'name'=> 'san pham 3',
                    'id_loaisp'=>'3', 
                    'price'=> 88000,
                    'soluong'=>100,
                    'img'=>"7_nuoc-hoa-ban-chay-nhat.png",
                    'thongtin'=>'san pham tot nhat',
                    'desc'=> 'khong có mo ta',
                    'coupe'=>'hadgakga',
                    'sale'=>5,
                    'viewcount'=>0,
                    'producer'=> 'chanel',
                    'created_at'=>new DateTime()
                ]);
        $faker = Faker\Factory::create();
        for ($i=0; $i < 15; $i++) { 
            DB::table('products')->insert([
                'name'=>$faker->name,
                'id_loaisp'=>'1',
                'price'=>$faker->numberBetween($min = 1000, $max = 900000),
                'soluong'=>$faker->numberBetween($min = 1, $max = 900),
                'img'=>"7_nuoc-hoa-ban-chay-nhat.png",
                'thongtin'=>$faker->text,
                'desc'=>$faker->text,
                'coupe'=>$faker->password,
                'sale'=>$faker->numberBetween($min = 0, $max = 90),
                'viewcount'=>0,
                'producer'=> 'chanel',
                'created_at'=>new DateTime()
            ]);
        }
        for ($i=0; $i < 15; $i++) { 
            DB::table('products')->insert([
                'name'=>$faker->name,
                'id_loaisp'=>'2',
                'price'=>$faker->numberBetween($min = 1000, $max = 900000),
                'soluong'=>$faker->numberBetween($min = 1, $max = 900),
                'img'=>"7_nuoc-hoa-ban-chay-nhat.png",
                'thongtin'=>$faker->text,
                'desc'=>$faker->text,
                'coupe'=>$faker->password,
                'sale'=>$faker->numberBetween($min = 0, $max = 90),
                'viewcount'=>0,
                'producer'=> 'chanel',
                'created_at'=>new DateTime()
            ]);
        }
        for ($i=0; $i < 15; $i++) { 
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
                'viewcount'=>0,
                'producer'=> 'chanel',
                'created_at'=>new DateTime()
            ]);
        }
    }
}
