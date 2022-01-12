@extends('layouts.site')

@section('page-content-area')

    <section class="p-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 mb-3">
                    <form name="checkout_frm" id="checkout_frm" >
                        @csrf
                    {{-- <div class="checkoutBox">
                        <h4>Login or Signup</h4>
                        <div class="checkoutBoxContent" style="display: block;">
                            <div class="form-group"><input type="text" class="form-control"
                                    placeholder="Enter Email/Mobile Number*"></div>
                            <a href="#" class="btn btn-primary mobileBtn">Continue</a>
                        </div>
                    </div> --}}
                    <div class="checkoutBox">
                        <h4>Billing Information</h4>
                        <div class="checkoutBoxContent" style="display: block;">
                            <div class="form-group"><input type="text" name="billing_name" id="billing_name" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="form-group"><input type="email" name="billing_email" id="billing_email" class="form-control" placeholder="Email"></div>
                            <div class="form-group"><input type="text" name="billing_phone" id="billing_phone" class="form-control" placeholder="Phone"></div>
                            <div class="form-group"><textarea name="billing_address" id="billing_address" class="form-control" placeholder="Address"></textarea>
                            </div>
                            <div class="form-group"><input type="text" name="billing_pin" id="billing_pin" class="form-control" placeholder="Pin"></div>
                            <a href="javascript:void(0)" id="billing_continue" class="btn btn-primary mobileBtn">Continue</a>
                        </div>
                    </div>
                    <div class="checkoutBox">
                        <h4 id="shipping_tab">Shipping Information</h4>
                        <div class="checkoutBoxContent">
                            <div class="myCustomCheck mb-2">
                                <input class="form-check-input" value="1" id="frame" name="same_as_billing" type="checkbox">
                                <label class="form-check-label" for="frame">Same As Billing Address</label>
                            </div>
                            <div class="form-group"><input type="text" name="shipping_name" id="shipping_name" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="form-group"><input type="text" name="shipping_email" id="shipping_email" class="form-control" placeholder="Email"></div>
                            <div class="form-group"><input type="text" name="shipping_phone" id="shipping_phone" class="form-control" placeholder="Phone"></div>
                            <div class="form-group"><textarea name="shipping_address" id="shipping_address" class="form-control" placeholder="Address"></textarea>
                            </div>
                            <div class="form-group"><input type="text" name="shipping_pin" id="shipping_pin" class="form-control" placeholder="Pin"></div>
                            <a href="javascript:void(0)" id="shipping_continue" class="btn btn-primary mobileBtn">Continue</a>
                        </div>
                    </div>
                    <div class="checkoutBox">
                        <h4 id="payment_tab">Payment</h4>
                        <div class="checkoutBoxContent">
                            <div class="row mb-2">
                                <p>Please pay for your order by clicking the button below. One of our representative will guide you with purchase soon.</p>
                            </div>
                            <div class="text-right">
                                <a class="btn btn-primary mobileBtn"
                                href="javascript:void(0);"
                                data-receipt-id="{{ $razorpay['receipt_id']}}"
                                data-order-id="{{ $razorpay['orderId']}}"
                                data-rz-key="{{ $razorpay['razorpayId']}}"
                                data-rz-amount="{{ $razorpay['amount']}}"
                                data-rz-currency="{{ $razorpay['currency']}}"
                                data-logo="{{ $razorpay['logo'] }}"
                                id="place_order" >Pay Now</a>
                            </div>
                        </div>
                    </div>
                </form>

                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="whiteBox mb-3">
                        <h5 class="text-center mb-3">ORDER SUMMARY</h5>
                        <div>
                            @forelse ($cartItems as $item)
                            <div>
                                <div class="d-flex flex-row align-items-center">
                                    <div>
                                        <div class="cartImg"><img src="{{ $item->attributes->image }}" alt=""></div>
                                    </div>
                                    <div>
                                        <div class="cartProName">{{ $item->name }} X {{ $item->quantity }}</div>
                                        <p class="mb-0">₹ {{ $item->price }}</p>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            @empty
                            <div>
                                <div class="d-flex flex-row align-items-center">
                                    <div>
                                        <div class="cartProName">No product in cart</div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            @endforelse
                        </div>
                        <div class="d-flex flex-row align-items-center justify-content-between mb-2">
                            <div>
                                <p class="mb-0">Subtotal:</p>
                            </div>
                            <div>
                                <p class="mb-0"><strong>₹ {{ Cart::getTotal() }}</strong></p>
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <div class="mb-1">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Coupon">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="button" id="button-addon2">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right"><a href="#" class="text-primary">Have a Coupon code?</a></div>
                        </div> --}}
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <div>
                                <p class="mb-0">Amount Payble:</p>
                            </div>
                            <div>
                                <p class="mb-0 text-primary"><strong>₹ {{ Cart::getTotal() }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('javascript')
    <script src="{{ asset('siteassets/js/jquery.responsive-tables.js') }}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script defer src="{{ asset('siteassets/js/app/checkout.js') }}"></script>
@endpush
