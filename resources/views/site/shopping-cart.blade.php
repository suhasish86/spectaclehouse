@extends('layouts.site')

@section('page-content-area')

    <!---------------------- Cart ---------------------------->
    <section class="p-5">
        <div class="container">
            <h3 class="text-center mb-4">Your Cart</h3>

            <div class="customTable">
                <table class="table table1 table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>ID</th>
                            <th width="80">Quantity</th>
                            <th>Price (₹)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cartItems as $item)
                            <tr>
                                <td>
                                    <div class="d-flex flex-row align-items-center">
                                        <div>
                                            <div class="cartImg"><img src="{{ $item->attributes->image }}" alt="">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="cartProName">{{ $item->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->attributes->sku }}</td>
                                <td>
                                    <div class="tableField"><input type="text" name="item_quantity" id="item_quantity" class="form-control" data-itemid="{{ $item->id }}"
                                            value="{{ $item->quantity }}"></div>
                                </td>
                                <td>{{ $item->price }}</td>
                                <td class="text-center"><a href="javascript:void(0);" id="remove_cart-{{ $item->id }}" class="text-primary"><i
                                            class="lni lni-trash"></i></a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Your Cart Is Empty</th>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="row justify-content-between mb-4">
                <div class="col-sm-6 col-md-5 col-lg-4 col-xl-3">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button" id="clear_cart">Clear Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-5 col-xl-4 text-right">
                    <dl>
                        {{-- <dt>Sub Total:</dt>
                        <dd> Total:₹ {{ Cart::getTotal() }}</dd>
                        <dt>Tax:</dt>
                        <dd>₹ 10</dd>
                        <dt>Shipping:</dt>
                        <dd>₹ 30</dd>
                        <dt>Discount:</dt>
                        <dd>- ₹ 0</dd> --}}
                        <dt><big>Total:</big></dt>
                        <dd><big> Total:₹ {{ Cart::getTotal() }}</big></dd>
                    </dl>
                </div>
            </div>
            <div class="text-right">
                <a href="#" class="btn btn-info btn-lg mobileBtn">Update Cart</a>
                <a href="checkout.html" class="btn btn-primary btn-lg mobileBtn">Checkout</a>
            </div>

        </div>
    </section>

    <!---------------------- Cart End ---------------------------->


@endsection

@push('javascript')
    <script defer src="{{ asset('siteassets/js/app/cart.js') }}"></script>
@endpush
