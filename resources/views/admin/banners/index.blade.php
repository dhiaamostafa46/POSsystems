@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Company.Advertisements') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Company.Onlinestore') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Company.Advertisements') }} </li>
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
                <h6 style="display: inline-block"> {{ trans('Company.Displayads') }} </h6>
                <a href="{{route('banners.create')}}" class="btn btn-primary btnAddsys"><i class="fa fa-plus"></i>  {{ trans('Company.addition') }}</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Company.thename') }} </th>
                    <th> {{ trans('Company.Image') }} </th>
                    <th>  {{ trans('Company.Datecreated') }} </th>
                    <th> {{ trans('Company.Options') }} </th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  @if (count($banners) > 0)
                      @foreach ($banners as $index => $banner)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$banner->nameAr}}</td>
                        <td><img src="{{asset('dist/img/banners/'.$banner->img)}}" width="30px" alt=""></td>
                        <td>{{$banner->created_at}}</td>
                        <td>
                          <a href="{{route('banners.show',$banner->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>  {{ trans('Company.Show') }} </a>
                          <a href="{{route('banners.edit',$banner->id)}}" class="btn btn-info"><i class="fa fa-edit"></i>  {{ trans('Company.Edit') }} </a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{ $banner->id }})"><i class="fa fa-trash"></i>  {{ trans('Company.delete') }} </a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">{{ trans('Company.NotfoundData') }}  </td>
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
        <h1 id="titalmesssage">  {{ trans('Company.Areyousuretodelete') }} </h1>
        <h1 id="confirmButtonText">  {{ trans('Company.confirmButtonText') }} </h1>
        <h1 id="cancelButtonText">  {{ trans('Company.cancelButtonText') }} </h1>
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
      confirmButtonText: dyes,
      cancelButtonText:dno
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/delete-banner/"+id;
      }
    })
  }
  
</script>