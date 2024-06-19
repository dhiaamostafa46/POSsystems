@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Account.Costcenter') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Account.accounts') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Account.Costcenter') }} </li>
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
                <h3 class="card-title">   {{ trans('Account.Recordcostcenters') }}  </h3>
                <a href="{{route('costcenters.create')}}" class="btn btn-primary btnAddsys" ><i class="fa fa-plus"></i> {{ trans('Account.Add') }}  </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>{{ trans('Account.Code') }} </th>
                    <th>{{ trans('Account.Costname') }}  </th>
                    <th>{{ trans('Account.date') }}  </th>
                    <th> {{ trans('Account.Mainaccount') }}</th>
                    <th> {{ trans('Account.Options') }}  </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($CostCenter) > 0)
                      @foreach ($CostCenter as $index => $row)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row->CostCodeID}}</td>
                        <td>{{$row->CostName}}</td>
                        <td>{{$row->dataCost}}</td>
                        <td>{{$row->namefather}}</td>
                        <td>
                          {{-- <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a> --}}
                          <a href="{{route('costcenters.edit',$row->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> {{ trans('Account.Edite') }}</a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{$row->id}})"><i class="fa fa-trash"></i> {{ trans('Account.Delete') }}</a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center"> {{ trans('Account.NoFound') }}  </td>
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
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>

  function handleDelete(id){



    var title ='هل انت متأكد من حذف مركز التكلفة؟'

    Swal.fire({
      title: title,
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: 'نعم',
      cancelButtonText: ' الغاء'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/costcenters.delete/"+id;
      }
    })
  }

</script>
