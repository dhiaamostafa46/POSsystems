@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">  تقييم المنتجات </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">  تقارير  </a></li>
          <li class="breadcrumb-item active"> تقييم المنتجات  </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header bg-white row">
            <div class="col-6">
            </div>
          </div>
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover text-center">
              <thead>
                <tr>
                    <th>#</th>
                    <th>المنتج</th>
                    <th> فئة المنتج</th>
                    <th>الوحدة</th>
                    <th>المتوسط المرجح</th>
                    <th> الكمية </th>
                    <th> القيمة</th>

                </tr>
              </thead>
              <tbody>
                <?php $sum=0; ?>
                   <!--get product transaction on stock-->
              @if (count($stocks) > 0)
                  @foreach ($stocks as $index => $product)
                  <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$product->product->nameAr}}</td>
                    <td>{{$product->product->category->nameAr ?? ''}}</td>
                    <td>{{$product->ProdUnit->unitname ??""}}</td>
                    <td>{{$product->ProdUnit->costprodect ?? ''}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->quantity *($product->ProdUnit->costprodect ?? 1)}}</td>
                  </tr>
                  @endforeach

              @else
                  <tr>
                    <td colspan="6" class="text-center">لا يوجد حركات</td>
                  </tr>
              @endif
              </tbody>
             <tfoot>
             </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
