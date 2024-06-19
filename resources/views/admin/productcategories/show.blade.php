@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ trans('Products.Productsections') }}  </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb floatmleft">
          <li class="breadcrumb-item"><a href="#">{{ trans('Products.Productsections') }}  </a></li>
          <li class="breadcrumb-item active">{{ trans('Products.Sectiondetails') }}  </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">{{ trans('Products.Sectiondetails') }} </h3>
          </div>
          <div class="card-body">
            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('Products.DepartmentName-Arabic') }} </label>
                      <h6 class="text-primary">{{$prodcategory->nameAr}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('Products.DepartmentName-English') }}  </label>
                      <h6 class="text-primary">{{$prodcategory->nameEn}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  @if (!empty($prodcategory->sFrom))
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">من الساعة</label>
                      <h6 class="text-primary">{{$prodcategory->sFrom}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">الى الساعة</label>
                      <h6 class="text-primary">{{$prodcategory->sTo}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  @endif


                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">{{ trans('Products.picture') }}  </label>
                      <h6 class="text-primary">
                        <img src="{{asset('dist/img/productcategories/'.$prodcategory->img)}}" style="width: 20%" alt="">
                      </h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
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
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
