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
          <li class="breadcrumb-item"><a href="#">ربط بوابة الدفع</a></li>
          <li class="breadcrumb-item active">تأكيد النفاذ</li>
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
                <h3 class="card-title">تأكيد نفاذ</h3>
              </div>
              <div class="card-body">
                <form class="user" action="{{ route('payment.storeNafath') }}" enctype = "multipart/form-data">
                 
                  <div class="pl-lg-4">
                    <div class="row">
                      
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="form-control-label" for="otp">ادخل الرمز التالي على تطبيق نفاذ الخاص بك</label>
                          <h1>
                            {{session('nafathRandomNumber')}}
                          </h1>
                          @error('otp')
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
                          <input type="checkbox" name="approve" required>&nbsp;
                          تم تأكيد نفاذ
                          <br><br><br>
                          <button type="submit" class="btn btn-primary" style="width: 100%">التالي</button>
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
