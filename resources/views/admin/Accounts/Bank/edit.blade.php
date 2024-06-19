@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sandat.Banks') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sandat.Treasurysandbanks') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sandat.Banks') }} </li>
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
                <h3 class="card-title">     {{ trans('Sandat.EditBank') }}    </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('Bank.update',$data->id) }}" enctype = "multipart/form-data">
                  @csrf
                  <input type="hidden" value="{{$data->AccountID}}" name="AccountID" >
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('Sandat.BanksName') }}    :  <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span> </label>
                          <input type="text"  class="form-control @error('nameBank') is-invalid @enderror" value="{{$data->nameBank}}" id="nameBank" name="nameBank" placeholder="   {{ trans('Sandat.BanksName') }}   ">
                          @error('nameBank')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">      {{ trans('Sandat.Bankaccountname') }} :</label>
                          <input type="text"  class="form-control @error('NameAccountBank') is-invalid @enderror" value="{{$data->NameAccountBank}}" id="NameAccountBank" name="NameAccountBank" placeholder="   {{ trans('Sandat.Bankaccountname') }} ">
                          @error('NameAccountBank')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  IBN:</label>
                          <input type="text"  class="form-control @error('IBN') is-invalid @enderror" id="IBN"value="{{$data->IBN}}" name="IBN" placeholder="   IBN ">
                          @error('IBN')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">    {{ trans('Sandat.accountnumber') }}:</label>
                          <input type="number"  class="form-control @error('NumAcounnt') is-invalid @enderror"value="{{$data->NumAcounnt}}" id="NumAcounnt" name="NumAcounnt" placeholder=" {{ trans('Sandat.accountnumber') }}">
                          @error('NumAcounnt')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">      {{ trans('Sandat.currency') }}  :  <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span> </label>

                          <select class="form-control @error('currency') is-invalid @enderror" value="{{$data->currency}}" id="currency" name="currency" >
                             @foreach (currency() as $key =>  $item)
                             <option value="{{$item}}" > {{ $item}}</option>
                             @endforeach
                          </select>
                          @error('currency')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>


                      <div class="col-lg-6" style="display: none">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">    {{ trans('Sandat.amount') }}:</label>
                          <input type="number"  class="form-control @error('amount') is-invalid @enderror" id="amount" value="{{$data->amount}}" name="amount" placeholder="   المبلغ الموجود في الحساب ">
                          @error('amount')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Sandat.Status') }}:  <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span> </label>

                          <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{$data->status}}" placeholder="حالة الحساب">
                            <option value="1" >  {{ trans('Sandat.Active') }}  </option>
                            <option value="0" >  {{ trans('Sandat.NoActive') }} </option>
                          </select>
                          @error('status')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">      {{ trans('Sandat.Branch') }} :  <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span> </label>
                          <select class="form-control @error('branchID') is-invalid @enderror" id="branchID" name="branchID" >
                             @foreach (auth()->user()->organization->branches as $key =>  $item)
                              <option @if ($data->branchID ==$item->id) selected @endif value="{{$item->id}}" > @if(LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{ $item->nameAr}} @else {{ $item->nameEn}} @endif </option>
                             @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Sandat.description') }}  :</label>
                          <textarea  class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" placeholder="{{ trans('Sandat.description') }}  " rows="3" cols="3">{{trim($data->desc)}}</textarea>
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
                          <input type="submit" class="btn btn-primary" value=" {{ trans('Sandat.save') }} " style="width: 100%">
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
