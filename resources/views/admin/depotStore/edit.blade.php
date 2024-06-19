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
            <li class="breadcrumb-item active"> {{ trans('Store.EditWarehouses') }} </li>
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
                <h3 class="card-title">  {{ trans('Store.EditWarehouses') }} </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('depotStore.update' ,$DepotStore->id) }}" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('Store.Warehousesname') }} </label>
                          <input type="text"  class="form-control @error('name') is-invalid @enderror" value="{{$DepotStore->name}}" id="name" name="name" placeholder="  {{ trans('Store.Warehousesname') }} ">
                          @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">    {{ trans('Store.Warehousestatus') }} </label>
                          <select class="form-control @error('status') is-invalid @enderror" id="amount" value="{{$DepotStore->status}}" name="status" placeholder="  {{ trans('Store.Warehousestatus') }}">
                            @if ($DepotStore->status ==0)
                                <option  value="1" >  {{ trans('Store.Active') }} </option>
                                <option selected value="0" >   {{ trans('Store.NoActive') }}</option>
                            @else
                                <option selected value="1" >  {{ trans('Store.Active') }} </option>
                                <option value="0" >   {{ trans('Store.NoActive') }}</option>
                            @endif

                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Store.Branch') }}</label>
                          <select class="form-control @error('branchID') is-invalid @enderror" id="branchID" name="branchID" >
                            <option value="false" style="display:none"></option>
                             @foreach ($branch->branches as $key =>  $item)
                               @if ($item->id == $DepotStore->branchID)
                                 <option selected value="{{$item->id}}" >{{ $item->nameAr}}</option>
                               @else
                                 <option value="{{$item->id}}" >{{ $item->nameAr}}</option>
                               @endif

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
