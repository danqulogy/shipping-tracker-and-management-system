<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(DeposTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(AgentsTableSeeder::class);
         $this->call(RecipientsTableSeeder::class);
         $this->call(ContainersSeederTable::class);
         $this->call(GoodsTableSeeder::class);
         $this->call(UtilityTableSeeder::class);

    }
}
