@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Store.Manufacturingorder') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Store.Inventory') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Store.Manufacturingorder') }} </li>
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
            <h3 class="card-title"> {{ trans('Store.details') }}</h3>
          </div>
          <div class="card-body">
            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">    {{ trans('Store.ProductName') }} </label>
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
                      <label class="form-control-label" for="input-username">  {{ trans('Store.Quantity') }}  </label>
                      <h6 class="text-primary">{{$vom->Quantity}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('Store.description') }} </label>
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
                      <label class="form-control-label" for="input-username">    {{ trans('Store.Datecreated') }}  </label>
                      <h6 class="text-primary">{{$vom->date}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('Store.Unit') }} </label>
                      <h6 class="text-primary">{{$vom->Unit->nameAr ??''}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('Store.Entrytype') }} </label>
                      <h6 class="text-primary"> @if ($vom->kind ==1)   {{ trans('Store.Draft') }}  @else      {{ trans('Store.certified') }}   @endif</h6>
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
                                <th>  {{ trans('Store.ProductName') }} </th>
                                <th>   {{ trans('Store.Unit') }}</th>
                                <th>  {{ trans('Store.Quantity') }}</th>
                                <th> {{ trans('Store.Weightedaverage') }}  </th>
                                <th>  {{ trans('Store.Total') }} </th>
                                <?php $rt=0;  $sum=0;?>
                            </tr>
                        </thead>
                        <tbody>

                              @if (count( $vom->Manufacturdetials) > 0)
                                  @foreach ( $vom->Manufacturdetials as $index => $details)
                                  <tr>
                                      <td>{{$index+1}}</td>
                                      <td>{{$details->product->nameAr}}</td>
                                      <td>{{$details->Unit->nameAr ?? ''}}</td>
                                      <td>{{$details->Quantity}}  <?php $rt+=$details->Quantity; ?></td>
                                      <td>{{$details->coststore }}</td>
                                      <td>{{$details->QuantityTotal}}</td>
                                  </tr>
                                  @endforeach
                              @endif
                              <tr>
                                <th>#</th>
                                <th>  {{ trans('Store.Total') }} </th>
                                <th>  </th>
                                <th> <?php echo $rt ;?></th>
                                <th>  </th>
                                <th> {{$vom->totalcost}}  </th>

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
