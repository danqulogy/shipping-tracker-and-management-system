@extends('layouts.app')

@section('page_title', 'Reset Password')

@section('local-styles')
    <style>
        body{
            background-image: url('{{asset('img/shipping-2.jpg')}}');
        }

        .password-reset-section{
            margin-top: 100px;
        }
    </style>
@endsection


@section('content')
<div class="container">
    <div class="row password-reset-section">
        <div class="col"></div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Reset Password</div>
                <div class="card-block">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group {{$errors->has('email') ? ' has-error' : '' }}">
                            <label class="text-bold" for="email">Enter your Email Address</label>
                            <input type="email" class="form-control" id="email" value="{{ old('email') }}" name="email" required autofocus aria-describedby="emailHelp" placeholder="Enter email">
                            @if ($errors->has('email'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>Oh error!</strong> {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
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
