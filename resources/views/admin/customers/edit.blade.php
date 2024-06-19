@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sale.Customer') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sale.sales') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sale.Customer') }} </li>
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
                <h3 class="card-title">  {{ trans('Sale.CustomerChooseNew') }}</h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('customers.update',$customer->id) }}" enctype = "multipart/form-data">
                  @csrf

                  @method('PUT')
                  <input type="hidden" value="{{$customer->AccountID}}" name="AccountID" >
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Sale.customername') }} </label>
                          <input type="text"  class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder=" {{ trans('Sale.customername') }}  " value="{{$customer->name}}">
                          @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Sale.Mobilenumber') }} </label>
                          <input type="phone" pattern="[0-9]{10}" maxlength="10" oninvalid="this.setCustomValidity('{{ trans('Sale.InterMobilenumber') }}')"
            oninput="this.setCustomValidity('')" minlength="10"  class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="   {{ trans('Sale.Mobilenumber') }}" value="{{$customer->phone}}">
                          @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Sale.Email') }}</label>
                          <input type="text"  class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder=" {{ trans('Sale.Email') }}" value="{{$customer->email}}">
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Sale.Region') }}</label>
                          <input type="text" class="form-control @error('area') is-invalid @enderror" id="area" name="area" placeholder="{{ trans('Sale.Region') }} " value="{{$customer->area}}">
                          @error('area')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Sale.City') }}</label>
                          <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder=" {{ trans('Sale.City') }}" value="{{$customer->city}}">
                          @error('city')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Sale.District') }}</label>
                          <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" name="district" placeholder=" {{ trans('Sale.District') }}" value="{{$customer->district}}">
                          @error('district')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Sale.address') }}</label>
                          <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="{{ trans('Sale.address') }} " value="{{$customer->address}}">
                          @error('address')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Sale.TaxNumber') }} </label>
                          <input type="number" class="form-control @error('vatNo') is-invalid @enderror" id="vatNo" name="vatNo" placeholder="  {{ trans('Sale.TaxNumber') }} " value="{{$customer->vatNo}}">
                          @error('vatNo')
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
                          <input type="submit" class="btn btn-primary" value=" {{ trans('Sale.save') }}" style="width: 100%">
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
