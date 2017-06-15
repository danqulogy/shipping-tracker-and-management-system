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
            <h3 s style="margin-top: -30px; flex: 2"><a href="{{url('/recipients')}}">Recipients Listings</a>
                <i class="fa fa-chevron-right"></i>
                Edit Recipient
                <i class="fa fa-chevron-right"></i>
                {{$recipient->full_name}}</h3>
            <a href="{{url('/recipients')}}" class="btn btn-primary" style="margin-top: -30px">
                <i class="fa fa-chevron-back"></i> Back to Recipient Listing
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
            <form method="post" action="{{'/recipients/edit/'.$recipient->id}}" class="col-lg-6 modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update <small class="bg-info text-bold padding5 curvy fg-white" >{{$recipient->full_name}}</small> Details</h5>

                </div>
                <div class="modal-body">
                    <div>
                        {{csrf_field()}}
                        <div class="form-group {{$errors->has('email') ? ' has-error' : '' }}">
                            <label for="first_name">First Name</label>
                            <input type="text" value="{{$recipient->first_name}}" required class="form-control" id="first_name" name="first_name">
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                            <strong><small class="form-text fg-red text-muted">{{ $errors->first('first_name') }}</small></strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('other_names') ? ' has-error' : '' }}">
                            <label for="other_names">Other Names</label>
                            <input type="text" value="{{$recipient->other_names}}" pattern="^[a-zA-Z- ]{2,50}$" required class="form-control" name="other_names" id="other_names">
                            @if ($errors->has('other_names'))
                                <span class="help-block">
                            <strong><small class="form-text fg-red text-muted">{{ $errors->first('other_names') }}</small></strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" minlength="10" maxlength="10" value="{{$recipient->phone_number}}" required class="form-control" name="phone_number" id="phone_number">
                            @if ($errors->has('phone_number'))
                                <span class="help-block">
                            <strong><small class="form-text fg-red text-muted">{{ $errors->first('phone_number') }}</small></strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('email') ? ' has-error' : '' }}">
                            <label for="phone_number">Email Address</label>
                            <input type="text" value="{{$recipient->email}}" required class="form-control" name="email" id="email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                            <strong><small class="form-text fg-red text-muted">{{ $errors->first('email') }}</small></strong>
                        </span>
                            @endif
                        </div>




                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{url('/recipients')}}" class="btn btn-secondary" data-dismiss="modal">Go Back</a>
                    <button type="submit" class="btn btn-primary">Update Recipient Details</button>
                </div>
            </form>
            <div class="col"></div>
        </div>


        </div>
    </div>
</div>
@endsection
