@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('purchases.Allsuppliers') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('purchases.Purchase') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('purchases.Allsuppliers') }} </li>
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
                <h3 class="card-title"> {{ trans('purchases.Allsuppliers') }}</h3>
                <a href="{{route('suppliers.create')}}" class="btn btn-primary btnAddsys" ><i class="fa fa-plus"></i>  {{ trans('purchases.Add') }} </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>{{ trans('purchases.Code') }}</th>
                    <th>{{ trans('purchases.Name') }}</th>
                    <th>{{ trans('purchases.Mobilenumber') }}</th>
                    <th> {{ trans('purchases.TaxNumber') }}</th>

                    <th> {{ trans('purchases.Datecreated') }}</th>
                    <th>{{ trans('purchases.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($suppliers) > 0)
                      @foreach ($suppliers as $index => $supplier)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$supplier->AccountID}}</td>
                        <td>{{$supplier->name}}</td>
                        <td>{{$supplier->phone}}</td>
                        <td>{{$supplier->vatNo}}</td>

                        <td>{{$supplier->created_at}}</td>
                        <td>
                          <a href="{{route('suppliers.show',$supplier->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('purchases.Show') }}</a>
                          <a href="{{route('suppliers.edit',$supplier->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> {{ trans('purchases.Edite') }}</a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{ $supplier->id }})"><i class="fa fa-trash"></i> {{ trans('purchases.Delete') }}</a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center"> {{ trans('purchases.NoFound') }}</td>
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
    <h1 id="titalmesssage">  {{ trans('purchases.Areyousuretodelete') }} </h1>
    <h1 id="confirmButtonText">  {{ trans('purchases.confirmButtonText') }} </h1>
    <h1 id="cancelButtonText">  {{ trans('purchases.cancelButtonText') }} </h1>
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
        window.location.href = "/delete-supplier/"+id;
      }
    })
  }

</script>
