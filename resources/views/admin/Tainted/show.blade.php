

@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Store.Damagedinventory') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Store.Inventory') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Store.Damagedinventory') }} </li>
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
          <div class="card-header ">
              {{ trans('Store.details') }}
          </div>
          <div class="card-body">
            <table id="example2" class="table text-center table-bordered table-hover">
              <thead>
              <tr>
                <th>#</th>
                <th> {{ trans('Store.productname') }} </th>
                <th>{{ trans('Store.Productprice') }} </th>
                <th>   {{ trans('Store.Quantitytransferred') }} </th>

              </tr>
              </thead>
              <tbody>
                   <!--get product transaction on stock-->
                    @if (count( $Tainted->TaintedDetail) > 0)
                        @foreach ( $Tainted->TaintedDetail as $index => $details)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$details->product->nameAr ?? ''}}</td>
                            <td>{{$details->product->costPrice ?? ''}}</td>
                            <td>{{$details->quantity}}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">{{ trans('Store.NoFound') }} </td>
                        </tr>
                    @endif
              </tbody>
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
