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
        .btn-primary
        {
            background:{{session('orgsetting')->storecolor}};
            color:{{session('orgsetting')->fontcolor}};
        }
        /*{{session('orgsetting')->backPhoto}}*/
        
    </style>
</head>

<body class="hold-transition login-page" style="direction: rtl;font-family:boutros;background: url('{{asset('public/dist/img/onlinestore/'.session('orgsetting')->backPhoto)}}') no-repeat; background-position: center;background-attachment: fixed; background-size: cover !important;"">
    <div class="login-box">

        @if (session('success'))
            <div class="alert alert-success" id="message">
                {{ session('success') }}
            </div>
        @endif

        <!-- /.login-logo -->
        <div class="card card-outline card-primary" style="border-top-color:{{session('orgsetting')->storecolor}};">

            <div class="card-body">







                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <a type="submit" href="{{ route('PayNow') }}" class="btn btn-primary btn-block"> الدفع الان
                        </a>
                    </div>
                    <!-- /.col -->
                </div>

                <!-- /.social-auth-links -->
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <a href="{{ route('public.index', $orgID) }}" class="btn btn-primary btn-block mt-2 "> القائمة
                        </a>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <a href="{{ route('callnadel') }}" class="btn btn-primary btn-block mt-2 "> طلب النادل </a>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <a href="{{ route('Shop.login', $orgID) }}" class="btn btn-primary btn-block mt-2 ">  تسجيل الدخول  </a>
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
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
