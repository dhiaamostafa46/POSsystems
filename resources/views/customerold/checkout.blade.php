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

    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
                <span class="badge badge-warning"><h6> {{ trans('Online.Completetherequest') }} </h6></span>
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
                <h4> {{ trans('Online.Customerdetails') }}  </h4>
                <form action="#" method="POST">
                    @csrf
                    <div class="row" style="margin-bottom: 80px">
                        <div class="col-lg-8 col-md-6">

                            <div class="checkout__input row col-12">
                                <p class="col-12"> {{ trans('Online.customername') }} <span>*</span></p>
                                <input type="text" class="col-12" name="name" id="name" required>
                                 <input type="hidden" class="col-12" name="result" id="result" required >
                            </div>
                            <div class="checkout__input row col-12">
                                <p class="col-12"> {{ trans('Online.Mobilenumber') }}  <span>*</span></p>
                                <input type="text" class="col-12" name="phone" id="phone" required>
                            </div>
                            <!--{{$payment_token}}-->
                            {{-- @if(session('orderType')!=3)
                            <div class="checkout__input row col-12">
                                <p class="col-12">استلام الطلب<span>*</span></p>
                                <select class="col-12" name="orderType" id="orderType" onchange="">
                                    <option value="">اختر طريقة الاستلام</option>
                                    <option value="2">توصيل</option>
                                    <option value="1">استلام من الفرع</option>
                                </select>
                            </div>
                            <div class="checkout__input row col-12">
                                <p class="col-12">الفرع<span>*</span></p>
                                <select class="col-12" style="text-align: right" name="orderType">
                                    <option value="">اختر الفرع</option>
                                    @foreach ($shop->branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->nameAr}}</option>
                                    @endforeach
                                </select>
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

                            @endif --}}

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>  {{ trans('Online.Yourorder') }}</h4>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col" style="width: 70%">{{ trans('Online.product') }} </th>
                                        <th scope="col" style="width: 20%">{{ trans('Online.price') }}</th>
                                        <th scope="col" style="width: 5%"></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0 ; $count = 0;?>
                                        @foreach ($products as $index => $product)
                                            <?php
                                                $total = $total + $product['quantity']*($product['price']+$product['extraSum']);
                                                $count++;
                                            ?>
                                            <tr>
                                                @if (LaravelLocalization::getCurrentLocaleDirection()=="rtl")
                                                   <td style="font-size: small">{{$product['quantity'].' X '.$product['nameAr']." ".$product['extra']}} </td>
                                                @else
                                                   <td style="font-size: small">{{$product['quantity'].' X '.$product['nameEn']." ".$product['extra']}} </td>
                                                @endif

                                                <td>{{$product['quantity']*($product['price']+$product['extraSum'])}} </td>
                                                <td><a href="{{route('public.Remove',[$product['id'] ,$orgID])}}" ><i class="fa fa-trash"></i></a></td>
                                                <input type="hidden" name="item{{$index+1}}" value="{{$product['id']}}">
                                                <input type="hidden" name="quantity{{$index+1}}" value="{{$product['quantity']}}">
                                                <input type="hidden" name="price{{$index+1}}" value="{{$product['price']}}">
                                            </tr>
                                        @endforeach

                                    </tbody>
                                  </table>
                                {{-- <div class="checkout__order__products">المنتج <span>القيمة</span></div>
                                <ul>

                                     @foreach ($products as $index => $product)
                                     <?php
                                        $total = $total + $product['quantity']*($product['price']+$product['extraSum']);
                                        $count++;
                                     ?>
                                     <li style="font-size: small">{{$product['quantity'].' X '.$product['nameAr']." ".$product['extra']}} <span>{{$product['quantity']*($product['price']+$product['extraSum'])}}</span> </li>
                                     <input type="hidden" name="item{{$index+1}}" value="{{$product['id']}}">
                                     <input type="hidden" name="quantity{{$index+1}}" value="{{$product['quantity']}}">
                                     <input type="hidden" name="price{{$index+1}}" value="{{$product['price']}}">
                                     <hr>
                                     @endforeach
                                </ul> --}}
                                <div class="checkout__order__subtotal">{{ trans('Online.total') }} <span>{{$total}} {{ trans('Online.Rial') }}</span></div>
                                <div class="checkout__order__total">{{ trans('Online.total1') }}  <span>{{$total}} {{ trans('Online.Rial') }} </span></div>
                                <input type="hidden" name="total" id="total" value="{{$total}}">
                                <input type="hidden" name="count" value="{{$count}}">


                                    <button type="button" class="btn btn-info" style="letter-spacing: 0px" onclick="payNow();"> {{ trans('Online.Paymentbycard') }}   <img src="{{asset('dist/img/payments/visa.png')}}" style="width: 40px;height:40px" alt=""></button>
                                    <button type="button" class="btn btn-white" style="letter-spacing: 0px" onclick="applePayNow();">   {{ trans('Online.PPayviaApple') }} <img src="{{asset('dist/img/payments/apple.png')}}" style="width: 40px;height:40px" alt=""></button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
      <input type="hidden" value="{{$orgID}}" id="orgID">
    <!-- Checkout Section End -->
