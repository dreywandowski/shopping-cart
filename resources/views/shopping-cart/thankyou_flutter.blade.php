@extends('shop-layout.layout')
@section('content')

<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="/shop">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$msg}}</strong></div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
              @if($pay == 'ok')
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Thank you!</h2>
            <p class="lead mb-5">Thanks for your order. Here is your reference number: {{$ref}}</p>

              @elseif($pay == 'pending')
                  <span class="icon-error display-3 .text-warning"></span>
                  <h2 class="display-3 text-black">Pending</h2>
                  <p class="lead mb-5">Your payment was successfull but your order cannot be completed. Please take your reference
                      number {{$ref}} to the site admin and lodge a complaint</p>

              @elseif($pay == 'fail')
                  <span class="icon-error display-3 .text-danger"></span>
                  <h2 class="display-3 text-black">Transaction Failed</h2>
                  <p class="lead mb-5">Payment verification failed.Please take your reference
                      number {{$ref}} to the site admin and lodge a complaint</p>
             @endif
            <p><a href="/shop" class="btn btn-sm btn-primary">Back to shop</a></p>
          </div>
        </div>
      </div>
    </div>


.    @endsection
