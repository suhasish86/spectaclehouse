@extends('layouts.site')

@section('banner-content-area')
@include('site.partials.banner')
@endsection

@section('page-content-area')

<!---------------------- New Arrival Start ---------------------------->
<section class="p-5">
    <div class="container">
      <h2 class="text-center m-5">Our Collection</h2>
      <div class="container">
        <div class="d-flex  justify-content-center">
            @if (!empty($collection))
            @foreach ($collection as $product)
            <div class=""><div class="circleBox"><a href="products.html"><img src="{{ $product->image }}" alt=""></a></div></div>
            @endforeach
            @endif
        </div>
      </div>
    </div>
  </section>
  <!---------------------- New Arrival End ---------------------------->



  <!---------------------- Trending Start ---------------------------->
  <section class="p-5 paddingTopOff">
    <div class="container">
      <h2 class="text-center m-5">Trending</h2>
      <div class="productOwl">
        <div class="loop owl-carousel owl-theme">

            @if (!empty($trending))
            @foreach ($trending as $product)
            <div class="item">
                <div class="proBox">
                  <div class="proBoxImg"><a href="product-details.html"><img src="{{ $product->image }}" alt=""></a></div>
                  <div class="proBoxDes">
                    <h4>{{ $product->productname }}</h4>
                    <h5>₹ {{ $product->price }}</h5>
                    <a href="product-details.html" class="btn btn-info">View Now</a>
                  </div>
                </div>
              </div>
            @endforeach
            @endif

        </div>
      </div>
    </div>
  </section>
  <!---------------------- Trending End ---------------------------->



  <!---------------------- New Arrival Start ---------------------------->
  <section class="p-5 paddingTopOff">
    <div class="container">
      <h2 class="text-center m-5">New Arrival</h2>
      <div class="productOwl">
        <div class="loop owl-carousel owl-theme">

            @if (!empty($newest))
            @foreach ($newest as $product)
            <div class="item">
                <div class="proBox">
                  <div class="proBoxImg"><a href="product-details.html"><img src="{{ $product->image }}" alt=""></a></div>
                  <div class="proBoxDes">
                    <h4>{{ $product->productname }}</h4>
                    <h5>₹ {{ $product->price }}</h5>
                    <a href="product-details.html" class="btn btn-info">View Now</a>
                  </div>
                </div>
              </div>
            @endforeach
            @endif

        </div>
      </div>
    </div>
  </section>

  <!---------------------- New Arrival End ---------------------------->

  <!---------------------- Best Deal Start ---------------------------->
  <section class="p-5 paddingTopOff">
    <div class="container">
      <h2 class="text-center m-5">Best Deal</h2>
      <div class="productOwl">
        <div class="loop owl-carousel owl-theme">
            @if (!empty($best_deal))
            @foreach ($best_deal as $product)
            <div class="item">
                <div class="proBox">
                  <div class="proBoxImg"><a href="product-details.html"><img src="{{ $product->image }}" alt=""></a></div>
                  <div class="proBoxDes">
                    <h4>{{ $product->productname }}</h4>
                    <h5>₹ {{ $product->price }}</h5>
                    <a href="product-details.html" class="btn btn-info">View Now</a>
                  </div>
                </div>
              </div>
            @endforeach
            @endif


        </div>
      </div>
    </div>
  </section>

  <!---------------------- Best Deal End ---------------------------->



@endsection
