@extends('layouts.eCommerceMasterPage')
<style>
    .no-js .owl-carousel,
    .owl-carousel.owl-loaded {
        display: contents !important;
    }
    .seting:after {
	position: absolute;
	right: 0;
	bottom: -15px;
	left: 0;
	height: 4px;
	width: 80px;
	background: red;
	content: "";
	margin: 0 auto;
}
</style>
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all colors">
                            <i class="fa fa-bars" style="color:{{session('orgsetting')->fontcolor ?? ''}}"></i>
                            <span style="color:{{session('orgsetting')->fontcolor ??''}}"> {{ trans('Online.ALLsections') }} </span>
                        </div>
                        <ul>
                            @foreach ($groups as $group)
                                <li><a href="{{ route('public.categoryDetails', [$group->id, $orgID]) }}">
                                        @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                            {{ $group->nameAr }}
                                        @else
                                            {{ $group->nameEn }}
                                        @endif
                                    </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    {{ trans('Online.ProductName') }}
                                </div>
                                <input type="text" placeholder=" {{ trans('Online.Whatareyoulookingfor') }}">
                                <button type="submit" class="site-btn colors"> {{ trans('Online.Search') }}</button>
                            </form>
                        </div>
                    </div>
                    <div class="hero__item set-bg"
                        @if ($Online->banners->first() == null) data-setbg="{{ asset('dist/img/banners/1.webp') }}"
                    @else
                          data-setbg="{{ asset('dist/img/banners/' . $Online->banners->first()->img) }}" @endif
                        style="background-size:cover">
                        <div class="hero__text">
                            <p>
                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                    {{ $Online->nameAr }}
                                @else
                                    {{ $Online->nameEn }}
                                @endif
                            </p>
                            <a href="#" class="primary-btn colors"> {{ trans('Online.Shopnow') }} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->



    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 class="card-outline" style="border-top-color:red;">{{ trans('Online.products') }}</h2>
                    </div>
                    <div class="featured__controls">
                        <ul style="color:{{session('orgsetting')->catcolor ?? ' '}}">

                            <li class="active"  style="color:{{session('orgsetting')->catcolor ??''}}" data-filter="*">{{ trans('Online.All') }}</li>
                            @foreach ($groups as $group)
                                <li data-filter=".{{ str_replace(' ', '-', $group->nameEn) }}" style="color:{{session('orgsetting')->catcolor ?? ''}}">
                                    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                        {{ $group->nameAr }}
                                    @else
                                        {{ $group->nameEn }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($items as $item)
                    <div
                        class="col-lg-3 col-6 col-md-4 col-sm-6 mix oranges {{ str_replace(' ', '-', $item->category->nameEn) }}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg"
                                data-setbg="{{ asset('public/dist/img/products/' . $item->img) }}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="{{ route('itemDetails', [$item->id, $orgID]) }}"><i
                                                class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-share-alt"></i></a></li>
                                    <li><a href="#" onclick="addToBasket({{ $item->id }})"><i
                                                class="fa fa-shopping-cart"></i></a></li>
                                    <input type="hidden" id="quantity" value="1">
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                    <h6><a
                                            href="#">{{ \Illuminate\Support\Str::limit($item->nameAr, 40, $end = '...') }}</a>
                                    </h6>
                                @else
                                    <h6><a
                                            href="#">{{ \Illuminate\Support\Str::limit($item->nameEn, 40, $end = '...') }}</a>
                                    </h6>
                                @endif
                                <h5 style="color:{{session('orgsetting')->pricecolor ?? ''}}">{{ $item->prodPrice }} {{ trans('Online.Rial') }} </h5>
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
                        <h4> {{ trans('Online.AccordingEvaluation') }} </h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($items as $item)
                                    <a href="{{ route('itemDetails', [$item->id, $orgID]) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset('public/dist/img/products/' . $item->img) }}"
                                                alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                <h6>{{ \Illuminate\Support\Str::limit($item->nameAr, 60, $end = '...') }}
                                                </h6>
                                            @else
                                                <h6>{{ \Illuminate\Support\Str::limit($item->nameEn, 60, $end = '...') }}
                                                </h6>
                                            @endif
                                            <span style="direction: rtl">{{ $item->prodPrice }} {{ trans('Online.Rial') }}
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4> {{ trans('Online.mostwanted') }} </h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($items as $item)
                                    <a href="{{ route('itemDetails', [$item->id, $orgID]) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset('public/dist/img/products/' . $item->img) }}"
                                                alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                <h6>{{ \Illuminate\Support\Str::limit($item->nameAr, 60, $end = '...') }}
                                                </h6>
                                            @else
                                                <h6>{{ \Illuminate\Support\Str::limit($item->nameEn, 60, $end = '...') }}
                                                </h6>
                                            @endif
                                            <span style="direction: rtl">{{ $item->prodPrice }}
                                                {{ trans('Online.Rial') }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4> {{ trans('Online.Latestproducts') }} </h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($items as $item)
                                    <a href="{{ route('itemDetails', [$item->id, $orgID]) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset('public/dist/img/products/' . $item->img) }}"
                                                alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                <h6>{{ \Illuminate\Support\Str::limit($item->nameAr, 60, $end = '...') }}
                                                </h6>
                                            @else
                                                <h6>{{ \Illuminate\Support\Str::limit($item->nameEn, 60, $end = '...') }}
                                                </h6>
                                            @endif
                                            <span style="direction: rtl">{{ $item->prodPrice }} {{ trans('Online.Rial') }}
                                            </span>
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



@endsection
