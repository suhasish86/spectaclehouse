@extends('layouts.site')

@section('page-content-area')
    <section class="p-5">
        <div class="container">
            <h3 class="mb-5 text-center">Account Dashboard</h3>
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 mb-2">
                    <div class="tabLeft">
                        <ul>
                            <li class="active"><a href="javascript:void(0);">Account Dashboard</a></li>
                            <li><a href="javascript:void(0);">Account Information</a></li>
                            <li><a href="javascript:void(0);">Address Book</a></li>
                            <li><a href="javascript:void(0);">My Orders</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-7 col-lg-8 col-xl-9">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="whiteBox mb-2">
                                <h5 class="mb-2">Contact Information</h5>
                                <p class="mb-3">Linda Smith<br>
                                    linda@gmail.com
                                </p>
                                <div><a href="#" class="btn btn-primary btn-sm">Edit</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="whiteBox mb-2">
                                <h5 class="mb-2">Default Billing Address</h5>
                                <p class="mb-3">Linda Smith<br>
                                    445, lorem address, <br />
                                    pin- 74893
                                </p>
                                <div><a href="#" class="btn btn-primary btn-sm">Edit</a></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="whiteBox mb-2">
                                <h5 class="mb-2">Default Shipping Address</h5>
                                <p class="mb-3">Linda Smith<br>
                                    445, lorem address, <br />
                                    pin- 74893
                                </p>
                                <div><a href="#" class="btn btn-primary btn-sm">Edit</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
