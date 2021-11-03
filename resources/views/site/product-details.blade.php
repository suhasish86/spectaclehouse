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
                            <h4 class="detailsPrice"><span class="text-primary">₹</span> {{ $product->price }}</h4>
                        </div>
                        <div class="mb-2">
                            <h5>Color</h5>
                            <div class="colorImg">
                                @if (!empty($product->inventories))
                                    <ul>
                                        @forelse ($product->inventories as $inventory)
                                            <li style="background-color: {{ $inventory->color }};"></li>
                                        @empty
                                            <li>N/A</li>
                                        @endforelse
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <form name="add_to_cart_frm" id="add_to_cart_frm">
                            @csrf
                            <div class="mb-2">
                                <h5>Quantity</h5>
                                <div class="quaField">
                                    <input type="text" class="form-control" name="product_quantity" id="product_quantity"
                                        value="1">
                                </div>
                            </div>


                            <div class="mb-3">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="product_name" value="{{ $product->productname }}">
                                <input type="hidden" name="product_price" value="{{ $product->price }}">
                                <input type="hidden" name="product_image" value="{{ $product->galleries->first()->image }}">
                                <input type="hidden" name="product_color"
                                    value="{{ $product->inventories->first()->color }}">
                                <a href="javascript:void(0);" class="btn btn-lg btn-info" id="add_cart">Add to Cart</a>
                                <a href="javascript:void(0);" class="btn btn-lg btn-primary" id="buy_now">Buy Now</a>
                            </div>
                        </form>
                        <div class="descriptionBox">
                            @if (!empty($product->specification))
                                <h4>Specifications</h4>
                                <dl>
                                    @foreach ($product->specification as $spec)
                                        <dt>{{ $spec->specname }}</dt>
                                        <dd>{{ $spec->specification }}</dd>
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
        $(window).load(function() {
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
                start: function(slider) {
                    $('body').removeClass('loading');
                }
            });
        });
    </script>

@endsection

@push('javascript')
    <script defer src="{{ asset('siteassets/js/app/cart.js') }}"></script>
@endpush
