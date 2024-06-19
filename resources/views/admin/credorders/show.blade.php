@extends('layouts.dashboard')
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
      <h6 style="text-align: center;margin:5px">اشعار دائن للفاتورة الضريبية</h6>
      <h6 style="text-align: center;margin:5px">Credit note for the tax invoice</h6>
      <h5 style="text-align: center;margin:5px"><strong>{{auth()->user()->organization->nameAr}}</strong></h5>
      <h6 style="text-align: center;margin:0px;font-size: small">{{auth()->user()->branch->area}} - {{auth()->user()->branch->city}} - {{auth()->user()->branch->district}}</h6>
    </div>
    <div class="col-3"><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl={{$qr}}&choe=UTF-8" style="width: 100px" title="Link to Google.com" /></div>
  </div>
  <hr>
  <div class="row col-12"  style="margin: auto">

    <table class="col-12" style="margin: auto;float:none">
      <tr>
        <td style="text-align: right;font-size: small">
          وقت وتاريخ الاشعار
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
          رقم الاشعار
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$order->id}}
        </td>
        <td style="text-align: right;font-size: small">
          رقم الفاتورة
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$order->serial}}
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
          الرقم الضريبي
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{auth()->user()->organization->vatNo}}
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
          <th style="font-size: small;background-color: rgb(202, 199, 199);">Total VAT<br> اجمالي ضريبة ق.م</th>
          <th style="font-size: small;direction:ltr;background-color: rgb(202, 199, 199);">Total (Inc VAT)<br> الاجمالي شامل ضريبة ق.م</th>
        </tr>
      </thead>
      <tbody>
        @if(count($order->orderdetails) > 0)
      @foreach ($order->orderdetails as $item)
      <tr>
          <td style="font-size:small;width:40vw">{{$item->product->nameAr ?? ''}}</td>
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
          <td style="background-color: rgb(202, 199, 199);font-size:small">{{$order->totalwvat - $order->totalvat}}</td>
        </tr>
        <tr>
          <td colspan="5" style="background-color: rgb(202, 199, 199);font-size:small;height:30px"> مجموع ضريبة القيمة المضافة 15%  Total VAT</td>
          <td style="background-color: rgb(202, 199, 199);font-size:small">{{$order->totalvat}}</td>
        </tr>
        <tr>
          <td colspan="5" style="background-color: rgb(202, 199, 199);font-size:small;height:30px"> اجمالي المبلغ المستحق  Total Amount Due</td>
          <td style="background-color: rgb(202, 199, 199);font-size:small">{{$order->totalwvat}}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
@endsection

<script>
  function printDiv(){
    window.print();
  }
</script>
