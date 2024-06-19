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
    <!-- Latest Product Section Begin -->
    <section class="latest-product spad" style="direction:ltr;padding-bottom:50px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6" style="margin: auto">
                    <div class="latest-product__text">
                        <h4>ألمطاعم</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($organizations as $organization)
                                <a href="{{route('public.products',$organization->id)}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{asset('public/dist/img/organizations/'.$organization->logo)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ \Illuminate\Support\Str::limit($organization->nameAr, 60, $end='...') }}</h6>
                                        <span style="direction: rtl">{{$organization->address}}</span>
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
