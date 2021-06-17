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
            'name'=>'nuoc hoa cho nam',
            'id_loaisp'=>'1',
            'price'=>99000,
            'soluong'=>2,
            'img'=>'1623332171_nuoc-hoa-ban-chay-nhat.png',
            'thongtin'=>'san pham chat luong',
            'desc'=>'khong co mo ta',
            'coupe'=>'',
            'sale'=>0,
            'created_at'=>new DateTime()
        ]);
        DB::table('products')->insert([
            'name'=>'quan ao cho nu',
            'id_loaisp'=>'2',
            'price'=>25000,
            'soluong'=>3,
            'img'=>'1623332171_nuoc-hoa-ban-chay-nhat.png',
            'thongtin'=>'san pham tot',
            'desc'=>'co mo ta',
            'coupe'=>'',
            'sale'=>0,
            'created_at'=>new DateTime()
        ]);
        DB::table('products')->insert([
            'name'=>'quan ao cho a',
            'id_loaisp'=>'3',
            'price'=>25000,
            'soluong'=>3,
            'img'=>'1623332171_nuoc-hoa-ban-chay-nhat.png',
            'thongtin'=>'san pham tot',
            'desc'=>'co mo ta',
            'coupe'=>'',
            'sale'=>0,
            'created_at'=>new DateTime()
        ]);
        DB::table('products')->insert([
            'name'=>'quan ao cho nu',
            'id_loaisp'=>'2',
            'price'=>25000,
            'soluong'=>3,
            'img'=>'1623332171_nuoc-hoa-ban-chay-nhat.png',
            'thongtin'=>'san pham tot',
            'desc'=>'co mo ta',
            'coupe'=>'',
            'sale'=>0,
            'created_at'=>new DateTime()
        ]);
        DB::table('products')->insert([
            'name'=>'quan ao cho afaf',
            'id_loaisp'=>'2',
            'price'=>25000,
            'soluong'=>3,
            'img'=>'1623332171_nuoc-hoa-ban-chay-nhat.png',
            'thongtin'=>'san pham tot',
            'desc'=>'co mo ta',
            'coupe'=>'',
            'sale'=>0,
            'created_at'=>new DateTime()
        ]);
    }
}
