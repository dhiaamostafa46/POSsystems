@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('HR.permanences') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
            <li class="breadcrumb-item active"> {{ trans('HR.permanences') }}</li>
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
                <h3 class="card-title"> {{ trans('HR.newpermanence') }} </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('attendance.storeShift') }}" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('HR.NameArabic') }} <span class="requiredData">*</span></label>
                          <input type="text"  class="form-control @error('nameAr') is-invalid @enderror" id="nameAr" name="nameAr" placeholder="{{ trans('HR.NameArabic') }}" required>
                          @error('nameAr')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('HR.NameEnglish') }} <span class="requiredData">*</span></label>
                          <input type="text"  class="form-control @error('nameEn') is-invalid @enderror" id="nameEn"  onkeypress="return ValidateKey();" name="nameEn" placeholder="{{ trans('HR.NameEnglish') }}" required>
                          @error('nameEn')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-username"> {{ trans('HR.Permanenttype') }}    <span class="requiredData">*</span> </label>
                                <div class="form-check">
                                <input id="TypeProdect"  name="type" value="1" type="radio" onclick="showTime()" class="form-check-input" >
                                <label class="form-check-label" for="credit">   {{ trans('HR.constant') }}</label>
                                </div>
                                <div class="form-check">
                                <input id="TypeProdect" name="type" value="2" type="radio"  onclick="hideTime()" class="form-check-input" >
                                <label class="form-check-label" for="debit">   {{ trans('HR.flexible') }} </label>
                            </div>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('HR.numberofhours') }} <span class="requiredData">*</span></label>
                          <input type="text"  class="form-control @error('hours') is-invalid @enderror" id="hours" name="hours" placeholder="{{ trans('HR.numberofhours') }}" required>
                          @error('hours')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6" id="stTime" style="display: none">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('HR.Fromhour') }}</label>
                          <input type="time"  class="form-control text-right @error('stTime') is-invalid @enderror" id="stTime" name="stTime" placeholder="{{ trans('HR.Fromhour') }}">
                          @error('stTime')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6" id="enTime" style="display: none">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('HR.tohour') }} </label>
                          <input type="time"  class="form-control text-right @error('enTime') is-invalid @enderror" id="enTime" name="enTime" placeholder=" {{ trans('HR.tohour') }} ">
                          @error('enTime')
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
                          <input type="submit" class="btn btn-primary" value=" {{ trans('HR.Save') }} " style="width: 100%">
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

<script>
  function showTime() {

      document.getElementById('stTime').style.display = "block";
      document.getElementById('enTime').style.display = "block";


  }
  function hideTime() {

      document.getElementById('stTime').style.display = "none";
      document.getElementById('enTime').style.display = "none";

  }
</script>
