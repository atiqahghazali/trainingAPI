@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <table class="table"> 
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Price</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody>
        @foreach($houses as $house)
        <tr>
            <td>{{$house['id']}}</td>
            <td>{{$house['type']}}</td>
            <td>{{$house['price']}}</td>
            <td><button onclick="location.href='{{route('purchase:store',$house['id'])}}'">Buy</button></td>
        </tr>
        @endforeach
    </tbody>
</table>
<h5>My Purchases</h5>
<table class="table"> 
    <thead>
        <tr>
            <th>House</th>
            <th>Price</th>
            <th>Payment Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($purchases as $purchase)
        <tr>
            <td>{{$purchase['house_id']}}</td>
            <td>{{$purchase['real_amount']}}</td>
            <td>
                @if($purchase['payment_status'] == 0)  
                    Not Paid
                @else
                    Paid
                @endif
            </td>
            <td>
                @if($purchase['payment_status'] == 0)
                    <a href="{{$purchase['payment_link']}}" class="btn btn-success">Pay</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    <passport-token></passport-token>
</div>
@endsection
