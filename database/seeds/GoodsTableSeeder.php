<?php

use Illuminate\Database\Seeder;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods')->insert(array(
           [
               'container_id' => 1,
               'name'       =>  'Yamaha Motor Cycle',
               'quantity'   =>  "25 Boxes"
           ],

            [
                'container_id' => 1,
                'name'       =>  'Maize',
                'quantity'   =>  "500 bags"
            ],

            [
                'container_id' => 2,
                'name'       =>  'Charcoal',
                'quantity'   =>  "300 bags"
            ],

            [
                'container_id' => 2,
                'name'       =>  'John Deere Tractor',
                'quantity'   =>  "1 Machine"
            ],

            [
                'container_id' => 2,
                'name'       =>  'Cement',
                'quantity'   =>  "800 Bags"
            ],

            [
                'container_id' => 3,
                'name'       =>  'Office Furnitures',
                'quantity'   =>     "5 Set"
            ],
            [
                'container_id' => 3,
                'name'       =>  'Bicycles',
                'quantity'   =>  "30 pieces"
            ],

        ));
    }
}
