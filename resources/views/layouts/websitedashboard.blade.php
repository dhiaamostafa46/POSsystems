<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="
              ايفيكس نظام تخطيط موارد المنشات  (ERP)يقدم حلول مبتكره ومزايا فريدة لاداره المشاريع بحيث يوفر مجموعه من الخدمات التي تحسن وترفع أداء منشأتك حيث انه يتمتع بالمرونة والدقة العالية التي تساعد في السيطرة على جميع موارد منشأتك عن طريق التخزين السحابي ليمنحك امانا تاما لبيانات ومعلومات منشأتك ويسهل عليك الحصول على تقارير متطورة وملهمة لاتخاذ قرارت تعزز من ربحيتك في أي وقت واي مكان
">
    <meta name="keywords"
        content="نقاط البيع, نظام نقاط البيع, نظما محاسبي , إدارة المخزون, إدارة الطلبات, غدارة المطاعم, إدارة المبيعات, إدارة المشتريات, معتمد من هيئة الذكاة والدخل,خيئة الزكاة والضريبة, إيفكس لإدارة المطاعم, إيفكس نظام محاسبي, إيفكس للموارد البشرية, مسير الرواتب, سجلات الحضور والإنصراف,الريسبي,المطاعم الريسبي والمقادير">
    <meta name="author" content="elemis">
    <title>{{ trans('website.Evix') }}</title>



    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    
    <link href="{{ asset('assets/img/favicon.png') }}" rel="apple-touch-icon">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="{{ asset('assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/colors/green.css') }}">

    <!--Tajwal Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        .tajawal-extralight {
            font-family: "Tajawal", sans-serif;
            font-weight: 200;
            font-style: normal;
        }

        .tajawal-light {
            font-family: "Tajawal", sans-serif;
            font-weight: 300;
            font-style: normal;
        }

        .tajawal-regular {
            font-family: "Tajawal", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .tajawal-medium {
            font-family: "Tajawal", sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        .tajawal-bold {
            font-family: "Tajawal", sans-serif;
            font-weight: 700;
            font-style: normal;

        }

        .tajawal-extrabold {
            font-family: "Tajawal", sans-serif;
            font-weight: 800;
            font-style: normal;
        }

        .tajawal-black {
            font-family: "Tajawal", sans-serif;
            font-weight: 900;
            font-style: normal;
        }

        p,
        h1,
        h2,
        h3.h4,
        h5,
        a {
            font-family: "Tajawal", sans-serif;
        }

        .toRight {
            text-align: right;
            float: right;
        }
    </style>
</head>

<!--style="direction: rtl;" -->

<body>
    <div class="content-wrapper" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
        <header class="wrapper bg-soft-primary">
            <nav class="navbar navbar-expand-lg classic transparent position-absolute navbar-dark">
                <div class="container flex-lg-row flex-nowrap align-items-center">
                    <div class="navbar-brand w-100">
                        <a> <!--EVIX LOGO-AR  logo-purple.png logo-light.png-->
                            @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                <img class="logo-dark" src="{{ asset('assets/img/website/EVIX LOGO-A.png') }}"
                                    srcset="{{ asset('assets/img/EVIX LOGO-A.png') }}" alt="" />
                                <img class="logo-light" src="{{ asset('assets/img/website/EVIX LOGO-A.png') }}"
                                    srcset="{{ asset('assets/img/EVIX LOGO-A.png 2x') }}" alt="" />
                            @else
                                <!--<img class="logo-dark" src="{{ asset('assets/img/website/EVIX LOGO  - EN.png') }}" srcset="{{ asset('assets/img/EVIX LOGO-A.png') }}" alt="" />-->
                                <!--<img class="logo-light" src="{{ asset('assets/img/website/EVIX LOGO  - EN.png') }}" srcset="{{ asset('assets/img/EVIX LOGO-A.png 2x') }}" alt="" />-->
                            @endif
                        </a>
                    </div>
                    <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                        <div class="offcanvas-header d-lg-none">
                            <h3 class="text-white fs-30 mb-0 tajawal-bold">{{ trans('website.Evix') }}</h3>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown dropdown-mega">
                                    <a class="nav-link" href="{{route('home')}}">{{ trans('website.Home') }}</a>
                                    {{-- <ul class="dropdown-menu mega-menu mega-menu-dark mega-menu-img">
                    <li class="mega-menu-content">
                      <ul class="row row-cols-1 row-cols-lg-6 gx-0 gx-lg-4 gy-lg-2 list-unstyled">



                      </ul>
                      <!--/.row -->
                      <span class="d-none d-lg-flex"><i class="uil uil-direction"></i><strong>Scroll to view more</strong></span>
                    </li>
                    <!--/.mega-menu-content-->
                  </ul> --}}
                                    <!--/.dropdown-menu -->
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link " href="#"
                                        data-bs-toggle="dropdown">{{ trans('website.OurSolutions') }}</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="dropdown-item" href="{{route('posdescription')}}"
                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') style="text-align:right" @else tyle="text-align:left" @endif>{{ trans('website.pos') }}</a>
                                        </li>
                                        <li class="nav-item"><a class="dropdown-item" href="{{route('restaurantdescription')}}"
                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') style="text-align:right" @else tyle="text-align:left" @endif>{{ trans('website.resturant') }}</a>
                                        </li>

                                        <li class="nav-item"><a class="dropdown-item" href="{{route('HRdescription')}}"
                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') style="text-align:right" @else tyle="text-align:left" @endif>{{ trans('website.hr') }}</a>
                                        </li>
                                        <li class="nav-item"><a class="dropdown-item" href="{{route('TreeDesc.index')}}"
                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') style="text-align:right" @else tyle="text-align:left" @endif>{{ trans('website.accounting') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{ route('menudescription') }}" @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') style="text-align:right" @else tyle="text-align:left" @endif> المنيو الالكتروني </a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="dropdown-item" href="{{ route('journalsdescription') }}" @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') style="text-align:right" @else tyle="text-align:left" @endif>  قيود الالكترونية </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{ route('Warehousesdescription') }}" @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') style="text-align:right" @else tyle="text-align:left" @endif>  إدارة المستودعات </a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link " href="#"
                                        data-bs-toggle="dropdown">{{ trans('website.OtherServices') }}</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="dropdown-item" href="#">الربط مع بوابات
                                                الدفع الإلكتروني</a></li>
                                        <li class="nav-item"><a class="dropdown-item" href="#"
                                                style="text-align:right">الرسائل القصيرة</a></li>
                                        <li class="nav-item"><a class="dropdown-item" href="#"
                                                style="text-align:right">رسائل الواتساب</a></li>


                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" type ="button"
                                        href="{{route('home')}}#prices">{{ trans('website.PackagePricing') }}</a>

                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link " href="{{route('home')}}#contacts">{{ trans('website.Contactus') }}</a>

                                </li>


                            </ul>
                            <!-- /.navbar-nav -->

                            <!-- /.offcanvas-footer -->
                        </div>
                        <!-- /.offcanvas-body -->
                    </div>
                    <!-- /.navbar-collapse -->
                    <div class="navbar-other ms-lg-4">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item dropdown language-select text-uppercase">
                                <a class="nav-link dropdown-item dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                        class="uil uil-globe btn-white" style="font-size: 30px;"></i></a>

                                <ul class="dropdown-menu">

                                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li class="nav-item">
                                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                            <li class="nav-item d-none d-md-block">
                                <a href="{{ route('register') }}"
                                    class="btn btn-sm btn-white rounded-pill tajawal-bold">{{ trans('website.testversion') }}
                                </a>
                            </li>
                            <li class="nav-item d-none d-md-block">
                                <a href="{{ route('login') }}"
                                    class="btn btn-sm btn-white rounded-pill tajawal-bold">تسجيل الدخول</a>
                            </li>
                            <li class="nav-item d-lg-none">
                                <button class="hamburger offcanvas-nav-btn"><span></span></button>
                            </li>
                        </ul>
                        <!-- /.navbar-nav -->
                    </div>
                    <!-- /.navbar-other -->
                </div>
                <!-- /.container -->
            </nav>
            <!-- /.navbar -->
        </header>
        <!-- /header -->
        @yield('content')

    </div>
    <!-- /.content-wrapper -->

    <footer class="bg-dark text-inverse" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" style='font-family: "Tajawal", sans-serif;'>
        <div class="container py-13 py-md-15">
            <div class="row gy-6 gy-lg-0">
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <img class="mb-4" src="{{ asset('assets/img/EVIX LOGO-A.png') }}"
                            srcset="./assets/img/EVIX LOGO-A.png 2x" alt="" />
                        <p class="mb-4">{{ trans('website.evix2024') }} <br
                                class="d-none d-lg-block" />{{ trans('website.allrights') }}</p>
                        <nav class="nav social social-white">
                            <!--<a href="#"><i class="uil uil-twitter"></i></a>-->
                            <a href="https://www.facebook.com/profile.php?id=61558958787960&sk=about_details"><i class="uil uil-facebook-f"></i></a>
                            <!--<a href="#"><i class="uil uil-dribbble"></i></a>-->
                            <a href="https://www.instagram.com/evixksa?igsh=NTc4MTIwNjQ2YQ=="><i class="uil uil-instagram"></i></a>
                            <!--<a href="#"><i class="uil uil-youtube"></i></a>-->
                        </nav>
                        <!-- /.social -->
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title text-white mb-3 tajawal-bold">{{ trans('website.Contactus') }}</h4>
                        <ul class="list-unstyled  mb-0" style='font-family: "Tajawal", sans-serif;'>
                            <li><a href="#" class="tajawal-bold">info@evix.com.sa</a></li>
                            {{-- <li><a href="#">Projects</a></li> --}}
                            <li><a href="{{route('Condition')}}" class="tajawal-bold">{{ trans('website.Terms') }}</a></li>
                            <li><a href="{{route('Condition')}}" class="tajawal-bold">{{ trans('website.Privacy') }}</a></li>
                        </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title text-white mb-3">{{ trans('website.LearnMore') }}</h4>
                        <ul class="list-unstyled  mb-0" style='font-family: "Tajawal", sans-serif;'>

                            <li><a href="#" class="tajawal-bold">{{ trans('website.accounting') }}</a></li>
                            <li><a href="#" class="tajawal-bold">{{ trans('website.pos') }}</a></li>
                            <li><a href="#" class="tajawal-bold">{{ trans('website.hr') }}</a></li>
                            <li><a href="#" class="tajawal-bold">{{ trans('website.stock') }}</a></li>
                        </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-md-12 col-lg-3">
                    <div class="widget" style='font-family: "Tajawal", sans-serif;'>
                        <h4 class="widget-title text-white mb-3">{{ trans('website.News') }}</h4>
                        <p class="mb-5" style='font-family: "Tajawal", sans-serif;'>{{ trans('website.newsDet') }}</p>
                        <div class="newsletter-wrapper">
                            <!-- Begin Mailchimp Signup Form -->
                            <div id="mc_embed_signup2">
                                <form action="#" method="post" id="mc-embedded-subscribe-form2"
                                    name="mc-embedded-subscribe-form" class="validate dark-fields" target="_blank"
                                    novalidate>
                                    <div id="mc_embed_signup_scroll2" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
                                        <div class="mc-field-group input-group form-floating" >

                                            <input type="email" value="" name="EMAIL"
                                                class="form-control tajawal-bold toRight" placeholder="Email Address"
                                                id="mce-EMAIL2">
                                            {{-- <label for="mce-EMAIL2" class="tajawal-bold toRight"> البريد الإلكتروني</label> --}}
                                            <input type="submit" value="{{ trans('website.Join') }}"
                                                name="subscribe" id="mc-embedded-subscribe2"
                                                class="btn btn-primary toRight">

                                        </div>
                                        <div id="mce-responses2" class="clear">
                                            <div class="response" id="mce-error-response2" style="display:none">
                                            </div>
                                            <div class="response" id="mce-success-response2" style="display:none">
                                            </div>
                                        </div>
                                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input
                                                type="text" name="b_ddc180777a163e0f9f66ee014_4b1bcfa0bc"
                                                tabindex="-1" value=""></div>
                                        <div class="clear"></div>
                                    </div>
                                </form>
                            </div>
                            <!--End mc_embed_signup-->
                        </div>
                        <!-- /.newsletter-wrapper -->
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </footer>
    {{-- <div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
  </div> --}}

  <style>
    .float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 40px;
    right: 40px;
    background-color: #25d366;
    color: #FFF;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    box-shadow: 2px 2px 3px #999;
    z-index: 100;
}
  </style>

    <a href="https://api.whatsapp.com/send?phone=966583490100&amp;text=مرحبا ايفكس :        %0a
    اود الاستفسار عن الخدمات المتوفره عندكم والاسعار
    %0a   وكيفية الحصول على كود الخصم
"
        class="float" target="_blank">
        <i class="uil uil-whatsapp my-float"></i>
    </a>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
</body>

</html>

