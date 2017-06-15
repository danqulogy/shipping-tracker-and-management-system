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
                Delete Recipient
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
            <form id="confirmDeleteForm" method="post" action="{{url('/recipients/delete/'.$recipient->id)}}" class="col-lg-6" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                {{csrf_field()}}
                <input type="hidden" name="targetedRecipient">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-times"></i> Confirm Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Do you really want to delete <span class="text-bold">{{$recipient->full_name}}</span> ?<br><br>
                            Click on Continue if your want permanently remove this recipient and related transactions or click on cancel to decline.
                        </div>
                        <div class="modal-footer">
                            <a href="{{url('/recipients')}}" class="btn btn-secondary" data-dismiss="modal">Back to Recipients</a>
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="col"></div>
        </div>


        </div>
    </div>
</div>
@endsection
