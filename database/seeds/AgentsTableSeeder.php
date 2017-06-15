<?php

use Illuminate\Database\Seeder;

class AgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agents')->insert(array(
           [
               'first_name'     =>  'Owusu',
               'other_names'    =>  'James',
               'phone_number'    =>  '0245495834',
               'email'          =>  'owusujames@gmail.com',
           ],
            [
                'first_name'     =>  'Samuel',
                'other_names'    =>  'Appiah',
                'phone_number'    =>  '0204445834',
                'email'          =>  'appiahsamuel@gmail.com',
            ],
            [
                'first_name'     =>  'Martha',
                'other_names'    =>  'Afram',
                'phone_number'    =>  '0274515834',
                'email'          =>  'martha@gmail.com',
            ],
            [
                'first_name'     =>  'Boakye',
                'other_names'    =>  'Tony',
                'phone_number'    =>  '0542524834',
                'email'          =>  'tonyod44@gmail.com',
            ],
        ));
    }
}
