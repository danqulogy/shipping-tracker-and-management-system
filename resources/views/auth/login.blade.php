@extends('layouts.app')

@section('page_title', 'Login')

@section('local-styles')
    <style>
        body{
            background-image: url('{{asset('img/shipping-2.jpg')}}');
        }

        .login-section{
            margin-top: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row login-section">
            <div class="col"></div>
            <div class="col-6">
                <div class="card">
                    <h3 class="card-header"><i class="fa fa-lock"></i> Sign in to Service...</h3>
                    <div class="card-block">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group {{$errors->has('email') ? ' has-error' : '' }}">
                                <label class="text-bold" for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" value="{{ old('email') }}" name="email" required autofocus aria-describedby="emailHelp" placeholder="Enter email">
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh error!</strong> {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="text-bold" for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input">
                                    Remember my Identity
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="text-center">All rights reserved. &copy; Copyright 2017</p>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

@endsection
