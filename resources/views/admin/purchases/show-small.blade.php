<html>

<head>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500&display=swap" rel="stylesheet">

</head>

<body dir="rtl">
<style>
        body{
            direction: rtl;
            font-family: 'Tajawal', sans-serif !important;
            margin: 0px !important;
            -webkit-print-color-adjust:exact !important;
            print-color-adjust:exact !important;
            margin: 15px !important;
        }

        #invoice-POS ::selection {
            background: #f31544;
            color: #fff;
        }

        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #fff;
        }

        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
        }

        #invoice-POS h2 {
            font-size: 0.9em;
        }

        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        #invoice-POS p {
            font-size: 0.7em;
            color: #000;
            line-height: 1.2em;
        }

        #invoice-POS #top {
            min-height: 100px;
        }

        #invoice-POS #mid {
            min-height: 80px;
        }

        #invoice-POS #bot {
            min-height: 50px;
        }
        table tr{
            border-bottom: 2px solid #000000;
        }

        /* #invoice-POS #top .logo {
            height: 60px;
            width: 60px;
            background: url(https://waiterq.com/logo/287121.png) no-repeat;
            background-size: 60px 60px;
        } */

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title {
            float: right;
        }

        #invoice-POS .title p {
            text-align: right;
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-POS .tabletitle {
            font-size: 0.5em;
            background: #fff;
            font-size:small
        }
        #invoice-POS .tableitem {
            font-size: 0.5em;
            background: #fff;
            font-size:small
        }

        #invoice-POS .service {
            border-bottom: 1px solid #fff;
            font-size:small
        }

        #invoice-POS .item {
            width: 70%;
        }
        #invoice-POS .Qty {
            width: 10%;
        }
        #invoice-POS .price {
            width: 20%;
        }

        #invoice-POS .itemtext {
            font-size: 0.9em;
        }

        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }

        .qr{
            margin-top: 5px;
        }
    </style>

    <div id="invoice-POS">

        <center id="top">
            <div class="logo">
              @if (!empty(auth()->user()->organization->logo) && auth()->user()->organization->logo != "default.png")
                <img width="60" height="60" src="{{asset('dist/img/organizations/'.auth()->user()->organization->logo)}}">
              @endif

            </div>
            <div class="info">
                <h2>{{auth()->user()->organization->nameAr}}</h2>
                <h2>{{auth()->user()->branch->nameAr}}</h2>
                <p>{{auth()->user()->branch->area}} - {{auth()->user()->branch->city}} - {{auth()->user()->branch->district}}</p>
                <div>
                    <p>فاتورة ضريبية مبسطة
                        <br>
                        الرقم الضريبي: {{auth()->user()->organization->vatNo}}
                    </p>
                    <h2>رقم الفاتورة - # {{$order->serial}}</h2>
                </div>
                <p dir="ltr">{{$order->created_at->format('Y-m-d -- H:i:s')}}</p>
            </div><!--End Info-->
        </center><!--End InvoiceTop-->

        <div id="bot">

            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>الصنف</h2>
                        </td>
                        <td class="Hours">
                            <h2>الكمية</h2>
                        </td>
                        <td class="Rate">
                            <h2>السعر قبل الضريبة</h2>
                        </td>
                         <td class="Rate">
                            <h2>السعر بعد الضريبة</h2>
                        </td>
                    </tr>

                    @if(count($order->orderdetails) > 0)
                      @foreach ($order->orderdetails as $item)
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext">{{$item->product->nameAr}}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{$item->quantity}}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{$item->price * $item->quantity}}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{$item->price * $item->quantity}}</p>
                            </td>
                        </tr>
                        @endforeach
                      @endif

                    <tr class="tabletitle">
                        <td colspan="2" class="Rate">
                            <h2>الاجمالي قبل الضريبة</h2>
                        </td>
                        <td colspan="2" class="payment">
                            <h2 class="itemtext2">{{$order->totalwvat - $order->totalvat}} ريال</h2>
                        </td>
                    </tr>

                    <tr class="tabletitle">
                        <td colspan="2" class="Rate">
                            <h2>ضريبة القيمة المضافة15%</h2>
                        </td>
                        <td colspan="2" class="payment">
                            <h2>{{$order->totalvat}} ريال</h2>
                        </td>
                    </tr>

                    <tr class="tabletitle">
                        <td colspan="2" class="Rate">
                            <h2>الاجمالي</h2>
                        </td>
                        <td colspan="2" class="payment">
                            <h2>{{$order->totalwvat}} ريال</h2>
                        </td>
                    </tr>

                </table>
            </div><!--End Table-->

            <center>
                <div class="qr">
                    <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl={{$qr}}&choe=UTF-8" title="Link to Google.com" />
                </div>
                <div id="legalcopy">
                    <p class="legal"><strong>شكراً لطلبك❤️</strong>

                    </p>
                     <p>المستخدم :{{$order->user->name}}</p>
                </div>
            </center>
            <center><b style="font-size: 6pt;">Evix <?=date('Y')?>©️</b></center>

        </div><!--End InvoiceBot-->
    </div><!--End Invoice-->
</body>

</html>
<script>
  window.print();
</script>
