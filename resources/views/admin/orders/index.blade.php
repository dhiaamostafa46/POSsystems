@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sale.OrdersList') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sale.sales') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sale.OrdersList') }} </li>
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
                <a href="{{route('orders.create')}}" class="btn btn-primary btnAddsys" ><i class="fa fa-plus"></i> {{ trans('Sale.Add') }}</a>
                {{-- <form class="row col-6 no-print" method="POST" action="{{route('setPeriod')}}">
                  @csrf
                  <div class="col-lg-4">
                    <input type="date" name="dateFrom" class="form-control" value="{{session('dateFrom')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <input type="date" name="dateTo" class="form-control" value="{{session('dateTo')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <input type="submit" class="form-control btn btn-primary" value="بحث">
                  </div>
                </form> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>  {{ trans('Sale.invoicesNumber') }}</th>
                    <th> {{ trans('Sale.customername') }}</th>
                    <th> {{ trans('Sale.value') }}</th>
                    <th> {{ trans('Sale.Tax') }}</th>
                    <th>{{ trans('Sale.Type') }}</th>
                    <th>{{ trans('Sale.user') }}</th>
                    <th> {{ trans('Sale.Datecreated') }}</th>
                    <th>{{ trans('Sale.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($orders) > 0)
                      @foreach ($orders as $index => $order)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$order->serial}}</td>
                        <td>{{!empty($order->customerID)?$order->Customer->name:""}}</td>
                        <td>{{$order->totalwvat}}</td>
                        <td>{{$order->totalvat}}</td>
                        <td>{{$order->type==121?trans('Sale.Cash'):($order->type==122?trans('Sale.Net'):trans('Sale.Paylater'))}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                          <a href="{{route('orders.show',$order->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('Sale.Show') }}</a>
                          <!--<a href="#" class="btn btn-danger" onclick="handleDelete({{ $order->id }})"><i class="fa fa-trash"></i> حذف</a>-->
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="8" class="text-center"> {{ trans('Sale.NoFound') }}</td>
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
