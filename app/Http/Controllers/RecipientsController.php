<?php

namespace App\Http\Controllers;

use App\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecipientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('recipients')
            ->with('key', 'recipients')
            ->with('page_title', 'Recipients')
            ->with('recipients', Recipient::all());
    }

    private function validateRecipients(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name'    =>  'required|alpha',
            'other_names'   =>  'required',
            'phone_number'  =>  'required|digits:10',
            'email'         =>  'required|email'
        ]);
        return $validator;
    }

    public function postRegisterRecipient(Request $request){
        $validator = $this->validateRecipients($request);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recipient = new Recipient();
        $recipient->first_name      =   $request->get('first_name');
        $recipient->other_names     =   $request->get('other_names');
        $recipient->phone_number    =   $request->get('phone_number');
        $recipient->email           =   $request->get('email');
        $recipient->save();

        return redirect()->back()->with('message', 'Recipient registration has been successful!');
    }

    public function getEditRecipient($recipient_id){
        return view('edit_recipient')
            ->with('key', 'recipients')
            ->with('page_title', 'Edit Recipient')
            ->with('recipient', Recipient::find($recipient_id));
    }

    public function postEditRecipient($recipient_id, Request $request){
        $validator = $this->validateRecipients($request);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recipient = Recipient::find($recipient_id);
        $recipient->first_name      =   $request->get('first_name');
        $recipient->other_names     =   $request->get('other_names');
        $recipient->phone_number    =   $request->get('phone_number');
        $recipient->email           =   $request->get('email');
        $recipient->save();

        return redirect()->back()->with('message', 'Recipient details update was successful!');
    }

    public function getDeleteRecipient($recipient_id, Request $request){
        return view('confirm_delete_recipient')
            ->with('key', 'recipients')
            ->with('page_title', 'Delete Recipient')
            ->with('recipient', Recipient::find($recipient_id));
    }

    public function postDeleteRecipient($recipient_id){
        $recipient = Recipient::find($recipient_id);
        $recipient->delete();
        return redirect()->to('/recipients')->with('message', 'The recipient was successfully deleted.');
    }
}
