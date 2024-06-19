<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>evix | التسجيل</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition register-page" style="direction: rtl;font-family:boutros">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="#" class="h1"><img src="{{asset('dist/img/logo.png')}}" style="width: 100%"></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">بيانات المنشأة</p>

      <form action="{{route('organizationUpdate',auth()->user()->orgID)}}" method="post" enctype = "multipart/form-data">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nameAr" placeholder="اسم المنشأة - عربي" value="{{auth()->user()->organization->nameAr}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-bookmark"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control"  onkeypress="return ValidateKey();" name="nameEn" placeholder="اسم المنشأة - انجليزي">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-language"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="number" class="form-control" name="vatNo" placeholder="الرقم الضريبي">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-qrcode"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <input type="number" class="form-control" name="CR" placeholder="السجل التجاري">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-id-card"></span>
              </div>
            </div>
        </div>
        <div class="input-group mb-3">
          <input type="file" class="form-control" name="img">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-image"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">حفظ</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>
