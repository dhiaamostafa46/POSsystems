@extends('layouts.eCommerceMasterPage')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg"  style="height: 200px;width:100%">
        <div class="container">

        </div>
    </section>
    {{-- <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
                <div class="breadcrumb__option">
                    <h6 href="#">{{$item->category->nameAr}} -> {{$item->nameAr}}</h6>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{asset('public/dist/img/products/'.$item->img)}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>
                            @if (LaravelLocalization::getCurrentLocaleDirection()=="rtl")
                               {{$item->nameAr}}
                            @else
                               {{$item->nameEn}}
                            @endif
                        </h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>( {{ trans('Online.Reviews') }} )</span>
                        </div>
                        <div class="product__details__price">{{$item->prodPrice}} {{ trans('Online.Rial') }}</div>
                        <p>{{$item->detailsAr}}</p>
                        @if(count($item->extras) > 0)
                        <h5><strong>الاضافات</strong></h5>
                        @foreach ($item->extras as $extra)
                            <h6>
                                <input type="checkbox" data-price="{{$extra->price}}" data-name="{{$extra->nameAr}}"> {{$extra->nameAr}} ({{$extra->price}} {{ trans('Online.Rial') }})
                            </h6>
                        @endforeach
                        @else

                        @endif
                        <div class="product__details__quantity mt-2">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" id="quantity" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="primary-btn" style="letter-spacing: 0px" onclick="addToBasket({{$item->id}})"> {{ trans('Online.Addtocart') }} </a>

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">{{ trans('Online.details') }} </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false"> {{ trans('Online.additionalinformation') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">{{ trans('Online.Reviews') }} <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6> {{ trans('Online.Productdetails') }} </h6>
                                    <p>{{$item->detailsAr}}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6> {{ trans('Online.additionalinformation') }} </h6>
                                    <p>
                                        <ul>
                                            <li><b> {{ trans('Online.Calories') }} </b> <span>{{$item->calories}}</span></li>
                                            <!--
                                            <li><b>الشحن</b> <span>خلال 1 يوم.</span></li>
                                            <li><b>الوزن</b> <span>0.5 kg</span></li>
                                            -->
                                        </ul>
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>{{ trans('Online.Reviews') }}</h6>
                                    <p>{{ trans('Online.NotFound') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>{{ trans('Online.RelatedProducts') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($item->category->products as $item2)
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{asset('public/dist/img/products/'.$item2->img)}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#" onclick="addToBasket({{$item2->id}})"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            @if (LaravelLocalization::getCurrentLocaleDirection()=="rtl")
                            <h6><a href="{{route('itemDetails',[$item->id,$orgID])}}">{{ \Illuminate\Support\Str::limit($item->nameAr, 35, $end='...') }}</a></h6>
                            @else
                            <h6><a href="{{route('itemDetails',[$item->id,$orgID])}}">{{ \Illuminate\Support\Str::limit($item->nameEn, 35, $end='...') }}</a></h6>
                            @endif
                            <h5>{{$item2->prodPrice}} {{ trans('Online.Rial') }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

@endsection
