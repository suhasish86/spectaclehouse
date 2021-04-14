<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Spectacle House</title>
<link rel="icon" href="{{ asset('siteassets/img/favicon.ico') }}" type="image/x-icon"/>
<link rel="shortcut icon" href="{{ asset('siteassets/img/favicon.ico') }}" type="image/x-icon"/>
<link href="{{ asset('siteassets/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('siteassets/css/LineIcons.css') }}" rel="stylesheet">
<link href="{{ asset('siteassets/css/fonts.css') }}" rel="stylesheet">
<link href="{{ asset('siteassets/css/select2.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('siteassets/css/flexslider.css') }}" type="text/css" media="screen" />
<link rel="stylesheet" href="{{ asset('siteassets/css/owl.carousel.min.css') }}">
<link href="{{ asset('siteassets/css/style.css') }}" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!---------------------- Header End ---------------------------->
  <header id="sticky">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="{{ route('/') }}"><img src="{{ asset('siteassets/img/logo.png') }}" alt=""></a>
      <div class="blankSpace d-lg-none"></div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="lni lni-menu"></i>
      </button>
      <div class="blankSpace d-none d-lg-block"></div>
      <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav">
            @foreach ($navList as $navigation)
                <a class="nav-link" href="{{ route('page_nav', ['page' => $navigation->pageslug])}}">{{ $navigation->pagename }}</a>
            @endforeach
        </ul>
      </div>
      {{-- <div class="headerIcons">
        <ul>
          <li><a href="javascript:void(0)"><span class="headerIconsBox"><i class="lni lni-search-alt"></i></span></a></li>
          <li><a href="cart.html"><span class="headerIconsBox"><i class="lni lni-cart"></i><span class="cartNo">12</span></span></a></li>
          <li>
            <div class="btn-group">
              <div type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="headerIconsBox"> <i class="lni lni-user"></i></span>
              </div>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="login.html">Sign In</a>
                <a class="dropdown-item" href="registration.html">Sign Up</a>
                <a class="dropdown-item" href="my-account.html">My Account</a>
              </div>
            </div>
          </li>
        </ul>
      </div> --}}

    </nav>
  </header>
<!---------------------- Header End ---------------------------->


<!-- Banner Content Area
============================================ -->
@yield('banner-content-area')
<!-- Banner Content Area End ------------------->


<!-- Page Content Area
============================================ -->
@yield('page-content-area')
<!-- Page Content Area End ------------------->




<!---------------------- Footer Start ---------------------------->
  <footer>

   <div class="container text-center">
     <div class="footerLinks">
       <ul>
         <li><a href="{{ route('/') }}">Home</a></li>
         <li><a href="javascript:void(0)">Our Story</a></li>
         <li><a href="contact.html">Contact</a></li>
       </ul>
     </div>
     <div class="socialIcons">
       <a href="javascript:void(0)"><i class="lni lni-facebook"></i></a>
       <a href="javascript:void(0)"><i class="lni lni-twitter"></i></a>
     </div>
    <p>© 2020, Spectacle House</p>
   </div>
  </footer>
<!---------------------- Footer End ---------------------------->

<script src="{{ asset('siteassets/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('siteassets/js/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('siteassets/js/bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('siteassets/js/custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('siteassets/js/select2.full.js') }}" type="text/javascript"></script>
<script src="{{ asset('siteassets/js/jquery.scrollme.js') }}"></script>
<script defer src="{{ asset('siteassets/js/jquery.flexslider.js') }}"></script>
<script type="text/javascript">
    $(window).load(function(){
      $('#bannerSlider').flexslider({
        animation: "fade",
		directionNav: false,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>

<script src="{{ asset('siteassets/js/owl.carousel.js') }}"></script>
<script>
  jQuery(document).ready(function($) {
    $('.loop').owlCarousel({
      center: true,
      items: 2,
      loop: true,
      margin: 0,
      autoplay: true,
      autoplayTimeout: 2000,
      autoplayHoverPause: false,
      responsive: {
        1000: {
          items: 3
        }
      }
    });

  });
</script>

<!-- Page Scrypt Area
============================================ -->
@yield('page-extra-script')
<!-- Page Scrypt Area End ------------------->

</body>
</html>
