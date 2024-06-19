@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    @if (auth()->user()->organization->activity == 2)
                        {{ trans('Products.Ingredients') }}
                    @else
                        {{ trans('admin.Productcomponents') }}
                    @endif
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb floatmleft">
                    <li class="breadcrumb-item"><a href="#">
                            @if (auth()->user()->organization->activity == 2)
                                {{ trans('Products.Ingredients') }}
                            @else
                                {{ trans('admin.Productcomponents') }}
                            @endif
                        </a></li>
                    <li class="breadcrumb-item active">
                        @if (auth()->user()->organization->activity == 2)
                            {{ trans('Products.listIngredients') }}
                        @else
                            {{ trans('Products.details') }}
                        @endif
                    </li>
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
            <h3 class="card-title">{{ trans('Products.details') }} </h3>
          </div>
          <div class="card-body">
            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">{{ trans('Products.productname') }} </label>
                      <h6 class="text-primary">{{$vom->nameprodect}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('Products.Numberofcomponents') }}  </label>
                      <h6 class="text-primary">{{$vom->countVol}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">{{ trans('Products.comment') }}  </label>
                      <h6 class="text-primary">{{$vom->desc}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">{{ trans('Products.Totalcost') }}  </label>
                      <h6 class="text-primary">{{$vom->totalcost}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">{{ trans('Products.Quantity') }}  </label>
                      <h6 class="text-primary">{{$vom->totalguenty}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <table class="table text-center table-bordered table-hover">
                        <thead>
                        <tr>
                          <th>#</th>
                          <th> {{ trans('Products.ProductName') }}  </th>
                          <th>  {{ trans('Products.Costprice') }} </th>
                          <th> {{ trans('Products.Unit') }} </th>
                          <th>{{ trans('Products.Quantity') }}  </th>
                          <?php $rt=0; ?>
                        </tr>
                        </thead>
                        <tbody>

                              @if (count( $vom->VolumeDetail) > 0)
                                  @foreach ( $vom->VolumeDetail as $index => $details)
                                  <tr>
                                      <td>{{$index+1}}</td>
                                      <td>{{$details->product->nameAr}}</td>
                                      <td>{{$details->QuantityTotal}}  <?php $rt+=$details->QuantityTotal; ?></td>
                                      <td>{{$details->unit ?? ''}}</td>
                                      <td>{{$details->Quantity}}</td>
                                  </tr>
                                  @endforeach
                              @endif

                              <tr>
                                <th>#</th>
                                <th>{{ trans('Products.Total') }}   </th>
                                <th>   <?php echo $rt;?> </th>
                                <th> </th>
                                <th></th>
                              </tr>
                        </tbody>
                      </table>
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
