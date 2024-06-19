<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>evix | إيفكس</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('assets/img/EVIX ICON SVG.svg') }}" rel="icon">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->

    <link rel="stylesheet" src="{{ asset('plugins/select2/css/select2.min.css') }}">
    </link>
    <link rel="stylesheet" src="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    </link>

    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('dist/css/adminlteEn.css') }}">
    @endif

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


    @include('layouts.Style')


</head>

<body class="hold-transition sidebar-mini layout-fixed" style="font-family: boutros;"
    dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
    <div class="wrapper">



        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light  no-print">
            <!-- right navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"
                            style="color: #35d5b6 ;     font-size: 20px;"></i></a>
                </li>
            </ul>

            <!-- left navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search" style="color: #35d5b6 ;     font-size: 20px;"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search" style="color: #35d5b6 ;     font-size: 20px;"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times" style="color: #35d5b6 ;     font-size: 20px;"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-globe" style="color: #35d5b6 ;     font-size: 20px;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a rel="alternate" class="dropdown-item" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                                <!-- Message Start -->
                                <div class="media">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            {{ $properties['native'] }}

                                            &nbsp;&nbsp;&nbsp;
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach

                    </div>
                </li>
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src="{{ asset('dist/img/users/' . auth()->user()->img) }}" alt="User Avatar"
                            class="mr-3 img-circle" style="width: 20px">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title" onclick="handlePassword();">
                                        <span class="float-right text-sm text-muted"><i
                                                class="fas fa-user"></i></span>
                                        &nbsp;&nbsp;&nbsp;
                                        {{ trans('admin.Changepassword') }}
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" onclick="handleLogout()">
                            <!-- Message Start -->
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        <span class="float-right text-sm text-muted"><i
                                                class="fa fa-power-off"></i></span>
                                        &nbsp;&nbsp;&nbsp;
                                        {{ trans('admin.Exit') }}
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                    </div>
                </li>
                <!-- Messages Dropdown Menu -->
                <!--
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
          <a href="#" class="dropdown-item">-->
                <!-- Message Start -->
                <!--
            <div class="media">
              <img src="{{ asset('dist/img/users/' . auth()->user()->img) }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-left text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
             -->
                <!-- Message End -->
                <!--
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item"> -->
                <!-- Message Start -->
                <!--
            <div class="media">
              <img src="{{ asset('dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-left text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> -->
                <!-- Message End -->
                <!--
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item"> -->
                <!-- Message Start -->
                <!--
            <div class="media">
              <img src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-left text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> -->
                <!-- Message End -->
                <!--
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
       -->
                <!-- Notifications Dropdown Menu -->
                <!--
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
          <span class="dropdown-item dropdown-header">15 اشعار</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 رسائل جديدة
            <span class="float-left text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 فواتير غير مسددة
            <span class="float-left text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 منتجات على وشك النفاد
            <span class="float-left text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">عرض كل الاشعارات</a>
        </div>
      </li>
       -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt" style="color: #35d5b6 ;     font-size: 20px;"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->

        @include('layouts.aside')







        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            @if (session('subscribtionStatus') == 3)
                <div class="alert alert-danger alert-dismissible no-print">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('subscribtionMsg') }}
                </div>
            @elseif (session('subscribtionStatus') == 2)
                <div class="alert alert-warning alert-dismissible no-print">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('subscribtionMsg') }}
                </div>
            @endif

            @if (empty(auth()->user()->organization->CR) || empty(auth()->user()->organization->vatNo))
                <div class="alert alert-danger alert-dismissible no-print">
                    <a href="#" class="close " data-dismiss="alert" aria-label="close">&times; </a>
                    عزيزي العميل لم يتم إكمال بيانات المنشاة
                    <a type="button" href="{{ route('organizations.edit', auth()->user()->orgID) }}"
                        class="btn btn-light" style="color: black"> إكمال </a>
                </div>
            @endif



            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Password Modal -->
        <div class="modal fade modal" id="passwordModel" tabindex="-1" role="dialog"
            aria-labelledby="passwordModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">تحديث كلمة المرور</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-left:0px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="col-12 row mt-3">
                        <div class="col-12">
                            <form class="user" id="passwordForm" method="POST"
                                action="{{ route('users.password') }}" enctype = "multipart/form-data">
                                @csrf
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password" placeholder="كلمة المرور الجديدة">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary" value="حفظ"
                                                    style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <hr class="my-4" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Password Modal -->

    <div class="modal fade modal" id="linkModel" tabindex="-1" role="dialog" aria-labelledby="linkModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">
                        {{ trans('permissions.Facilitylink') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="margin-left:0px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-12 row mt-3">
                    <div class="col-12">
                        <form class="user" id="linkForm" method="POST" action="#"
                            enctype = "multipart/form-data">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('link') is-invalid @enderror"
                                                id="link" name="link"
                                                placeholder="{{ trans('permissions.Facilitylink') }}">
                                            @error('link')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="button" onclick="copyFunction()" data-dismiss="modal"
                                                class="btn btn-primary" value="{{ trans('permissions.Copy') }}"
                                                style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <hr class="my-4" />
                    </form>
                </div>
            </div>
        </div>
    </div>


    <footer class="main-footer no-print">
        <strong>Copyleft &copy; {{ date('Y') }} <a href="#">eyein code</a>.</strong>
        All lefts reserved.
        <div class="float-left d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
    </div>
    <audio style="display: none" controls id="myAudio">
        <source src="{{ asset('public/sound/1.mp3') }}" type="audio/mpeg">
    </audio>
    <input type="hidden" id="success" value="{{ Session::get('success') }}">
    <input type="hidden" id="faild" value="{{ Session::get('faild') }}">
    <!-- ./wrapper -->
    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
        @csrf
    </form>



    <div style="display: none">
        <h1 id="sSearchmessage"> {{ trans('Dadhoard.sSearch') }} </h1>
        <h1 id="sInfomessage"> {{ trans('Dadhoard.sInfo') }} </h1>
        <h1 id="sLengthMenumessage"> {{ trans('Dadhoard.sLengthMenu') }} </h1>
        <h1 id="successMassage"> {{ trans('Dadhoard.success') }} </h1>
        <h1 id="faildMessage"> {{ trans('Dadhoard.faild') }} </h1>


        <h1 id="Areyousuretofinishwork"> {{ trans('Sale.Areyousuretofinishwork') }} </h1>
        <h1 id="finishSure"> {{ trans('Sale.finishSure') }} </h1>
        <h1 id="finishCancel"> {{ trans('Sale.finishCancel') }} </h1>


        <h1 id="AreyousExit"> {{ trans('admin.AreyousExit') }} </h1>
        <h1 id="confirmExit"> {{ trans('admin.confirm') }} </h1>
        <h1 id="cancelExit"> {{ trans('admin.cancel') }} </h1>

        <h1 id="titalmesssageEntertheopeningbalanceofthefund"> {{ trans('Sale.Entertheopeningbalanceofthefund') }}
        </h1>
        <h1 id="confirmButtonTextbalanceText"> {{ trans('Sale.balanceText') }} </h1>
        <h1 id="cancelButtonTextbalanceCancel"> {{ trans('Sale.balanceCancel') }} </h1>

    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>


    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

    <script>
        $(function() {

                $('#selectmultiple').select2();
             });
    </script>

    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote({
                height: 200
            })

            $('#summernotecomments').summernote({
                height: 200
            })

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"

            });
        })
    </script>
    <script>
        $(document).ready(function() {

            @if (auth()->user()->role->permissions->contains('pageID', $pages->where('code', 'WaiterPOS')->first()->id) &&
                    auth()->user()->organization->activity == 2)
                setInterval(function() {
                    $.ajax({
                        url: '/getmassagenade',
                        type: 'get',
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {

                            response.code.forEach(element => {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "رقم الطاولة   " + element.msg +
                                        "  يريد نادل   ",
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                $("#myAudio")[0].play();
                            });


                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            // Handle error
                        }
                    });

                    console.log("skkkkkkkkkkk");
                }, 5000);
            @endif



        });
    </script>
    <script>
        $(function() {

            ddd = document.getElementById('sSearchmessage').innerHTML;
            dyes = document.getElementById('sInfomessage').innerHTML;
            dno = document.getElementById('sLengthMenumessage').innerHTML;



            $("#RepotAllDataTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", {
                    extend: 'print',
                    autoPrint: false,
                    exportOptions: {
                        modifier: {
                            page: 'current'

                        }
                    }
                }, , "colvis"],
                "oLanguage": {
                    "sSearch": ddd,
                    "sInfo": dyes,
                    "sLengthMenu": dno,
                },
                lengthMenu: [
                    [50, -1],
                    [50, 'All']
                ]

            }).buttons().container().appendTo('#RepotAllDataTable_wrapper .col-md-6:eq(0)');

            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "buttons": ["copy", "excel", "print"],
                "oLanguage": {
                    "sSearch": ddd,
                    "sInfo": dyes,
                    "sLengthMenu": dno,
                }
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
            $('#example3').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": true,
                "responsive": true,
            });
        });
    </script>
    <link href="{{ asset('dist/css/dark.css') }}" rel="stylesheet">
    <script src="{{ asset('dist/css/sweetalert2.min.js') }}"></script>
    <script>
        function handleLogout() {



            AreyousExit = document.getElementById('AreyousExit').innerHTML;
            confirmExit = document.getElementById('confirmExit').innerHTML;
            cancelExit = document.getElementById('cancelExit').innerHTML;
            Swal.fire({
                title: AreyousExit,
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#f8a29e',
                confirmButtonText: confirmExit,
                cancelButtonText: cancelExit
            }).then((result) => {
                if (result.isConfirmed) {

                    document.getElementById('logout-form').submit();
                }
            })
        }

        function endDuration(id) {

            dddfinish = document.getElementById('Areyousuretofinishwork').innerHTML;
            dyesfinish = document.getElementById('finishSure').innerHTML;
            dnofinish = document.getElementById('faildMessage').innerHTML;
            Swal.fire({
                title: dddfinish,
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#f8a29e',
                confirmButtonText: dyesfinish,
                cancelButtonText: dnofinish
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/endDuration/${id}`;
                }
            })
        }


        if (document.getElementById('success').value) {
            success = document.getElementById('successMassage').innerHTML;

            Swal.fire(
                success,
                '<h6  style="color:white">' + document.getElementById('success').value + '</h6>',
                'success'
            )
            document.getElementById('success').value = "";
        }

        if (document.getElementById('faild').value) {
            faild = document.getElementById('faildMessage').innerHTML;
            Swal.fire(
                faild,
                '<h6  style="color:white">' + document.getElementById('faild').value + '</h6>',
                'error'
            )
            document.getElementById('faild').value = "";
        }
    </script>
    <script>
        function createReceive() {
            Swal.fire({
                title: 'ادخل رقم فاتورة المبيعات للعميل',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    window.location.href = `/createReceive/${login}`;
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }

        function createDeliver() {
            Swal.fire({
                title: 'ادخل رقم فاتورة المشتريات',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    window.location.href = `/createDeliver/${login}`;
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }

        function createInvoice() {
            Swal.fire({
                title: 'ادخل رقم فاتورة المشتريات',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    window.location.href = `/createInvoice/${login}`;
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }

        function handlePassword() {
            $('#passwordModel').modal('show')
        }
    </script>


    <script type="text/javascript">
        function ValidateKey() {
            var key = window.event.keyCode;
            var allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890 :;,.?!£$%^&*()_+-*{}@~<>&"\'';

            return allowed.indexOf(String.fromCharCode(key)) != -1;
        }

        function ValidateKeyArabic() {
            var key = window.event.keyCode;
            var allowed = 'ابتثجحخدذرزسشصضطظعغفقكلمنهويـًٌٍَُِّْءآأؤإئ؟؛،ـ.1234567890 :;,.?!£$%^&*()_+-*{}@~<>&"\'';

            return allowed.indexOf(String.fromCharCode(key)) != -1;
        }


        function getLink(id) {
            document.getElementById('link').value = window.location.protocol + '//' + window.location.host + '/Online/' +
                {{ auth()->user()->orgID }};

            $('#linkModel').modal('show')
        }

        function copyFunction() {
            // Get the text field
            var copyText = document.getElementById("link");
            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);
            // Alert the copied text
            alert("تم نسخ: " + copyText.value);
        }


        function startDuration() {

            ddd = document.getElementById('titalmesssageEntertheopeningbalanceofthefund').innerHTML;
            dyes = document.getElementById('confirmButtonTextbalanceText').innerHTML;
            dno = document.getElementById('cancelButtonTextbalanceCancel').innerHTML;


            $.ajax({
                url: `/DurationUser/{{ auth()->user()->id }}`,
                success: data => {
                    if (data.data == 0) {
                        Swal.fire({
                            title: ddd,
                            input: 'text',
                            inputAttributes: {
                                autocapitalize: 'off'
                            },
                            showCancelButton: true,
                            confirmButtonText: dyes,
                            cancelButtonText: dno,
                            showLoaderOnConfirm: true,
                            preConfirm: (amount) => {
                                window.location.href = `/createDuration/${amount}`;
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        })

                    } else {

                        window.location.href = `orders/create`;

                    }

                }
            });

        }







        function startNadelDuration() {
            Swal.fire({
                title: 'هل انت متأكد من بداية الوردية',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#f8a29e',
                confirmButtonText: 'نعم، تاكيد',
                cancelButtonText: 'لا، الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/createDurationNadel/";
                }
            })
        }
    </script>
</body>

</html>
