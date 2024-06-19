@extends('layouts.eCommerceMasterPage')
@section('content')


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

<script src="{{asset('payment/paylink.src.js')}}"></script>
<!-- <script src="https://paylink.sa/assets/js/paylink.js"></script> -->
<script>
    function successCallback() {
        console.log('success');
    }

    let payment = new PaylinkPayments({mode: 'production', defaultLang: 'ar', backgroundColor: '#EEE'});

    function payNow() {
        //alert("Pay");



        // 3) Send the generated token value to client side.
        const token ='<?= $payment_token ?>';///assign login tokin

        var form = document.querySelector('form');
        var formData = new FormData(form);

        var total=document.getElementById("total").value;
        formData.append("name", document.getElementById("name").value);
        formData.append("phone", document.getElementById("phone").value);
        formData.append("total", document.getElementById("total").value);
        formData.append("orgID", document.getElementById("orgID").value);
        // send order to insert in db and get response of inserted order details
        fetch("/storeTableClientCompany",{
            method: "post",
            body: formData
        })
        .then((response)=> response.json())
        .then((response)=>{
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
                clientName: document.getElementById("name").value, // the name of the buyer. (mandatory)
                clientMobile: document.getElementById("phone").value, // the mobile of the buyer. (mandatory)
                amount: response.total_amount,
                clientEmail: 'info@evix.com.sa', // the email of the buyer (optional) // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
                orderNumber: response.order_id, // the order number in your system. (mandatory)
                });

        //          let order = new Order({
        //       callBackUrl: 'https://evix.com.sa/payment-response',// callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
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
        // 4) Check if the current browser support apple pay.
        if (payment.isApplePayAllowed()) {
        var myModalEl = document.getElementById('exampleModal');
        var modal = bootstrap.Modal.getInstance(myModalEl); // Returns a Bootstrap modal instance
        modal.hide();
        document.getElementById('main').style.display="none";
        document.getElementById('footer').style.display="none";
        // 3) Send the generated token value to client side.
        const token = '<?= $payment_token ?>';

        var form = document.querySelector('form');
        var formData = new FormData(form);
        formData.append("add_order", true);
        formData.append("from_js", true);

        fetch("https://waiterq.com/checkout2.php",{
            method: "post",
            body: formData
        })
        .then((response)=> response.json())
        .then((response)=>{
            console.log(response);
            if (response.status == 'success') {
                let order = new Order({
                callBackUrl: 'https://waiterq.com/processPayment.php', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
                clientName: document.getElementById("name_for_payment").value, // the name of the buyer. (mandatory)
                clientMobile: document.getElementById("phone_for_payment").value, // the mobile of the buyer. (mandatory)
                amount: response.total_amount,
                clientEmail: 'info@waiterq.com', // the email of the buyer (optional) // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
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
</script>
@endsection
