<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(userSeeder::class);
         $this->call(roleSeeder::class);
         $this->call(commentSeeder::class);
         $this->call(productSeeder::class);
         $this->call(loaisanphamSeeder::class);
         $this->call(cartSeeder::class);
         $this->call(xeploaiSeeder::class);
         $this->call(hoadonSeeder::class);
         $this->call(chitiethoadonSeeder::class);
    }
}
