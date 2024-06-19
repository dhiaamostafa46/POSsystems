@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">  {{ trans('Products.ListProducts') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">  {{ trans('Products.Products') }} </a></li>
            <li class="breadcrumb-item active">  {{ trans('Products.ListProducts') }}</li>
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
              <a href="{{route('stocks.print',$product->id)}}" class="btn btn-danger" style="float:left"><i class="fa fa-print"></i> {{ trans('Report.Print') }} </a>
            </div>
          </div>
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>#</th>
                <th> {{ trans('Report.name') }}</th>
                <th> {{ trans('Report.Quantity') }}</th>
                <th>{{ trans('Report.Operationtype') }}</th>
                <th>{{ trans('Report.details') }}</th>
                <th>{{ trans('Report.Datecreated') }}</th>
                <th>{{ trans('Report.warehouse') }}</th>
              </tr>
              </thead>
              <tbody>
                   <!--get product transaction on stock-->
              @if (count($product->stocksWhere) > 0)
                  @foreach ($product->stocksWhere as $index => $transaction)
                  <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$transaction->item->nameAr ?? ''}}</td>
                    <td class="@if($transaction->quantityIn > 0) text-success @else text-danger @endif">
                      @if($transaction->quantityIn > 0)
                      <i class="fa fa-arrow-down"></i>
                      @else
                      <i class="fa fa-arrow-up"></i>
                      @endif
                      {{$transaction->quantityIn > 0?$transaction->quantityIn:$transaction->quantityOut}}
                    </td>
                    <td>{{$transaction->quantityIn > 0 ? trans('Report.push') : trans('Report.pull') }}</td>
                    <td>{{$transaction->comment}}</td>
                    <td>{{$transaction->created_at}}</td>
                    <td>{{$transaction->branch->nameAr}}</td>
                  </tr>
                  @endforeach
              @else
                  <tr>
                    <td colspan="6" class="text-center"> {{ trans('Report.NotFounddata') }} </td>
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
