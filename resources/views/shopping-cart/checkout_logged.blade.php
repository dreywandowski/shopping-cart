@extends('shop-layout.layout')
@section('content')

<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="/shop">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$page}}</strong></div>
        </div>
      </div>
    </div>
<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="border p-4 rounded" role="alert">

                <div class="col-md-12">
              @if(Auth::check())
              @else

                        You need to <a href="/register">register</a> before making an order.<br> <br>
                        Returning customer? <a href="/shopping-cart/checkout_logged">Click here</a> to login
                </div>
            </div>
        </div>

        @endif
<form method = "post" action="{{ route('paystack') }}" >
    @csrf

<span id="ajaxRep" style="color:green"></span>
        <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
                <h2 class="h3 mb-3 text-black">Billing Details</h2>
                <div class="p-3 p-lg-5 border">
                    <div class="form-group">
                        <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_state_country" name="country" readonly value="<?php if (Auth::user()){
                            echo Auth::user()->country;
                        }
                        else echo ""; ?>">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_fname" class="text-black">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" readonly value="<?php if (Auth::user()){
                                echo Auth::user()->name;
                            }
                            else echo ""; ?>">
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address" readonly value="<?php if (Auth::user()){
                                echo Auth::user()->address1;
                            }
                            else echo ""; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)" readonly value="<?php if (Auth::user()){
                            echo Auth::user()->address2;
                        }
                        else echo ""; ?>">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="c_state_country" class="text-black">State <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_state_country" name="c_state_country" readonly value="<?php if (Auth::user()){
                                echo Auth::user()->state;
                            }
                            else echo ""; ?>">
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>

                    <div class="form-group row mb-5">
                        <div class="col-md-6">
                            <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email" name="email" readonly value="<?php if (Auth::user()){
                                echo Auth::user()->email;
                            }
                            else echo ""; ?>" placeholder="test@mail.com">
                        </div>
                        <div class="col-md-6">
                            <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" readonly value="<?php if (Auth::user()){
                                echo Auth::user()->phone;
                            }
                            else echo ""; ?>" placeholder="Phone Number">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="c_order_notes" class="text-black">Order Notes</label>
                        <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                    </div>

                </div>
            </div>
          <div class="col-md-6">


              @if($data != null)
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        @foreach($row as $item)
                 <input type="text" class='hide' hidden value="{{ $item['name'] }} x {{ $item['number'] }}" readonly>

                      <tr>
                        <td>{{ $item['name'] }} <strong class="mx-2">x</strong> {{ $item['number'] }}</td>
                        <td class="price">NGN {{ $item['price'] }}</td>
                      </tr>
                      @endforeach
                    @endforeach
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td class="text-black finPrice"><strong>$350.00</strong></td>
                      </tr>
                    </tbody>
                  </table>

                    <input id = "amt" type="text" name='amount' hidden>
@endif
                  <div class="border p-3 mb-3">

                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Pay with Paystack</a></h3>

                    <div class="collapse" id="collapsebank">
                        <label for="paystack" class="text-black"></label>
                        <input type="radio" name = "pay_type" id="pay_type" value="PAYSTACK" required>
                      <div class="py-2"><img src="/images/paystack-secured-300x147.png" alt="pay thru paysrack">
                        <p class="mb-0">You will be redirected to the Paystack payment interface where you will be able to make payment securely</p>
                      </div>
                    </div>
                  </div>
                    <div class="border p-3 mb-3">

                        <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Pay with REMITA</a></h3>

                        <div class="collapse" id="collapsebank">
                            <label for="remita" class="text-black"></label>
                            <input type="radio" name = "pay_type" id="pay_type" value="REMITA" required>
                            <div class="py-2"><img src="/images/New-Remita-Logo-Payoff-1-e1503309784658.png" alt="pay thru remita">
                                <p class="mb-0">You will be redirected to the REMITA payment interface where you will be able to make payment securely</p>
                            </div>
                        </div>
                    </div>
                  <div class="border p-3 mb-3">

                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Pay with Flutterwave</a></h3>

                    <div class="collapse" id="collapsecheque">
                        <label for="flutterwave" class="text-black"></label>
                        <input type="radio" name = "pay_type" id="pay_type" value="FLUTTERWAVE" required>
                      <div class="py-2"><img src="/images/fw-1.png" alt="pay thru flutterwave">
                        <p class="mb-0">You will be redirected to the Flutterwave payment interface where you will be able to make payment securely.</p>
                      </div>

                    </div>
                  </div>
                  </div>
                  <div class="form-group">

                      <button class="btn btn-primary btn-lg py-3 btn-block" type="submit" id="pay">Place Order</button>
                  </div>


                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
</form>
@endsection
