<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class chitiethoadonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chitiethoadons')->insert([
            'hd_id'=>1,
            'created_at'=>new DateTime()
        ]);
        
        $faker = Faker\Factory::create();
        for ($i=0; $i < 50; $i++) { 
            DB::table('chitiethoadons')->insert([
                'hd_id'=>2,
                'created_at'=>new DateTime()
            ]);
        }
        
    }
}
