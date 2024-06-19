<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>evix | الدخول</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <style>
        input:focus::placeholder {
            color: transparent !important;
        }
    </style>
</head>

<body class="hold-transition login-page" style="direction: rtl;font-family:boutros">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><img src="{{ asset('dist/img/logo.png') }}" style="width: 100%"></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">التسجيل / Register </p>

                <form action="{{ route('ShopRegister') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{$orgID}}" name="orgID">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nameAr" placeholder="اسم المستخدم">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-building"></span>
                            </div>
                        </div>
                    </div>



                    <div class="input-group mb-3">
                        <input type="phone" pattern="[0-9]{10}" minlength="10" maxlength="10"
                            oninvalid="this.setCustomValidity('ادخل رقم جوال حقيقي')"
                            oninput="this.setCustomValidity('')" class="form-control" name="phone"
                            placeholder="رقم الهاتف / Phone (05XXXXXXXX)" onchange="chkPhone">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>



                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email"
                            oninvalid="this.setCustomValidity('الايميل غير صحيح')"
                            placeholder="البريد الالكتروني / Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="كلمة المرور /Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="اعادة كلمة المرور /Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">تسجيل</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <div class="row">

                    <div class="col-12">

                        <a href="{{ route('Shop.login',$orgID) }}"  class="btn btn-primary btn-block mt-2">  لدي حساب مسبقا  </a>

                    </div>
                    <!-- /.col -->
                </div>

            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
