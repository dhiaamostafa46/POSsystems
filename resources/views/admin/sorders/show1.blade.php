@extends('layouts.dashboard')
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<style>
    @font-face {
    font-family:ARABTYPE;
    src:url("assets/fonts/ARABTYPE.TTF");
    
    }
    @media print
    {  
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
</style>
@section('content')
<section class="content mt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
  <a href="#" onclick="printDiv();" class="btn btn-danger no-print" style="margin: auto"><i class="fa fa-print"></i> طباعة</a>
  <div id="table" class="for-print col-xs-12" style="margin-top: 5px;float:none;font-size:large;text-align: center;direction:rtl;margin:auto;">
        
          <div class="row" style="margin: 0px">
            <div class="col-xs-3">
              <div style="display: block;margin-top:2px;">
                @if (!empty(auth()->user()->organization->logo) && auth()->user()->organization->logo != "default.png")
                <img src="{{asset('dist/img/organizations/'.auth()->user()->organization->logo)}}" width="60%" alt="">
                @endif
              </div>
            </div>
            <div class="col-xs-6">
              <h6 style="text-align: center;margin:5px">فاتورة ضريبية مبسطة</h6>
              <h6 style="text-align: center;margin:5px">Simplified Tax Invoice</h6>
              <h5 style="text-align: center;margin:5px"><strong>{{auth()->user()->organization->nameAr}}</strong></h5>
              <h6 style="text-align: center;margin:0px;font-size: small">{{auth()->user()->branch->area}} - {{auth()->user()->branch->city}} - {{auth()->user()->branch->district}}</h6>
            </div>
            <div class="col-xs-3"><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl={{$qr}}&choe=UTF-8" style="width: 200px" title="Link to Google.com" /></div>
          </div>
      
          <div class="row col-xs-12"  style="margin: auto">
            <hr>
            <table class="col-xs-11" style="margin: auto;float:none">
              <tr>
                <td style="text-align: right;font-size: x-small">
                  وقت وتاريخ الفاتورة
                </td>
                <td style="text-align:right;font-size: x-small">
                  {{$order->created_at->format('Y-m-d -- H:i:s')}}
                </td>
                <td style="text-align: right;font-size: x-small">
                  البائع
                </td>
                <td style="text-align:right;font-size: x-small">
                  {{$order->user->name}}
                </td>
              </tr>
              <tr>
                <td style="text-align: right;font-size: x-small">
                  رقم الفاتورة
                </td>
                <td style="text-align:right;font-size: x-small">
                  {{$order->number}}
                </td>
                <td style="text-align: right;font-size: x-small">
                  الرقم الضريبي
                </td>
                <td style="text-align:right;font-size: x-small">
                  {{auth()->user()->organization->vatNo}}
                </td>
              </tr>
              <tr>
                <td style="text-align: right;font-size: x-small">
                  اسم العميل
                </td>
                <td style="text-align:right;font-size: x-small">
                  {{$order->customer->name}}
                </td>
                <td style="text-align: right;font-size: x-small">
                  طريقة الدفع
                </td>
                <td style="text-align:right;font-size: x-small">
                  @if ($order->type == 1)
                    نقداً
                  @else
                    شبكة
                  @endif
                </td>
              </tr>
            </table>
          <table class="col-xs-11 border for-print" style="margin:auto;float:none;text-align:center;padding:5px" >
            <tr  style="border: 1px solid #000;">
              <!--<td style="font-size: x-small">Item Code<br> كود الصنف</td>-->
              <td style="font-size: x-small;background-color: rgb(202, 199, 199);">Item<br> الصنف</td>
              <td style="font-size: x-small;background-color: rgb(202, 199, 199);">quantity<br> الكمية</td>
              <td style="font-size: x-small;background-color: rgb(202, 199, 199);">Unit Price<br>سعر الوحدة</td>
              <td style="font-size: x-small;direction:ltr;background-color: rgb(202, 199, 199);">Total (Exc VAT)<br> الاجمالي غير شامل ضريبة ق.م</td>
              <td style="font-size: x-small;background-color: rgb(202, 199, 199);">Total VAT<br> اجمالي ضريبة ق.م</td>
              <td style="font-size: x-small;direction:ltr;background-color: rgb(202, 199, 199);">Total (Inc VAT)<br> الاجمالي شامل ضريبة ق.م</td>
            </tr>
            @if(count($order->orderdetails) > 0)
            @foreach ($order->orderdetails as $item)
            <tr>
                <td style="font-size:x-small;width:40vw">{{$item->product->nameAr}}</td>
                <td style="font-size:x-small">{{$item->quantity}}</td>
                <td style="font-size:x-small">{{$item->price}}</td>
                <td style="font-size:x-small">{{$item->price}}</td>
                <td style="font-size:x-small">{{$item->price}}</td>
                <td style="font-size:x-small">{{$item->price}}</td>
            </tr>
            @endforeach
            @endif
            <hr>
            <?php
                  $size = 66 - count($order->orderdetails)*1.5;
            ?>
            <tr style="height: {{$size}}vh;">
              <td style="font-size:x-small;">&nbsp;</td>
              <td style="font-size:x-small"></td>
              <td style="font-size:x-small"></td>
              <td style="font-size:x-small"></td>
              <td style="font-size:x-small"></td>
              <td style="font-size:x-small"></td>
            </tr>
            <tr>
              <td colspan="5" style="background-color: rgb(202, 199, 199);;font-size:x-small"> الإجمالي الخاضع للضريبة (غير شاملة ضريبة ق.م)  Total Taxable Amount (Excluding VAT)</td>
              <td style="background-color: rgb(202, 199, 199);font-size:x-small">{{$order->totalwvat - $order->vat}}</td>
            </tr>
            <tr>
              <td colspan="5" style="background-color: rgb(202, 199, 199);;font-size:x-small"> مجموع ضريبة القيمة المضافة  Total VAT</td>
              <td style="background-color: rgb(202, 199, 199);font-size:x-small">{{$order->vat}}</td>
            </tr>
            <tr>
              <td colspan="5" style="background-color: rgb(202, 199, 199);;font-size:x-small"> اجمالي المبلغ المستحق  Total Amount Due</td>
              <td style="background-color: rgb(202, 199, 199);font-size:x-small">{{$order->totalwvat}}</td>
            </tr>
          </table>
          </div>
      </div>
    </div>
  </div>
  </div>
</div>
</div>
</section>
@endsection