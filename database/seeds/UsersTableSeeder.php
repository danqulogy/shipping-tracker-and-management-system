<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
           [
               'name'       => 'Kwame Swift',
               'email'      =>  'swift@gmail.com',
               'password'   =>  \Illuminate\Support\Facades\Hash::make('password'),
               'depo_id'    =>  1
           ]
        ));
    }
}
