@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Company.Branches') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Company.Establishmentdata') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Company.Branches') }} </li>
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
                <h3 class="card-title">  {{ trans('Company.editbranches') }}</h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('branches.update',$branch->id) }}" enctype = "multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Company.BranchnameArabic') }} : <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span></label>
                          <input type="text"  class="form-control @error('nameAr') is-invalid @enderror" id="nameAr" name="nameAr" placeholder=" {{ trans('Company.BranchnameArabic') }} " value="{{$branch->nameAr}}">
                          @error('nameAr')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Company.BranchnameArabic') }}</label>
                          <input type="text"  class="form-control @error('nameEn') is-invalid @enderror" id="nameEn"  onkeypress="return ValidateKey();" name="nameEn" placeholder=" {{ trans('Company.BranchnameArabic') }}" value="{{$branch->nameEn}}">
                          @error('nameEn')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Company.Mobilenumber') }} : <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span></label>
                          <input type="phone" pattern="[0-9]{10}" maxlength="10" oninvalid="this.setCustomValidity(' {{ trans('Company.InterMobilenumber') }} ')"
                                      oninput="this.setCustomValidity('')" minlength="10"  class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="  {{ trans('Company.Mobilenumber') }}" value="{{$branch->phone}}">
                          @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Company.Region') }}</label>
                          <input type="text" class="form-control @error('area') is-invalid @enderror" id="area" name="area" placeholder=" {{ trans('Company.Region') }}" value="{{$branch->area}}">
                          @error('area')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Company.City') }} </label>
                          <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder=" {{ trans('Company.City') }}" value="{{$branch->city}}">
                          @error('city')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Company.District') }}</label>
                          <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" name="district" placeholder=" {{ trans('Company.District') }}" value="{{$branch->district}}">
                          @error('district')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Company.theaddress') }}</label>
                          <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder=" {{ trans('Company.theaddress') }}" value="{{$branch->addressAr}}">
                          @error('address')
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
                          <input type="submit" class="btn btn-primary" value="{{ trans('Company.save') }}" style="width: 100%">
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
  function availableT() {
    if(document.getElementById('availableTime').checked == true){
      document.getElementById('sfrom').style.display = "block";
      document.getElementById('sto').style.display = "block";
    }else{
      document.getElementById('sfrom').style.display = "none";
      document.getElementById('sto').style.display = "none";
    }
  }
</script>
