@extends('layouts.site')

@section('page-content-area')

    <section class="p-5">
        <div class="container">
            <div class="text-center mb-4">
                <h3 class="">Thank You</h3>
                <p>For Your Purchase</p>
            </div>

            <div class="mb-2">
                <h4 class="mb-0">Invoice: SPH-{{ $order->order_no }}</h4>
                <p>Date: {{ $order->purchase_date }}</p>
            </div>
            <div class="customTable">
                <table class="table table1 table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th width="80">Quantity</th>
                            <th>Price (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cartItems as $item)
                        <tr>
                            <td>
                                <div class="d-flex flex-row align-items-center">
                                    <div>
                                        <div class="cartImg"><img src="{{ $item->attributes->image }}" alt=""></div>
                                    </div>
                                    <div>
                                        <div class="cartProName">{{ $item->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->attributes->sku }}</td>
                            <td>
                                {{ $item->quantity }}
                            </td>
                            <td>{{ $item->price }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Order is empty</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-end mb-4">

                <div class="col-sm-6 col-md-6 col-lg-5 col-xl-4 text-right">
                    <dl>
                        {{-- <dt>Sub Total:</dt>
                        <dd>₹ 1000</dd>
                        <dt>Tax:</dt>
                        <dd>₹ 10</dd>
                        <dt>Shipping:</dt>
                        <dd>₹ 30</dd>
                        <dt>Discount:</dt>
                        <dd>- ₹ 0</dd> --}}
                        <dt><big>Total:</big></dt>
                        <dd><big>₹ {{ $order->order_total }}</big></dd>
                    </dl>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6 scol-md-4 col-lg-3 mb-2">
                    <h4>Billing Address</h4>
                    <p>{{ $order->billing_address->name }}<br />
                        {{ $order->billing_address->email }}<br />
                        {{ $order->billing_address->phone }}<br />
                        {{ $order->billing_address->address }}<br />
                        Pin: {{ $order->billing_address->pin }}
                    </p>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <h4>Shipping Address</h4>
                    <p>{{ $order->shipping_address->name }}<br />
                        {{ $order->shipping_address->email }}<br />
                        {{ $order->shipping_address->phone }}<br />
                        {{ $order->shipping_address->address }}<br />
                        Pin: {{ $order->shipping_address->pin }}
                    </p>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Continue to shopping</a>
            </div>


        </div>
    </section>

@endsection()
