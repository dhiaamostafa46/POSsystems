@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">بيانات المنشأة</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">ربط بوابة الدف</a></li>
          <li class="breadcrumb-item active">بيانات المنشأة</li>
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
                <h3 class="card-title">ادخل بيانات المنشأة</h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('payment.storeBasic') }}" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="registrationType">نوع الوثيقة</label>
                          <select class="form-control @error('registrationType') is-invalid @enderror" id="registrationType" name="registrationType">
                            <option value="">اختر نوع الوثيقة</option>
                            <option value="cr" @if(session('registrationType') == "cr") selected @endif>سجل تجاري</option>
                            <option value="freelancer" @if(session('registrationType') == "freelancer") selected @endif>وثيقة عمل حر</option>
                          </select>
                          @error('registrationType')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="licenseNumber">رقم الوثيقة/السجل التجاري</label>
                          <input type="number" class="form-control @error('licenseNumber') is-invalid @enderror" id="licenseNumber" name="licenseNumber" placeholder="اكتب رقم الوثيقة او السجل" value="{{session('licenseNumber')}}">
                          @error('licenseNumber')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="mobileNumber">رقم الجوال</label>
                          <input type="phone" pattern="[0-9]{10}" maxlength="10" oninvalid="this.setCustomValidity('ادخل رقم جوال حقيقي')"
            oninput="this.setCustomValidity('')" minlength="10"  class="form-control @error('mobileNumber') is-invalid @enderror" id="mobileNumber" name="mobileNumber" placeholder="ادخل رقم الجوال" value="{{session('mobileNumber')}}">
                          @error('mobileNumber')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">تاريخ بداية الشركة</label>
                          <div class="row">
                            <div class="col-4">
                              <input type="number" class="form-control @error('hijriDay') is-invalid @enderror" id="hijriDay" name="hijriDay" placeholder="اليوم (هجري)" value="{{session('hijriDay')}}">
                            </div>
                            <div class="col-4">
                              <input type="number" class="form-control @error('hijriMonth') is-invalid @enderror" id="hijriMonth" name="hijriMonth" placeholder="الشهر (هجري)" value="{{session('hijriMonth')}}">
                            </div>
                            <div class="col-4">
                              <input type="number" class="form-control @error('hijriYear') is-invalid @enderror" id="hijriYear" name="hijriYear" placeholder="السنة (هجري)" value="{{session('hijriYear')}}">
                            </div>
                          </div>
                          @error('hijriDay')
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
                          <input type="submit" class="btn btn-primary" value="التالي" style="width: 100%">
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
@endsection
