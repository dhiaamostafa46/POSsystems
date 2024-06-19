@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Packages.Anintroductoryfacility') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Packages.Visualidentity') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Packages.Anintroductoryfacility') }} </li>
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
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"> {{ trans('Packages.Adddata') }}</h3>
          </div>
          <div class="card-body">
            <form class="user" method="post" action="{{route('ProfileInfCompany.ServicesStore')}}" enctype = "multipart/form-data">
              @csrf
              @method('PUT')
              <div class="pl-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Packages.Servicename') }}  </label>
                          <input type="text"  class="form-control text-right" id="name" name="name" rows="4" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Packages.Serviceimage') }}  </label>
                          <input type="file" class="form-control text-right "   id="signature" name="img">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Packages.Servicedescription') }}  </label>
                          <textarea class="form-control text-right" id="disc" name="disc" rows="4" ></textarea>
                        </div>
                    </div>














                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary" style="width: 100%">{{ trans('Packages.save') }} </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
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
    Swal.fire({
      title: 'هل انت متأكد من الحذف؟',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: 'نعم، حذف',
      cancelButtonText: 'لا، الغاء'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/delete-user/"+id;
      }
    })
  }

</script>
