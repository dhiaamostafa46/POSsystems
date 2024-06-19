<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>evix | التسجيل</title>

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
        #show_data {
            display: none;

        }
    </style>
</head>



<body class="hold-transition register-page"
    style="direction: rtl;font-family:boutros; background: url('{{ asset('dist/img/ww.jpeg') }}') no-repeat; background-position: center;background-attachment: fixed; background-size: cover !important;">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><img src="{{ asset('dist/img/logo.png') }}" style="width: 100%"></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">التسجيل / Register </p>

                <form action="{{ route('organizationStore') }}" method="post">
                    @csrf

                    <div class=" row ">
                        <div class="col-12 mb-3 input-group">
                            <input type="text" class="form-control  @error('nameAr') is-invalid @enderror "
                                name="nameAr" placeholder="اسم المنشأة /Name Company">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-building"></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            @error('nameAr')
                                <span style="color: red;">{{ $message }}</span><br>
                            @enderror

                        </div>

                    </div>


                    <div class="row">
                        <div class="col-12 mb-3 input-group">
                            <select class="form-control  @error('nameAr') is-invalid @enderror" id="select" name="type">
                                <option value="">اختر نوع النشاط/Activity Type </option>>
                                <option value="1">مراكز تجارية</option>
                                <option value="2">مطاعم</option>
                                <option value="3">منشأة غير ربحية</option>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-building"></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            @error('type')
                                <span style="color: red;">{{ $message }}</span><br>
                            @enderror
                        </div>

                    </div>

                    <div class="input-group mb-3" id="show_data">
                        <input type="number" class="form-control" name="opening_balance"
                            placeholder="الرصيد الافتتاحي ">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="اسم المستخدم">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div> --}}
                    <div class="row">
                        <div class="col-12 input-group mb-3">
                            <input type="phone" pattern="[0-9]{10}" minlength="10" maxlength="10"
                                oninvalid="this.setCustomValidity('ادخل رقم جوال حقيقي')"
                                oninput="this.setCustomValidity('')"
                                class="form-control  @error('phone') is-invalid @enderror" name="phone"
                                placeholder="رقم الهاتف / Phone (05XXXXXXXX)" onchange="chkPhone">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            @error('phone')
                                <span style="color: red;">{{ $message }}</span><br>
                            @enderror
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">

                                <label for="agreeTerms">

                                    لديك رمز نرويجي؟
                                </label>

                                <input type="checkbox" class="form-check-input" id="inviteCode" name="inviteCode"
                                    value="yes" onclick="showcode()">
                            </div>
                        </div>

                    </div>
                    <div class="input-group mb-3" id="incodediv" style="display: none">
                        <input type="text" class="form-control" name="incode" onleave="alert('test')" id="incode"
                            disabled>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12 input-group mb-3">
                            <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                name="email" oninvalid="this.setCustomValidity('الايميل غير صحيح')"
                                placeholder="البريد الالكتروني / Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            @error('email')
                                <span style="color: red;">{{ $message }}</span><br>
                            @enderror
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-12 input-group mb-3">
                            <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                name="password" placeholder="كلمة المرور /Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            @error('password')
                                <span style="color: red;">{{ $message }}</span><br>
                            @enderror

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
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                                <label for="agreeTerms">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    اوافق على <a href="{{ route('Condition') }}">الشروط</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">تسجيل</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="{{ route('login') }}" class="text-center">لديك حساب؟</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script>
        const el = document.getElementById('select');
        const box = document.getElementById('show_data');
        el.addEventListener('change', function handleChange(event) {
            if (event.target.value === '3') {
                box.style.display = 'flex';
            } else {
                box.style.display = 'none';
            }
        });

        function showcode() {

            if (document.getElementById('inviteCode').checked == true) {
                document.getElementById('incode').disabled = false;
                document.getElementById('incode').value = "";
                document.getElementById('incode').required = true;

                $('#incodediv').show();
            } else {
                document.getElementById('incode').disabled = true;
                document.getElementById('incode').value = "";
                document.getElementById('incode').required = false;
                $('#incodediv').hide();
            }

        }
    </script>
</body>

</html>
