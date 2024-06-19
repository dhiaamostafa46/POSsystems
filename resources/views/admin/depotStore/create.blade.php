@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Store.Warehouses') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Store.Warehouses') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Store.AddWarehouses') }} </li>
          </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<!-- /.content-header -->
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">  {{ trans('Store.AddWarehouses') }} </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('depotStore.store') }}" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Store.Warehousesname') }}</label>
                          <input type="text"  class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="  {{ trans('Store.Warehousesname') }} ">
                          @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Store.Warehousestatus') }} </label>
                          <select class="form-control @error('status') is-invalid @enderror" id="amount" required name="status" placeholder=" {{ trans('Store.Warehousestatus') }} ">
                            <option value="1" >  {{ trans('Store.Active') }} </option>
                            <option value="0" >   {{ trans('Store.NoActive') }} </option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Store.branch') }} </label>
                          <select class="form-control @error('branchID') is-invalid @enderror"  required id="branchID" name="branchID" >
                             @foreach ($branch->branches as $key =>  $item)
                              <option value="{{$item->id}}" >{{ $item->nameAr}}</option>
                             @endforeach
                          </select>
                        </div>
                      </div>




                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <input type="submit" class="btn btn-primary" value=" {{ trans('Store.save') }}" style="width: 100%">
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
