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
    {{--Add new Transaction Modal--}}
    <form method="post" action={{ url('/users/register') }} class="modal fade" id="addNewTransactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Register new User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        {{csrf_field()}}

                        <div class="form-group {{$errors->has('name') ? ' has-error' : '' }}">
                            <label for="agent_id">Full Name</label>
                            <input type="text" value="{{old('name')}}" required class="form-control" id="name" name="name"/>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('name') }}</small></strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('email') ? ' has-error' : '' }}">
                            <label for="recipient_id">Email Address</label>
                            <input type="email" required class="form-control" id="email" name="email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('email') }}</small></strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('password') ? ' has-error' : '' }}">
                            <label for="phone_number">Password</label>
                            <input type="password" required class="form-control" name="password" id="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('password') }}</small></strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('password') ? ' has-error' : '' }}">
                            <label for="phone_number">Password</label>
                            <input type="password" required class="form-control" name="password_confirmation" id="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('password') }}</small></strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('depo_id') ? ' has-error' : '' }}">
                            <label for="phone_number">Select Depo</label>
                            <select required class="form-control" name="depo_id" id="depo_id">
                                @foreach($depos as $depo)
                                    <option value="{{$depo->id}}">{{$depo->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('depo_id'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('depo_id') }}</small></strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>
    </form>



<div class="container">
    <div class="row jumbotron">

        <div class="col-lg-12" style="display: flex;">
            <h3 s style="margin-top: -30px; flex: 2"> Users Listings</h3>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewTransactionModal" style="margin-top: -30px">
                <i class="fa fa-plus"></i> Add New User
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Depo</th>
                        {{--<th>Action</th>--}}
                    </tr>
                </thead>
                <tbody>
                    @if(count($users)>0)
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{\App\Depo::find($user->depo_id)->name}}</td>
                                {{--<td></td>--}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
                                <p class="text-bold align-center fg-green"> There are currently no transactions registered!</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
