<?php

use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert(array(
           [
               'agent_id'       =>  1,
               'recipient_id'   =>  4,
               'container_id'   =>  1,
               'sending_depo_id' => 1,
               'receiving_depo_id' => 2,
               'token'  =>      '56782939',
               'amount_due' =>  50.00
           ],
            [
                'agent_id'       =>  2,
                'recipient_id'   =>  3,
                'container_id'   =>  2,
                'sending_depo_id' => 1,
                'receiving_depo_id' => 3,
                'token'  =>      '48561425',
                'amount_due' =>  120.00
            ],
            [
                'agent_id'       =>  3,
                'recipient_id'   =>  2,
                'container_id'   =>  3,
                'sending_depo_id' => 1,
                'receiving_depo_id' => 4,
                'token'  =>      '78943216',
                'amount_due' =>  45.00
            ]
        ));
    }
}
