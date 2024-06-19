<html>

<head>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
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

    <div class="row">
        <a href="{{url()->previous()}}" class="btn btn-danger mb-3 no-print" style="margin: auto">رجوع</a>
    </div>
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
                    <p>تقرير دوام</p>
                    <h2>رقم الدوام - # {{$duration->durationNo}}</h2>
                </div>
            </div><!--End Info-->
        </center><!--End InvoiceTop-->

        <div id="bot">

            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>بداية الدوام</h2>
                        </td>
                        <td class="Hours">
                            <h2>{{$duration->created_at}}</h2>
                        </td>
                    </tr>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>بواسطة</h2>
                        </td>
                        <td class="Hours">
                            <h2>{{$duration->user->name}}</h2>
                        </td>
                    </tr>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>الرصيد الافتتاحي</h2>
                        </td>
                        <td class="Hours">
                            <h2>{{$duration->openBalance}}</h2>
                        </td>
                    </tr>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>اجمالي النقد</h2>
                        </td>
                        <td class="Hours">
                            <h2>{{$duration->orders->where('type',1)->sum('totalwvat')}}</h2>
                        </td>
                    </tr>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>اجمالي الشبكة</h2>
                        </td>
                        <td class="Hours">
                            <h2>{{$duration->orders->where('type',2)->sum('totalwvat')}}</h2>
                        </td>
                    </tr>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>اجمالي الآجل</h2>
                        </td>
                        <td class="Hours">
                            <h2>{{$duration->orders->where('type',3)->sum('totalwvat')}}</h2>
                        </td>
                    </tr>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>اجمالي المبيعات</h2>
                        </td>
                        <td class="Hours">
                            <h2>{{$duration->orders->sum('totalwvat')}}</h2>
                        </td>
                    </tr>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>نهاية الدوام</h2>
                        </td>
                        <td class="Hours">
                            <h2>{{$duration->endAt}}</h2>
                        </td>
                    </tr>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>بواسطة</h2>
                        </td>
                        <td class="Hours">
                            <h2>{{$duration->endby->name}}</h2>
                        </td>
                    </tr>
                </table>
            </div><!--End Table-->

        </div><!--End InvoiceBot-->
    </div><!--End Invoice-->
</body>

</html>
<script>
  window.print();
</script>