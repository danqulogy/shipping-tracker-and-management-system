<?php

use Illuminate\Database\Seeder;

class RecipientsTableSeeder extends Seeder
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
                'first_name'     =>  'Abigail',
                'other_names'    =>  'Amponsah',
                'phone_number'    =>  '05444141424',
                'email'          =>  'abigail.ampong@gmail.com',
            ],
            [
                'first_name'     =>  'Sampson',
                'other_names'    =>  'Attakorah',
                'phone_number'    =>  '0201414514',
                'email'          =>  'sammy1998@gmail.com',
            ],
            [
                'first_name'     =>  'Kwaku',
                'other_names'    =>  'Duah',
                'phone_number'    =>  '05417784454',
                'email'          =>  'kwaku_duah@gmail.com',
            ],
            [
                'first_name'     =>  'Seidu',
                'other_names'    =>  'Mohammed',
                'phone_number'    =>  '0271141414',
                'email'          =>  'seidu990@gmail.com',
            ],
        ));
    }
}
