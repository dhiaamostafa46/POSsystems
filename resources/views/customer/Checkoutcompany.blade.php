@extends('layouts.eCommerceMasterPage')
@section('content')
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
                <span class="badge badge-warning">
                    <h6> {{ trans('Online.Completetherequest') }} </h6>
                </span>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout pt-1">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt">
                            {{-- </span> هل لديك رمز ترويجي؟ <a href="#">اضغط هنا</a> لكتابة الرمز --}}
                    </h6>
                </div>
            </div>

            <div class="checkout__form">
                <h4> {{ trans('Online.Customerdetails') }} </h4>
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        @if (empty(auth()->guard('Shop')->user()->id))
                            <div id="logindiv">
                                <form action="{{ route('Shopauth') }}" method="post">

                                    @csrf
                                    <input type="hidden" value="{{ $orgID }}" name="orgID">
                                    <input type="hidden" value="2" name="typepage">
                                    @if (session('subscribtionStatus') == 3)
                                        <div class="alert alert-danger alert-dismissible">
                                            <a href="#" class="close" data-dismiss="alert"
                                                aria-label="close">&times;</a>
                                            {{ session('subscribtionMsg') }} <a href="https://wa.me/966538444938"
                                                class="alert-link">راسلنا للتجديد</a>
                                        </div>
                                    @endif
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="example@test.com" value="">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password" placeholder="Password"
                                            value="">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-12">
                                            <button type="submit" style="background: #00d798"
                                                class="btn btn-primary btn-block">دخول</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-12">
                                        <a onclick="displaydivAll(1)" class="btn btn-primary btn-block mt-2 "
                                            style="background: #00d798">
                                            سجل
                                            معنا </a>
                                    </div>
                                    <!-- /.col -->
                                </div>

                            </div>
                            <div id="register" style="display: none">
                                <form action="{{ route('ShopRegister') }}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $orgID }}" name="orgID">
                                    <input type="hidden" value="2" name="typepage">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="nameAr"
                                            placeholder="اسم المستخدم">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-building"></span>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="input-group mb-3">
                                        <input type="phone" pattern="[0-9]{10}" minlength="10" maxlength="10"
                                            oninvalid="this.setCustomValidity('ادخل رقم جوال حقيقي')"
                                            oninput="this.setCustomValidity('')" class="form-control" name="phone"
                                            placeholder="رقم الهاتف / Phone (05XXXXXXXX)" onchange="chkPhone">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-phone"></span>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" name="email"
                                            oninvalid="this.setCustomValidity('الايميل غير صحيح')"
                                            placeholder="البريد الالكتروني / Email">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password"
                                            placeholder="كلمة المرور /Password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="اعادة كلمة المرور /Confirm Password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-12">
                                            <button type="submit" style="background: #00d798"
                                                class="btn btn-primary btn-block">تسجيل</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                                <div class="row">

                                    <div class="col-12">

                                        <a onclick="displaydivAll(2)" class="btn btn-primary btn-block mt-2"
                                            style="background: #00d798">
                                            لدي
                                            حساب مسبقا </a>

                                    </div>
                                    <!-- /.col -->
                                </div>

                            </div>
                        @endif


                    </div>
                    <div class="col-lg-4 col-md-6">
                        <form action="#" method="POST" id="formCheckoutpay">
                            @csrf
                            <input type="hidden" class="col-12" name="result" id="result" required>
                            <div class="checkout__order">
                                <h4> {{ trans('Online.Yourorder') }}</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 70%">{{ trans('Online.product') }} </th>
                                            <th scope="col" style="width: 20%">{{ trans('Online.price') }}</th>
                                            <th scope="col" style="width: 5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0;
                                        $count = 0; ?>
                                        @foreach ($products as $index => $product)
                                            <?php
                                            $total = $total + $product['quantity'] * ($product['price'] + $product['extraSum']);
                                            $count++;
                                            ?>
                                            <tr>

                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                    <td style="font-size: small">
                                                        {{ $product['quantity'] . ' X ' . $product['nameAr'] . ' ' . $product['extra'] }}
                                                    </td>
                                                @else
                                                    <td style="font-size: small">
                                                        {{ $product['quantity'] . ' X ' . $product['nameEn'] . ' ' . $product['extra'] }}
                                                    </td>
                                                @endif
                                                <td>{{ $product['quantity'] * ($product['price'] + $product['extraSum']) }}
                                                </td>
                                                <td><a href="{{ route('public.Remove', [$product['id'], $orgID]) }}"><i
                                                            class="fa fa-trash"></i></a></td>
                                                <input type="hidden" name="item{{ $index + 1 }}"
                                                    value="{{ $product['id'] }}">
                                                <input type="hidden" name="quantity{{ $index + 1 }}"
                                                    value="{{ $product['quantity'] }}">
                                                <input type="hidden" name="price{{ $index + 1 }}"
                                                    value="{{ $product['price'] }}">
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{-- <div class="checkout__order__products">المنتج <span>القيمة</span></div>
                                <ul>

                                    @foreach ($products as $index => $product)
                                    <?php
                                    $total = $total + $product['quantity'] * ($product['price'] + $product['extraSum']);
                                    $count++;
                                    ?>
                                    <li style="font-size: small">{{$product['quantity'].' X '.$product['nameAr']." ".$product['extra']}} <span>{{$product['quantity']*($product['price']+$product['extraSum'])}}</span> </li>
                                    <input type="hidden" name="item{{$index+1}}" value="{{$product['id']}}">
                                    <input type="hidden" name="quantity{{$index+1}}" value="{{$product['quantity']}}">
                                    <input type="hidden" name="price{{$index+1}}" value="{{$product['price']}}">
                                    <hr>
                                    @endforeach
                                </ul> --}}
                                <div class="checkout__order__subtotal">{{ trans('Online.total') }}
                                    <span>{{ $total }} {{ trans('Online.Rial') }}</span>
                                </div>
                                <div class="checkout__order__total">{{ trans('Online.total1') }}
                                    <span>{{ $total }}
                                        {{ trans('Online.Rial') }} </span>
                                </div>
                                <input type="hidden" name="total" id="total" value="{{ $total }}">
                                <input type="hidden" name="count" value="{{ $count }}">


                                <button type="button" class="btn btn-info" style="letter-spacing: 0px "
                                    onclick="payNow();">
                                    {{ trans('Online.Paymentbycard') }} <img
                                        src="{{ asset('dist/img/payments/visa.png') }}" style="width: 40px;height:40px"
                                        alt=""></button>
                                <button type="button" class="btn btn-white" style="letter-spacing: 0px"
                                    onclick="applePayNow();"> {{ trans('Online.PPayviaApple') }} <img
                                        src="{{ asset('dist/img/payments/apple.png') }}" style="width: 40px;height:40px"
                                        alt=""></button>

                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </section>

    <input type="hidden" value="{{ $orgID }}" id="orgID">
    <input type="hidden" value="{{ trans('Online.Youmustlogin') }} " id="Youmustlogin">

    <!-- Checkout Section End -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="{{ asset('payment/paylink.src.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://paylink.sa/assets/js/paylink.js"></script> -->
    <script>
        function displaydivAll(id) {

            if (id == 1) {
                $('#logindiv').hide();
                $('#register').show();
                console.log("ddddddddddd");
            } else {
                $('#logindiv').show();
                $('#register').hide();

            }

        }

        function successCallback() {
            console.log('success');
        }

        let payment = new PaylinkPayments({
            mode: 'test',
            defaultLang: 'ar',
            backgroundColor: '#EEE'
        });

        function payNow() {
            //alert("Pay");


            @if (!empty(auth()->guard('Shop')->user()->id))


                // 3) Send the generated token value to client side.
                const token = '<?= $payment_token ?>'; ///assign login tokin

                var form = document.getElementById('formCheckoutpay');
                var formData = new FormData(form);
                var total = document.getElementById("total").value;
                formData.append("id", {{ auth()->guard('Shop')->user()->id }});
                formData.append("name", '{{ auth()->guard('Shop')->user()->name }}');
                formData.append("phone", {{ auth()->guard('Shop')->user()->phone }});
                formData.append("total", document.getElementById("total").value);
                formData.append("orgID", document.getElementById("orgID").value);
                // send order to insert in db and get response of inserted order details
                fetch("/storeTableClientCompany", {
                        method: "post",
                        body: formData
                    })
                    .then((response) => response.json())
                    .then((response) => {
                        //console.log(response);

                        if (response.status == 'success') {
                            // let order = new Order({
                            // callBackUrl: 'https://test1.evix.com.sa/payment-response', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
                            // clientName: document.getElementById("name").value, // the name of the buyer. (mandatory)
                            // clientMobile: document.getElementById("phone").value, // the mobile of the buyer. (mandatory)
                            // amount: response.total_amount,
                            // clientEmail: 'info@evix.com.sa', // the email of the buyer (optional) // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
                            // orderNumber: response.order_id, // the order number in your system. (mandatory)
                            // });

                            let order = new Order({
                                callBackUrl: 'https://evix.com.sa/payment-response', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
                                clientName: 'Saeed Elhassan', // the name of the buyer. (mandatory)
                                clientMobile: '0535331597', // the mobile of the buyer. (mandatory)
                                amount: total, // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
                                orderNumber: '0000125', // the order number in your system. (mandatory)
                                clientEmail: 'saeed@eyeincode.com', // the email of the buyer (optional)
                                products: [ // list of products (optional)
                                    {
                                        title: 'Burger',
                                        price: 15,
                                        qty: 2
                                    }

                                ],
                            });

                            document.getElementById("result").value = order.clientMobile;
                            console.log(order);
                            payment.openPayment(token, order, successCallback);
                        } else {

                            alert(response.msg);

                        }
                    });

                /*
                let order = new Order({
                    callBackUrl: 'http://localhost:6655/processPayment.php', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
                    clientName: 'Zaid Matooq', // the name of the buyer. (mandatory)
                    clientMobile: '0509200900', // the mobile of the buyer. (mandatory)
                    amount: 5, // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
                    orderNumber: '12301230123', // the order number in your system. (mandatory)
                    clientEmail: 'myemail@example.com', // the email of the buyer (optional)
                    products: [ // list of products (optional)
                        {title: 'Dress 1', price: 120, qty: 2},
                        {title: 'Dress 2', price: 120, qty: 2},
                        {title: 'Dress 3', price: 70, qty: 2}
                    ],Youmustlogin
                });
                */
            @else
                Swal.fire({
                    position: "top-start",
                    icon: "error",
                    title: document.getElementById("Youmustlogin").value,
                    showConfirmButton: false,
                    timer: 1500
                });
            @endif
        }


        function applePayNow() {
            // 4) Check if the current browser support apple pay.
            if (payment.isApplePayAllowed()) {
                @if (!empty(auth()->guard('Shop')->user()->id))
                    var myModalEl = document.getElementById('exampleModal');
                    var modal = bootstrap.Modal.getInstance(myModalEl); // Returns a Bootstrap modal instance
                    modal.hide();
                    document.getElementById('main').style.display = "none";
                    document.getElementById('footer').style.display = "none";
                    // 3) Send the generated token value to client side.
                    const token = '<?= $payment_token ?>';

                    var form = document.querySelector('form');
                    var formData = new FormData(form);
                    formData.append("add_order", true);
                    formData.append("from_js", true);

                    fetch("https://waiterq.com/checkout2.php", {
                            method: "post",
                            body: formData
                        })
                        .then((response) => response.json())
                        .then((response) => {
                            console.log(response);
                            if (response.status == 'success') {
                                let order = new Order({
                                    callBackUrl: 'https://waiterq.com/processPayment.php', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
                                    clientName: document.getElementById("name_for_payment")
                                        .value, // the name of the buyer. (mandatory)
                                    clientMobile: document.getElementById("phone_for_payment")
                                        .value, // the mobile of the buyer. (mandatory)
                                    amount: response.total_amount,
                                    clientEmail: 'info@waiterq.com', // the email of the buyer (optional) // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
                                    orderNumber: response
                                    .order_id, // the order number in your system. (mandatory)
                                });

                                payment.openApplePay(token, order, successCallback);
                            } else {
                                alert(response.msg);
                            }
                        });
                @else
                    Swal.fire({
                        position: "top-start",
                        icon: "error",
                        title: document.getElementById("Youmustlogin").value,
                        showConfirmButton: false,
                        timer: 1500
                    });
                @endif


            } else {
                alert('This browser does not support ApplePay. Please use Safari on any Apple Device.');
            }
        }
    </script>
@endsection
