<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>evix | الدخول</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <style>
  input:focus::placeholder {
    color: transparent !important;
    }
  </style>
</head>
<body class="hold-transition login-page" style="direction: rtl;font-family:boutros">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><img src="{{asset('dist/img/logo.png')}}" style="width: 100%"></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"> تسجيل الدخول المندوب </p>

      <form action="{{route('Shopauth')}}" method="post">
        @csrf
        <input type="hidden" value="{{$orgID}}" name="orgID">
        @if (session('subscribtionStatus')==3)
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             {{session('subscribtionMsg')}} <a href="https://wa.me/966538444938" class="alert-link">راسلنا للتجديد</a>
        </div>
        @endif
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="example@test.com" value="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" value="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
         <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">دخول</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
      <div class="row">
        <!-- /.col -->
         <div class="col-12">
           <a href="{{route('Shop.Register',$orgID)}}" class="btn btn-primary btn-block mt-2 ">  سجل معنا  </a>
         </div>
         <!-- /.col -->
       </div>



    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>
