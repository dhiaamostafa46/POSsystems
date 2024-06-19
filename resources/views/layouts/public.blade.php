
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>evix | إيفكس</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/img/EVIX ICON SVG.svg')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  
  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/variables-green.css')}}" rel="stylesheet"> 
  @if (session('lang') == 'ar')
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.rtl.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
    @else
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link href="{{asset('assets/css/mainEn.css')}}" rel="stylesheet">   
  @endif
  <style>

  @media screen and (max-width: 600px) {
    .header .logo img{
        max-height:30px !important;
    }
  }
  .butt2 {
  position: relative;
  padding: 8px 16px;
  border: none;
  outline: none;
  cursor: pointer;
  }

  .button:active {
    background: #007a63;
  }

  .button__text {
    color: #ffffff;
    transition: all 0.2s;
  }

  .button--loading .button__text {
    visibility: hidden;
    opacity: 0;
  }

  .button--loading::after {
    content: "";
    position: absolute;
    width: 16px;
    height: 16px;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    border: 4px solid transparent;
    border-top-color: #ffffff;
    border-radius: 50%;
    animation: button-loading-spinner 1s ease infinite;
  }

  @keyframes button-loading-spinner {
    from {
      transform: rotate(0turn);
    }

    to {
      transform: rotate(1turn);
    }
  }
  </style>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="{{route('admin.index')}}" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        @if (session('lang') == 'ar')
        <img src="{{asset('assets/img/EVIX LOGO-AR.png')}}" alt="www.evix.com.sa"> 
        @else
        <img src="{{asset('assets/img/EVIX LOGO-EN.png')}}" alt="www.evix.com.sa"> 
        @endif
        <!-- <h1>HeroBiz<span>.</span></h1>-->
      </a>

      <nav id="navbar" class="navbar">
        @if (session('lang') == 'ar')
        <ul>
          <li><a class="nav-link scrollto" href="#">الرئيسية</a></li>
          <li><a class="nav-link scrollto" href="#about">عن ايفكس</a></li>
          <li><a class="nav-link scrollto" href="#services">الخدمات</a></li>
          <li><a class="nav-link scrollto" href="#pricing">سجل الآن</a></li>
          <li><a class="nav-link scrollto" href="#contact">للتواصل</a></li>
        </ul>
        @else
        <ul>
          <li><a class="nav-link scrollto" href="#">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About Evix</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#pricing">Register</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact Us</a></li>
        </ul>
        @endif
        <i class="bi bi-list mobile-nav-toggle d-none"></i>
      </nav><!-- .navbar -->

      <form method="post">
        @if (session('lang') == 'ar')
          <a href="{{route('english')}}" class="btn-getstarted scrollto border-0" style="padding:6px 10px;" type="submit" name="eng">
          <span>En</span>
          </a>
          <a href="{{route('admin.index')}}" class="btn-getstarted scrollto border-0" style="padding:6px 10px;">
            <span>دخول</span>
          </a>
          @else
          <a href="{{route('arabic')}}" class="btn-getstarted scrollto border-0" style="padding:6px 10px;" type="submit" name="arb">
            <span>Ar</span>
          </a>
          <a href="{{route('admin.index')}}" class="btn-getstarted scrollto border-0" style="padding:6px 10px;">
            <span>Login</span>
          </a>
        @endif
      </form>
    </div>
  </header><!-- End Header -->
  @yield('content')
 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">
  <div class="footer-content">
  </div>
  <div class="footer-legal text-center">
    <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">
      <div class="d-flex flex-column align-items-center align-items-lg-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Evix</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
         Designed by <a href="#">Eyein Co</a>
        </div>
      </div>
      <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </div>
  
  </footer><!-- End Footer -->
  
  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <div id="preloader"></div>
  
  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  
  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  </body>
  </html> 