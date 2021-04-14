@extends('layouts.site')

@section('banner-content-area')
@include('site.partials.banner')
@endsection

@section('page-content-area')

<!---------------------- Category Start ---------------------------->
<section class="p-5">
    <div class="container">
        <div class="d-flex  justify-content-center">
            <div class="">
                <div class="circleBox">
                    <a href="category.html">
                        <img src="{{ asset('siteassets/img/man.jpg') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="">
                <div class="circleBox">
                    <a href="category.html">
                        <img src="{{ asset('siteassets/img/woman.jpg') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="">
                <div class="circleBox">
                    <a href="category.html">
                        <img src="{{ asset('siteassets/img/kid.jpg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!---------------------- Category End ---------------------------->
@if(!empty($our_collection))
<!---------------------- Our Collection ---------------------------->
<section class="p-5 paddingTopOff">
    <div class="container">
        <h2 class="text-center m-5">Our ollection</h2>
        <div class="trendingSlider">
            <div class="loop owl-carousel owl-theme">
                @foreach($our_collection as $product)
                <div class="item">
                    <a href="product-details.html">
                        <img src="{{ $product->image }}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
<!---------------------- Our Collection End ---------------------------->
<!---------------------- Animation/Glass Shape Start ---------------------------->
<section class="animationBg ">
    <div class="container">
        <div class="d-flex flex-row bd-highlight scrollme">
            <div
                class="effect_box effect_box_translate animateme"
                data-when="view"
                data-from="0.65"
                data-to="0.15"
                data-translatex="-250"
                data-opacity="0"
                data-translatey="250"
                style="opacity: 1; transform: translate3d(153px, 153px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale3d(1, 1, 1);"
            >
                <img src="{{ asset('siteassets/img/animation1.png') }}" alt="">
            </div>
            <div
                class="animateme"
                data-when="view"
                data-from="0.65"
                data-to="0.15"
                data-translatey="-250"
                data-opacity="0"
                style="opacity: 1; transform: translate3d(153px, 153px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale3d(1, 1, 1); z-index: 9;"
            >
                <img src="{{ asset('siteassets/img/animation2.png') }}" alt="">
            </div>
            <div
                class="effect_box effect_box_translate animateme"
                data-when="view"
                data-from="0.65"
                data-opacity="0"
                data-to="0.15"
                data-translatex="250"
                data-translatey="250"
                style="opacity: 1; transform: translate3d(153px, 153px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale3d(1, 1, 1);"
            >
                <img src="{{ asset('siteassets/img/animation3.png') }}" alt="">
            </div>
        </div>
    </div>
</section>
<!---------------------- Animation/Glass Shape End ---------------------------->
@if(!empty($newest_arrival))
<!---------------------- New Arrival Start ---------------------------->
<section class="p-5">
    <div class="container">
        <h2 class="text-center m-5">New Arrival</h2>
        <div class="row">
            @foreach($our_collection as $product)
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="proBox">
                    <div class="proBoxImg">
                        <a href="product-details.html">

                            <img src="{{ $product->image }}" alt="">
                        </a>
                    </div>
                    <div class="proBoxDes">
                        <h4>{{ $product->productname}}</h4>
                        <h5>{{ $product->price }}</h5>
                        <a href="product-details.html" class="btn btn-info">Buy Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!---------------------- New Arrival End ---------------------------->
<!---------------------- Brand Start ---------------------------->
<section class="p-5 paddingTopOff">
    <div class="container">
        <h2 class="text-center m-5">Our Brands</h2>
        <div class="brandList">
            <ul>
                <li>
                    <img src="{{ asset('siteassets/img/brand1.png') }}" alt="">
                </li>
                <li>
                    <img src="{{ asset('siteassets/img/brand2.png') }}" alt="">
                </li>
                <li>
                    <img src="{{ asset('siteassets/img/brand3.png') }}" alt="">
                </li>
                <li>
                    <img src="{{ asset('siteassets/img/brand4.png') }}" alt="">
                </li>
                <li>
                    <img src="{{ asset('siteassets/img/brand5.png') }}" alt="">
                </li>
                <li>
                    <img src="{{ asset('siteassets/img/brand6.png') }}" alt="">
                </li>
                <li>
                    <img src="{{ asset('siteassets/img/brand7.png') }}" alt="">
                </li>
                <li>
                    <img src="{{ asset('siteassets/img/brand8.png') }}" alt="">
                </li>
                <li>
                    <img src="{{ asset('siteassets/img/brand9.png') }}" alt="">
                </li>
                <li>
                    <img src="{{ asset('siteassets/img/brand10.png') }}" alt="">
                </li>
            </ul>
        </div>
    </div>
</section>
<!---------------------- Brand End ---------------------------->


@endsection
