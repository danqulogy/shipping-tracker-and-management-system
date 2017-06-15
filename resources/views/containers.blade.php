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
            <h3 s style="margin-top: -30px; flex: 2"> Containers Listings</h3>
            <a href="{{url('/containers/generate')}}" type="button" class="btn btn-primary" style="margin-top: -30px">
                <i class="fa fa-plus"></i> Generate New Container
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
                        <th>Container Label</th>
                        <th>Num. of Goods</th>
                        <th>Transaction Engagement</th>
                        <th>Created on</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($containers)>0)
                        @foreach($containers as $container)
                            <tr>
                                <td>{{$container->label}}</td>
                                <td style="text-align: center">{{$container->number_of_goods}}</td>
                                <td style="text-align: center">@if($container->state)
                                        <i style="color:red;" class="fa fa-exclamation" aria-hidden="true"></i>
                                    @else
                                        <i style="color:green" class="fa fa-check"></i>
                                    @endif</td>
                                <td>{{$container->created_at}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="">
                                        <a href="{{url('/container/'.$container->id.'/add-good')}}" class="btn btn-success"><i class="fa fa-add"></i> Add Good</a>
                                        <a href="{{url('/containers/'.$container->id.'/goods')}}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i> View Goods</a>
                                        <a href="{{url('/containers/delete/'.$container->id)}}" class="btn btn-danger">
                                            <i class="fa fa-remove"></i> Delete Container
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
                                <p class="text-bold align-center fg-green"> There are currently no containers registered!</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
