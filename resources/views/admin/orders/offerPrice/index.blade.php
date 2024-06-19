@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sale.OfferPrice') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sale.sales') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sale.OfferPrice') }} </li>
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
                <a href="{{route('OfferPrice.create')}}" class="btn btn-primary btnAddsys"><i class="fa fa-plus"></i> {{ trans('Sale.Add') }} </a>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Sale.customername') }}</th>
                    <th> {{ trans('Sale.value') }}</th>


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

                        <td> @if ($order->FlageCustumer==-1) {{$order->VirtualCustomer->name ?? ''}} @else  {{$order->Customer->name ?? ''}}  @endif </td>
                        <td>{{$order->totalwvat}}</td>


                        <td>{{$order->user->name}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                          <a href="{{route('OfferPrice.show',$order->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>  {{ trans('Sale.Show') }}</a>
                          <a href="{{route('OfferPrice.edit',$order->id)}}" class="btn btn-info"><i class="fa fa-eye"></i> {{ trans('Sale.Edite') }}</a>
                          <a href="{{route('OfferPrice.Convert',$order->id)}}" class="btn btn-info"><i class="fa fa-eye"></i>    {{ trans('Sale.Converttoinvoice') }}</a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{ $order->id }})"><i class="fa fa-trash"></i> {{ trans('Sale.Delete') }}</a>
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
        <h1 id="TheproduAreyousuretodelete">  {{ trans('Sale.Areyousuretodelete') }} </h1>
        <h1 id="namprmessageconfirmButtonText">  {{ trans('Products.confirmButtonText') }} </h1>
        <h1 id="namprssagecancelButtonText">  {{ trans('Products.cancelButtonText') }} </h1>
    </div>
@endsection

<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
  function handleDelete(id){
    Swal.fire({
      title: document.getElementById('TheproduAreyousuretodelete').innerHTML,
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: document.getElementById('namprmessageconfirmButtonText').innerHTML,
      cancelButtonText:  document.getElementById('namprssagecancelButtonText').innerHTML
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/OfferPrice.delete/"+id;
      }
    })
  }

</script>
