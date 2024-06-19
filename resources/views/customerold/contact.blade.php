@extends('layouts.eCommerceMasterPage')

@section('content')

    <!-- Breadcrumb Section Begin -->
    {{-- <section class="breadcrumb-section set-bg" data-setbg="{{asset('img/contact.jpg')}}" style="height: 200px">
        <div class="container">

        </div>
    </section> --}}
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('dist/img/Contactus.jpg')}} "style="height: 200px;width:100%">
        <div class="container text-center">
                 <h6>{{ trans('Online.Connectwithus') }} </h6>
        </div>
    </section>
    {{-- <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
                <span class="badge badge-warning"><h6>{{ trans('Online.Connectwithus') }} </h6></span>
            </div>
        </div>
    </div> --}}
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="fa fa-phone"></span>
                        <h4>{{ trans('Online.Mobilenumber') }} </h4>
                        <p>{{$User->phone }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="fa fa-map-marker"></span>
                        <h4>{{ trans('Online.Address') }} </h4>
                        <p>    @if (LaravelLocalization::getCurrentLocaleDirection()=="rtl") {{$shop->branches[0]->addressAr ??''}} @else {{$shop->branches[0]->addressEn ??''}} @endif</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="fa fa-clock-o"></span>
                        <h4> {{ trans('Online.timesofwork') }}</h4>
                        <p> {{ trans('Online.Open24hours') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="fa fa-envelope"></span>
                        <h4> {{ trans('Online.Email') }} </h4>
                        <p>{{$User->email}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->




    <!-- Contact Form Begin -->
    {{-- <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>راسلنا</h2>
                    </div>
                </div>
            </div>
            <form action="#">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="اكتب اسمك">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="اكتب بريدك الالكتروني">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="اكتب رسالتك"></textarea>
                        <button type="submit" class="site-btn" style="letter-spacing: 0px">ارسال</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End --> --}}

@endsection
