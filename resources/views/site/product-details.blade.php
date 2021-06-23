@extends('layouts.site')

@section('banner-content-area')
@include('site.partials.banner')
@endsection

@section('page-content-area')
{{-- @dd($product) --}}
<!---------------------- New Arrival Start ---------------------------->
<section class="p-5">
    <div class="container">

      <div class="row">
        <div class="col-md-6">
          <div class="proDetailsImg">
            <div id="slider" class="flexslider">
                @if (!empty($product->galleries))
                <ul class="slides">
                    @foreach ($product->galleries as $gallery)
                    <li><img src="{{ $gallery->image }}" /></li>
                    @endforeach
                </ul>
                @endif
          </div>
          <div id="carousel" class="flexslider">
            @if (!empty($product->galleries))
            <ul class="slides">
                @foreach ($product->galleries as $gallery)
                <li><img src="{{ $gallery->image }}" /></li>
                @endforeach
            </ul>
            @endif
          </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="proDetails">
            <div class="mb-3">
          <h3 class="productTitle">{{ $product->productname }}</h3>
          <p>{!! $product->description !!}</p>
          <h4 class="detailsPrice"><span class="text-primary">₹</span> {{ $product->price}}</h4>
        </div>
        <div class="mb-2">
          <h5>Color</h5>
          <div class="colorImg">
            @if (!empty($product->inventories))
            <ul>
                @foreach ($product->inventories as $inventory)
                <li style="background-color: {{ $inventory->color }};"></li>
                @endforeach
            </ul>
            @endif
          </div>
        </div>

        {{-- <div class="mb-2">
          <h5>Quantity</h5>
          <div class="quaField">
            <input type="text" class="form-control" name="" id="">
          </div>
        </div>
        <div class="mb-3">
          <a href="cart.html" class="btn btn-lg btn-info">Add to Cart</a>
          <a href="cart.html" class="btn btn-lg btn-primary">Buy Now</a>
        </div> --}}

        <div class="descriptionBox">
            @if (!empty($product->galleries))
            <h4>Specifications</h4>
            <dl>
                @foreach ($product->specificationas $specname=>$specvalue)
                <dt>{{ $specname }}</dt>
                <dd>{{ $specvalue }}</dd>
                @endforeach
            </dl>
            @endif
        </div>

        </div>
        </div>
      </div>

    </div>
  </section>

  <!---------------------- New Arrival End ---------------------------->



@endsection

@section('page-extra-script')

<script>
    $(window).load(function(){
        $('#carousel').flexslider({
          animation: "slide",
          controlNav: false,
          animationLoop: false,
          slideshow: false,
          itemWidth: 100,
          itemMargin: 5,
          asNavFor: '#slider'
        });

        $('#slider').flexslider({
          animation: "slide",
          controlNav: false,
          animationLoop: false,
          slideshow: false,
          sync: "#carousel",
          start: function(slider){
            $('body').removeClass('loading');
          }
        });
      });
  </script>

@endsection
