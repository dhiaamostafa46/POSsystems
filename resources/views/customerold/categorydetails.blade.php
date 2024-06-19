@extends('layouts.eCommerceMasterPage')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('img/groups/'.$category->img)}}" style="height: 200px">
        <div class="container">

        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>{{ trans('Online.productsAll') }}
                            @if (LaravelLocalization::getCurrentLocaleDirection()=="rtl") {{$category->nameAr}} @else {{$category->nameEn}} @endif
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($category->products as $item)
                    <div class="col-lg-3 col-6 col-md-4 col-sm-6 ">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{asset('public/dist/img/products/'.$item->img)}}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="{{route('itemDetails',[$item->id,$orgID])}}"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="#"><i class="fa fa-share-alt"></i></a></li>
                                    <li><a href="#" onclick="addToBasket({{$item->id}})"><i class="fa fa-shopping-cart"></i></a></li>
                                    <input type="hidden" id="quantity" value="1">
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                @if (LaravelLocalization::getCurrentLocaleDirection()=="rtl")
                                <h6><a href="#">{{ \Illuminate\Support\Str::limit($item->nameAr, 40, $end='...') }}</a></h6>
                                @else
                                <h6><a href="#">{{ \Illuminate\Support\Str::limit($item->nameEn, 40, $end='...') }}</a></h6>
                                @endif

                                <h5>{{$item->prodPrice}} {{ trans('Online.Rial') }}  </h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

@endsection
