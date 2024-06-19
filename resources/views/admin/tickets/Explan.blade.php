@extends('layouts.dashboard')

@section('content')
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('tree/src/css/filetree.css') }}" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('tree/src/js/filetree.js') }}"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> شروحات النظام </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">  شروحات </a></li>
                        <li class="breadcrumb-item active"> شروحات النظام  </li>
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
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="filetree row" dir="rtl">
                                <div class="col-lg-6">
                                    <ul class="main-tree">
                                        <li class="tree-title">  إدارة العمليات </li>
                                        <ul class="tree" style="display: none;">
                                            <li class="tree-title"> البيانات الاساسية </li>
                                            <li class="tree-item">  <a target="_blank" href="{{asset('public/Expan/إضافة منتج.pdf')}}">  إضافة منتج   </a>  </li>
                                            <li class="tree-item">  <a target="_blank" href="{{asset('public/Expan/قائمة الطاولات.pptx.pdf')}}">   قائمة الطاولات   </a>  </li>
                                            <li class="tree-item">   <a target="_blank" href="{{asset('public/Expan/طلبات السيارات.pptx.pdf')}}"> طلبات السيارات  </a>  </li>
                                            <li class="tree-item"> <a target="_blank" href="{{asset('public/Expan/المقادير (الريسبي).pdf')}}"> المقادير (الريسبي)      </a>
                                        </ul>
                                        {{-- <ul class="tree" style="display: none;">
                                            <li class="tree-title">disneyland</li>
                                            <li class="tree-item">3-2015-02-01.jpg</li>
                                            <li class="tree-item">7-2015-02-02.jpg</li>
                                            <li class="tree-item">8-2015-02-03.jpg</li>
                                            <ul class="tree" style="display: none;">
                                                <li class="tree-title">birthday party</li>
                                                <li class="tree-item">4-2015-02-01.jpg</li>
                                                <li class="tree-item">5-2015-02-01.jpg</li>
                                                <li class="tree-item">6-2015-02-01.jpg</li>
                                            </ul>
                                        </ul> --}}
                                    </ul>

                                </div>



                                <!-- End of Tree 1 -->
                                <div class="col-lg-6">
                                    <ul class="main-tree">
                                        <li class="tree-title"> الموارد البشرية </li>
                                        {{-- <ul class="tree" style="display: none;">
                                            <li class="tree-title">nearby</li>
                                            <ul class="tree" style="display: none;">
                                                <li class="tree-title">css</li>
                                                <li class="tree-item">animations.js</li>
                                                <li class="tree-item">google-maps.js</li>
                                                <li class="tree-item">main.js</li>
                                                <li class="tree-item">mobile.js</li>
                                            </ul>
                                            <ul class="tree" style="display: none;">
                                                <li class="tree-title">js</li>
                                                <li class="tree-item">google-maps.js</li>
                                                <li class="tree-item">main.js</li>
                                            </ul>
                                            <ul class="tree" style="display: none;">
                                                <li class="tree-title">resources</li>
                                                <li class="tree-item">favicon.ico</li>
                                            </ul>
                                            <li class="tree-item">index.html</li>
                                            <li class="tree-item">README.md</li>
                                        </ul> --}}
                                    </ul>
                                    <!-- End of Tree 2 -->

                                    <!-- Tree 3 -->


                                </div>
                                <div class="col-lg-6">
                                    <ul class="main-tree">
                                        <li class="tree-title">  المتجر الالكتروني والهوية البصرية</li>
                                        <li class="tree-item"> <a target="_blank" href="{{asset('public/Expan/البنر الاعلاني.pdf')}}"> البنر الاعلاني  </a> </li>
                                        <li class="tree-item"> <a target="_blank" href="{{asset('public/Expan/الهوية البصرية .pdf')}}">  الهوية البصرية   </a> </li>

                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="main-tree">
                                        <li class="tree-title">  الاعدادات </li>
                                        <li class="tree-item"> <a target="_blank" href="{{asset("public/Expan/تسجيل الد.pptx.pdf")}}">  تسجيل حساب   </a> </li>
                                        <li class="tree-item"> <a target="_blank" href="{{asset("public/Expan/ربط وتفعيل الدفع الالكتروني.pdf")}}">  ربط وتفعيل الدفع الالكتروني   </a> </li>
                                        <li class="tree-item"> <a target="_blank" href="{{asset('public/Expan/حسابات التواصل الأجتماعي.pdf')}}">   حسابات التواصل الاجتماعي  </a> </li>
                                         <li class="tree-item"> <a target="_blank" href="{{asset('public/Expan/الوان المنيو.pdf')}}"> ألوان المنيو     </a> </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="main-tree">
                                        <li class="tree-title"> المستخدمين والصلاحيات </li>
                                        <li class="tree-item">  <a target="_blank" href="{{asset('public/Expan/المستخدمين والصلاحيات.pdf')}}">المستخدمين والصلاحيات  </a> </li>

                                    </ul>
                                </div>

                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                
                
                
                <!-- /.col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <input type="hidden" id="lang" value="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

{{-- $('#tbody').append(`<tr> <td>${item.AccountID}</td> <td>${item.AccountName}</td><td>${item.type}</td> <td> </td> </tr> `) --}}
