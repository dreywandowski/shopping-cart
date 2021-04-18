@extends('shop-layout.layout')
@section('content')
<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="/shop/">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$page}}</strong></div>
        </div>
      </div>
    </div>  


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
                      <a class="dropdown-item" href="#">Relevance</a>
                      <button   name="asc" value="asc" class="dropdown-item button" >Name, A to Z</button>
                      <button   name="asc" value="desc" class="dropdown-item button" >Name, Z to A</button>
                       <div class="dropdown-divider"></div>
                      <button  name="asc" value="asc" class="dropdown-item button" >Price, low to high</button>
                      <button name="asc" value="desc" class="dropdown-item button" >Price, high to low</button>

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
                    <a href="/shopping-cart/shop-single/{{ $item->name }}"><img src="{{ $item->file_path }}" alt="Image placeholder" class="img-fluid"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="/shopping-cart/shop-single/{{ $item->name }}">{{ $item->name }}</a></h3>
                    <p class="mb-0">Finding perfect t-shirt</p>
                    <p class="text-primary font-weight-bold">{{ $item->price }}</p>
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
                <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
              </div>

              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
                <label for="s_sm" class="d-flex">
                  <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Small (2,319)</span>
                </label>
                <label for="s_md" class="d-flex">
                  <input type="checkbox" id="s_md" class="mr-2 mt-1"> <span class="text-black">Medium (1,282)</span>
                </label>
                <label for="s_lg" class="d-flex">
                  <input type="checkbox" id="s_lg" class="mr-2 mt-1"> <span class="text-black">Large (1,392)</span>
                </label>
              </div>

              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
                <a href="#" class="d-flex color-item align-items-center" >
                  <span class="bg-danger color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Red (2,429)</span>
                </a>
                <a href="#" class="d-flex color-item align-items-center" >
                  <span class="bg-success color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Green (2,298)</span>
                </a>
                <a href="#" class="d-flex color-item align-items-center" >
                  <span class="bg-info color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Blue (1,075)</span>
                </a>
                <a href="#" class="d-flex color-item align-items-center" >
                  <span class="bg-primary color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Purple (1,075)</span>
                </a>
              </div>

            </div>
          </div>
        </div>

       
    @endsection