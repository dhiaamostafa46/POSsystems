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
        <img src="{{asset('dist/img/organizations/'.auth()->user()->organization->logo)}}" style="width: 70px" alt="">
         <br>{{auth()->user()->organization->nameAr}}        
      </h4>
    </div>
    <div class="col-4">
      <h4>
        <br><br>
        <small class="float-right">العنوان: {{auth()->user()->branch->area}} - {{auth()->user()->branch->city}} - {{auth()->user()->branch->district}}</small><br>
        <small class="float-right">السجل التجاري: {{auth()->user()->organization->CR}}</small><br>
        <small class="float-right">الرقم الضريبي: {{auth()->user()->organization->vatNo}}</small><br>
      </h4>
    </div>
    <!-- /.col -->
  </div>
  <hr>
  <h5>تقرير المنتجات في الفترة من {{session('dateFrom')}} الى {{session('dateTo')}}</h5>
  <hr>
    <!-- Table row -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <form class="row col-6 no-print" method="POST" action="{{route('setPeriod')}}">
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
            </form>
            <table id="example3" class="table table-bordered table-hover" style="width: 95%">
              <thead>
              <tr>
                <th>#</th>
                <th>اسم المنتج</th>
                <th>الكود</th>
                <th>السعر</th>
                <th>الموجود</th>
                <th>المباع</th>
                <th>الربح</th>
                <th>الضريبة</th>
              </tr>
              </thead>
              <tbody>
             
              @if (count($products) > 0)
                  @foreach ($products as $index => $product)
                  <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$product->nameAr}}</td>
                    <td>{{$product->barcode}}</td>
                    <td>{{$product->prodPrice}}</td>
                    <td class="@if($product->stocksWhere->sum('quantityIn') - $product->stocksWhere->sum('quantityOut') >= 0) text-success @else text-danger @endif">
                      {{$product->stocksWhere->sum('quantityIn') - $product->stocksWhere->sum('quantityOut')}}
                    </td>
                    <td>{{$product->stocksWhere->sum('quantityOut')}}</td>
                    <td>{{$product->stocksWhere->sum('quantityOut') * ($product->prodPrice - $product->costPrice)}}</td>
                    <td>{{$product->stocksWhere->sum('quantityOut') * ($product->prodPrice - $product->costPrice) * $product->vat/100}}</td>
                  </tr>
                  @endforeach
              @else
                  <tr>
                    <td colspan="7" class="text-center">لا يوجد منتجات</td>
                  </tr>
              @endif
              </tfoot>
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
      <a href="#" onclick="printDiv();" class="btn btn-default"><i class="fas fa-print"></i> طباعة</a>
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