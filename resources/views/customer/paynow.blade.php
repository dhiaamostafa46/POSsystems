@extends('layouts.eCommerceMasterPage')

@section('content')
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="height: 100px">
                </div>
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">{{ trans('Online.product') }} </th>
                                    <th>{{ trans('Online.price') }}</th>
                                    <th> {{ trans('Online.Quantity') }}</th>
                                    <th>{{ trans('Online.total') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($Order) > 0)
                                    @foreach ($Order as $Ord)
                                        @if (count($Ord->orderdetails) > 0)
                                            @foreach ($Ord->orderdetails as $item)
                                                <tr>
                                                    <td class="shoping__cart__item">
                                                        <img src="{{ asset('public/dist/img/products/' . $item->img) }}"
                                                            alt="">
                                                        <h5> {{ $item->productName }} </h5>
                                                    </td>
                                                    <td class="shoping__cart__price">
                                                        {{ $item->price }}
                                                    </td>
                                                    <td class="shoping__cart__quantity">
                                                        {{ $item->quantity }}
                                                    </td>
                                                    <td class="shoping__cart__total">
                                                        {{ $item->quantity * $item->price }}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-6">

                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">

                        <ul>
                            <li> {{ trans('Online.total') }}
                                <span>{{ $Order->sum('totalwvat') - $Order->sum('totalvat') }}</span></li>
                            <li>{{ trans('Online.Tax') }} <span>{{ $Order->sum('totalvat') }}</span></li>
                            <li>{{ trans('Online.total1') }} <span>{{ $Order->sum('totalwvat') }} <input type="hidden"
                                        name="total" id="total" value="{{ $Order->sum('totalwvat') }}"> </span></li>
                        </ul>

                        <a type="button" class="btn mb-2 primary-btn btn-info" style="letter-spacing: 0px"
                            onclick="payNow();"> {{ trans('Online.Paymentbycard') }} <img
                                src="{{ asset('dist/img/payments/visa.png') }}" style="width: 40px;height:40px"
                                alt=""></a>
                        <a type="button" class="btn  primary-btn btn-white" style="letter-spacing: 0px"
                            onclick="applePayNow();"> {{ trans('Online.PPayviaApple') }} <img
                                src="{{ asset('dist/img/payments/apple.png') }}" style="width: 40px;height:40px"
                                alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('payment/paylink.src.js') }}"></script>
    <script>
        function PayLater() {

            total = document.getElementById("total").value;

            window.location.href = `/storeTableClientPaylater/${total}`;

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





            let order = new Order({
                callBackUrl: 'https://evix.com.sa/payment-response', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
                clientName: 'Saeed Elhassan', // the name of the buyer. (mandatory)
                clientMobile: '0535331597', // the mobile of the buyer. (mandatory)
                amount:  document.getElementById('total').value,
                clientEmail: 'info@evix.com.sa', // the email of the buyer (optional) // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
                orderNumber:  3, // the order number in your system. (mandatory)
            });





        }



    </script>
@endsection
