@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sale.Customer') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sale.sales') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sale.Customer') }} </li>
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
                <h3 class="card-title"> {{ trans('Sale.Customerlist') }}</h3>
                <a href="{{route('customers.create')}}" class="btn btn-primary btnAddsys" ><i class="fa fa-plus"></i> {{ trans('Sale.Add') }}</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Sale.Code') }}</th>
                    <th>{{ trans('Sale.Name') }}</th>
                    <th>{{ trans('Sale.phone') }}</th>
                    <th> {{ trans('Sale.TaxNumber') }}</th>

                    <th> {{ trans('Sale.Datecreated') }}</th>
                    <th>{{ trans('Sale.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($customers) > 0)
                      @foreach ($customers as $index => $customer)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$customer->AccountID}}</td>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>{{$customer->vatNo}}</td>

                        <td>{{$customer->created_at}}</td>
                        <td>
                          <a href="{{route('customers.show',$customer->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('Sale.Show') }}</a>
                          <a href="{{route('customers.edit',$customer->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> {{ trans('Sale.Edite') }} </a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{ $customer->id }})"><i class="fa fa-trash"></i> {{ trans('Sale.Delete') }}</a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center"> {{ trans('Sale.NoFound') }}</td>
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
    <h1 id="titalmesssage">  {{ trans('Sale.Areyousuretodelete') }} </h1>
    <h1 id="confirmButtonText">  {{ trans('Sale.confirmButtonText') }} </h1>
    <h1 id="cancelButtonText">  {{ trans('Sale.cancelButtonText') }} </h1>
</div>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
  function handleDelete(id){
    ddd= document.getElementById('titalmesssage').innerHTML ;
 dyes= document.getElementById('confirmButtonText').innerHTML ;
 dno = document.getElementById('cancelButtonText').innerHTML ;
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
        window.location.href = "/delete-customer/"+id;
      }
    })
  }

</script>
