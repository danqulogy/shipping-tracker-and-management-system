<?php

use Illuminate\Database\Seeder;

class DeposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('depos')->insert(array(
           [
               'name'       =>  'Prefos Depo',
               'town'       =>  'Ejisu',
               'region'     =>  'Ashanti'
           ],

            [
                'name'       =>  'Goodsman Depo',
                'town'       =>  'Tamale',
                'region'     =>  'Northern'
            ],

            [
                'name'       =>  'Golden Depo',
                'town'       =>  'Obuasi',
                'region'     =>  'Ashanti'
            ],

            [
                'name'       =>  'Swift Depo',
                'town'       =>  'Tarkwa',
                'region'     =>  'Western'
            ],

            [
                'name'       =>  'Sunyani Depo',
                'town'       =>  'Sunyani',
                'region'     =>  'Brong-Ahafo'
            ],
        ));
    }
}
