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
                <h3>اشعار دائن للفاتورة الضريبية المبسطة</h3>
                <h2>{{auth()->user()->organization->nameAr}}</h2>
                <h2>{{auth()->user()->branch->nameAr}}</h2>
                <p>{{auth()->user()->branch->area}} - {{auth()->user()->branch->city}} - {{auth()->user()->branch->district}}</p>
                <div>
                    <p>
                        <br>
                        الرقم الضريبي: {{auth()->user()->organization->vatNo}}
                    </p>
                    <h2>رقم الفاتورة - # {{$order->serial}}</h2>
                    <h2>رقم الاشعار - # {{$order->id}}</h2>
                </div>
                <p dir="ltr">{{$order->created_at->format('Y-m-d -- H:i:s')}}</p>
            </div><!--End Info-->
        </center><!--End InvoiceTop-->

        <div id="bot">

            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td colspan="2" class="item">
                            <h2>الصنف</h2>
                        </td>
                        <td class="Hours">
                            <h2>الكمية</h2>
                        </td>

                    </tr>

                    @if(count($order->orderdetails) > 0)
                      @foreach ($order->orderdetails as $item)
                        <tr class="service">
                            <td colspan="2" class="tableitem">
                                <p class="itemtext">{{$item->product->nameAr}}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{$item->quantity}}</p>
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
                    <div class="demo" style="display: block;margin-top:2px;"></div>
                </div>
                <div id="legalcopy">
                     <p class="legal"><strong>شكراً لطلبك</strong>

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
<input type="hidden" id="bill_date" value="{{$order->created_at}}">
<input type="hidden" id="bill_total" value="{{$order->totalwvat}}">
<input type="hidden" id="tax_total" value="{{$order->totalvat}}">
<!-- Description -->
<input type="hidden" id="seller" value="{{auth()->user()->organization->nameAr}}">
<input type="hidden" id="vatNo" value="{{auth()->user()->organization->vatNo}}">

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script src="{{asset('dist/jquery-qrcode.js')}}"></script>

<script>
    var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
    function decimalToHexString(number)
    {
      if (number < 0)
      {
        number = 0xFFFFFFFF + number + 1;
      }

      return number.toString(16).toUpperCase();
    }

    function hex_to_ascii(str1)
   {
    var hex  = str1.toString();
    var str = '';
    for (var n = 0; n < hex.length; n += 2) {
      str += String.fromCharCode(parseInt(hex.substr(n, 2), 16));
    }
    return str;
   }
    function tlv(tag,svalue){
      var sLength = new TextEncoder().encode(svalue).length;
      var hexSTag = tag.toString(16);
      var hexSLength = sLength.toString(16);
      return hex_to_ascii(hexSTag)+hex_to_ascii(hexSLength)+String(svalue);
    }

      $(".demo").qrcode({
      size: 90,
      fill: '#333',
      text:  Base64.encode(tlv(1,document.getElementById('seller').value)+tlv(2,document.getElementById('vatNo').value)+tlv(3,document.getElementById('bill_date').value)+tlv(4,document.getElementById('bill_total').value)+tlv(5,document.getElementById('tax_total').value)),
      mode: 3,
      //label: 'elite fitness',
      fontcolor: '#000',
    });
    $("canvas").css({border:'solid white',});
</script>
