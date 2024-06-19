@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('permissions.permissions') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('permissions.Usersandpermissions') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('permissions.permissions') }} </li>
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
                <h3 class="card-title">{{ trans('permissions.Allpowers') }} </h3>
                <a href="{{route('roles.create')}}" class="btn btn-primary btnAddsys" ><i class="fa fa-plus"></i> {{ trans('permissions.addition') }} </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>{{ trans('permissions.NameArabic') }} </th>
                    <th> {{ trans('permissions.NameEnglish') }}</th>
                    <th> {{ trans('permissions.Datecreated') }}</th>
                    <th>{{ trans('permissions.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  @if (count($roles) > 0)
                      @foreach ($roles as $index => $role)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$role->nameAr}}</td>
                        <td>{{$role->nameEn}}</td>
                        <td>{{$role->created_at}}</td>
                        <td>
                          <a href="{{route('roles.show',$role->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('permissions.show') }}</a>
                          <a href="{{route('roles.edit',$role->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> {{ trans('permissions.amendment') }}</a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{ $role->id }})"><i class="fa fa-trash"></i> {{ trans('permissions.delete') }}</a>
                          <a href="{{route('roles.pages',$role->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> {{ trans('permissions.permissions') }}</a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">{{ trans('permissions.thepage') }}</td>
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
        <h1 id="titalmesssage">  {{ trans('permissions.Areyousuretodelete') }} </h1>
        <h1 id="confirmButtonText">  {{ trans('permissions.confirmButtonText') }} </h1>
        <h1 id="cancelButtonText">  {{ trans('permissions.cancelButtonText') }} </h1>
    </div>
@endsection
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
      confirmButtonText:  dyes,
      cancelButtonText:  dno 
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/delete-role/"+id;
      }
    })
  }
  
</script>