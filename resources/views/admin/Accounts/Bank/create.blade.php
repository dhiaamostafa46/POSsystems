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
                <h3 class="card-title">    {{ trans('Sandat.AddBank') }}    </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('Bank.store') }}" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Sandat.BanksName') }}    :  <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span> </label>
                          <input type="text"  class="form-control @error('nameBank') is-invalid @enderror" id="nameBank" name="nameBank" placeholder="  {{ trans('Sandat.BanksName') }} ">
                          @error('nameBank')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">    {{ trans('Sandat.Bankaccountname') }}  :</label>
                          <input type="text"  class="form-control @error('NameAccountBank') is-invalid @enderror" id="NameAccountBank" name="NameAccountBank" placeholder="   {{ trans('Sandat.Bankaccountname') }} ">
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
                          <div class="input-group mb-3">

                            <input type="number" class="form-control @error('IBN') is-invalid @enderror" id="IBN" name="IBN" placeholder="IBN ">
                            <span class="input-group-text" id="basic-addon1">SA</span>
                          </div>
                          @error('IBN')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Sandat.accountnumber') }} :</label>
                          <input type="number"  class="form-control @error('NumAcounnt') is-invalid @enderror" id="IBN" name="NumAcounnt" placeholder="  {{ trans('Sandat.accountnumber') }}">
                          @error('NumAcounnt')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">      {{ trans('Sandat.currency') }} :  <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span> </label>
                          {{-- <input type="text"  class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency" placeholder=" اسم حساب الدليل "> --}}
                          <select class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency" >
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
                          <label class="form-control-label" for="input-username">    {{ trans('Sandat.amount') }} :  </label>
                          <input type="number"  class="form-control @error('amount') is-invalid @enderror" value="0" id="amount" name="amount" placeholder=" {{ trans('Sandat.amount') }}">
                          @error('amount')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Sandat.Status') }}: <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span> </label>

                          <select class="form-control @error('status') is-invalid @enderror" id="amount" name="status" placeholder="حالة الحساب">
                            <option value="1" >  {{ trans('Sandat.Active') }}  </option>
                            <option value="0" >   {{ trans('Sandat.NoActive') }} </option>
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
                              <option value="{{$item->id}}" >   @if(LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{ $item->nameAr}} @else {{ $item->nameEn}} @endif </option>
                             @endforeach
                          </select>
                        </div>
                      </div>



                      {{-- <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   الارصدة الافتتاحية :</label>
                          <input type="number"  class="form-control @error('balance') is-invalid @enderror" id="balance" name="balance" placeholder="الارصدة الافتتاحية">
                          @error('balance')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div> --}}
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Sandat.description') }} :</label>
                          <textarea  class="form-control @error('desc') is-invalid @enderror" id="amount" name="desc" placeholder="    {{ trans('Sandat.description') }}  " rows="3" cols="3"></textarea>
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
                          <input type="submit" class="btn btn-primary" value="{{ trans('Sandat.save') }} " style="width: 100%">
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
