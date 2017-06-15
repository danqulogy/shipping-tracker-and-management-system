@extends('layouts.admin')
@section('page_title',$page_title)

@section('local-styles')
    <style>
        body{
            background-image: url({{asset('img/shipping-1.jpg')}});
        }

    </style>                                                         
@endsection

@section('content')


<div class="container">
    <div class="row jumbotron">

        <div class="col-lg-12" style="display: flex;">
            <h3 s style="margin-top: -30px; flex: 2"><a href="{{url('/containers')}}">Containers</a>
                <i class="fa fa-chevron-right"></i>
                {{$container->label}}
                <i class="fa fa-chevron-right"></i>
                Goods</h3>
            <a href="{{url('/container/'.$container->id.'/add-good')}}" class="btn btn-primary" style="margin-top: -30px">
                <i class="fa fa-plus"></i> Add Good to Container
            </a>
        </div>
        <hr style="height: 1px; background: black; width: 100%;">
        <div class="col-lg-12">
            @if(session('message'))
                <div class="alert alert-success" role="alert">
                    <strong>Notification!</strong> {{session('message')}}
                </div>
            @endif
            @if(count($errors)>0)
                    <div class="alert alert-danger" role="alert">
                        <strong>Oops! some errors occured. </strong> {{$errors->first()}}
                    </div>
                @endif
        </div>
        <div class="col-lg-12">
            <table class="table table-striped uppercase table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($goods)>0)
                        @foreach($goods as $good)
                            <tr>
                                <td>{{$good->name}}</td>
                                <td>{{$good->quantity}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="">
                                        <a href="{{url('/container/'.$container->id.'/edit-good/'.$good->id)}}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i> Edit</a>
                                        <a href="{{url('/container/'.$container->id).'/delete-good/'.$good->id}}" class="btn btn-danger">
                                            <i class="fa fa-remove"></i> Remove
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
                                <p class="text-bold align-center fg-green"> There are currently no goods registered!</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
