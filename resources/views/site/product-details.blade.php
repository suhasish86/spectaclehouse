@extends('layouts.site')

@section('banner-content-area')
@include('site.partials.banner')
@endsection

@section('page-content-area')

<!---------------------- New Arrival Start ---------------------------->
<section class="p-5">
    <div class="container">

      <div class="row">
        <div class="col-md-6">
          <div class="proDetailsImg">
            <div id="slider" class="flexslider">
            <ul class="slides">
              <li><img src="{{ asset('siteassets/img/sliderimg.jpg') }}" /></li>
              <li><img src="{{ asset('siteassets/img/sliderimg.jpg') }}" /></li>
              <li><img src="{{ asset('siteassets/img/sliderimg.jpg') }}" /></li>
              <li><img src="{{ asset('siteassets/img/sliderimg.jpg') }}" /></li>
              <li><img src="{{ asset('siteassets/img/sliderimg.jpg') }}" /></li>
              <li><img src="{{ asset('siteassets/img/sliderimg.jpg') }}" /></li>
            </ul>
          </div>
          <div id="carousel" class="flexslider">
            <ul class="slides">
              <li><img src="{{ asset('siteassets/img/pro-placeholder.jpg') }}" /></li>
              <li><img src="{{ asset('siteassets/img/pro-placeholder.jpg') }}" /></li>
              <li><img src="{{ asset('siteassets/img/pro-placeholder.jpg') }}" /></li>
              <li><img src="{{ asset('siteassets/img/pro-placeholder.jpg') }}" /></li>
              <li><img src="{{ asset('siteassets/img/pro-placeholder.jpg') }}" /></li>
              <li><img src="{{ asset('siteassets/img/pro-placeholder.jpg') }}" /></li>
            </ul>
          </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="proDetails">
            <div class="mb-3">
          <h3 class="productTitle">Vincent Chase Polarized</h3>
          <h4 class="detailsPrice"><span class="text-primary">₹</span> 1100</h4>
        </div>
        <div class="mb-2">
          <h5>Color</h5>
          <div class="colorImg">
            <ul>
              <li style="background-color: black;"></li>
              <li style="background-color: blueviolet;" class="active"></li>
              <li style="background-color: chocolate;"></li>
              <li style="background-color: blanchedalmond;"></li>
              <li style="background-color:cadetblue;"></li>
            </ul>
          </div>
        </div>

        <div class="mb-2">
          <h5>Quantity</h5>
          <div class="quaField">
            <input type="text" class="form-control" name="" id="">
          </div>
        </div>
        <div class="mb-3">
          <a href="cart.html" class="btn btn-lg btn-info">Add to Cart</a>
          <a href="cart.html" class="btn btn-lg btn-primary">Buy Now</a>
        </div>

        <div class="descriptionBox">
          <h4>Description</h4>
          <dl>
            <dt>Material</dt>
            <dd>TR90 (Flexible Light-Weight)</dd>
            <dt>Frame Style</dt>
            <dd>Standard</dd>
            <dt>Gender</dt>
            <dd>Unisex</dd>
            <dt>Frame Dimensions</dt>
            <dd>49-19-140 mm</dd>
            <dt>Frame Width</dt>
            <dd>134 mm</dd>
            <dt>Frame colour</dt>
            <dd>Grey Transparent</dd>
          </dl>
        </div>

        </div>
        </div>
      </div>

    </div>
  </section>

  <!---------------------- New Arrival End ---------------------------->



@endsection
