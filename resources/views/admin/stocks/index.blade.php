@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">المخزون</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">المخزون</a></li>
          <li class="breadcrumb-item active">قائمة المخزون</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">كل المخزون</h3>
                <div style="float:left">
                  <a href="{{route('stocks.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة</a>
                  <a href="{{route('stocks.drop')}}" class="btn btn-danger"><i class="fa fa-minus"></i> سحب</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الكود</th>
                    <th>السعر</th>
                    <th>الصورة</th>
                    <th>الموجود</th>
                    <th>خيارات</th>
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
                        <td><img src="{{asset('dist/img/productcategories/'.$product->img)}}" width="30px" alt=""></td>

                        <td class="@if($product->stocks->sum('quantityIn') - $product->stocks->sum('quantityOut') >= 0) text-success @else text-danger @endif">
                          @if($product->stocks->sum('quantityIn') - $product->stocks->sum('quantityOut') >= 0)
                          <i class="fa fa-circle"></i>
                          @else
                          <i class="fa fa-circle"></i>
                          @endif
                          {{$product->stocks->sum('quantityIn') - $product->stocks->sum('quantityOut')}}
                        </td>



                        
                        <td>
                          <a href="{{route('stocks.show',$product->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a>
                        </td>
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
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
@endsection
