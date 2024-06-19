

@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sale.Order') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sale.sales') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sale.Order') }} </li>
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
            {{ trans('Sale.details') }}
          </div>
          <div class="card-body">
            <table class="table text-center table-bordered table-hover">
              <thead>
              <tr>
                <th>#</th>
                <th>    {{ trans('Sale.Requestname') }} </th>
                <th> {{ trans('Sale.price') }}  </th>
                <th> {{ trans('Sale.Ingredients') }}  </th>
                <th>{{ trans('Sale.Quantity') }}  </th>
                <th>{{ trans('Sale.Total') }}  </th>
              </tr>
              </thead>
              <tbody>
                   <!--get product transaction on stock-->
                    @if (count( $orders->orderdetails) > 0)
                        @foreach ( $orders->orderdetails as $index => $details)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$details->productName}}</td>
                            <td>{{$details->price}}</td>
                            <td>
                                @if ($details->Extracount !=0)
                                    @foreach ($details->extrasdetials as $item)
                                       {{$item->nameAr}}<br>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{$details->quantity}}</td>
                            <td>{{$details->quantity *$details->price }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">لا يوجد حركات</td>
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
