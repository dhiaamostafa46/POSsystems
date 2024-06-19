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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> {{ trans('permissions.Modifypermissions') }} </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('roles.update',$role->id) }}" enctype = "multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('permissions.ThetitleofpowersisArabic') }}</label>
                          <input type="text"  class="form-control @error('nameAr') is-invalid @enderror" id="nameAr" name="nameAr" placeholder="{{ trans('permissions.ThetitleofpowersisArabic') }}" value="{{$role->nameAr}}">
                          @error('nameAr')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('permissions.PowerstitleinEnglish') }}</label>
                          <input type="text"  class="form-control @error('nameEn') is-invalid @enderror" id="nameEn"  onkeypress="return ValidateKey();" name="nameEn" placeholder="{{ trans('permissions.PowerstitleinEnglish') }}" value="{{$role->nameEn}}">
                          @error('nameEn')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <input type="submit" class="btn btn-primary" value=" {{ trans('permissions.save') }}" style="width: 100%">
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <hr class="my-4" />
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
