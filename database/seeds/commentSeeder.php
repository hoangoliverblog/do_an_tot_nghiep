<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class commentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('comments')->insert([
            'user_id'=>1,
            'pr_id'=>1,
            'content'=>'san pham kha tot'
        ]);
       
        $faker = Faker\Factory::create();
        for ($i=0; $i < 5; $i++) { 
            DB::table('comments')->insert([
                'user_id'=>2,
                'pr_id'=>1,
                'content'=>$faker->text
            ]);
        }
    }
}
