@extends('layouts.eCommerceMasterPage')
<style>
    .no-js .owl-carousel, .owl-carousel.owl-loaded{
        display: contents !important;
    }
</style>
@section('content')
@if (session()->get("lang")=="en")
<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul>
                        <li><a href="#">Fresh Meat</a></li>
                        <li><a href="#">Vegetables</a></li>
                        <li><a href="#">Fruit & Nut Gifts</a></li>
                        <li><a href="#">Fresh Berries</a></li>
                        <li><a href="#">Ocean Foods</a></li>
                        <li><a href="#">Butter & Eggs</a></li>
                        <li><a href="#">Fastfood</a></li>
                        <li><a href="#">Fresh Onion</a></li>
                        <li><a href="#">Papayaya & Crisps</a></li>
                        <li><a href="#">Oatmeal</a></li>
                        <li><a href="#">Fresh Bananas</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="{{asset('img/shop/'.$shop->favicon)}}">
                    <div class="hero__text">
                        <span>FRUIT FRESH</span>
                        <h2>Vegetable <br />100% Organic</h2>
                        <p>Free Pickup and Delivery Available</p>
                        <a href="#" class="primary-btn">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
@else
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>جميع الأقسام</span>
                        </div>
                        <ul>
                            @foreach ($groups as $group)
                            <li><a href="{{route('public.group',$group->id)}}">{{$group->nameAr}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    كل الأقسام
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="عن ماذا تبحث؟">
                                <button type="submit" class="site-btn">بحث</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>{{$shop->phone}}</h5>
                                <span>متاح 24 ساعة</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="{{asset('dist/img/banners/'.$shop->banners->first()->img)}}" style="background-size:cover">
                        <div class="hero__text">
                            <p>{{$shop->nameAr}}</p>
                            <a href="#" class="primary-btn">تسوق الآن</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row" style="direction:ltr">
                <div class="categories__slider owl-carousel">
                    @foreach ($groups as $group)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset('img/groups/'.$group->img)}}">
                            <h5><a href="#">{{$group->nameAr}}</a></h5>
                        </div>
                    </div> 
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>منتجاتنا</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            
                            <li class="active" data-filter="*">الكل</li>
                            @foreach ($groups as $group)
                            <li data-filter=".{{$group->nameEn}}">{{$group->nameAr}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($items as $item)
                <div class="col-lg-3 col-6 col-md-4 col-sm-6 mix oranges {{$item->category->nameEn}}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{asset('dist/img/products/'.$item->img)}}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="{{route('public.itemDetails',$item->id)}}"><i class="fa fa-eye"></i></a></li>
                                <li><a href="#"><i class="fa fa-share-alt"></i></a></li>
                                <li><a href="#" onclick="addToBasket({{$item->id}})"><i class="fa fa-shopping-cart"></i></a></li>
                                <input type="hidden" id="quantity" value="1">
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">{{ \Illuminate\Support\Str::limit($item->nameAr, 40, $end='...') }}</a></h6>
                            <h5>{{$item->prodPrice}} ريال</h5>
                        </div>
                    </div>
                </div> 
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    
    <!-- Latest Product Section Begin -->
    <section class="latest-product spad" style="direction:ltr;padding-bottom:50px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>أحدث المنتجات</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($items as $item)
                                <a href="{{route('public.itemDetails',$item->id)}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{asset('dist/img/products/'.$item->img)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ \Illuminate\Support\Str::limit($item->nameAr, 60, $end='...') }}</h6>
                                        <span style="direction: rtl">{{$item->prodPrice}} ريال</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>الأكثر طلباً</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($items as $item)
                                <a href="{{route('public.itemDetails',$item->id)}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{asset('dist/img/products/'.$item->img)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ \Illuminate\Support\Str::limit($item->nameAr, 60, $end='...') }}</h6>
                                        <span style="direction: rtl">{{$item->prodPrice}} ريال</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>حسب التقييم</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($items as $item)
                                <a href="{{route('public.itemDetails',$item->id)}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{asset('dist/img/products/'.$item->img)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ \Illuminate\Support\Str::limit($item->nameAr, 60, $end='...') }}</h6>
                                        <span style="direction: rtl">{{$item->prodPrice}} ريال</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->
@endif
@endsection
