@extends('shop-layout.auth')
@section('content')

<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="/shop">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Welcome!</strong></div>
        </div>
      </div>
    </div>
   <center>
    <div class="registration">
        <div class="reg-note">
            <p>Registration Successful! <span class="usrName"></span> <br><br>
                Click <a href="/login">here</a> to go to your dashboard.
                </p></div></div></center>
@endsection

