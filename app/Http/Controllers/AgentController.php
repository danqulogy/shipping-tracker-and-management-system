<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')
            ->with('key', 'agents')
            ->with('page_title', 'Agents')
            ->with('agents', Agent::all());
    }


    private function validateAgents(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name'    =>  'required|alpha',
            'other_names'   =>  'required',
            'phone_number'  =>  'required|digits:10',
            'email'         =>  'required|email'
        ]);
        return $validator;
    }

    public function postRegisterAgent(Request $request){
        $validator = $this->validateAgents($request);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $agent = new Agent();
        $agent->first_name      =   $request->get('first_name');
        $agent->other_names     =   $request->get('other_names');
        $agent->phone_number    =   $request->get('phone_number');
        $agent->email           =   $request->get('email');
        $agent->save();

        return redirect()->back()->with('message', 'Agent registration has been successful!');
    }

    public function getEditAgent($agent_id){
        return view('edit_agent')
            ->with('key', 'agents')
            ->with('page_title', 'Edit Agent')
            ->with('agent', Agent::find($agent_id));
    }

    public function postEditAgent($agent_id, Request $request){
        $validator = $this->validateAgents($request);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $agent = Agent::find($agent_id);
        $agent->first_name      =   $request->get('first_name');
        $agent->other_names     =   $request->get('other_names');
        $agent->phone_number    =   $request->get('phone_number');
        $agent->email           =   $request->get('email');
        $agent->save();

        return redirect()->back()->with('message', 'Agent details update was successful!');
    }

    public function getDeleteAgent($agent_id, Request $request){
        return view('confirm_delete_agent')
            ->with('key', 'agents')
            ->with('page_title', 'Delete Agent')
            ->with('agent', Agent::find($agent_id));
    }

    public function postDeleteAgent($agent_id){
        $agent = Agent::find($agent_id);
        $agent->delete();
        return redirect()->to('/home')->with('message', 'The agent was successfully deleted.');
    }
}
