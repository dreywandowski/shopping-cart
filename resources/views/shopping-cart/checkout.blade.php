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
                            <input type="text" class="form-control" id="c_fname" name="c_fname" readonly value="<?php if (Auth::user()){
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
                            <input type="text" class="form-control" id="c_email_address" name="c_email_address" readonly value="<?php if (Auth::user()){
                                echo Auth::user()->email;
                            }
                            else echo ""; ?>" placeholder="test@mail.com">
                        </div>
                        <div class="col-md-6">
                            <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_phone" name="c_phone" readonly value="<?php if (Auth::user()){
                                echo Auth::user()->phone;
                            }
                            else echo ""; ?>" placeholder="Phone Number">
                        </div>
                    </div>


              <div class="form-group">
                <label for="c_order_notes" class="text-black">Order Notes</label>
                <textarea name="c_order_notes" readonly id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
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
@endif
                  <div class="border p-3 mb-3">
                    <input type="radio" value="paystack">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Pay with Paystack</a></h3>

                    <div class="collapse" id="collapsebank">
                      <div class="py-2"><img src="/images/paystack-secured-300x147.png" alt="pay thru paysrack">
                        <p class="mb-0">You will be redirected to the Paystack payment interface where you will be able to make payment securely</p>
                      </div>
                    </div>
                  </div>

                  <div class="border p-3 mb-3">
                    <input type="radio" value="flutterwave">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Pay with Flutterwave</a></h3>

                    <div class="collapse" id="collapsecheque">
                      <div class="py-2"><img src="/images/fw-1.png" alt="pay thru paysrack">
                        <p class="mb-0">You will be redirected to the Flutterwave payment interface where you will be able to make payment securely.</p>
                      </div>
                    </div>
                  </div>

                  <!--<div class="border p-3 mb-5">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                    <div class="collapse" id="collapsepaypal">
                      <div class="py-2">
                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>-->
                  </div>

                  <div class="form-group">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='/shopping-cart/thankyou'">Place Order</button>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- </form> -->
      </div>
    </div>

   @endsection
