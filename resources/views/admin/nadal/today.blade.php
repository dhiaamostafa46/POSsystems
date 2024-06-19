@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sale.Postpaidorders') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sale.sales') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sale.Postpaidorders') }} </li>
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
              <div class="row mt-2 col-12">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{  $orders->count() }}</h3>
                      <p>    {{ trans('Sale.Numberofrequests') }}  </p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>

                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>{{count($orders->where('kind',2))}}</h3>
                      <p>   {{ trans('Sale.paymentwasmade') }} </p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>

                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>{{count($orders->where('kind',1 ))}}</h3>
                      <p>   {{ trans('Sale.unpaid') }}</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>

                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>{{count($orders->where('kind',3))}}</h3>
                      <p>   {{ trans('Sale.Ordercanceled') }} </p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>

                  </div>
                </div>
                <!-- ./col -->
              </div>
            </div>
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table text-center table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Sale.invoicenumber') }}  </th>
                    <th>  {{ trans('Sale.Table') }} </th>
                    <th> {{ trans('Sale.value') }} </th>
                    <th>  {{ trans('Sale.Ordertime') }} </th>
                    <th>  {{ trans('Sale.paymentmethod') }}  </th>
                  
                    <th> {{ trans('Sale.Status') }} </th>
                    <th> {{ trans('Sale.Options') }} </th>
                  </tr>
                  </thead>
                  <tbody id="tbody">

                  @if (count($orders) > 0)
                      @foreach ($orders as $index => $order)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$order->id}}</td>
                        <td> {{$order->table->tableNo ?? ''}} </td>
                        <td>{{$order->totalwvat }}</td>
                        <td>{{$order->created_at->diffForHumans()}}</td>
                        <td> <select id="typePayment" class="form-control"  onchange="showCashCard(this)" style="display:inline-block" required>
                                    <option selected value="121" > {{ trans('Sale.Cash') }}</option>
                                    <option value="122"> {{ trans('Sale.Net') }}</option>
                            </select>
                        </td>
                        <td>
                          @switch($order->kind)
                            @case(1)

                                <span class="badge badge-info">  {{ trans('Sale.unpaid') }}</span>
                                @break
                            @case(2)
                                <span class="badge badge-success"> {{ trans('Sale.paymentwasmade') }}</span>
                                @break
                            @case(3)
                                 <span class="badge badge-danger">  {{ trans('Sale.Ordercanceled') }} </span>
                                @break
                            @default
                        @endswitch
                        </td>
                        <td>
                          <a href="{{route('Nadal.show',$order->id)}}" class="btn btn-info"><i class="fa fa-eye"></i> {{ trans('Sale.Show') }}</a>
                          @if ($order->type ==3)
                          <a  onclick="handleDelete({{ $order->id }})"  target="_blank" class="btn btn-primary"><i class="fa fa-check-circle"></i> {{ trans('Sale.Done') }}</a>
                          @endif
                          @if ($order->type ==3)
                             <a  onclick="handleconsol({{ $order->id }})"  target="_blank" class="btn btn-danger"><i class="fa fa-trash"></i> {{ trans('Sale.cancel') }}</a>
                          @endif

                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="8" class="text-center">{{ trans('Sale.NoFound') }}  </td>
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


<div  style="display: none">
    <h1 id="titalmesssage">  {{ trans('Sale.SureConfirm') }} </h1>
    <h1 id="confirmButtonText">  {{ trans('Sale.SureSure') }} </h1>
    <h1 id="cancelButtonText">  {{ trans('Sale.SureCancel') }} </h1>
    <h1 id="CancelConfirm">  {{ trans('Sale.CancelConfirm') }} </h1>

</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
     function handleDelete(id){

        ddd= document.getElementById('titalmesssage').innerHTML ;
        dyes= document.getElementById('confirmButtonText').innerHTML ;
        dno = document.getElementById('cancelButtonText').innerHTML ;

        console.log( document.getElementById(`typePayment`).value);
    Swal.fire({
      title: ddd,
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: dyes,
      cancelButtonText: dno
    }).then((result) => {
      if (result.isConfirmed) {

        window.location.href = `/Nadal.update/${id}/${document.getElementById(`typePayment`).value}`;

      }
    })
  }
</script>
<script>
    function handleconsol(id){

        ddd= document.getElementById('CancelConfirm').innerHTML ;
        dyes= document.getElementById('confirmButtonText').innerHTML ;
        dno = document.getElementById('cancelButtonText').innerHTML ;

   Swal.fire({
     title:ddd,
     text: "",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#f8a29e',
     confirmButtonText:dyes,
     cancelButtonText:dno
   }).then((result) => {
     if (result.isConfirmed) {

       window.location.href = `/Nadal.delete/${id}`;

     }
   })
 }
</script>



