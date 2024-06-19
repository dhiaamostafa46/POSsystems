@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Packages.Services') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Packages.Visualidentity') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Packages.Services') }} </li>
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
                <h3 class="card-title">  {{ trans('Packages.Services') }}  </h3>
                <a href="{{route('ProfileInfCompany.ServicesCreate')}}" class="btn btn-primary btnAddsys" ><i class="fa fa-plus"></i> {{ trans('Packages.addition') }}</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Packages.name') }} </th>
                    <th> {{ trans('Packages.Image') }} </th>
                    <th>  {{ trans('Packages.thedescription') }} </th>
                    <th> {{ trans('Packages.Options') }} </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($prof) > 0)
                      @foreach ($prof as $index => $product)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$product->name}}</td>
                        <td><img src="{{asset('dist/img/Profile/'.$product->img)}}" width="30px" alt=""></td>
                        <td>{{$product->disc}}</td>
                        <td>
                          <a href="{{route('ProfileInfCompany.ServicesEdite',$product->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> {{ trans('Packages.amendment') }} </a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{ $product->id }})"><i class="fa fa-trash"></i> {{ trans('Packages.delete') }} </a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center"> {{ trans('Packages.Notfound') }} </td>
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
        <h1 id="titalmesssage">  {{ trans('Packages.Areyousuretodelete') }} </h1>
        <h1 id="confirmButtonText">  {{ trans('Packages.confirmButtonText') }} </h1>
        <h1 id="cancelButtonText">  {{ trans('Packages.cancelButtonText') }} </h1>
    </div>
    <!-- Extras Modal -->
@endsection

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
      cancelButtonText:  dno
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/ProfileInfCompany.ServicesDelete/"+id;
      }
    })
  }

</script>
