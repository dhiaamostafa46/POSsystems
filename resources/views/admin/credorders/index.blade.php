@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sale.Creditnotes') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sale.sales') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sale.Creditnotes') }} </li>
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

                {{-- <a href="{{route('credorders.create')}}" class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a> --}}
                <a href="#" onclick="createConvert();" class="btn btn-primary btnAddsys" ><i class="fa fa-plus"></i> {{ trans('purchases.Add') }}</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Sale.customername') }}</th>
                    <th> {{ trans('Sale.value') }}</th>
                    <th> {{ trans('Sale.Tax') }}</th>
                    <th> {{ trans('Sale.user') }}</th>
                    <th>  {{ trans('Sale.Datecreated') }}</th>
                    <th> {{ trans('Sale.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($orders) > 0)
                      @foreach ($orders as $index => $order)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{!empty($order->customerID)?$order->customer->name:""}}</td>
                        <td>{{$order->totalwvat}}</td>
                        <td>{{$order->totalvat}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                          <a href="{{route('credorders.show',$order->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>  {{ trans('Sale.Show') }}</a>
                          {{-- <a href="#" class="btn btn-danger" onclick="handleDelete({{ $order->id }})"><i class="fa fa-trash"></i>  {{ trans('Sale.Delete') }}</a> --}}
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="8" class="text-center"> {{ trans('Sale.NoFound') }} </td>
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
    <div  style="display: none">
        <h1 id="titalmesssage">  {{ trans('Sale.Areyoupurchaseinvoice') }} </h1>
        <h1 id="confirmButtonText">  {{ trans('Sale.confirmTextSure') }} </h1>
        <h1 id="cancelButtonText">  {{ trans('Sale.cancelCancel') }} </h1>
    </div>
    <script>

        function createConvert(){
            ddd= document.getElementById('titalmesssage').innerHTML ;
 dyes= document.getElementById('confirmButtonText').innerHTML ;
 dno = document.getElementById('cancelButtonText').innerHTML ;
            Swal.fire({
            title:ddd,
            input: 'text',
            inputAttributes: {
              autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: dyes,
            cancelButtonText:dno,
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
              window.location.href = `/credorders/create/${login}`;
            },
            allowOutsideClick: () => !Swal.isLoading()
          })
          }
            </script>
@endsection
