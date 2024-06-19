@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sandat.Treasury') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sandat.Treasurysandbanks') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sandat.Treasury') }} </li>
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
                <h3 class="card-title">    {{ trans('Sandat.EditTreasury') }}   </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('Treasury.update' ,$Treasury->id) }}" enctype = "multipart/form-data">
                  @csrf
                  <input type="hidden" value="{{$Treasury->AccountCode}}" name="AccountID" >
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">    {{ trans('Sandat.Fundname') }}  :   <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span> </label>
                          <input type="text"  class="form-control @error('nameTreasury') is-invalid @enderror" value="{{$Treasury->name}}" id="nameTreasury" name="nameTreasury" placeholder=" اسم الصندوق ">
                          @error('nameTreasury')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">      {{ trans('Sandat.Branch') }} :   <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span> </label>

                          <select class="form-control @error('branchID') is-invalid @enderror" id="branchID" name="branchID" >
                             @foreach ($branch->branches as $key =>  $item)
                                @if ($item->id ==$Treasury->branchID)
                                    <option selected value="{{$item->id}}" > @if(LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{ $item->nameAr}} @else {{ $item->nameEn}} @endif </option>
                                @else
                                   <option value="{{$item->id}}" >{{ $item->nameAr}}</option>
                                @endif

                             @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Sandat.Status') }}   </label>
                            <div class="form-check">
                              <input id="credit" name="status" value="0" type="radio" class="form-check-input" checked="" required="">
                              <label class="form-check-label" for="credit">  {{ trans('Sandat.Active') }}</label>
                            </div>
                            <div class="form-check">
                              <input id="debit" name="status" value="1" type="radio" class="form-check-input" required="">
                              <label class="form-check-label" for="debit">  {{ trans('Sandat.NoActive') }} </label>
                            </div>
                        </div>
                      </div>


                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">    {{ trans('Sandat.description') }} :</label>
                          <textarea  class="form-control @error('desc') is-invalid @enderror" id="amount" name="desc" placeholder="  وصف الحساب  " rows="3" cols="3">{{$Treasury->desc}}</textarea>
                          @error('desc')
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
                          <input type="submit" class="btn btn-primary" value="  {{ trans('Sandat.save') }}" style="width: 100%">
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
