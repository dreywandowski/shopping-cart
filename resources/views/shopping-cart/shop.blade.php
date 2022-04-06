@extends('shop-layout.layout')
@section('content')
<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="/shop/">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$page}}</strong></div>
        </div>
      </div>
    </div>


<span id="ajaxRep" > </span>


    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div  class="float-md-left mb-4"><h2 id = 'title' class="text-black h5">{{$title}}</h2></div>
                <div class="d-flex">
                  <div class="dropdown mr-1 ml-md-auto">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Latest
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                      <a class="dropdown-item" href="/shopping-cart/shop/man">Men</a>
                      <a class="dropdown-item" href="/shopping-cart/shop/woman">Women</a>
                      <a class="dropdown-item" href="/shopping-cart/shop/child">Children</a>
                    </div>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">

                      <a  class="dropdown-item "  href="/shopping-cart/shop/A">Name, A to Z</a>
                      <a class="dropdown-item" href="/shopping-cart/shop/Z" >Name, Z to A</a>
                       <div class="dropdown-divider"></div>
                      <a  class="dropdown-item " href="/shopping-cart/shop/low">Price, low to high</a>
                      <a class="dropdown-item " href="/shopping-cart/shop/high">Price, high to low</a>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-5">

              @foreach($items as $item)
<div class="col-sm-6 col-lg-4 mb-4" id = "newcontent" data-aos="fade-up">
                <div class="block-4 text-center border">
                  <figure class="block-4-image">
                      @php
                          $file =  $item->file_path;
                              if(strpos($file, 'public') === 0){
                                  $content = str_replace('public/images/', '',$file);
                                  //$content_ = Storage::get($content);
                                  $content_ = asset('storage/images/'.$content);
                                  $item->file_path = $content_;
                                 }
                      @endphp
                    <a href="/shopping-cart/shop-single/{{ $item->name }}"><img src="{{ $item->file_path }}" alt="Image placeholder" class="img-fluid"></a>
                  </figure>

                  <div class="block-4-text p-4">
                    <h3><a href="/shopping-cart/shop-single/{{ $item->name }}">{{ $item->name }}</a></h3>
                    <p class="mb-0">@if($item->description !='')
                            {{ $item->description }}
                        @else
                         Finding perfect wears</p>
                      @endif
                    <p class="text-primary font-weight-bold">NGN {{ $item->price }}</p>
                  </div>
                </div>
              </div>


@endforeach
<br>
   </div>

<div>{{ $items->links() }}</div><br>


          <div class="row" data-aos="fade-up">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  <!--<ul>
                    <li><a href="#">&lt;</a></li>
                    <li class="active"><span>1</span></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">&gt;</a></li>
                  </ul>-->
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
              <ul class="list-unstyled mb-0">
                <li class="mb-1"><a href="/shopping-cart/shop/man" class="d-flex"><span>Men</span> <span class="text-black ml-auto">({{$man}})</span></a></li>
                <li class="mb-1"><a href="/shopping-cart/shop/woman" class="d-flex"><span>Women</span> <span class="text-black ml-auto">({{$woman}})</span></a></li>
                <li class="mb-1"><a href="/shopping-cart/shop/child" class="d-flex"><span>Children</span> <span class="text-black ml-auto">({{$child}})</span></a></li>
              </ul>
            </div>
   <div class="border p-4 rounded mb-4">
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                <div id="slider-range" class="border-primary"></div>

                <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white"  disabled="" />
              </div>
       <form method="GET" action="/shopping-cart/apply">
           @csrf
       <div class="col-md-6" >
           <input type="text" name="first" id="first" class="form-control border-0 pl-0 bg-white"  hidden="" />
           <input type="text" name="second" id="second" class="form-control border-0 pl-0 bg-white"  hidden="" />
           <input type="text" name="req" id="last" class="form-control border-0 pl-0 bg-white"  hidden value="{{$req}}" />
           <button type="submit" class="btn btn-primary">
               APPLY
           </button>
       </div>
       </form>
        </div>
    <br><br><br>
              <br><br><br>
              <br><br><br>
              <br><br><br>
              <br><br><br>
              <br><br><br>
              <br><br><br>
    @endsection
