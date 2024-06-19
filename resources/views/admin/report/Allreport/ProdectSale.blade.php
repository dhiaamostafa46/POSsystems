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
table td{
  padding: 2px !important;
}
</style>
@section('content')
<div class="invoice p-3 mb-3">
  <!-- title row -->
  <div class="row">
    <div class="col-8">
      <h4>
        <img src="{{asset('public/dist/img/organizations/'.auth()->user()->organization->logo)}}" style="width: 70px" alt="">
         <br>{{auth()->user()->organization->nameAr}}
      </h4>
    </div>
    <div class="col-4">
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
  <h5>   {{ trans('Report.Salesitemreport') }} </h5>
  <hr>
    <!-- Table row -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            {{-- <form class="row col-6 no-print" method="POST" action="{{route('setPeriod')}}">
              @csrf
              <div class="col-lg-4">
                <label for="">من تاريخ</label>
                <input type="date" name="dateFrom" class="form-control" value="{{session('dateFrom')}}">
              </div>
              <div class="col-lg-4" style="float: none">
                <label for="">الى تاريخ</label>
                <input type="date" name="dateTo" class="form-control" value="{{session('dateTo')}}">
              </div>
              <div class="col-lg-4" style="float: none">
                <label for="">&nbsp;</label>
                <input type="submit" class="form-control btn btn-primary" value="بحث">
              </div>
            </form> --}}
            <table id="example3" class="table table-bordered table-hover" style="width: 95%">
              <thead>
                <tr>
                  <th>#</th>
                  <th> {{ trans('Report.invoicenumber') }}</th>
                  <th>{{ trans('Report.productname') }}</th>
                  <th>{{ trans('Report.Quantity') }}</th>
                  <th>{{ trans('Report.Operationtype') }}</th>
                  <th>{{ trans('Report.details') }}</th>
                  <th>{{ trans('Report.date') }}</th>
                  <th>{{ trans('Report.mainbranch') }}</th>
                </tr>
                </thead>
                <tbody>

                @if (count($stocks) > 0)
                    @foreach ($stocks as $index => $product)
                    <tr>
                      <td>{{$index+1}}</td>
                      <td>{{$product->Order->serial ?? ''}}</td>
                      <td>{{$product->item->nameAr ?? ''}}</td>
                      <td class="@if($product->quantityIn > 0) text-success @else text-danger @endif">
                        @if($product->quantityIn > 0)
                        <i class="fa fa-arrow-down"></i>
                        @else
                        <i class="fa fa-arrow-up"></i>
                        @endif
                        {{$product->quantityIn > 0?$product->quantityIn:$product->quantityOut}}
                      </td>
                      <td>{{$product->quantityIn > 0? trans('Report.push'):trans('Report.pull')}}</td>
                      <td>{{$product->comment}}</td>
                      <td>{{$product->created_at}}</td>
                      <td>{{$product->branch->nameAr ?? ''}}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                      <td colspan="6" class="text-center">{{ trans('Report.NotFounddata') }} </td>
                    </tr>
                @endif
                </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-12">
      <a href="#" onclick="printDiv();" class="btn btn-default"><i class="fas fa-print"></i> {{ trans('Report.Print') }}</a>
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
