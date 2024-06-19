@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Store.Warehouses') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Store.Warehouses') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Store.ListWarehouses') }} </li>
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
                <h3 class="card-title">   {{ trans('Store.ListWarehouses') }}</h3>
                <div class="btnAddsys">
                  <a href="{{route('depotStore.create')}}" class="btn btn-primary "><i class="fa fa-plus"></i>  {{ trans('Store.Add') }}</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table text-center table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>  {{ trans('Store.accountnumber') }}</th>
                    <th> {{ trans('Store.name') }}</th>
                    <th> {{ trans('Store.status') }}</th>

                    <th> {{ trans('Store.branch') }}</th>
                    <th> {{ trans('Store.Options') }} </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($DepotStore) > 0)
                      @foreach ($DepotStore as $index => $product)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$product->AccountID}}</td>
                        <td>{{$product->name}}</td>
                        <td>@if ($product->status ==1)  {{ trans('Store.Active') }} @else   {{ trans('Store.NoActive') }} @endif</td>

                        <td>{{$product->branch->nameAr ?? ''}}</td>
                        <td>
                          <a href="{{route('depotStore.show',$product->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>  {{ trans('Store.Show') }}</a>
                          <a href="{{route('depotStore.edit',$product->id)}}" class="btn btn-info"><i class="fa fa-edit"></i>  {{ trans('Store.Edite') }}</a>
                          {{-- <a href="{{route('StockDepot.create',$product->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> اضافة رصيد افتتاحي </a> --}}
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center">  {{ trans('Store.NoFound') }} </td>
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
