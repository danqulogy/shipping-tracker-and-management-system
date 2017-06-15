<?php

namespace App\Http\Controllers;

use App\Container;
use App\Good;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContainersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('containers')
            ->with('key', 'containers')
            ->with('page_title', 'Containers')
            ->with('containers', Container::all());
    }

    private function validateContainers(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name'    =>  'required|alpha',
            'other_names'   =>  'required',
            'phone_number'  =>  'required|digits:10',
            'email'         =>  'required|email'
        ]);
        return $validator;
    }

    public function generateNewContainer(Request $request){
        if(count(Container::all()) > 0)
        {
            $mostRecent = Container::all()->last();
            $goodsCount = 0;
//            return $mostRecent;
            if($mostRecent != null){

                $containerGoods = Good::where('container_id', $mostRecent->id)->get();
                $goodsCount = count($containerGoods);
            }

            if($goodsCount > 0 ){
                $container = new Container();
                $util = Utility::find(1);
                $next = $util->container_label + 1;
                $util->container_label = $next;
                $util->save();
                $container->label = 'CT'. $next;
                $container->save();
                return redirect()->back()->with('message', 'A new container is ready for goods label!');
            }else{
                return redirect()->back()->with('message', 'Cannot create container because the most recent container has not been filled with any goods');
            }
        }


        $container = new Container();
        $util = Utility::find(1);
        $next = $util->container_label + 1;
        $util->container_label = $next;
        $util->save();
        $container->label = 'CT'. $next;
        $container->save();
        return redirect()->back()->with('message', 'A new container is ready for goods label!');
    }

    public function addNewGoodToContainer($container_id){
        return view('add_good')
            ->with('key', 'containers')
            ->with('page_title', 'Add New Good')
            ->with('container', Container::find($container_id));
    }

    public function postAddNewGoodToContainer($container_id, Request $request){
        $validator = Validator::make($request->all(), [
            'name'          =>   'required',
            'quantity'      =>  'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $good = new Good();
        $good->container_id = $container_id;
        $good->name = $request->get('name');
        $good->quantity = $request->get('quantity');
        $good->save();

        $container = Container::find($container_id)->label;

        return redirect()->to('/containers')->with('message', 'A new good has been added to container '.$container);

    }

    public function viewContainerGoods($container_id){
        return view('goods')
            ->with('key', 'containers')
            ->with('page_title', 'View Goods')
            ->with('goods', Good::where('container_id', $container_id)->get())
            ->with('container', Container::find($container_id));
    }

    public function getEditGood($container_id, $good_id){

        return view('edit_good')
            ->with('key', 'containers')
            ->with('page_title', 'Edit Good')
            ->with('containers', Container::all())
            ->with('container', Container::find($container_id))
            ->with('good', Good::find($good_id));
    }


    public function postEditGood($container_id, $good_id, Request $request){
        $good = Good::find($good_id);
        $good->name = $request->get('name');
        $good->quantity = $request->get('quantity');
        $good->container_id = $request->get('container_id');
        $good->save();

        return redirect()->to('/containers/'.$container_id.'/goods')->with('message','The update was successful!');
    }

    public function deleteGood($container_id, $good_id){
        $good = Good::find($good_id);
        $good->delete();
        return redirect()->to('/containers')->with('message', 'The removal was successful');
    }





    public function getEditContainer($container_id){
        return view('edit_recipient')
            ->with('key', 'recipients')
            ->with('page_title', 'Edit Container')
            ->with('recipient', Container::find($container_id));
    }

    public function postEditContainer($container_id, Request $request){
        $validator = $this->validateContainers($request);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recipient = Container::find($container_id);
        $recipient->first_name      =   $request->get('first_name');
        $recipient->other_names     =   $request->get('other_names');
        $recipient->phone_number    =   $request->get('phone_number');
        $recipient->email           =   $request->get('email');
        $recipient->save();

        return redirect()->back()->with('message', 'Container details update was successful!');
    }

    public function getDeleteContainer($container_id, Request $request){
        return view('confirm_delete_container')
            ->with('key', 'containers')
            ->with('page_title', 'Delete Container')
            ->with('container', Container::find($container_id));
    }

    public function postDeleteContainer($container_id){
       $goods = Good::where('container_id', $container_id)->get();
       if(count($goods)> 0){
           foreach ($goods as $good) {
               $good->delete();
           }
       }

       $container = Container::find($container_id);
       $container->delete();

        return redirect()->to('/containers')->with('message', 'The container and its content has been successfully deleted.');
    }
}
