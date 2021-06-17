<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class loaisanphamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loaisanphams')->insert([
            'name'=>'nước hoa'
        ]);
        DB::table('loaisanphams')->insert([
            'name'=>'quần áo'
        ]);
        DB::table('loaisanphams')->insert([
            'name'=>'mỹ phẩm'
        ]);
        DB::table('loaisanphams')->insert([
            'name'=>'bộ sản phẩm'
        ]);
        DB::table('loaisanphams')->insert([
            'name'=>'thương hiệu nổi tiếng'
        ]);
    }
}
