@extends('shop-layout.auth')
@section('content')
    @if(Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('status')  }}</div>
    @endif
<div class="row">
    <div class="col-md-9 mb-5 mb-md-0">
        <center><h2 class="h3 mb-3 text-black">Edit My Profile</h2> </center>
        <form class="form-sample" method="POST" enctype="multipart/form-data" action="/shopping-cart/update_details ">
            @csrf
        <div class="p-3 p-lg-5 border">

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="c_fname" class="text-black">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_fname" name="name" value="<?php echo Auth::user()->name ?>">
                </div>
                <div class="col-md-6">

                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-9">

                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_address" name="address1" placeholder="Street address" value="<?php echo Auth::user()->address1; ?>">
                </div>
            </div>

            <div class="form-group"><div class="col-md-6">
                <input type="text" class="form-control" placeholder="Apartment, suite, unit etc." name="address2" value="<?php echo Auth::user()->address2; ?>" >
                </div></div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="c_state_country" class="text-black">State <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_state_country" name="state" value="<?php echo Auth::user()->state; ?>">
                </div>
                <div class="col-md-3">

                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="c_state_country" class="text-black">Country <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_state_country" name="country" value="<?php echo Auth::user()->country; ?>">
                </div>
                <div class="col-md-3">

                </div>
            </div>
            <div class="form-group row mb-5">
                <div class="col-md-3">
                    <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                    <input type="text" value="<?php echo Auth::user()->email; ?>" class="form-control" id="c_email_address" name="email" placeholder="test@mail.com">
                </div>
                <div class="col-md-3">
                    <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_phone" name="phone" placeholder="Phone Number" value="<?php echo Auth::user()->phone; ?>">
                </div>
            </div>
        </div>

            <div class="form-group">
                <button class="btn btn-primary btn-lg py-3 btn-block" type="submit" >Edit Profile</button>
            </div>
        </form>


@endsection
