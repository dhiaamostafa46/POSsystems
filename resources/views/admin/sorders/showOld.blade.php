@extends('layouts.dashboard')

@section('content')
<!-- Main content -->
<section class="content mt-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-8">
              <h4>
                 {{auth()->user()->organization->nameAr}}
                <br><br>
                <img src="{{asset('dist/img/organizations/'.auth()->user()->organization->logo)}}" style="width: 70px" alt="">
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
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-2 invoice-col">
              <address class="text-right">
                رقم الفاتورة<br>
                وقت وتاريخ الفاتورة<br>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <address>
                {{$order->serial}}<br>
                {{$order->created_at}}<br>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-2 invoice-col">
              <address class="text-right">
                العميل<br>
                عنوان العميل<br>
                الرقم الضريبي للعميل
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <address>
                {{$order->customer->name}}<br>
                {{$order->address}}<br>
                {{$order->vatNo}}
              </address>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>الصنف</th>
                  <th>الكمية</th>
                  <th>السعر</th>
                  <th>الاجمالي</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($order->orderdetails as $item)
                  <tr>
                    <td>{{$item->product->nameAr}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->price * $item->quantity}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
              <div class="qr">
                <img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl={{$qr}}&choe=UTF-8" style="width: 200px" title="Link to Google.com" />
              </div>
            </div>
            <!-- /.col -->
            <div class="col-6">
              <p class="lead"></p>

              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">المجموع</th>
                    <td>{{$order->totalwvat - $order->totalvat}}</td>
                  </tr>
                  <tr>
                    <th>ضريبة القيمة المضافة</th>
                    <td>{{$order->totalvat}}</td>
                  </tr>
                  <tr>
                    <th>الاجمالي</th>
                    <td><strong>{{$order->totalwvat}}</strong> ريال</td>
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
              <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
              <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                Payment
              </button>
              <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                <i class="fas fa-download"></i> Generate PDF
              </button>
            </div>
          </div>
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection