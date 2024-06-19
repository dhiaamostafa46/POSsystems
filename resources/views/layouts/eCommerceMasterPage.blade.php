<!DOCTYPE html>
<html lang="zxx" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="evix | ايفكس">
    <meta name="keywords" content="مطاعم، مطعم، تسوق، طلب، مشاوي، شاورما">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">




    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/img/EVIX ICON SVG.svg') }}" rel="icon">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('cssECommerce/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('cssECommerce/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('cssECommerce/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('cssECommerce/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('cssECommerce/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('cssECommerce/slicknav.min.css') }}" type="text/css">


    @if (LaravelLocalization::getCurrentLocaleDirection() == 'ltr')
        <link rel="stylesheet" href="{{ asset('cssECommerce/styleEnl.css') }}" type="text/css">
    @else
        <link rel="stylesheet" href="{{ asset('cssECommerce/styleAr.css') }}" type="text/css">
    @endif
    {{-- @dd(session('orgsetting')->storecolor); --}}
    <style>
        a {
            text-decoration: none;
        }

        .mobile-nav {
            background: #f5f5f5 !important;
            position: fixed !important;
            bottom: 0 !important;
            height: 65px !important;
            width: 100% !important;
            display: flex !important;
            justify-content: space-around !important;
        }

        .bloc-icon {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
        }

        .bloc-icon img {
            width: 30px;
        }

        @media screen and (min-width: 600px) {
            .mobile-nav {
                display: none !important;
            }
        }

        @media screen and (max-width: 600px) {

            .header__logo {
                height: 70px;
                width: 60px;
            }

            .header .logo img {
                max-height: 30px !important;
            }

            .header__cart {
                padding: 30px 1px 20px !important;
            }

            .hero__categories {
                display: none !important;
            }

            .hero__item {
                height: 175px !important;
            }

            .hero__text {
                display: none !important;
            }

            .owl-nav {
                margin: auto !important;
            }

            .categories {
                display: none !important;
            }

            .featured {
                padding-top: 0px !important;
            }

            .hero {
                padding-bottom: 10px !important;
            }

            .latest-product__text {
                padding-bottom: 50px !important;
            }

            .fa-phone {
                padding: 17px !important;
            }

            .fa-shopping-cart,
            .fa-share-alt,
            .fa-eye {
                padding: 10px !important;
            }

            .featured__controls {
                margin-bottom: 5px !important;
            }

            .product-details {
                padding-top: 10px;
            }

            #basket2 {
                height: 13px;
                width: 13px;
                background: #fb2205;
                font-size: 10px;
                color: #ffffff;
                line-height: 13px;
                text-align: center;
                font-weight: 700;
                display: inline-block;
                border-radius: 50%;
                position: absolute;
                top: 20px;
                margin-left: 15px;
            }

            .latest-product__item__pic {
                width: 60px;
            }

            .latest-product__item__pic img {
                width: 100%;
                max-height: 60px;
            }

            .latest-product {
                padding-top: 10px;
            }

            .featured {
                padding-bottom: 5px;
            }

            .latest-product__text {
                padding-bottom: 5px;
            }

            .set-bg {
                background-size: cover;
            }

            .checkout {
                padding-bottom: 5px;
                padding-top: 5px;
            }

            .checkout__order {
                padding-bottom: 70px;
            }

            .latest-product__text h4 {
                padding-bottom: 20px;
            }

        }

        .latest-product__item__pic {
            width: 60px;
        }

        .latest-product__item__pic img {
            width: 100%;
            max-height: 60px;
        }

        .fa-shopping-cart,
        .fa-share-alt,
        .fa-eye {
            padding: 10px !important;
        }

        .nice-select {
            text-align: right !important;
        }

        .nice-select .option {
            text-align: right !important;
        }

        .btn-white {
            background-color: #fff !important;
        }

        .btn-primary
        {
            background-color:{{session('orgsetting')->storecolor ??""}};
        }
        .colors
        {
            background:{{session('orgsetting')->storecolor ?? ''}};
            color:{{session('orgsetting')->fontcolor ?? ''}};
        }
    </style>
   
    @if (LaravelLocalization::getCurrentLocaleDirection() == 'ltr')
        <style>
            @media screen and (max-width: 750px) {
                #headerlogodiv {
                    display: none;
                }

                #headermenudiv {
                    display: none;
                }

            }

            @media screen and (max-width: 600px) {
                .header__cart {
                    text-align: left
                }

            }
        </style>
    @else
        <style>
            @media screen and (max-width: 750px) {
                #headerlogodiv {
                    display: none;
                }

                #headermenudiv {
                    display: none;
                }

            }

            @media screen and (max-width: 600px) {
                .header__cart {
                    text-align: right;

                }

            }
        </style>
    @endif

    @include('layouts.Styleshop')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @if (LaravelLocalization::getCurrentLocaleDirection() == 'ltr')
        <!-- Humberger Begin -->
        <div class="humberger__menu__overlay"></div>
        <div class="humberger__menu__wrapper">
            <div class="humberger__menu__logo">
                <a href="#"><img src="{{ asset('img/shop/' . $Online->logo) }}" alt=""></a>
            </div>
            <div class="humberger__menu__cart">
                <ul>
                    <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                    <li><a href="#"><i class="fa fa-shopping-bag"></i> <span
                                id="basket3">{{ $sum }}</span></a></li>
                </ul>
            </div>

            <nav class="humberger__menu__nav mobile-menu">
                <ul>
                    <li class="active"><a href="{{ route('public.index', $orgID) }}"> {{ trans('Online.Main') }}</a>
                    </li>
                    <li><a href="{{ route('public.contact', $orgID) }}"> {{ trans('Online.Connectwithus') }}</a></li>
                    <li><a href="{{ LaravelLocalization::getLocalizedURL('ar') }}"> عربي </a></li>
                    <li><a href="{{ route('Shop.login', $orgID) }}"> Login </a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>

        </div>
        <!-- Humberger End -->
    @else
        <!-- Humberger Begin -->
        <div class="humberger__menu__overlay"></div>
        <div class="humberger__menu__wrapper">
            <div class="humberger__menu__logo">
                <a href="#"><img src="{{ asset('img/shop/' . $Online->logo) }}" alt=""></a>
            </div>
            <div class="humberger__menu__cart">
                <ul>
                    <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                    <li><a href="#"><i class="fa fa-shopping-bag"></i> <span
                                id="basket3">{{ $sum }}</span></a></li>
                </ul>
            </div>

            <nav class="humberger__menu__nav mobile-menu">
                <ul>

                    <li class="active"><a href="{{ route('public.index', $orgID) }}"> {{ trans('Online.Main') }}</a>
                    </li>
                    <li><a href="{{ route('public.contact', $orgID) }}"> {{ trans('Online.Connectwithus') }}</a></li>
                    <li class="active"><a href="{{ LaravelLocalization::getLocalizedURL('en') }}"> English </a></li>
                    <li><a href="{{ route('Shop.login', $orgID) }}"> الدخول </a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>

        </div>
        <!-- Humberger End -->
    @endif

    @if (LaravelLocalization::getCurrentLocaleDirection() == 'ltr')
        <!-- Header Section Begin -->
        <header class="header">
            <div class="header__top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="header__top__left">
                                <ul>
                                    <li><i class="fa fa-envelope"></i> {{ $Online->email }}</li>
                                    <li>{{ $Online->bio_en }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="header__top__right">
                                <div class="header__top__right__social">
                                    <a href="{{ $Online->facebook }}"><i class="fa fa-facebook"></i></a>
                                    <a href="{{ $Online->twitter }}"><i class="fa fa-twitter"></i></a>
                                    <a href="{{ $Online->linkedin }}"><i class="fa fa-linkedin"></i></a>
                                    <a href="{{ $Online->snapchat }}"><i class="fa fa-snapchat"></i></a>
                                </div>
                                <div class="header__top__right__language">
                                    <img src="{{ asset('dist/img/language.png') }}" alt="">
                                    <div>English</div>
                                    <span class="fa fa-angle-down"></span>
                                    <ul>
                                        {{-- <li><a href="{{route('arabic')}}">العربية</a></li>
                                    <li><a href="{{route('english')}}">English</a></li> --}}
                                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <li>
                                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                    {{ $properties['native'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="header__top__right__auth">
                                    @if (empty(auth()->guard('Shop')->User()))
                                        <a href="{{ route('Shop.login', $orgID) }}"><i class="fa fa-user"></i>
                                            {{ trans('Online.Login') }}</a>
                                    @else
                                        <div class="header__top__left__language">
                                            <a href="{{ route('ProfileShop', $orgID) }}">
                                                <img src="{{ asset('dist/img/profile.png') }}"
                                                    style="width:20px;height:20px;" alt="">
                                                <div>{{ auth()->guard('Shop')->user()->name }}</div>
                                                <span class="fa fa-angle-down"></span>
                                            </a>

                                            <ul>
                                                <li><a href="{{ route('ProfileShop', $orgID) }}"><span
                                                            class="fa fa-info text-white"></span>&nbsp; بياناتي</a>
                                                </li>
                                                <li><a href="{{ route('ProfileShop', $orgID) }}"><span
                                                            class="fa fa-list text-white"></span>&nbsp;طلباتي</a></li>
                                                <li><a data-toggle="modal" style="color: white" data-target="#logoutModal"><span class="fa fa-sign-out text-white"></span>&nbsp;خروج</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3" id="headerlogodiv">
                        <div class="header__logo">
                            <a href="#"><img src="{{ asset('img/shop/' . $Online->logo) }}"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6" id="headermenudiv">
                        <nav class="header__menu">
                            <ul>
                                <li><a
                                        href="{{ route('public.index', $orgID) }}">{{ trans('Online.Main') }}</a>
                                </li>
                                <li ><a href="{{ route('public.categories', $orgID) }}">
                                        {{ trans('Section') }} </a>
                                </li>

                                <li><a
                                        href="{{ route('public.contact', $orgID) }}">{{ trans('Online.Connectwithus') }}</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3">
                        <div class="header__cart">
                            <ul>
                                <!--<li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>-->
                                <li><a href="{{ route('checkouts', $orgID) }}"><i class="fa fa-shopping-bag"></i>
                                        <span id="basket">{{ $sum }}</span></a></li>
                            </ul>

                        </div>
                    </div>

                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>
        <!-- Header Section End -->
    @else
        <!-- Header Section Begin -->
        <header class="header">
            <div class="header__top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="header__top__right">
                                <ul>
                                    <li><i class="fa fa-envelope"></i> {{ $Online->email }}</li>
                                    <li>{{ $Online->bio_ar }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="header__top__left">
                                <div class="header__top__left__social">
                                    <a href="{{ $Online->facebook }}"><i class="fa fa-facebook"></i></a>
                                    <a href="{{ $Online->twitter }}"><i class="fa fa-twitter"></i></a>
                                    <a href="{{ $Online->linkedin }}"><i class="fa fa-linkedin"></i></a>
                                    <a href="{{ $Online->snapchat }}"><i class="fa fa-snapchat"></i></a>
                                </div>
                                <div class="header__top__left__language">
                                    <img src="{{ asset('dist/img/saudi.png') }}" alt="">
                                    <div>العربية</div>
                                    <span class="fa fa-angle-down"></span>
                                    <ul>
                                        {{-- <li><a href="{{route('arabic')}}">العربية</a></li>
                                    <li><a href="{{route('english')}}">English</a></li> --}}
                                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <li>
                                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                    {{ $properties['native'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="header__top__left__auth">
                                    @if (empty(auth()->guard('Shop')->User()))
                                        <a href="{{ route('Shop.login', $orgID) }}"><i class="fa fa-user"></i>
                                            {{ trans('Online.Login') }}</a>
                                    @else
                                        <div class="header__top__left__language">
                                            <a href="{{ route('ProfileShop', $orgID) }}">
                                                <img src="{{ asset('dist/img/profile.png') }}"
                                                    style="width:20px;height:20px;" alt="">
                                                <div>{{ auth()->guard('Shop')->user()->name }}</div>
                                                <span class="fa fa-angle-down"></span>
                                            </a>

                                            <ul>
                                                <li><a href="{{ route('ProfileShop', $orgID) }}"><span
                                                            class="fa fa-info text-white"></span>&nbsp; بياناتي</a>
                                                </li>
                                                <li><a href="{{ route('ProfileShop', $orgID) }}"><span
                                                            class="fa fa-list text-white"></span>&nbsp;طلباتي</a></li>
                                                <li><a data-toggle="modal" style="color:white" data-target="#logoutModal"><span class="fa fa-sign-out text-white"></span>&nbsp;خروج</a>
                                                </li>

                                            </ul>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-2 header__logodiv" id="headerlogodiv">
                        <div class="header__logo">
                            <a href="{{ route('public.index', $orgID) }}"><img
                                    src="{{ asset('dist/img/shop/' . $Online->logo) }}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-6 header__menudiv" id="headermenudiv">
                        <nav class="header__menu">
                            <ul>
                                <li><a href="{{ route('public.index', $orgID) }}"
                                        style="letter-spacing: 0px"> {{ trans('Online.Main') }}</a></li>
                                <li><a href="{{ route('public.categories', $orgID) }}">
                                        {{ trans('الأقسام') }} </a>
                                <li><a href="{{ route('public.contact', $orgID) }}" style="letter-spacing: 0px">
                                        {{ trans('Online.Connectwithus') }}</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-4 ">
                        <div class="header__cart">
                            <ul>
                                <!--<li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>-->
                                <li><a href="{{ route('checkouts', $orgID) }}"><i class="fa fa-shopping-bag"></i>
                                        <span id="basket">{{ $sum }}</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>

        <!-- Header -->
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">هل تريد الخروج فعلاً؟</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"
                            style="margin-left: 0px">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">اختر الخروج اذا كنت ترغب في المغادرة</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">بقاء</button>
                        <a class="btn btn-primary" href="{{ route('Shoplogout', $orgID) }}">خروج</a>

                    </div>
                </div>
            </div>
        </div>
    @endif
























    @yield('content')
     <style>
        .header__top__left__social li {
            display: inline-block;
            padding-right: 5px;
            padding-left: 5px;
            margin-bottom: 10px;
        }
    </style>

      <div class="text-center" style="margin-bottom: 100px">
        <div class="header__top__left__social">
            @if (session('orgsetting')->Facebook != null)
                <li> <a href="{{ session('orgsetting')->Facebook }}"><i class="fa fa-Facebook"></i></a></li>
            @endif
            @if (session('orgsetting')->Twitter != null)
                <li> <a href="{{ session('orgsetting')->Twitter }}"><i class="fa fa-twitter"></i></a></li>
            @endif
            @if (session('orgsetting')->Instagram != null)
                <li> <a href="{{ session('orgsetting')->Instagram }}"><i class="fa fa-instagram"></i></a></li>
            @endif
            @if (session('orgsetting')->Snapchat != null)
                <li> <a href="{{ session('orgsetting')->Snapchat }}"><i class="fa fa-napchat"></i></a></li>
            @endif
            @if (session('orgsetting')->YouTube != null)
                <li> <a href="{{ session('orgsetting')->YouTube }}"><i class="fa fa-youtube"></i></a></li>
            @endif
            @if (session('orgsetting')->TikTok != null)
                <li> <a href="{{ session('orgsetting')->TikTok }}"><i class="fa fa-youtube"></i></a></li>
            @endif
            @if (session('orgsetting')->Pinterest != null)
                <li> <a href="{{ session('orgsetting')->Pinterest }}"><i class="fa fa-pinterest"></i></a></li>
            @endif
            @if (session('orgsetting')->Messenger != null)
                <li> <a href="{{ session('orgsetting')->Messenger }}"><i class="fa fa-pinterest"></i></a></li>
            @endif
            @if (session('orgsetting')->Google != null)
                <li> <a href="{{ session('orgsetting')->Google }}"><i class="fa fa-google-plus"></i></a></li>
            @endif
        </div>

    </div>
    
    
    
       <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // Create a new style element
            var styleElement = $("<style>");
            var styleElementul = $("<style>");

            var color="{{session('orgsetting')->storecolor ??''}}";
            // Define the CSS rule for the pseudo-element
            var cssRule = ".section-title h2::after { background-color:"+color+"!important; }";
            var cssRuleulil = ".featured__controls ul li:after { background-color:"+color+"!important; }";


            // Add the CSS rule to the style element
            styleElement.text(cssRule);
            styleElementul.text(cssRuleulil);

            // Append the style element to the document head
            $("head").append(styleElement);
            $("head").append(styleElementul);
        });
    </script>
    

    <nav class="mobile-nav mt-4" style="display: none">
        <a href="{{ route('public.index', $orgID) }}" class="bloc-icon">
            <img src="{{ asset('dist/img/hero/home.svg') }}" alt="">
        </a>
        <a href="{{ route('public.categories', $orgID) }}" class="bloc-icon">
            <img src="{{ asset('dist/img/hero/category.svg') }}" alt="">
        </a>
        <a href="{{ route('checkouts', $orgID) }}" class="bloc-icon">
            <img src="{{ asset('dist/img/hero/bag.svg') }}" alt="">
            <span id="basket2">{{ $sum }}</span>
        </a>
        @if (!empty(session('tableNo')))
        <a class="bloc-icon" href="{{ route('callnadel') }}" >
            <img src="{{ asset('dist/img/hero/ball.png') }}" alt="">
        </a>
        @endif
        <a class="bloc-icon" href="{{ route('Shop.login', $orgID) }}" >
            <img src="{{ asset('dist/img/hero/profile.svg') }}" alt="">
        </a>
    </nav>

    <!-- Js Plugins -->
    <script src="{{ asset('jsECommerce/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('jsECommerce/bootstrap.min.js') }}"></script>
    <script src="{{ asset('jsECommerce/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('jsECommerce/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('jsECommerce/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('jsECommerce/mixitup.min.js') }}"></script>
    <script src="{{ asset('jsECommerce/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('jsECommerce/main.js') }}"></script>

    <script>
        function addToBasket(id) {

            var sName = " ";
            var sum = 0;
            try {
                $('input[type=checkbox]').each(function() {
                    sum += (this.checked ? +$(this).data('price') : +0);
                    sName += (this.checked ? "+" + $(this).data('name') : "");
                });
            } catch {

            }

            console.log(sName)

            $('#basket').empty()
            $('#basket2').empty()
            $('#basket3').empty()
            $.ajax({
                url: `/basket/${document.getElementById('quantity').value}/${id}/${sName}/${sum}`,
                success: data => {
                    $('#basket').html(data.sum)
                    $('#basket2').html(data.sum)
                    $('#basket3').html(data.sum)
                }
            });
        }
    </script>


    <script>
        function RemoveToBasket(id) {


            $.ajax({
                url: `/RemoveTasket/${id}`,
                dataType: "json",
                success: data => {


                    //    console.log(data.products);
                    $('#basket').html(data.sum)
                    $('#basket2').html(data.sum)
                    $('#basket3').html(data.sum)
                    $('#itemscardShopees').empty();
                    data.products.forEach((element, index) => {
                        $('#itemscardShopees').append(`<tr>
                                        <th scope="col" style="width: 70%">المنتج </th>
                                        <th scope="col" style="width: 20%">القيمة</th>
                                        <th scope="col" style="width: 5%"></th>
                                      </tr>`);



                    });



                }
            });
        }
    </script>

</body>

</html>
