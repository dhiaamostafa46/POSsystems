<!DOCTYPE html>
<html lang="zxx" @if(session()->get("lang")=="ar") direction="rtl" @endif>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="evix | ايفكس">
    <meta name="keywords" content="مطاعم، مطعم، تسوق، طلب، مشاوي، شاورما">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$shop->nameAr}}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link href="{{asset('assets/img/EVIX ICON SVG.svg')}}" rel="icon">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('cssECommerce/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('cssECommerce/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('cssECommerce/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('cssECommerce/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('cssECommerce/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('cssECommerce/slicknav.min.css')}}" type="text/css">

    @if (session()->get("lang")=="en")
    <link rel="stylesheet" href="{{asset('cssECommerce/style_en.css')}}" type="text/css">
    @else
    <link rel="stylesheet" href="{{asset('cssECommerce/style.css')}}" type="text/css">
    @endif

    <style>
        .mobile-nav {
            background:#f5f5f5 !important;
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

            .header .logo img{
                max-height:30px !important;
            }

            .header__cart{
                padding: 30px 1px 20px !important;
            }
            .hero__categories{
                display: none !important;
            }
            .hero__item{
                height: 175px !important;
            }
            .hero__text{
                display: none !important;
            }
            .owl-nav{
                margin: auto !important;
            }
            .categories{
                display: none !important;
            }
            .featured{
                padding-top: 0px !important;
            }
            .hero{
                padding-bottom:10px !important;
            }
            .latest-product__text{
                padding-bottom:50px !important;
            }
            .fa-phone{
                padding: 17px !important;
            }
            .fa-shopping-cart, .fa-share-alt, .fa-eye{
                padding: 10px !important;
            }
            .featured__controls{
                margin-bottom: 5px !important;
            }
            .product-details{
                padding-top:10px;
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
            .latest-product__item__pic{
                width: 60px;
            }
            .latest-product__item__pic img{
                width: 100%;
                max-height: 60px;
            }
            .latest-product{
                padding-top: 10px;
            }
            .featured{
                padding-bottom: 5px;
            }
            .latest-product__text{
                padding-bottom: 5px;
            }
            .set-bg{
                background-size:cover;
            }
            .checkout{
                padding-bottom: 5px;
                padding-top:5px;
            }
            .checkout__order{
                padding-bottom: 70px;
            }
            .latest-product__text h4{
                padding-bottom: 20px;
            }

            }
            .latest-product__item__pic{
                width: 60px;
            }
            .latest-product__item__pic img{
                width: 100%;
                max-height: 60px;
            }
            .fa-shopping-cart, .fa-share-alt, .fa-eye{
                padding: 10px !important;
            }
            .nice-select{
                text-align: right !important;
            }

            .nice-select .option{
                text-align: right !important;
            }

            .btn-white{
            background-color: #fff !important;
            }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @if (session()->get("lang")=="en")
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{asset('dist/img/logo.png')}}" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__left__language">
                <img src="{{asset('dist/img/language.png')}}" alt="">
                <div>English</div>
                <span class="fa fa-angle-down"></span>
                <ul>
                    <li><a href="{{route('arabic')}}">العربية</a></li>
                    <li><a href="{{route('english')}}">English</a></li>
                </ul>
            </div>
            <div class="header__top__left__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{route('public.index')}}">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="{{route('public.contact')}}">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__left__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->
    @else
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{asset('img/shop/'.$shop->logo)}}" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span id="basket3">{{$sum}}</span></a></li>
            </ul>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__left__language">
                <img src="{{asset('dist/img/saudi.png')}}" alt="">
                <div>العربية</div>
                <span class="fa fa-angle-down"></span>
                <ul>
                    <li><a href="{{route('arabic')}}">العربية</a></li>
                    <li><a href="{{route('english')}}">English</a></li>
                </ul>
            </div>
            <div class="header__top__left__auth">
                @if (empty(auth()->user()))
                <a href="#"><i class="fa fa-user"></i> الدخول</a>
                @else
                <div class="header__top__left__language">
                    <i class="fa fa-user"></i>
                    <div>{{auth()->user()->name}}</div>
                    <span class="fa fa-angle-down"></span>
                    <ul>
                        <li><a href="{{route('public.profile')}}"><span class="fa fa-info text-white"></span>&nbsp; بياناتي</a></li>
                        <li><a href="{{route('public.profile')}}"><span class="fa fa-list text-white"></span>&nbsp;طلباتي</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#logoutModal"><span class="fa fa-sign-out text-white"></span>&nbsp;خروج</a></li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{route('public.index')}}">الرئيسية</a></li>
                <li><a href="{{route('public.contact')}}">تواصل معنا</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__left__social">
            <a href="{{$shop->facebook}}"><i class="fa fa-facebook"></i></a>
            <a href="{{$shop->twitter}}"><i class="fa fa-twitter"></i></a>
            <a href="{{$shop->linkedin}}"><i class="fa fa-linkedin"></i></a>
            <a href="{{$shop->snapchat}}"><i class="fa fa-snapchat"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> {{$shop->email}}</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->
    @endif

    @if (session()->get("lang")=="en")
    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> {{$shop->email}}</li>
                                <li>{{$shop->bio_en}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="{{$shop->facebook}}"><i class="fa fa-facebook"></i></a>
                                <a href="{{$shop->twitter}}"><i class="fa fa-twitter"></i></a>
                                <a href="{{$shop->linkedin}}"><i class="fa fa-linkedin"></i></a>
                                <a href="{{$shop->snapchat}}"><i class="fa fa-snapchat"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="{{asset('dist/img/language.png')}}" alt="">
                                <div>English</div>
                                <span class="fa fa-angle-down"></span>
                                <ul>
                                    <li><a href="{{route('arabic')}}">العربية</a></li>
                                    <li><a href="{{route('english')}}">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="#"><i class="fa fa-user"></i> Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="#"><img src="{{asset('img/shop/'.$shop->logo)}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{route('public.index')}}">Home</a></li>
                            <li><a href="{{route('public.contact')}}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price">Total: <span>$150.00</span></div>
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
                                <li><i class="fa fa-envelope"></i> {{$shop->email}}</li>
                                <li>{{$shop->bio_ar}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <div class="header__top__left__social">
                                <a href="{{$shop->facebook}}"><i class="fa fa-facebook"></i></a>
                                <a href="{{$shop->twitter}}"><i class="fa fa-twitter"></i></a>
                                <a href="{{$shop->linkedin}}"><i class="fa fa-linkedin"></i></a>
                                <a href="{{$shop->snapchat}}"><i class="fa fa-snapchat"></i></a>
                            </div>
                            <div class="header__top__left__language">
                                <img src="{{asset('dist/img/saudi.png')}}" alt="">
                                <div>العربية</div>
                                <span class="fa fa-angle-down"></span>
                                <ul>
                                    <li><a href="{{route('arabic')}}">العربية</a></li>
                                    <li><a href="{{route('english')}}">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__left__auth">
                                @if (empty(auth()->user()))
                                <a href="#"><i class="fa fa-user"></i> دخول</a>
                                @else
                                <div class="header__top__left__language">
                                    <img src="{{asset('dist/img/profile.png')}}" style="width:20px;height:20px;" alt="">
                                    <div>{{auth()->user()->name}}</div>
                                    <span class="fa fa-angle-down"></span>
                                    <ul>
                                        <li><a href="{{route('arabic')}}"><span class="fa fa-info text-white"></span>&nbsp; بياناتي</a></li>
                                        <li><a href="{{route('arabic')}}"><span class="fa fa-list text-white"></span>&nbsp;طلباتي</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#logoutModal"><span class="fa fa-sign-out text-white"></span>&nbsp;خروج</a></li>
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
                <div class="col-2">
                    <div class="header__logo">
                        <a href="{{route('public.index')}}"><img src="{{asset('dist/img/shop/'.$shop->logo)}}" alt=""></a>
                    </div>
                </div>
                <div class="col-4">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{route('public.index')}}" style="letter-spacing: 0px">الرئيسية</a></li>
                            <li><a href="{{route('public.contact')}}" style="letter-spacing: 0px">تواصل معنا</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-6">
                    <div class="header__cart">
                        <ul>
                            <!--<li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>-->
                            <li><a href="{{route('public.checkouts')}}"><i class="fa fa-shopping-bag"></i> <span id="basket">{{$sum}}</span></a></li>
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
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">هل تريد الخروج فعلاً؟</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="margin-left: 0px">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">اختر الخروج اذا كنت ترغب في المغادرة</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">بقاء</button>
              <a class="btn btn-primary" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">خروج</a>
              <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                      @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
    @endif

    @yield('content')

    <nav class="mobile-nav mt-4" style="display: none">
        <a href="{{route('public.index')}}" class="bloc-icon">
            <img src="{{asset('dist/img/hero/home.svg')}}" alt="">
        </a>
        <a href="{{route('public.categories')}}" class="bloc-icon">
            <img src="{{asset('dist/img/hero/category.svg')}}" alt="">
        </a>
        <a href="{{route('public.checkouts')}}" class="bloc-icon">
            <img src="{{asset('dist/img/hero/bag.svg')}}" alt="">
            <span id="basket2">{{$sum}}</span>
        </a>
        <a href="{{route('public.profile')}}" class="bloc-icon">
            <img src="{{asset('dist/img/hero/profile.svg')}}" alt="">
        </a>
    </nav>

    <!-- Js Plugins -->
    <script src="{{asset('jsECommerce/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('jsECommerce/bootstrap.min.js')}}"></script>
    <script src="{{asset('jsECommerce/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('jsECommerce/jquery-ui.min.js')}}"></script>
    <script src="{{asset('jsECommerce/jquery.slicknav.js')}}"></script>
    <script src="{{asset('jsECommerce/mixitup.min.js')}}"></script>
    <script src="{{asset('jsECommerce/owl.carousel.min.js')}}"></script>
    <script src="{{asset('jsECommerce/main.js')}}"></script>

    <script>
        function addToBasket(id){

            var sName = " ";
            var sum = 0;
            try{
                $('input[type=checkbox]').each(function () {
                sum += (this.checked ? +$(this).data('price') : +0);
                sName += (this.checked ? "+"+$(this).data('name') : "");
                });
            }catch{

            }

            console.log (sName)

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
    function RemoveToBasket(id){


       $.ajax({
                    url: `/RemoveTasket/${id}`,
                    dataType: "json",
                    success: data => {


                        //    console.log(data.products);
                            $('#basket').html(data.sum)
                            $('#basket2').html(data.sum)
                            $('#basket3').html(data.sum)
                            $('#itemscardShopees').empty();
                          data.products.forEach((element,index) => {
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


