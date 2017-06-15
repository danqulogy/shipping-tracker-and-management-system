<?php

use Illuminate\Database\Seeder;

class ContainersSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('containers')->insert(array(
           [
               'label' => 'MT25140015',
               'transaction_engagement' => 1,
               'created_at' =>  \Carbon\Carbon::now(),
               'updated_at' => \Carbon\Carbon::now()
           ],
            [
                'label' => 'MT25140016',
                'transaction_engagement' => 1,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'label' => 'MT25140017',
                'transaction_engagement' => 1,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ));
    }
}
