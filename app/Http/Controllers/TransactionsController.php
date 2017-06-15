<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Container;
use App\Depo;
use App\Recipient;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('transactions')
            ->with('key', 'transactions')
            ->with('page_title', 'Transactions')
            ->with('containers', Container::all())
            ->with('agents', Agent::all())
            ->with('depos', Depo::all())
            ->with('recipients', Recipient::all())
            ->with('transactions', Transaction::all());
    }

    private function validateTransactions(Request $request){
        $validator = Validator::make($request->all(), [
            'sending_depo_id'    =>  'required',
            'recieving_depo_id'   =>  'required',
            'agent_id'            =>  'required',
            'recipient_id'         =>  'required',
            'container_id'         =>   'required',
            'amount_due'           =>   'required'
        ]);
        return $validator;
    }

    public function postRegisterTransaction(Request $request){

        $validator = $this->validateTransactions($request);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

//        return $request->all();

        $transaction = new Transaction();
        $transaction->agent_id      =   $request->get('agent_id');
        $transaction->recipient_id     =   $request->get('recipient_id');
        $transaction->container_id    =   $request->get('container_id');
        $transaction->sending_depo_id  =   $request->get('sending_depo_id');
        $transaction->receiving_depo_id  =   $request->get('recieving_depo_id');
        $transaction->amount_due = $request->get('amount_due');
        $transaction->delivery_status = 0;
        $transaction->token = str_random(2). mt_rand(632514,6999999);
        $transaction->save();

        $data = [
            'receiver'          => Recipient::find($transaction->recipient_id),
            'sender'            =>   Agent::find($transaction->agent_id),
            'container_label'   =>  Container::find($transaction->container_id)->label,
            'depo'              =>  Depo::find($transaction->receiving_depo_id)->name,
            'token'             =>  $transaction->token,
            'timestamp'         =>  $transaction->created_at
        ];

        Mail::send('emails.sender', $data, function($message) use ($data){
           $message->from('admin@mtracker.com', 'MTracker.io');
            $message->to($data['sender']->email, $data['sender']->full_name);
            $message->subject('MTracker Transaction Token');
        });

        Mail::send('emails.receiver', $data, function($message) use ($data){
            $message->from('admin@mtracker.com', 'MTracker.io');
            $message->to($data['receiver']->email, $data['receiver']->full_name);
            $message->subject('MTracker Transaction Token');
        });

        return redirect()->to('/transactions')->with('message', 'The Transaction was successfully created! ');
    }

    public function getEditTransaction($transaction_id){
        return view('edit_transaction')
            ->with('key', 'transactions')
            ->with('page_title', 'Edit Transaction')
            ->with('transaction', Transaction::find($transaction_id));
    }

    public function postEditTransaction($transaction_id, Request $request){
        $validator = $this->validateTransactions($request);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $transaction = Transaction::find($transaction_id);
        $transaction->first_name      =   $request->get('first_name');
        $transaction->other_names     =   $request->get('other_names');
        $transaction->phone_number    =   $request->get('phone_number');
        $transaction->email           =   $request->get('email');
        $transaction->save();

        return redirect()->back()->with('message', 'Transaction details update was successful!');
    }

    public function getDeleteTransaction($transaction_id, Request $request){
        return view('confirm_delete_transaction')
            ->with('key', 'transactions')
            ->with('page_title', 'Delete Transaction')
            ->with('transaction', Transaction::find($transaction_id));
    }

    public function postDeleteTransaction($transaction_id){
        $transaction = Transaction::find($transaction_id);
        $transaction->delete();
        return redirect()->to('/transactions')->with('message', 'The transaction was successfully deleted.');
    }

    public function confirmTransactionDelivery($transaction_id){
        $transaction = Transaction::find($transaction_id);
        $transaction->delivery_status = 1;
        $transaction->save();

        return redirect()->to('/transactions')->with('message', 'Confirmation Delivery was successful!');
    }

    public function revertDeliveryAction($transaction_id){
        $transaction = Transaction::find($transaction_id);
        $transaction->delivery_status = 0;
        $transaction->save();

        return redirect()->to('/transactions')->with('message', 'The confirmation delivery action has been reverted!');
    }

    public function getUsersListings(){
        return view('users')
            ->with('key', 'users')
            ->with('depos', Depo::all())
            ->with('page_title', 'User Listing')
            ->with('users', User::all());
    }

    public function registerUser(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'depo_id'   =>  'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->depo_id = $request->get('depo_id');
        $user->save();

        return redirect()->back()->with('message', 'A new user for the systen has been created');
    }


}
