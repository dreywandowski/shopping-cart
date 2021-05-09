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
        <div class="row mb-5" style="overflow-x:auto;">
          <!--<form class="col-md-12" method="post" style="overflow-x:auto;">-->
            <div class="site-blocks-table" style="overflow-x:auto;">
                @if($data != null) <caption style="color:black"><h3><center><u>My Cart</center></u></h3> </caption>
               <table class="table table-bordered" style="overflow-x:auto;">

                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
      <!-- to return deletion msg -->
                      @if(Session::has('status'))
                          <div class="alert alert-warning">
            {{ Session::get('status')  }}</div>
            @endif

                    @foreach($data as $row)
                    @foreach($row as $item)

                    <td class="product-thumbnail">
                      <img src="{{ $item['file'] }}" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black">{{ $item['name'] }}</h2>
                    </td>
                    <td>NGN {{ $item['priceFin'] }}</td>
                    <td>
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <!--<div class="input-group-prepend">
                          <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                        </div>-->
                        <input type="text" class="form-control text-center" value="{{ $item['number'] }}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                       <!-- <div class="input-group-append">
                          <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                        </div>-->
                      </div>

                    </td>
                    <td  class="price">NGN {{ $item['price']  }}</td>

                    <td><a href="{{ $item['name'] }}" class="btn remove  btn-primary">X</a></td>
                  </tr>
                  <span class="mx-2 mb-0" id="ajax" style="color:red"></span>
@endforeach
@endforeach

                </tbody>
              </table>
            </div>
         <!-- </form>-->
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-6 mb-3 mb-md-0">
               <!-- <button class="btn btn-primary btn-sm btn-block">Update Cart</button>--> @else
               <img src="/images/6011.jpg">
          <h3><b>Your cart is currently empty at the momment</b></h3><br><br><br>
          @endif
              </div>
              <div class="col-md-6">
                <p><a href="/shopping-cart/shop/all  " class="btn btn-sm btn-primary">Continue Shopping</a></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="text-black h4" for="coupon">Coupon</label>
                <p>Enter your coupon code if you have one.</p>
              </div>
              <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
              </div>
              <div class="col-md-4">
                <button class="btn btn-primary btn-sm">Apply Coupon</button>
              </div>
            </div>
          </div>
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black finPrice"></strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black  finPrice"></strong>
                  </div>
                </div>

                  <div class="col-md-6">
                      <p><a href="/shopping-cart/checkout" class="btn btn-sm btn-primary">Proceed To Checkout</a></p>
                  </div>
              </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>

    @endsection
