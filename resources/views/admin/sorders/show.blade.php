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
      @if($sorder->status==1)
      <a href="#" onclick="confirm({{$sorder->id}});" class="btn btn-primary float-right">
        <i class="fas fa-check-circle"></i> قبول الطلب
      </a>
      @endif
    </div>
  </div>
  <div class="row" style="margin-top: 0px;">
    <div class="col-3">
      <div style="display: block;margin-top:2px;">
        @if (!empty(auth()->user()->organization->logo) && auth()->user()->organization->logo != "default.png")
        <img src="{{asset('dist/img/organizations/'.auth()->user()->organization->logo)}}" width="70px" alt="">
        @endif
      </div>
    </div>
    <div class="col-6">
      <h6 style="text-align: center;margin:5px">نموذج استلام بضاعة</h6>
      <h5 style="text-align: center;margin:5px"><strong>{{auth()->user()->organization->nameAr}}</strong></h5>
      <h6 style="text-align: center;margin:0px;font-size: small">{{auth()->user()->branch->area}} - {{auth()->user()->branch->city}} - {{auth()->user()->branch->district}}</h6>
    </div>
    <div class="col-3"></div>
  </div>
  <div class="row col-12"  style="margin: auto">
    <table class="col-12" style="margin: auto;float:none">
      <tr>
        <td style="text-align: right;font-size: small">
          وقت وتاريخ الطلب
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$sorder->created_at->format('Y-m-d -- H:i:s')}}
        </td>
        <td style="text-align: right;font-size: small">
          رقم الطلب
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$sorder->id}}
        </td>
      </tr>
      <tr>
        <td style="text-align: right;font-size: small">
          طلب بواسطة
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$sorder->user->name}}
        </td>
        <td style="text-align: right;font-size: small">
          اسم المستلم
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$sorder->reciever}}
        </td>
        
      </tr>
      <tr>
        <td style="text-align: right;font-size: small">
          حالة الطلب
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          @if ($sorder->status == 1)
            في انتظار الموافقة
          @else
            تمت الموافقة
          @endif
        </td>
        <td style="text-align: right;font-size: small">
          جوال المستلم
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$sorder->recieverPhone}}
        </td>
      </tr>
      <tr>
        <td style="text-align: right;font-size: small">
          الفرع
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$sorder->branch->nameAr}}
        </td>
        <td style="text-align: right;font-size: small">
          المسلّم
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$sorder->deliver}}
        </td>
      </tr>
      <tr>
        <td style="text-align: right;font-size: small">
          التعليق
        </td>
        <td colspan="3" style="text-align:right;font-size: small">
          {{$sorder->comment}}
        </td>
      </tr>
    </table>
    <table class="col-6 mt-3 border for-print" style="margin:auto;float:none;text-align:center;padding:5px" >
      <thead>
        <tr  style="border: 1px solid #000;">
          <th style="font-size: small;background-color: rgb(202, 199, 199);" colspan="3"> فاتورة الاستلام</th>
        </tr>
        <tr  style="border: 1px solid #000;">
          <th style="font-size: small;background-color: rgb(202, 199, 199);">Item barcode<br> كود الصنف</th>
          <th style="font-size: small;background-color: rgb(202, 199, 199);">Item<br> الصنف</th>
          <th style="font-size: small;background-color: rgb(202, 199, 199);">quantity<br> الكمية</th>
        </tr>
      </thead>
      <tbody>
        @if(count($sorder->sorderdetails) > 0)
        @foreach ($sorder->sorderdetails as $item)
        <tr>
          <td style="font-size:small;width:40vw">{{$item->product->barcode}}</td>
            <td style="font-size:small;width:40vw">{{$item->product->nameAr}}</td>
            <td style="font-size:small">{{$item->quantity}}</td>
        </tr>
        @endforeach
        @endif
      <?php
            $size = 40 - count($sorder->sorderdetails)*1.5;
      ?>
      <tr style="height: {{$size}}vh;">
        <td style="font-size:small;">&nbsp;</td>
        <td style="font-size:small"></td>
        <td style="font-size:small"></td>
      </tr>
      </tbody>
    </table>
    <table class="col-6 mt-3 border for-print" style="margin:auto;float:none;text-align:center;padding:5px" >
      <thead>
        <tr  style="border: 1px solid #000;">
          <th style="font-size: small;background-color: rgb(202, 199, 199);" colspan="3"> فاتورة المشتريات</th>
        </tr>
        <tr  style="border: 1px solid #000;">
          <th style="font-size: small;background-color: rgb(202, 199, 199);">Item barcode<br> كود الصنف</th>
          <th style="font-size: small;background-color: rgb(202, 199, 199);">Item<br> الصنف</th>
          <th style="font-size: small;background-color: rgb(202, 199, 199);">quantity<br> الكمية</th>
        </tr>
      </thead>
      <tbody>
        @if(count($sorder->purchase->purchasedetails) > 0)
        @foreach ($sorder->purchase->purchasedetails as $item)
        <tr>
          <td style="font-size:small;width:40vw">{{$item->product->barcode}}</td>
            <td style="font-size:small;width:40vw">{{$item->product->nameAr}}</td>
            <td style="font-size:small">{{$item->quantity}}</td>
        </tr>
        @endforeach
        @endif
      <?php
            $size = 40 - count($sorder->purchase->purchasedetails)*1.5;
      ?>
      <tr style="height: {{$size}}vh;">
        <td style="font-size:small;">&nbsp;</td>
        <td style="font-size:small"></td>
        <td style="font-size:small"></td>
      </tr>
      </tbody>
    </table>
    <div class="col-12 row mt-3" style="text-align: center">
      <div class="col-6">
        <h6>التوقيع</h6>
        @if(!empty($sorder->approveID))
        <h6><img src="{{asset('dist/img/signatures/'.$sorder->approve->signature)}}" style="width: 200px" alt=""></h6>
        @endif
      </div>
      <div class="col-6">
        <h6>الختم</h6>
        @if(!empty($sorder->approveID))
        <h6><img src="{{asset('dist/img/organizations/'.auth()->user()->organization->signature)}}" style="width: 200px" alt=""></h6>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

<script>
  function printDiv(){
    window.print();
  }
</script>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
  function confirm(id){
    Swal.fire({
      title: 'هل انت متأكد من قبول الطلب؟',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#35d5b6',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: 'نعم',
      cancelButtonText: 'لا'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/sorders-confirm/"+id;
      }
    })
  }
  
</script>