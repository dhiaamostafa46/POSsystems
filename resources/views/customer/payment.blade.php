@extends('layouts.eCommerceMasterPage')
@section('content')
@if (session()->get("lang")=="en")
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('public.index')}}">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add">
                                <input type="text" placeholder="Apartment, suite, unite ect (optinal)">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    <li>Vegetable’s Package <span>$75.99</span></li>
                                    <li>Fresh Vegetable <span>$151.99</span></li>
                                    <li>Organic Bananas <span>$53.99</span></li>
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>$750.99</span></div>
                                <div class="checkout__order__total">Total <span>$750.99</span></div>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@else
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('dist/img/checkout.jpg')}}" style="height: 200px;width: 300px;margin:auto">
        <div class="container">
            
        </div>
    </section>
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
                <span class="badge badge-success"><h6>تم الدفع بنجاح</h6></span>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <!--
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> هل لديك رمز ترويجي؟ <a href="#">اضغط هنا</a> لكتابة الرمز
                    </h6>
                </div>
            </div>
            -->
            <div class="checkout__form">
                <h4>تفاصيل العميل</h4>
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            @if($order->orderType==3)
                            <div class="checkout__input row col-12">
                                <p class="col-12">اسم العميل<span>*</span></p>
                                <input type="text" class="col-12" name="name" id="name" value="{{$order->vCustomer->name}}" readonly>
                            </div>
                            <div class="checkout__input row col-12">
                                <p class="col-12">رقم الجوال<span>*</span></p>
                                <input type="text" class="col-12" name="phone" id="phone" value="{{$order->vCustomer->phone}}" readonly>
                            </div>
                            @else
                            <div class="checkout__input">
                                <p>الاسم<span>*</span></p>
                                <input type="text" name="name" value="{{!empty(auth()->user()->name)?auth()->user()->name:''}}" readonly required>
                            </div>
                            <div class="checkout__input">
                                <p>العنوان<span>*</span></p>
                                <input type="text" placeholder="اسم الشارع" name="street" class="checkout__input__add" required>
                                <input type="text" placeholder="اسم الحي" name="district" required>
                            </div>
                            <div class="checkout__input">
                                <p>المدينة<span>*</span></p>
                                <input type="text" name="city" required>
                            </div>
                            <div class="checkout__input">
                                <p>المنطقة<span>*</span></p>
                                <input type="text" name="state" required>
                            </div>
                            
                            <div class="checkout__input">
                                <p>رقم الجوال<span>*</span></p>
                                <input type="text" name="phone" value="{{!empty(auth()->user()->phone)?auth()->user()->phone:''}}" required>
                            </div>
                            @endif

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>الطلب الخاص بك</h4>
                                <h5>رقم الطلب <strong>{{$order->dailyBillNo}}</strong></h5>
                                <div class="checkout__order__products">المنتج <span>القيمة</span></div>
                                <ul>
                                     @foreach ($order->orderdetails as $item)
                                     <li style="font-size: small">{{$item->quantity.' X '.$item->productName}} <span>{{$item->total}}</span></li>
                                     <hr> 
                                     @endforeach
                                     
                                </ul>
                                <div class="checkout__order__subtotal">المجموع <span>{{$order->totalwvat - $order->totalvat}} ريال</span></div>
                                <div class="checkout__order__total">الاجمالي <span>{{$order->totalwvat}} ريال</span></div>
                               
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endif

@endsection
