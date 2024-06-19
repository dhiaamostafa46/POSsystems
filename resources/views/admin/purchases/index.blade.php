@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('purchases.Purchaserecord') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('purchases.Purchase') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('purchases.Purchaserecord') }} </li>
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

                <h3 class="card-title">  {{ trans('purchases.Purchaserecord') }}  </h3>
                <a href="{{route('purchases.create')}}" class="btn btn-primary btnAddsys" ><i class="fa fa-plus"></i>  {{ trans('purchases.Add') }} </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('purchases.invoicenumber') }}  </th>
                    <th> {{ trans('purchases.supplier') }} </th>
                    <th> {{ trans('purchases.value') }} </th>
                    <th> {{ trans('purchases.Tax') }} </th>
                    <th> {{ trans('purchases.Paymenttype') }} </th>
                    <th> {{ trans('purchases.Invoicetype') }}  </th>
                    <th> {{ trans('purchases.by') }} </th>
                    <th> {{ trans('purchases.Datecreated') }} </th>
                    <th> {{ trans('purchases.Options') }} </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($purchases) > 0)
                      @foreach ($purchases as $index => $purchase)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$purchase->invoicesID}}</td>
                        <td>{{$purchase->supplier->name ??  trans('purchases.NoFound')  }}</td>
                        <td>{{$purchase->totalwvat}}</td>
                        <td>{{$purchase->totalvat}}</td>
                        <td>{{$purchase->type==121?  trans('purchases.Cash') :($purchase->type==122?  trans('purchases.Net')  :  trans('purchases.Paylater')   )}}</td>
                        <td>@if ($purchase->kind ==1)  {{ trans('purchases.Draft') }}  @else {{ trans('purchases.certified') }}  @endif </td>
                        <td>{{$purchase->user->name}}</td>
                        <td>{{$purchase->created_at}}</td>
                        <td>
                          <a href="{{route('purchases.showprint',$purchase->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> </a>
                          @if ($purchase->kind ==1)
                            <a href="{{route('purchases.edit',$purchase->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                            <a  onclick="handleDelete({{$purchase->id}})" class="btn btn-warning"><i class="fa fa-check-square"></i></a>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="8" class="text-center"> {{ trans('purchases.NoFound') }} </td>
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
        <h1 id="titalmesssage2222">  {{ trans('Dadhoard.Doyouwanttoconfirm222') }} </h1>
        <h1 id="confirmButtonText333">  {{ trans('Dadhoard.balanceText222') }} </h1>
        <h1 id="cancelButtonText333">  {{ trans('Dadhoard.balanceCancel222') }} </h1>
    </div>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    dddmd= document.getElementById('titalmesssage2222').innerHTML ;
 dddyes= document.getElementById('confirmButtonText333').innerHTML ;
 ddddno = document.getElementById('cancelButtonText333').innerHTML ;
  function handleDelete(id){
    Swal.fire({
      title: dddmd,
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText:dddyes,
      cancelButtonText:ddddno
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "/purchases/confirm/"+id;
        }
      })
  }
  </script>
@endsection




