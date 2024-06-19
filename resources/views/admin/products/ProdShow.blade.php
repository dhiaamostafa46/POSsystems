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


              <hr class="my-4" />

              <div class="card-header">
                <h3 class="card-title">  {{ trans('Products.Measurementunits') }}  </h3>
              </div>
              <br>
              <div class="col-lg-8" >
                    <h5 style="color: brown;"> {{ trans('Products.fromlargesttosmallest') }}</h5>
                <table  class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th> {{ trans('Products.Unit') }}</th>
                    <th>  {{ trans('Products.Conversionfactor') }}</th>
                    <th>  {{ trans('Products.Unitcost') }}</th>



                  </tr>
                  </thead>
                  <tbody id="trow">
                    <?php $count = 0;?>
                    @foreach($prdUnits as $uitem)
                    <tr>
                      <td>

                          @foreach (auth()->user()->organization->units as $unit)
                            @if($uitem->unitID == $unit->id )
                            <label class="form-control">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$unit->nameAr}} @else {{$unit->nameEn}} @endif</label>
                            @endif
                          @endforeach


                      </td>
                    <td>

                      <label class="form-control">{{$uitem->quantity}}</label>

                    </td>
                    <td>
                      <label class="form-control">{{$uitem->price}}</label>

                    </td>
                  </tr>
                  <?php $count++;?>
                  @endforeach
                  </tbody>
                </table>

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
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
