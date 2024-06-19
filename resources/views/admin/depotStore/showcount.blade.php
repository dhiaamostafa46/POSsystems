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
            <li class="breadcrumb-item active"> {{ trans('Store.listInventory') }} </li>
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
                <h3 class="card-title"> {{ trans('Store.listInventory') }}  </h3>
                <div style="float:left">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>{{ trans('Store.name') }} </th>
                    <th>{{ trans('Store.Unit') }} </th>
                    {{-- <th>السعر</th> --}}
                    <th>  {{ trans('Store.Quantityavailableinstock') }}  </th>
                    <th>    {{ trans('Store.Averageunitcost') }}  </th>
                    <th>   {{ trans('Store.CostSale') }}  </th>
                    <th>     {{ trans('Store.Productcostforinventory') }}  </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($unit) > 0)
                      @foreach ($unit as $index => $product)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$product->product->nameAr ??''}}</td>
                        <td>{{$product->Unit->nameAr ?? ''}}</td>
                        {{-- <td>{{$product->product->costPrice ??""}}</td> --}}
                        <td>
                            @if(($product->start +$product->count +$product->comeIn )- ($product->saller+$product->Tainted+$product->ComeOut + $product->hang)> 0)
                               <i class="fa fa-circle" style="color: green" ></i>
                             @else
                            <i class="fa fa-circle" style="color: red"></i>
                            @endif
                            {{($product->start +$product->count +$product->comeIn )- ($product->saller+$product->Tainted+$product->ComeOut + $product->hang) }}
                        </td>
                        <td>{{ number_format($product->costprodect ,3) }}</td>
                        <td>{{number_format($product->costprodect *$product->saller ,2) }}</td>
                        <td>{{ number_format($product->costprodect *($product->start +$product->count +$product->comeIn )- ($product->saller+$product->Tainted+$product->ComeOut + $product->hang) ,2)}}</td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center">{{ trans('Store.NoFound') }}   </td>
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
