<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('pagetitle')</title>
    <meta name="description" content="Admin pages.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('adminassets/img/favicon.ico') }}">
    <!-- Google Fonts
    ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('adminassets/css/bootstrap.min.css') }}">

    <!-- meanmenu CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('adminassets/css/meanmenu/meanmenu.min.css') }}">
    <!-- animate CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('adminassets/css/animate.css') }}">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('adminassets/css/normalize.css') }}">
    <!-- wave CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('adminassets/css/wave/waves.min.css') }}">
    <!-- notika icon CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('adminassets/css/notika-custom-icon.css') }}">

    <!-- Chosen CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('adminassets/css/chosen/chosen.css') }}">

    <!-- Page specific Css
    ============================================ -->
    @yield('specific_style')

    <!-- main CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('adminassets/css/main.css') }}">
    <!-- style CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('adminassets/css/style.css') }}">
    <!-- responsive CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('adminassets/css/responsive.css') }}">

    <!-- Fontawesome CSS
    ============================================ -->

    <link rel="stylesheet" href="{{ asset('adminassets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminassets/css/fontawesome/brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminassets/css/fontawesome/regular.min.css') }}">

    <!-- Custom CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('adminassets/css/custom.admin.css') }}">

    <!-- modernizr JS
    ============================================ -->
    <script src="{{ asset('adminassets/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    @yield('page_styles')
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <a href="#"><img src="{{ asset('adminassets/img/logo/logo.png') }}" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-search"></i></span></a>
                                <div role="menu" class="dropdown-menu search-dd animated flipInX">
                                    <div class="search-input">
                                        <i class="notika-icon notika-left-arrow"></i>
                                        <input type="text" />
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-settings"></i></span></a>
                                <div role="menu" class="dropdown-menu message-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Settings</h2>
                                    </div>
                                    <div class="hd-message-info">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <div class="hd-message-sn">
                                                <div class="hd-mg-ctn">
                                                    <h3>Log Out</h3>
                                                </div>
                                            </div>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route('admin.pagelist') }}">Pages</a></li>
                                <li><a href="{{ route('admin.categorylist') }}">Categories</a></li>
                                <li><a data-toggle="collapse" data-target="#framemanager" href="#">Frames</a>
                                    <ul id="framemanager" class="collapse dropdown-header-top">
                                        <li><a href="{{ route('admin.brandlist', ['brandproduct'=>'frame']) }}">Brands</a></li>
                                        <li><a href="{{ route('admin.stylelist', ['styleproduct'=>'frame']) }}">Styles</a></li>
                                        <li><a href="{{ route('admin.materiallist', ['materialproduct'=>'material']) }}">Materials</a></li>
                                        <li><a href="{{ route('admin.productlist', ['genre'=>'frame']) }}">Frames</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#sunglassanager" href="#">Sunglasses</a>
                                    <ul id="sunglassanager" class="collapse dropdown-header-top">
                                        <li><a href="{{ route('admin.brandlist', ['brandproduct'=>'sunglass']) }}">Brands</a></li>
                                        <li><a href="{{ route('admin.stylelist', ['styleproduct'=>'sunglass']) }}">Styles</a></li>
                                        <li><a href="{{ route('admin.materiallist', ['materialproduct'=>'sunglass']) }}">Materials</a></li>
                                        <li><a href="{{ route('admin.productlist', ['genre'=>'sunglass']) }}">Sunglasses</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#lensmanager" href="#">Lens</a>
                                    <ul id="lensmanager" class="collapse dropdown-header-top">
                                        <li><a href="{{ route('admin.brandlist', ['brandproduct'=>'lens']) }}">Brands</a></li>
                                        <li><a href="{{ route('admin.stylelist', ['styleproduct'=>'lens']) }}">Styles</a></li>
                                        <li><a href="{{ route('admin.materiallist', ['materialproduct'=>'lens']) }}">Materials</a></li>
                                        <li><a href="{{ route('admin.productlist', ['genre'=>'lens']) }}">Lenses</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#contactlensmanager" href="#">Contact Lens</a>
                                    <ul id="contactlensmanager" class="collapse dropdown-header-top">
                                        <li><a href="{{ route('admin.brandlist', ['brandproduct'=>'contactlens']) }}">Brands</a></li>
                                        <li><a href="{{ route('admin.stylelist', ['styleproduct'=>'contactlens']) }}">Styles</a></li>
                                        <li><a href="{{ route('admin.materiallist', ['materialproduct'=>'contactlens']) }}">Materials</a></li>
                                        <li><a href="{{ route('admin.productlist', ['genre'=>'contactlens']) }}">Contact Lenses</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#accessoriesmanager" href="#">Accessories</a>
                                    <ul id="accessoriesmanager" class="collapse dropdown-header-top">
                                        <li><a href="{{ route('admin.brandlist', ['brandproduct'=>'accessories']) }}">Brands</a></li>
                                        <li><a href="{{ route('admin.stylelist', ['styleproduct'=>'accessories']) }}">Styles</a></li>
                                        <li><a href="{{ route('admin.materiallist', ['materialproduct'=>'accessories']) }}">Materials</a></li>
                                        <li><a href="{{ route('admin.productlist', ['genre'=>'accessories']) }}">Accessories</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#facilitymanager" href="#">Facilities</a>
                                    <ul id="facilitymanager" class="collapse dropdown-header-top">
                                        <li><a href="{{ route('admin.facilitylist', ['facilitytype' => 'services']) }}">Services</a></li>
                                        <li><a href="{{ route('admin.facilitylist', ['facilitytype' => 'eyeclinic']) }}">Eye Clinic</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li class="{{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}"><i class="notika-icon notika-house"></i> Dashboard</a>
                        </li>
                        <li class="{{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                            <a href="{{ route('admin.pagelist') }}"><i class="notika-icon notika-house"></i> Pages</a>
                        </li>
                        <li class="{{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                            <a href="{{ route('admin.categorylist') }}"><i class="notika-icon notika-house"></i> Categories</a>
                        </li>
                        <li class="{{ (request()->is('admin/frame/*')) ? 'active' : '' }}">
                            <a data-toggle="tab" href="#frames"><i class="notika-icon notika-mail"></i> Frames</a>
                        </li>
                        <li class="{{ (request()->is('admin/sunglass/*')) ? 'active' : '' }}">
                            <a data-toggle="tab" href="#sunglasses"><i class="notika-icon notika-mail"></i> Sunglasses</a>
                        </li>
                        <li class="{{ (request()->is('admin/lense/*')) ? 'active' : '' }}">
                            <a data-toggle="tab" href="#lenses"><i class="notika-icon notika-mail"></i> Lens</a>
                        </li>
                        <li class="{{ (request()->is('admin/contactlense/*')) ? 'active' : '' }}">
                            <a data-toggle="tab" href="#contactlenses"><i class="notika-icon notika-mail"></i> Contact Lens</a>
                        </li>
                        <li class="{{ (request()->is('admin/accessories/*')) ? 'active' : '' }}">
                            <a data-toggle="tab" href="#accessories"><i class="notika-icon notika-mail"></i> Accessories</a>
                        </li>
                        <li class="{{ (request()->is('admin/createfacility/*') || request()->is('admin/editfacility/*') || request()->is('admin/facilitylist/*')) ? 'active' : '' }}">
                            <a data-toggle="tab" href="#facility"><i class="notika-icon notika-mail"></i> Facilities</a>
                        </li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="frames" class="tab-pane {{ (request()->is('admin/frame/*')) ? 'active' : '' }} notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ route('admin.brandlist', ['brandproduct' => 'frame']) }}">Brands</a></li>
                                <li><a href="{{ route('admin.stylelist', ['styleproduct' => 'frame']) }}">Styles</a></li>
                                <li><a href="{{ route('admin.materiallist', ['materialproduct' => 'frame']) }}">Materials</a></li>
                                <li><a href="{{ route('admin.productlist', ['genre' => 'frame']) }}">Frames</a></li>
                            </ul>
                        </div>
                        <div id="sunglasses" class="tab-pane {{ (request()->is('admin/sunglass/*')) ? 'active' : '' }} notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ route('admin.brandlist', ['brandproduct' => 'sunglass']) }}">Brands</a></li>
                                <li><a href="{{ route('admin.stylelist', ['styleproduct' => 'sunglass']) }}">Styles</a></li>
                                <li><a href="{{ route('admin.materiallist', ['materialproduct' => 'sunglass']) }}">Materials</a></li>
                                <li><a href="{{ route('admin.productlist', ['genre' => 'sunglass']) }}">Sunglasses</a></li>
                            </ul>
                        </div>
                        <div id="lenses" class="tab-pane {{ (request()->is('admin/lense/*')) ? 'active' : '' }} notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ route('admin.brandlist', ['brandproduct' => 'lense']) }}">Brands</a></li>
                                <li><a href="{{ route('admin.stylelist', ['styleproduct' => 'lense']) }}">Styles</a></li>
                                <li><a href="{{ route('admin.materiallist', ['materialproduct' => 'lense']) }}">Materials</a></li>
                                <li><a href="{{ route('admin.productlist', ['genre' => 'lense']) }}">Lenses</a></li>
                            </ul>
                        </div>
                        <div id="contactlenses" class="tab-pane {{ (request()->is('admin/contactlense/*')) ? 'active' : '' }} notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ route('admin.brandlist', ['brandproduct' => 'contactlense']) }}">Brands</a></li>
                                <li><a href="{{ route('admin.stylelist', ['styleproduct' => 'contactlense']) }}">Styles</a></li>
                                {{-- <li><a href="{{ route('admin.materiallist', ['materialproduct' => 'contactlense']) }}">Materials</a></li> --}}
                                <li><a href="{{ route('admin.productlist', ['genre' => 'contactlense']) }}">Contact Lenses</a></li>
                            </ul>
                        </div>
                        <div id="accessories" class="tab-pane {{ (request()->is('admin/accessories/*')) ? 'active' : '' }} notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ route('admin.brandlist', ['brandproduct' => 'accessories']) }}">Brands</a></li>
                                {{-- <li><a href="{{ route('admin.stylelist', ['styleproduct' => 'accessories']) }}">Styles</a></li> --}}
                                {{-- <li><a href="{{ route('admin.materiallist', ['materialproduct' => 'accessories']) }}">Materials</a></li> --}}
                                <li><a href="{{ route('admin.productlist', ['genre' => 'accessories']) }}">Accessories</a></li>
                            </ul>
                        </div>
                        <div id="facility" class="tab-pane {{ (request()->is('admin/createfacility/*') || request()->is('admin/editfacility/*') || request()->is('admin/facilitylist/*')) ? 'active' : '' }} notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ route('admin.facilitylist', ['facilitytype' => 'services']) }}">Services</a></li>
                                <li><a href="{{ route('admin.facilitylist', ['facilitytype' => 'eyeclinic']) }}">Eye Clinic</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Menu area End-->


    <!-- Start Label Content area -->
    @yield('content-label')
    <!-- End Label Content area-->

    <!-- Start Main Content area -->
    @yield('content')
    <!-- End Main Content area-->


    <!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2018
. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer area-->
    <!-- jquery
		============================================ -->
        <script src="{{ asset('adminassets/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <!-- bootstrap JS
        ============================================ -->
        <script src="{{ asset('adminassets/js/bootstrap.min.js') }}"></script>
        <!-- meanmenu JS
        ============================================ -->
        <script src="{{ asset('adminassets/js/meanmenu/jquery.meanmenu.js') }}"></script>
        <!--  wave JS
		============================================ -->
        <script src="{{ asset('adminassets/js/wave/waves.min.js') }}"></script>
        <!--  notification JS
		============================================ -->
        <script src="{{ asset('adminassets/js/notification/bootstrap-growl.min.js') }}"></script>
        <script src="{{ asset('adminassets/js/admin.utilities.js') }}"></script>
        <!-- icheck JS
        ============================================ -->
        <script src="{{ asset('adminassets/js/icheck/icheck.min.js') }}"></script>

        <!--  chosen JS
        ============================================ -->
        <script src="{{ asset('adminassets/js/chosen/chosen.jquery.js') }}"></script>

        <!-- AJAX Setup
        ============================================ -->
        <script type="text/javascript">
            var host = "{{ URL::to('/') }}" + "/";
            var error_class = 'form_errorFiled';
            $(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>
        <!-- Page specific Js
		============================================ -->
        @yield('specific_scrypt')

        <!-- Common JS
        ============================================ -->
        <script src="{{ asset('adminassets/js/admin-common.js') }}"></script>

        @yield('page_scrypt')

</body>

</html>
