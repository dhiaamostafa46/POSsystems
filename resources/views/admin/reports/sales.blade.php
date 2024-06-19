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
@section('content')
<div class="invoice p-3 mb-3">
  <!-- title row -->
  <div class="row">
    <div class="col-8">
      <h4>
        <img src="{{asset('public/dist/img/organizations/'.auth()->user()->organization->logo)}}" style="width: 70px;" alt="">
         <br>{{auth()->user()->organization->nameAr}}
      </h4>

    </div>
    <div class="col-4 ms-5 me-5">
      <h4>
        <br><br>
        <small class="floatmleft"> {{ trans('Report.theaddress') }}: {{auth()->user()->branch->area}} - {{auth()->user()->branch->city}} - {{auth()->user()->branch->district}}</small><br>
        <small class="floatmleft">  {{ trans('Report.commercialregister') }}: {{auth()->user()->organization->CR}}</small><br>
        <small class="floatmleft">  {{ trans('Report.TaxNumber') }} : {{auth()->user()->organization->vatNo}}</small><br>
      </h4>
    </div>
    <!-- /.col -->
  </div>
  <hr>
  <h5> {{ trans('Report.salesreport') }}</h5>
  <hr>
  <!-- Table row -->

  <div class="row">
        <div class="col-3">
            <div class="card">
              <div class="card-header">
                {{ trans('Report.Facilitysales') }}
              </div>
              <div class="card-body">
                <div class="row">

                  <div class="col-7 text-left">  {{ trans('Report.sales') }}</div><div class="col-5">{{auth()->user()->organization->sales->sum('totalwvat')  + auth()->user()->organization->salesInv->sum('totaldis')}}</div>
                  <div class="col-7 text-left">  {{ trans('Report.Creditnotes') }}</div><div class="col-5">{{auth()->user()->organization->Credorder->sum('totaldis')}}</div>
                  <div class="col-7 text-left">  {{ trans('Report.Purchases') }}</div><div class="col-5">{{auth()->user()->organization->purchases->sum('totaldis')}}</div>
                  <div class="col-7 text-left">  {{ trans('Report.Citynotices') }}</div><div class="col-5">{{auth()->user()->organization->Debitorder->sum('totaldis')}}</div>
                  <div class="col-7 text-left">  {{ trans('Report.Expenses') }}</div><div class="col-5">{{auth()->user()->organization->outcomes->sum('total')}}</div>
                  <div class="col-7 text-left">{{ trans('Sale.tax') }}  {{ trans('Report.sales') }}</div><div class="col-5">{{auth()->user()->organization->sales->sum('totalvat') + auth()->user()->organization->salesInv->sum('totalvat')}}</div>
                  <div class="col-7 text-left"> {{ trans('Sale.tax') }}  {{ trans('Report.Purchases') }}</div><div class="col-5">{{auth()->user()->organization->purchases->sum('totalvat')}}</div>
                </div>
              </div>
            </div>
        </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <hr>
  <h6> {{ trans('Report.Branchsales') }}</h6>
  <hr>
    <!-- Table row -->
    <div class="row">

      @foreach (auth()->user()->organization->branches as $branch)
        <div class="col-3">
            <div class="card">
              <div class="card-header">
                {{$branch->nameAr}}
              </div>
              <div class="card-body">
                <div class="row">

                  <div class="col-7 text-left"> {{ trans('Report.sales') }}</div><div class="col-5">{{$branch->sales->sum('totalwvat') +$branch->salesInv->sum('totaldis')}}</div>
                  <div class="col-7 text-left">  {{ trans('Report.Creditnotes') }}</div><div class="col-5">{{$branch->Credorder->sum('totaldis') }}</div>
                  <div class="col-7 text-left"> {{ trans('Report.Purchases') }}</div><div class="col-5">{{$branch->purchases->sum('totaldis')}}</div>
                  <div class="col-7 text-left">  {{ trans('Report.Citynotices') }}</div><div class="col-5">{{$branch->Debitorder->sum('totaldis') }}</div>
                  <div class="col-7 text-left"> {{ trans('Report.Expenses') }} </div><div class="col-5">{{$branch->outcomes->sum('total')}}</div>
                  <div class="col-7 text-left">{{ trans('Sale.tax') }}  {{ trans('Report.sales') }}</div><div class="col-5">{{$branch->sales->sum('totalvat') + $branch->salesInv->sum('totalvat')}}</div>
                  <div class="col-7 text-left"> {{ trans('Sale.tax') }}  {{ trans('Report.Purchases') }}</div><div class="col-5">{{$branch->purchases->sum('totalvat')}}</div>
                </div>
              </div>
            </div>
        </div>
      @endforeach
    {{-- @foreach (auth()->user()->organization->branches as $branch)
      <div class="col-lg-3">
          <div class="card">
            <div class="card-header">
              {{$branch->nameAr}}
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-7 text-left">المبيعات</div><div class="col-5">{{$branch->sales->sum('totalwvat')}}</div>
                <div class="col-7 text-left">المشتريات</div><div class="col-5">{{$branch->purchases->sum('totalwvat')}}</div>
                <div class="col-7 text-left">المصروفات</div><div class="col-5">{{$branch->outcomes->sum('total')}}</div>
                <div class="col-7 text-left">الضريبة</div><div class="col-5">{{$branch->sales->sum('totalvat')}}</div>
              </div>
            </div>
          </div>
      </div>
    @endforeach --}}
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-12">
      <a href="#" onclick="printDiv();" class="btn btn-default"><i class="fas fa-print"></i> {{ trans('Report.Print') }} </a>
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
