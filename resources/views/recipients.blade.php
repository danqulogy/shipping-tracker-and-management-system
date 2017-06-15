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
    {{--Add new Recipient Modal--}}
    <form method="post" action="{{url('/recipients/register')}}" class="modal fade" id="addNewRecipientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Register new Recipient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        {{csrf_field()}}
                        <div class="form-group {{$errors->has('email') ? ' has-error' : '' }}">
                            <label for="first_name">First Name</label>
                            <input type="text" value="{{old('first_name')}}" required class="form-control" id="first_name" name="first_name">
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('first_name') }}</small></strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('other_names') ? ' has-error' : '' }}">
                            <label for="other_names">Other Names</label>
                            <input type="text" pattern="^[a-zA-Z- ]{2,50}$" value="{{old('other_names')}}" required class="form-control" name="other_names" id="other_names">
                            @if ($errors->has('other_names'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('other_names') }}</small></strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" minlength="10" maxlength="10" value="{{old('phone_number')}}" required class="form-control" name="phone_number" id="phone_number">
                            @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('phone_number') }}</small></strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('email') ? ' has-error' : '' }}">
                            <label for="phone_number">Email Address</label>
                            <input type="text" value="{{old('email')}}" required class="form-control" name="email" id="email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('email') }}</small></strong>
                                </span>
                            @endif
                        </div>




                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Recipient</button>
                </div>
            </div>
        </div>
    </form>



<div class="container">
    <div class="row jumbotron">

        <div class="col-lg-12" style="display: flex;">
            <h3 s style="margin-top: -30px; flex: 2"> Recipients Listings</h3>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewRecipientModal" style="margin-top: -30px">
                <i class="fa fa-plus"></i> Add New Recipient
            </button>
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
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($recipients)>0)
                        @foreach($recipients as $recipient)
                            <tr>
                                <td>{{$recipient->full_name}}</td>
                                <td>{{$recipient->phone_number}}</td>
                                <td>{{$recipient->email}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="">
                                        {{--<button class="bt btn-success"><i class="fa fa-send"></i> Transport Goods</button>--}}
                                        <a href="{{url('/recipients/edit/'.$recipient->id)}}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i> Edit Recipient</a>
                                        <a href="{{url('/recipients/delete/'.$recipient->id)}}" class="btn btn-danger">
                                            <i class="fa fa-remove"></i> Remove
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
                                <p class="text-bold align-center fg-green"> There are currently no recipients registered!</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
