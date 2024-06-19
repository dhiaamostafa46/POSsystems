@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('purchases.Creditnotes') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('purchases.Purchase') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('purchases.Creditnotes') }} </li>
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
                {{-- <a href="{{route('debitorders.create')}}" class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a> --}}
                <h3 class="card-title">  {{ trans('purchases.Creditnotes') }}  </h3>
                <a href="#" onclick="createConvert();" class="btn btn-primary btnAddsys" ><i class="fa fa-plus"></i>  {{ trans('purchases.Add') }}</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('purchases.supplier') }}</th>
                    <th> {{ trans('purchases.value') }}</th>
                    <th> {{ trans('purchases.Tax') }}</th>
                    <th> {{ trans('purchases.user') }}</th>
                    <th>  {{ trans('purchases.Datecreated') }}</th>
                    <th> {{ trans('purchases.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($orders) > 0)
                      @foreach ($orders as $index => $order)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$order->Supplier->name ??  trans('purchases.NoFound') }}</td>
                        <td>{{$order->totalwvat}}</td>
                        <td>{{$order->totalvat}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                          <a href="{{route('debitorders.show',$order->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>{{  trans('purchases.Show') }}</a>

                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="8" class="text-center">{{ trans('purchases.NoFound') }}   </td>
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
        <h1 id="titalmesssage">  {{ trans('purchases.Areyoupurchaseinvoice') }} </h1>
        <h1 id="confirmButtonText">  {{ trans('purchases.confirmTextSure') }} </h1>
        <h1 id="cancelButtonText">  {{ trans('purchases.cancelCancel') }} </h1>
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
    cancelButtonText: dno,
    showLoaderOnConfirm: true,
    preConfirm: (login) => {
      window.location.href = `/debitorders/create/${login}`;
    },
    allowOutsideClick: () => !Swal.isLoading()
  })
  }
    </script>
@endsection
