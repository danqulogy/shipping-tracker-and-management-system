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
    <form method="post" action="{{url('/transactions/register')}}" class="modal fade" id="addNewTransactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Register new Transaction - ({{\App\Depo::find(\Illuminate\Support\Facades\Auth::user()->depo_id)->name}})</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        {{csrf_field()}}

                        <div class="form-group {{$errors->has('agent_id') ? ' has-error' : '' }}">
                            <label for="agent_id">Select Agent</label>
                            <select required class="form-control" id="agent_id" name="agent_id">
                                <option value="">-- Select Agent --</option>
                                @foreach($agents as $agent)
                                    <option value="{{$agent->id}}">{{$agent->full_name . ' ('. $agent->email .')'}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('agent_id'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('agent_id') }}</small></strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('recipient_id') ? ' has-error' : '' }}">
                            <label for="recipient_id">Select Recipient</label>
                            <select required class="form-control" id="recipient_id" name="recipient_id">
                                <option value="">-- Select recipient --</option>
                                @foreach($recipients as $recipient)
                                    <option value="{{$recipient->id}}">{{$recipient->full_name . ' ('. $recipient->email .')'}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('recipient_id'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('recipient_id') }}</small></strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group {{$errors->has('recieving_depo_id') ? ' has-error' : '' }}">
                            <label for="phone_number">Select destination</label>
                            <select required class="form-control" name="recieving_depo_id" id="recieving_depo_id">
                                @foreach($depos as $depo)
                                    @if($depo->id != \Illuminate\Support\Facades\Auth::user()->depo_id)
                                        <option value="{{$depo->id}}">{{$depo->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('recieving_depo_id'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('recieving_depo_id') }}</small></strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('container_id') ? ' has-error' : '' }}">
                            <label for="phone_number">Select Container</label>
                            <select required class="form-control" name="container_id" id="container_id">
                                @foreach($containers as $container)
                                    <option value="{{$container->id}}">{{$container->label}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('container_id'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('container_id') }}</small></strong>
                                </span>
                            @endif
                        </div>



                        <div class="form-group {{$errors->has('amount_due') ? ' has-error' : '' }}">
                            <label for="amount_due">Amount Due</label>
                            <input type="number" required class="form-control" name="amount_due" id="amount_due">
                            @if ($errors->has('amount_due'))
                                <span class="help-block">
                                    <strong><small class="form-text fg-red text-muted">{{ $errors->first('amount_due') }}</small></strong>
                                </span>
                            @endif
                        </div>




                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Transaction</button>
                </div>
            </div>
        </div>
    </form>



<div class="container">
    <div class="row jumbotron">

        <div class="col-lg-12" style="display: flex;">
            <h3 s style="margin-top: -30px; flex: 2"> Transactions Listings</h3>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewTransactionModal" style="margin-top: -30px">
                <i class="fa fa-plus"></i> Add New Transaction
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
                        <th>Agent Name</th>
                        <th>Recipient Name</th>
                        <th>Transaction Token</th>
                        <th>Container Label</th>
                        <th>Delivery Status</th>
                        <th>Confirmation</th>

                    </tr>
                </thead>
                <tbody>
                    @if(count($transactions)>0)
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{\App\Agent::find($transaction->agent_id)->full_name}}</td>
                                <td>{{\App\Recipient::find($transaction->recipient_id)->full_name}}</td>
                                <td>{{strtoupper($transaction->token)}}</td>
                                <td>{{\App\Container::find($transaction->container_id)['label']}}</td>
                                <td style="text-align: center">
                                    @if($transaction->delivery_status == 0) <span style="color:red"><i class="fa fa-exclamation"></i> Pending</span> @endif
                                    @if($transaction->delivery_status == 1) <span style="color:green"><i class="fa fa-check"></i> Delivered</span> @endif
                                </td>
                                <td>
                                    @if($transaction->delivery_status == 0)
                                        <a href="{{url('/transaction/'.$transaction->id.'/confirm_delivery')}}" class="btn btn-info">Confirm Delivery</a>
                                    @endif
                                    @if($transaction->delivery_status == 1)
                                            <a href="{{url('/transaction/'.$transaction->id.'/revert_delivery_action')}}" class="btn btn-success">Revert Action</a>
                                        @endif
                                </td>

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
