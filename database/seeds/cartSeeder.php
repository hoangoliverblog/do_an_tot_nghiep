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
            'hd_id'=>1,
            'user_id'=>1,
            'name'=>'hóa đơn thanh toan',
            'soluong'=>2,
            'sum'=>0,
            'status'=>'chưa giao',
            'created_at'=>new DateTime()
        ]);
        DB::table('carts')->insert([
            'hd_id'=>2,
            'user_id'=>2,
            'name'=>'hóa đơn thanh toán ',
            'soluong'=>3,
            'sum'=>0,
            'status'=>'đã thanh toán',
            'created_at'=>new DateTime()
        ]);
    }
}
