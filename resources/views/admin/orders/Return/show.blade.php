@extends('layouts.dashboard')
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<style>
  @font-face {
  font-family:ARABTYPE;
  src:url("assets/fonts/ARABTYPE.TTF");

  }
  @media print
  {

    body{
      background-color: #fff !important;
      margin-right: 25px !important;
      margin-left: 25px !important;
    }
    .content-wrapper{
      background-color: #fff !important;
    }
    .invoice{
      width: 100% !important;
      margin: auto;
    }
    .print:last-child {
     page-break-after: auto;
    }
  .no-print, .no-print *
    {
        display: none !important;
    }
  .for-print{
    -webkit-print-color-adjust:exact;
  }
  table td { border:1px solid #000; }
  tr    { page-break-inside:avoid; page-break-after:auto }
  thead { display:table-header-group }
  tfoot { display:table-footer-group }
  .main{
    background-color: #fff !important;
   font-family: Arial, Helvetica, sans-serif !important;
  }
  .col-xs-7{
    width: 100% !important;
  }
}
@page { size: auto;  margin: 0mm; }

</style>
<style>
table {
  page-break-inside: auto;
}
tr {
  page-break-inside: avoid;
  page-break-after: auto;
}
thead {
  display: table-header-group;
}
tfoot {
  display: table-footer-group;
}
.invoice{
  width: 80%;
  margin: auto;
}
</style>
@section('content')
<div class="invoice print">
  <!-- this row will not appear when printing -->
  <div class="row no-print mt-3">
    <div class="col-11" style="margin: auto">
      <a href="#" onclick="printDiv();" class="btn btn-default" style="margin-right: 5px;"><i class="fas fa-print"></i> طباعة</a>
      <button type="button" class="btn btn-primary float-right">
        <i class="fas fa-download"></i> تحميل PDF
      </button>
    </div>
  </div>
  <div class="row" style="margin-top: 0px;">
    <div class="col-3">
      <div style="display: block;margin-top:2px;">
        @if (!empty(auth()->user()->organization->logo) && auth()->user()->organization->logo != "default.png")
        <img src="{{asset('dist/img/organizations/'.auth()->user()->organization->logo)}}"  width="150px" height="150px" alt="">
        @endif
      </div>
    </div>
    <div class="col-6">
      <h6 style="text-align: center;margin:5px"> مرتجع مبيعات </h6>
      <h5 style="text-align: center;margin:5px"><strong>{{auth()->user()->organization->nameAr}}</strong></h5>
      <h6 style="text-align: center;margin:0px;font-size: small">{{auth()->user()->branch->area}} - {{auth()->user()->branch->city}} - {{auth()->user()->branch->district}}</h6>
      <h6 style="text-align: center;margin:5px"><strong>الرقم الضريبي: {{auth()->user()->organization->vatNo}}</strong></h6>
    </div>
    <div class="col-3"><div class="col-xs-3"><div class="demo" style="display: block;margin-top:2px;"></div></div>
  </div>
  <hr>
  <div class="row col-12"  style="margin: auto">

    <table class="col-12" style="margin: auto;float:none">
      <tr>
        <td style="text-align: right;font-size: small">
          وقت وتاريخ الفاتورة
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$order->created_at->format('Y-m-d -- H:i:s')}}
        </td>
        <td style="text-align: right;font-size: small">
          البائع
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$order->user->name}}
        </td>
      </tr>
      <tr>
        <td style="text-align: right;font-size: small">
          رقم الفاتورة
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$order->serial}}
        </td>
        <td style="text-align: right;font-size: small">
          الرقم الضريبي للعميل
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$order->customer->vatNo}}
        </td>
      </tr>
      <tr>
        <td style="text-align: right;font-size: small">
          اسم العميل
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$order->customer->name}}
        </td>
        <td style="text-align: right;font-size: small">
          طريقة الدفع
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          @if ($order->type == 1)
            نقداً
          @elseif ($order->type == 2)
            شبكة
          @else
            آجل
          @endif
        </td>
      </tr>
    </table>
    <table class="col-12 mt-3 border for-print" style="margin:auto;float:none;text-align:center;padding:5px" >
      <thead>
        <tr  style="border: 1px solid #000;">
          <!--<td style="font-size: small">Item Code<br> كود الصنف</td>-->
          <th style="font-size: small;background-color: rgb(202, 199, 199);">Item<br> الصنف</th>
          <th style="font-size: small;background-color: rgb(202, 199, 199);">quantity<br> الكمية</th>
          <th style="font-size: small;background-color: rgb(202, 199, 199);">Unit Price<br>سعر الوحدة</th>
          <th style="font-size: small;direction:ltr;background-color: rgb(202, 199, 199);">Total (Exc VAT)<br> الاجمالي غير شامل ضريبة ق.م</th>
          <th style="font-size: small;background-color: rgb(202, 199, 199);">Total VAT<br> اجمالي ضريبة ق.م 15%</th>
          <th style="font-size: small;direction:ltr;background-color: rgb(202, 199, 199);">Total (Inc VAT)<br> الاجمالي شامل ضريبة ق.م</th>
        </tr>
      </thead>
      <tbody>
        @if(count($order->orderdetails) > 0)
      @foreach ($order->orderdetails as $item)
      <tr>
          <td style="font-size:small;width:40vw">{{$item->product->nameAr}}</td>
          <td style="font-size:small">{{$item->quantity}}</td>
          <td style="font-size:small">{{$item->price}}</td>
          <td style="font-size:small">{{number_format(($item->price/1.15) * $item->quantity,2) }}</td>
          <td style="font-size:small">{{number_format(($item->price*0.15/1.15) * $item->quantity,2)}}</td>
          <td style="font-size:small">{{number_format($item->price * $item->quantity,2)}}</td>
      </tr>
      @endforeach
      @endif
      <hr>
      <?php
            $size = 77 - count($order->orderdetails)*1.5;
      ?>
      <tr style="height: {{$size}}vh;">
        <td style="font-size:small;">&nbsp;</td>
        <td style="font-size:small"></td>
        <td style="font-size:small"></td>
        <td style="font-size:small"></td>
        <td style="font-size:small"></td>
        <td style="font-size:small"></td>
      </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5" style="background-color: rgb(202, 199, 199);font-size:small;height:30px"> الإجمالي الخاضع للضريبة (غير شاملة ضريبة ق.م)  Total Taxable Amount (Excluding VAT)</td>
          <td style="background-color: rgb(202, 199, 199);font-size:small">{{number_format($order->totalwvat - $order->totalvat,2)}} ريال</td>
        </tr>
        <tr>
          <td colspan="5" style="background-color: rgb(202, 199, 199);font-size:small;height:30px"> مجموع ضريبة القيمة المضافة 15%  Total VAT</td>
          <td style="background-color: rgb(202, 199, 199);font-size:small">{{number_format($order->totalvat,2)}} ريال</td>
        </tr>
        <tr>
          <td colspan="5" style="background-color: rgb(202, 199, 199);font-size:small;height:30px"> اجمالي المبلغ المستحق  Total Amount Due</td>
          <td style="background-color: rgb(202, 199, 199);font-size:small">{{number_format($order->totalwvat,2)}} ريال</td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<input type="hidden" id="bill_date" value="{{$order->created_at}}">
<input type="hidden" id="bill_total" value="{{$order->totalwvat}}">
<input type="hidden" id="tax_total" value="{{$order->totalvat}}">
<!-- Description -->
<input type="hidden" id="seller" value="{{auth()->user()->organization->nameAr}}">
<input type="hidden" id="vatNo" value="{{auth()->user()->organization->vatNo}}">

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script src="{{asset('dist/jquery-qrcode.js')}}"></script>
<script>
  function printDiv(){
    window.print();
  }
</script>
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
@endsection
