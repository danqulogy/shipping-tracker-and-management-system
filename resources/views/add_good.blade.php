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
            <h3 s style="margin-top: -30px; flex: 2"><a href="{{url('/recipients')}}">Containers</a>
                <i class="fa fa-chevron-right"></i>
                {{$container->label}}
                <i class="fa fa-chevron-right"></i>
                Add New Good</h3>
            <a href="{{url('/containers')}}" class="btn btn-primary" style="margin-top: -30px">
                <i class="fa fa-chevron-back"></i> Back to Containers Listing
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
        <div class="col-lg-12 row">
            <div class="col"></div>
            <form method="post" action="{{'/container/'.$container->id.'/add-good'}}" class="col-lg-6 modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter <small class="bg-info text-bold padding5 curvy fg-white" >
                            new good </small> Details</h5>

                </div>
                <div class="modal-body">
                    <div>
                        {{csrf_field()}}
                        <div class="form-group {{$errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Goods Name or Description</label>
                            <input type="text" required class="form-control" id="name" name="name">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('name') }}</small></strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('quantity') ? ' has-error' : '' }}">
                            <label for="name">Quantity Description</label>
                            <input type="text" required class="form-control" id="quantity" name="quantity">
                            @if ($errors->has('quantity'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('quantity') }}</small></strong>
                                </span>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{url('/containers')}}" class="btn btn-secondary" data-dismiss="modal">Go Back</a>
                    <button type="submit" class="btn btn-primary">Add to Container</button>
                </div>
            </form>
            <div class="col"></div>
        </div>


        </div>
    </div>
</div>
@endsection
