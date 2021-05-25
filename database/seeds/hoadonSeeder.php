<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class hoadonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hoadons')->insert([
            'pr_id'=>1,
            'user_id'=>1,
            'sum'=> 0,
            'created_at'=>new DateTime()
        ]);
        DB::table('hoadons')->insert([
            'pr_id'=>2,
            'user_id'=>1,
            'sum'=> 0,
            'created_at'=>new DateTime()
        ]);
        DB::table('hoadons')->insert([
            'pr_id'=>1,
            'user_id'=>2,
            'sum'=> 0,
            'created_at'=>new DateTime()
        ]);
    }
}
// $table->integer('id_pr');
// $table->integer('id_user');
// $table->integer('sum');
// $table->timestamps();