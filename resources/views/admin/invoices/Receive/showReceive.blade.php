@extends('layouts.dashboard')
<style>
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
  table td { border:1px solid #000;font-size: 12px;  }
  table td tr { border:1px solid #000; }
  tr    { page-break-inside:avoid; page-break-after:auto ;}
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
@section('content')
<div class="invoice p-3 mb-3">
  <!-- title row -->
  <div class="row">
    <div class="col-4">
      <h4>
         {{auth()->user()->organization->nameAr}}
        <br><br>
        <img src="{{asset('dist/img/organizations/'.auth()->user()->organization->logo)}}" style="width: 70px" alt="">
      </h4>
    </div>
    <div class="col-4" style="margin: auto">
        <h5 class="text-center"> {{ trans('Sandat.SinadatindexReceive') }}</h5>
      </div>
    <div class="col-4">
      <h4>
        <br><br>
        <small class="float-right">{{ trans('Sandat.address') }}: {{auth()->user()->branch->area}} - {{auth()->user()->branch->city}} - {{auth()->user()->branch->district}}</small><br>
        <small class="float-right">{{ trans('Sandat.CommercialRecord') }} : {{auth()->user()->organization->CR}}</small><br>
        <small class="float-right">{{ trans('Sandat.TaxNumber') }} : {{auth()->user()->organization->vatNo}}</small><br>
      </h4>
    </div>
    <!-- /.col -->
  </div>
  <hr>

  <!-- Table row -->
  <div class="row">
    <div class="col-12 table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th style="width: 30%"> {{ trans('Sandat.BondNo') }}</th>
            <th>{{$invoice->id}}</th>
            <th style="width: 10%">{{ trans('Sandat.date') }}</th>
            <th>{{$invoice->created_at->format('Y-m-d')}}</th>
          </tr>
          <tr>
            <th>{{ trans('Sandat.customername') }}</th>
            <th colspan="3">{{$invoice->customer->name}}</th>
          </tr>
          <tr>
            <th>{{ trans('Sandat.account') }}</th>
            <th colspan="3">{{$invoice->nameAccount}}</th>
          </tr>
          <tr>
            <th> {{ trans('Sandat.phonenumber') }}</th>
            <th colspan="3">{{$invoice->customer->phone}}</th>
          </tr>
          <tr>
            <th>{{ trans('Sandat.comment') }}</th>
            <th colspan="3">{{$invoice->comment}}</th>
          </tr>
          <tr>
            <th>  {{ trans('Sandat.Salesinvoicenumber') }}</th>
            <th colspan="3">{{$invoice->invoicesID ?? ''}}</th>
          </tr>
          <tr>
            <th>  {{ trans('Sandat.Theamountcurrentlypaid') }}</th>
            <th colspan="3">{{$invoice->total}} {{ trans('Sandat.Rial') }}</th>
          </tr>

        </thead>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-6">
      &nbsp;
    </div>
    <!-- /.col -->
    <div class="col-6">
      <p class="lead"></p>

      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>  {{ trans('Sandat.Receiptvoucher') }}</th>
            <td><strong>{{$invoice->total}}</strong> {{ trans('Sandat.Rial') }}</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-12">
      <a href="#" onclick="printDiv();" class="btn btn-default"><i class="fas fa-print"></i> {{ trans('Sandat.Print') }}</a>
    </div>
  </div>
</div>
<!-- /.invoice -->
@endsection
<script>
  function printDiv(){
    window.print();
  }
</script>
