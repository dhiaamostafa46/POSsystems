@extends('layouts.eCommerceMasterPage')

@section('content')

<style>
    .blog__item {
        margin-bottom: 25px;
    }
    .breadcrumb__text h2 {
        color: black;
    }
</style>



    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg"
        style="background-image: url(&quot;img/breadcrumb.jpg&quot;);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>  @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') الأقسام     @else Section @endif </h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog spad">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        @if (count($groups) > 0)
                            @foreach ($groups as $item)
                            <a href="{{route('public.categoryDetails',[$item->id,$orgID])}}" class="col-lg-4 col-md-3  col-sm-1 text-center mb-3">
                                <div class="card" >
                                    <div class="blog__item">
                                        <div class="blog__item__pic">
                                            <img src="{{asset('dist/img/productcategories/'.$item->img)}}" alt="" style="height: 200PX">
                                        </div>
                                        <div class="blog__item__text">
                                            <h3 >
                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                               {{ \Illuminate\Support\Str::limit($item->nameAr, 60, $end='...') }}
                                             @else
                                               {{ \Illuminate\Support\Str::limit($item->nameEn, 60, $end='...') }}
                                             @endif

                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

@endsection
