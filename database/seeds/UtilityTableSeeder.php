<?php

use Illuminate\Database\Seeder;

class UtilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('utilities')->insert(array(
           [
                'container_label' => 16000
           ]
        ));
    }
}
