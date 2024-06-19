@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Store.Openingbalance') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Store.Warehouses') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Store.Openingbalance') }} </li>
          </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<!-- /.content-header -->
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">   {{ trans('Store.Openingbalance') }} </h3>
                <div style="float:left">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Store.ProductName') }}</th>
                    <th> {{ trans('Store.Productcode') }}</th>
                    <th> {{ trans('Store.price') }}</th>

                    <th> {{ trans('Store.quantity') }}</th>

                  </tr>
                  </thead>
                  <tbody>

                  @if (count($Stockinout->stockinoutdetails) > 0)
                      @foreach ($Stockinout->stockinoutdetails as $index => $product)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$product->product->nameAr ?? ''}}</td>
                        <td>{{$product->product->barcode?? ''}}</td>
                        <td>{{$product->product->prodPrice ?? ''}}</td>
                        <th>{{$product->quantity }}</th>

                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center"> {{ trans('Store.NoFound') }}  </td>
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
