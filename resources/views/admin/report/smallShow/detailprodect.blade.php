


@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">  {{ trans('Products.ListProducts') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">  {{ trans('Products.Products') }} </a></li>
            <li class="breadcrumb-item active">  {{ trans('Products.ListProducts') }}</li>
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
            <h3 class="card-title">{{ trans('Products.details') }}</h3>
          </div>
          <div class="card-body">
            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('Products.ProductName-Arabic') }}</label>
                      <h6 class="text-primary">{{$product->nameAr}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('Products.ProductName-Einglsh') }}</label>
                      <h6 class="text-primary">{{$product->nameEn}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('Products.CategorydetailsArabic') }}</label>
                      <h6 class="text-primary">{{$product->detailsAr}}</h6>
                      @error('details')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-userdetails"> {{ trans('Products.CategorydetailsEinglsh') }}</label>
                      <h6 class="text-primary">{{$product->detailsEn}}</h6>
                      @error('details')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">{{ trans('Products.Calories') }}</label>
                      <h6 class="text-primary">{{$product->calories}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('Products.Purchasingprice') }}</label>
                      <h6 class="text-primary">{{$product->costPrice}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('Products.sellingprice') }}</label>
                      <h6 class="text-primary">{{$product->prodPrice}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('Products.Productsection') }}</label>
                      <h6 class="text-primary">{{$product->category->nameAr}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">{{ trans('Products.Productcode') }}</label>
                      <h6 class="text-primary">{{$product->barcode}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">{{ trans('Products.Tax') }}</label>
                      <h6 class="text-primary">{{$product->vat}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('Products.Tax') }}</label>
                      <h6 class="text-primary">{{$product->user->name}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('Products.Datecreated') }}</label>
                      <h6 class="text-primary">{{$product->created_at}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  @if (!empty($product->sFrom))
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">من الساعة</label>
                      <h6 class="text-primary">{{$product->sFrom}}</h6>
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
                      <h6 class="text-primary">{{$product->sTo}}</h6>
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
                      <label class="form-control-label" for="input-username"> {{ trans('Products.Sectionpicture') }} </label>
                      <h6 class="text-primary">
                        <img src="{{asset('../dist/img/products/'.$product->img)}}" style="width: 20%" alt="">
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