@endif
<script src="{{asset('payment/paylink.src.js')}}"></script>
<!-- <script src="https://paylink.sa/assets/js/paylink.js"></script> -->
<script>
    function successCallback() {
        console.log('success');
    }

    let payment = new PaylinkPayments({mode: 'prod', defaultLang: 'ar', backgroundColor: '#EEE'});

    function payNow() {
        //alert("Pay");



        // 3) Send the generated token value to client side.
        const token ='<?= $payment_token ?>';///assign login tokin
    var total=document.getElementById("total").value;
        var form = document.querySelector('form');
        var formData = new FormData(form);
        formData.append("name", document.getElementById("name").value);
        formData.append("phone", document.getElementById("phone").value);
        formData.append("total", document.getElementById("total").value);
        formData.append("orgID", document.getElementById("orgID").value);
        // send order to insert in db and get response of inserted order details
        fetch("/storeTableClient",{
            method: "post",
            body: formData
        })
        .then((response)=> response.json())
        .then((response)=>{
            //console.log(response);

            if (response.status == 'success') {
                let order = new Order({
                callBackUrl: 'https://evix.com.sa/payment-response', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
                clientName: document.getElementById("name").value, // the name of the buyer. (mandatory)
                clientMobile: document.getElementById("phone").value, // the mobile of the buyer. (mandatory)
                amount: response.total_amount,
                clientEmail: 'info@evix.com.sa', // the email of the buyer (optional) // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
                orderNumber: response.order_id, // the order number in your system. (mandatory)
                });

        //          let order = new Order({
        //     callBackUrl: 'https://evix.com.sa/payment-response', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
        //     clientName: 'Saeed Elhassan', // the name of the buyer. (mandatory)
        //     clientMobile: '0535331597', // the mobile of the buyer. (mandatory)
        //     amount: total, // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
        //     orderNumber: '0000125', // the order number in your system. (mandatory)
        //     clientEmail: 'saeed@eyeincode.com', // the email of the buyer (optional)
        //     products: [ // list of products (optional)
        //         {title: 'Burger', price: 15, qty: 2}

        //     ],
        // });

                document.getElementById("result").value =order.clientMobile;
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
            ],
        });
        */
    }


    function applePayNow() {
        //alert('apple pay test');
        // 4) Check if the current browser support apple pay.
        if (payment.isApplePayAllowed()) {
        // var myModalEl = document.getElementById('exampleModal');
        // var modal = bootstrap.Modal.getInstance(myModalEl); // Returns a Bootstrap modal instance
        // modal.hide();
        // document.getElementById('main').style.display="none";
        // document.getElementById('footer').style.display="none";
        // 3) Send the generated token value to client side.
        const token = '<?= $payment_token ?>';

        var form = document.querySelector('form');
        var formData = new FormData(form);
        formData.append("add_order", true);
        formData.append("from_js", true);

        fetch("/storeTableClient",{
            method: "post",
            body: formData
        })
        .then((response)=> response.json())
        .then((response)=>{
            console.log(response);
            if (response.status == 'success') {
                let order = new Order({
                callBackUrl: 'https://evix.com.sa/payment-response', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
                clientName: document.getElementById("name").value, // the name of the buyer. (mandatory)
                clientMobile: document.getElementById("phone").value, // the mobile of the buyer. (mandatory)
                amount: response.total_amount,
                clientEmail: 'info@evix.com.sa', // the email of the buyer (optional) // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
                orderNumber: response.order_id, // the order number in your system. (mandatory)
                });

                payment.openApplePay(token, order, successCallback);
            } else {
                alert(response.msg);
            }
        });

        } else {
            alert('This browser does not support ApplePay. Please use Safari on any Apple Device.');
        }
    }
    // function applePayNow() {
    //     // 4) Check if the current browser support apple pay.
    //     if (payment.isApplePayAllowed()) {
    //         // 5) Send the generated token value to client side.
    //         const token = '<?= $payment_token ?>';

    //         // 6) In the client side create the order details for the buyer.
    //         let order = new Order({
    //             callBackUrl: 'http://localhost:6655/processPayment.php', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
    //             clientName: 'Zaid Matooq', // the name of the buyer. (mandatory)
    //             clientMobile: '0509200900', // the mobile of the buyer. (mandatory)
    //             amount: 5, // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
    //             orderNumber: '12301230123', // the order number in your system. (mandatory)
    //             clientEmail: 'myemail@example.com', // the email of the buyer (optional)
    //             products: [ // list of products (optional)
    //                 {title: 'Dress 1', price: 120, qty: 2},
    //                 {title: 'Dress 2', price: 120, qty: 2},
    //                 {title: 'Dress 3', price: 70, qty: 2}
    //             ],
    //         });

    //         // 7) Call openPayment function to open the payment popup screen. It takes the generated "token" and the "order" of the buyer.
    //         payment.openApplePay(token, order, successCallback);

    //         // 8) NOTE: After the payment is processed (either paid or declined), you must from the server side call
    //         // the endpoint https://restapi.paylink.sa/api/getInvoice/{transactionNo} for production or
    //         // the endpoint https://restpilot.paylink.sa/api/getInvoice/{transactionNo} for testing
    //         // to check the invoice status as appear in the processPayment.php example file.
    //     } else {
    //         alert('This browser does not support ApplePay. Please use Safari on any Apple Device.');
    //     }
    // }

</script>
@endsection
