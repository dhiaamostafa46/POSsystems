<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>evix | إيفكس</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link href="{{asset('assets/img/EVIX ICON SVG.svg')}}" rel="icon">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">




  <style>
  
    .select2-container .select2-selection--single {
        height: 40px !important;

     }
     
    .dt-print-view{
        direction: rtl;
    }
    .active-page{
      background-color: #4c7e82 !important;
      color: white !important;
    }

    .active-sub-page{
      color: white !important;
    }
  </style>
  <style>
    #example4_filter{
        float:  left !important;
    }
    #example2_filter{
      float:  left !important;
    }
    .nav .nav-treeview{
      padding-right:15px;
    }
    select.decorated option:hover {
      box-shadow: 0 0 10px 100px #1882A8 inset;
    }
    table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td{
      padding: 5px !important;
    }
    #RepotAllDataTable_filter{
        float:  left !important;
    }

  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="font-family: boutros;direction:rtl">
<div class="wrapper">



  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light  no-print">
    <!-- right navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- left navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-language"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

            <a rel="alternate" class="dropdown-item" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

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
          <img src="{{asset('dist/img/users/'.auth()->user()->img)}}" alt="User Avatar" class="mr-3 img-circle" style="width: 20px">
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title" onclick="handlePassword();">
                  <span class="float-right text-sm text-muted"><i class="fas fa-user"></i></span>
                  &nbsp;&nbsp;&nbsp;
                  تغيير كلمة المرور
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
                  <span class="float-right text-sm text-muted"><i class="fa fa-power-off"></i></span>
                  &nbsp;&nbsp;&nbsp;
                  تسجيل الخروج
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
              <img src="{{asset('dist/img/users/'.auth()->user()->img)}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
              <img src="{{asset('dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
              <img src="{{asset('dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4  no-print">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-white">
      <img src="{{asset('dist/img/logo.png')}}" alt="AdminLTE Logo" style="opacity: .8;width:100%">
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/users/'.auth()->user()->img)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','homePage')->first()->id))
          <li class="nav-item">
            <a href="{{route('admin.index')}}" class="nav-link @if(session('page')=='index') active-page @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                الرئيسية
              </p>
            </a>
          </li>
           @if(auth()->user()->id =6)
           <li class="nav-item">
            <a href="#" class="nav-link @if(session('page')=='index') active-page @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                الرئيسية تجربة
              </p>
            </a>
          </li>
            @endif
          @endif

          @if(
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','productsCategory')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','productsList')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','itemsStock')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','itemsUnit')->first()->id)
          )
          <li class="nav-item @if(session('page')=='products') menu-open @endif">
            <a href="#" class="nav-link @if(session('page')=='products') active-page @endif">
              <i class="nav-icon fas fa-book"></i>
              <p>
                {{ trans('admin.products') }}

                <i class="fas fa-angle-right left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','productsCategory')->first()->id))
              <li class="nav-item">
                <a href="{{route('prodcategories.index')}}" class="nav-link @if(session('sub-page')=='productsCategory') active-sub-page @endif">
                  <i class="fa fa-cubes	nav-icon"></i>
                  <p> {{ trans('admin.productsCategory') }}</p>


                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','productsList')->first()->id))
              <li class="nav-item">
                <a href="{{route('products.index')}}" class="nav-link @if(session('sub-page')=='productsList') active-sub-page @endif">
                  <i class="fa fa-list nav-icon"></i>
                  <p>قائمة المنتجات</p>
                </a>
              </li>
              @endif



              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','itemsUnit')->first()->id))
              <li class="nav-item">
                <a href="{{route('units.index')}}" class="nav-link @if(session('sub-page')=='itemsUnit') active-sub-page @endif">
                  <i class="fa fa-cube nav-icon"></i>
                  <p>الوحدات</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','tbls')->first()->id) && auth()->user()->organization->activity == 2)
              <li class="nav-item">
                <a href="{{route('tbls.index')}}" class="nav-link @if(session('sub-page')=='tbls') active-sub-page @endif">
                  <i class="fa fa-table nav-icon"></i>
                  <p>الطاولات</p>
                </a>
              </li>
              @endif

              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','drivethrus')->first()->id) && auth()->user()->organization->activity == 2)
              <li class="nav-item">
                <a href="{{route('drivethrus.index')}}" class="nav-link @if(session('sub-page')=='drivethrus') active-sub-page @endif">
                  <i class="fa fa-car nav-icon"></i>
                  <p>طلبات السيارة</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','kitchens')->first()->id) && auth()->user()->organization->activity == 2)
              <li class="nav-item">
                <a href="{{route('kitchens.index')}}" class="nav-link @if(session('sub-page')=='kitchens') active-sub-page @endif">
                  <i class="fa fa-coffee nav-icon"></i>
                  <p>المطابخ</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','volume')->first()->id) && auth()->user()->organization->activity == 2)
              <li class="nav-item">
                <a href="{{route('Volume.index')}}" class="nav-link @if(session('sub-page')=='Volume') active-sub-page @endif">
                  <i class="fa fa-table nav-icon"></i>
                  <p>الريسبي </p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif



          <li class="nav-item @if(session('page')=='Stores') menu-open @endif">
            <a href="#" class="nav-link @if(session('page')=='Stores') active-page @endif">
              <i class="nav-icon fas fa-book"></i>
              <p>
                  المخزون

                <i class="fas fa-angle-right left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','Storepage')->first()->id))
              <li class="nav-item">
                <a href="{{route('depotStore.index')}}" class="nav-link @if(session('sub-page')=='itemsStock') active-sub-page @endif">
                  <i class="fa fa-box nav-icon"></i>
                  <p>المستودعات</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('StockDepot.index')}}" class="nav-link @if(session('sub-page')=='openStore') active-sub-page @endif">
                  <i class="fa fa-box nav-icon"></i>
                  <p>الرصيد الافتتاحي  </p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','convertStorepage')->first()->id))
              <li class="nav-item">
                <a href="{{route('StoreConversion.index')}}" class="nav-link @if(session('sub-page')=='StoreConversion') active-sub-page @endif">
                  <i class="fa fa-box nav-icon"></i>
                  <p>تحويل المحزني </p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','Damagedinventory')->first()->id))
              <li class="nav-item">
                <a href="{{route('Tainted.index')}}" class="nav-link @if(session('sub-page')=='TaintedStore') active-sub-page @endif">
                  <i class="fa fa-box nav-icon"></i>
                  <p> المخزون التالف</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','Damagedinventory')->first()->id))
              <li class="nav-item">
                <a href="{{route('Arrangement.index')}}" class="nav-link @if(session('sub-page')=='ArrangementStore') active-sub-page @endif">
                  <i class="fa fa-box nav-icon"></i>
                  <p>تسوية مخزون </p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','Damagedinventory')->first()->id))
              <li class="nav-item">
                <a href="{{route('Manufactur.index')}}" class="nav-link @if(session('sub-page')=='Manufactur') active-sub-page @endif">
                  <i class="fa fa-box nav-icon"></i>
                  <p> أمر تصنيع  </p>
                </a>
              </li>
              @endif
            </ul>
          </li>













          <!-- <li class="nav-header text-white">المبيعات والمشتريات</li> -->
          @if(
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','billsCreate')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','billsList')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','billsCred')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','billsDebit')->first()->id)
          )
          @if(auth()->user()->organization->activity  !==3
          )
            <li class="nav-item @if(session('page')=='orders') menu-open @endif">
                <a href="#" class="nav-link @if(session('page')=='orders') active-page @endif">
                <i class="nav-icon fa fa-cart-plus"></i>
                <p>
                    المبيعات
                    <i class="fas fa-angle-right left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">

                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','Saleswindow')->first()->id))
                <li class="nav-item">
                    <a href="{{route('orders.create')}}" class="nav-link @if(session('sub-page')=='billsCreate') active-sub-page @endif">
                    <i class="fa fa-desktop nav-icon"></i>
                    <p>نافذة البيع</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','AllWaiterOrders')->first()->id) && auth()->user()->organization->activity == 2)
                <li class="nav-item">
                    <a href="{{route('Nadal.today')}}" class="nav-link @if(session('sub-page')=='Nadaltoday') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p>طلبات الندلاء</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','TodayOrders')->first()->id) && auth()->user()->organization->activity == 2)
                <li class="nav-item">
                    <a href="{{route('orders.today')}}" class="nav-link @if(session('sub-page')=='ordersToday') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p>طلبات اليوم</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','WaiterPOS')->first()->id) && auth()->user()->organization->activity == 2)
                <li class="nav-item">
                    <a href="{{route('Nadal.create')}}" class="nav-link @if(session('sub-page')=='NadalCreate') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p> نافذة النادل</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','WaiterOrders')->first()->id) && auth()->user()->organization->activity == 2)
                <li class="nav-item">
                    <a href="{{route('Nadal.index')}}" class="nav-link @if(session('sub-page')=='Nadalbllls') active-sub-page @endif">
                        <i class="fa fa-list nav-icon"></i>
                        <p> طلبات النادل  </p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','billsList')->first()->id))
                <li class="nav-item">
                    <a href="{{route('orders.index')}}" class="nav-link @if(session('sub-page')=='billsList') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p>سجل الفواتير</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','billsList')->first()->id))
                <li class="nav-item">
                    <a href="{{route('OrderInvoices.index')}}" class="nav-link @if(session('sub-page')=='Salesinvoice') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p> الفواتير مبيعات</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','OfferPricepage')->first()->id) && auth()->user()->organization->activity == 1)
                <li class="nav-item">
                    <a href="{{route('OfferPrice.index')}}" class="nav-link @if(session('sub-page')=='OfferPrice') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p> عرض سعر</p>
                    </a>
                </li>
                @endif
                {{-- @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','SalesReturns')->first()->id)  && auth()->user()->organization->activity == 1)
                <li class="nav-item">
                    <a href="{{route('SalesReturns.index')}}" class="nav-link @if(session('sub-page')=='SalesReturnsIndex') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p>  مرتجع مبيعات </p>
                    </a>
                </li>
                @endif --}}
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','billsCred')->first()->id))
                <li class="nav-item">
                    <a href="{{route('credorders.index')}}" class="nav-link @if(session('sub-page')=='billsCred') active-sub-page @endif">
                    <i class="fa fa-tag nav-icon"></i>
                    <p> مرتجع مبيعات </p>
                    </a>
                </li>
                @endif

                </ul>
            </li>
          @endif
          @endif





















          @if(
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','purchasesAdd')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','purchasesList')->first()->id))

          <li class="nav-item @if(session('page')=='purchases') menu-open @endif">
            <a href="#" class="nav-link @if(session('page')=='purchases') active-page @endif">
              <i class="nav-icon fa fa-cart-arrow-down"></i>
              <p>
                المشتريات
                <i class="fas fa-angle-right left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              {{-- @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','purchasesAdd')->first()->id))
              <li class="nav-item">
                <a href="{{route('purchases.create')}}" class="nav-link @if(session('sub-page')=='purchasesAdd') active-sub-page @endif">
                  <i class="fa fa-bookmark nav-icon"></i>
                  <p>تسجيل فاتورة</p>
                </a>
              </li>
              @endif --}}
              {{-- @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','purchasereturn')->first()->id))
              <li class="nav-item">
                <a href="{{route('Purchasereturns.index')}}" class="nav-link @if(session('sub-page')=='purchasereturn') active-sub-page @endif">
                  <i class="fa fa-bookmark nav-icon"></i>
                  <p> مرتجع مشتريات</p>
                </a>
              </li>
              @endif --}}

              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','purchasesList')->first()->id))
              <li class="nav-item">
                <a href="{{route('purchases.index')}}" class="nav-link @if(session('sub-page')=='purchasesList') active-sub-page @endif">
                  <i class="fa fa-list nav-icon"></i>
                  <p>فواتير المشتريات</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','billsDebit')->first()->id))
              <li class="nav-item">
                  <a href="{{route('debitorders.index')}}" class="nav-link @if(session('sub-page')=='billsDebit') active-sub-page @endif">
                  <i class="fa fa-tag nav-icon"></i>
                  <p> مرتجع  مشتريات</p>
                  </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          @if(
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','getItemsInvoice')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','createReceivePayments')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','createDeliverPayments')->first()->id)
          )
            @if(auth()->user()->organization->activity  !==3
            )
          <li class="nav-item @if(session('page')=='invoices') menu-open @endif">
            <a href="#" class="nav-link @if(session('page')=='invoices') active-page @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                السندات
                <i class="fas fa-angle-right left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','getItemsInvoice')->first()->id))
              <li class="nav-item">
                <a href="#" onclick="createInvoice();" class="nav-link @if(session('sub-page')=='getItemsInvoice') active-sub-page @endif">
                  <i class="fa fa-file nav-icon"></i>
                  <p>نموذج استلام بضاعة</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','createReceivePayments')->first()->id))
              <li class="nav-item">
                <a href="{{route('Sinadat.indexReceive')}}" class="nav-link @if(session('sub-page')=='createReceivePayments') active-sub-page @endif">
                  <i class="fa fa-file nav-icon"></i>
                  <p>سند قبض</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','createDeliverPayments')->first()->id))
              <li class="nav-item">
                <a href="{{route('Sinadat.indexDeliver')}}" class="nav-link @if(session('sub-page')=='createDeliverPayments') active-sub-page @endif">
                  <i class="fa fa-file nav-icon"></i>
                  <p>سند صرف</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
@endif

<!--Start Non-profit organization-->

          @if(
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','getItemsInvoice')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','createReceivePayments')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','createDeliverPayments')->first()->id)
            )
            @if(auth()->user()->organization->activity  ===3)
            <li class="nav-item @if(session('page')=='invoices') menu-open @endif">
              <a href="#" class="nav-link @if(session('page')=='invoices') active-page @endif">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  السندات
                  <i class="fas fa-angle-right left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','getItemsInvoice')->first()->id))
                <li class="nav-item">
                  <a href="#" onclick="createInvoice();" class="nav-link @if(session('sub-page')=='getItemsInvoice') active-sub-page @endif">
                    <i class="fa fa-file nav-icon"></i>
                    <p>نموذج استلام بضاعة</p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','createReceivePayments')->first()->id))
                <li class="nav-item">
                  <a href="{{route('invoices.indexReceive')}}"  class="nav-link @if(session('sub-page')=='createReceivePayments') active-sub-page @endif">
                    <i class="fa fa-file nav-icon"></i>
                    <p>سند قبض</p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','createDeliverPayments')->first()->id))
                <li class="nav-item">
                  <a href="{{route('invoices.indexDeliver')}}"  class="nav-link @if(session('sub-page')=='createDeliverPayments') active-sub-page @endif">
                    <i class="fa fa-file nav-icon"></i>
                    <p>سند صرف</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
              @endif
            @endif
<!--End Non-profit organization-->


          @if(
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','customersList')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','suppliersList')->first()->id)
          )
          <li class="nav-item @if(session('page')=='customers' || session('page')=='suppliers') menu-open @endif">
            <a href="#" class="nav-link @if(session('page')=='customers' || session('page')=='suppliers') active-page @endif">
              <i class="nav-icon fas fa-users"></i>
              <p>
                العملاء والموردين
                <i class="fas fa-angle-right left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','customersList')->first()->id))
              <li class="nav-item">
                <a href="{{route('customers.index')}}" class="nav-link @if(session('sub-page')=='customersList') active-sub-page @endif">
                  <i class="fa fa-users nav-icon"></i>
                  <p>قائمة العملاء</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','suppliersList')->first()->id))
              <li class="nav-item">
                <a href="{{route('suppliers.index')}}" class="nav-link @if(session('sub-page')=='suppliersList') active-sub-page @endif">
                  <i class="fa fa-user-secret nav-icon"></i>
                  <p>قائمة الموردين</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          <!--<li class="nav-header text-white">الموارد البشرية والحسابات</li>-->
          @if(
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesList')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesCreate')->first()->id) ||
          auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesType')->first()->id))
          <li class="nav-item @if(session('page')=='outcomes') menu-open @endif">
            <a href="#" class="nav-link @if(session('page')=='outcomes') active-page @endif">
              <i class="nav-icon fas fa-book"></i>
              <p>
                المصروفات
                <i class="fas fa-angle-right left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesList')->first()->id))
              <li class="nav-item">
                <a href="{{route('outcomes.index')}}" class="nav-link @if(session('sub-page')=='outcomesList') active-sub-page @endif">
                  <i class="fa fa-list nav-icon"></i>
                  <p>سجل المصروفات</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesCreate')->first()->id))
              <li class="nav-item">
                <a href="{{route('outcomes.create')}}" class="nav-link @if(session('sub-page')=='outcomesCreate') active-sub-page @endif">
                  <i class="fa fa-credit-card	nav-icon"></i>
                  <p>اضافة مصروف</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesType')->first()->id))
              <li class="nav-item">
                <a href="{{route('outcomeCategories.index')}}" class="nav-link @if(session('sub-page')=='outcomesType') active-sub-page @endif">
                  <i class="fa fa-book nav-icon"></i>
                  <p>بنود المصروفات</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif



          <!--
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                الموظفين
                <i class="fas fa-angle-right left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/invoice.html" class="nav-link">
                  <i class="fa fa-asterisk nav-icon"></i>
                  <p>سجل الموظفين</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/profile.html" class="nav-link">
                  <i class="fa fa-asterisk nav-icon"></i>
                  <p>الحضور والانصراف</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/e-commerce.html" class="nav-link">
                  <i class="fa fa-asterisk nav-icon"></i>
                  <p>تقييم الموظفين</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                الحسابات
                <i class="fas fa-angle-right left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/invoice.html" class="nav-link">
                  <i class="fa fa-asterisk nav-icon"></i>
                  <p>الحسابات</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/invoice.html" class="nav-link">
                  <i class="fa fa-asterisk nav-icon"></i>
                  <p>القيود</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/profile.html" class="nav-link">
                  <i class="fa fa-asterisk nav-icon"></i>
                  <p>الميزانية</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/e-commerce.html" class="nav-link">
                  <i class="fa fa-asterisk nav-icon"></i>
                  <p>الارباح والخسائر</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                المراسلات
                <i class="fas fa-angle-right left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="fa fa-asterisk nav-icon"></i>
                  <p>صندوق الوارد</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="fa fa-asterisk nav-icon"></i>
                  <p>البريد المرسل</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="fa fa-asterisk nav-icon"></i>
                  <p>رسالة جديدة</p>
                </a>
              </li>
            </ul>
          </li>
          -->






            @if(
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageAccountingGuide')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageBank')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageTreasury')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','pagecostcenters')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageJournal')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageEasyjournals')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageOpeningBalances')->first()->id)||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageRoutAccount')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','VirtualAccount')->first()->id) )
            <li class="nav-item @if(session('page')=='AccountingGuide') menu-open @endif">
                <a href="#" class="nav-link @if(session('page')=='AccountingGuide') active-page @endif">

                  <i class="fa fa-folder"></i>
                  <p>
                       الحسابات
                    <i class="fas fa-angle-right left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageAccountingGuide')->first()->id))
                  <li class="nav-item">
                    <a href="{{route('AccountingGuide.index')}}"  class="nav-link @if(session('sub-page')=='pageAccountingGuide') active-sub-page @endif">
                      <i class="fa fa-folder-open"></i>
                      <p>سجل الدليل الحسابي</p>
                    </a>
                  </li>
                  @endif
                  @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageBank')->first()->id))
                  <li class="nav-item">
                    <a href="{{route('Bank.index')}}"  class="nav-link @if(session('sub-page')=='pageBank') active-sub-page @endif">
                      <i class="fa fa-folder-open"></i>
                      <p>  سجل حسابات البنوك</p>
                    </a>
                  </li>
                  @endif
                  @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageTreasury')->first()->id))
                  <li class="nav-item">
                    <a href="{{route('Treasury.index')}}"  class="nav-link @if(session('sub-page')=='pageTreasury') active-sub-page @endif">
                      <i class="fa fa-folder-open"></i>
                      <p>  سجل حسابات الصناديق</p>
                    </a>
                  </li>
                  @endif
                  @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','pagecostcenters')->first()->id))
                  <li class="nav-item">
                    <a href="{{route('costcenters.index')}}"  class="nav-link @if(session('sub-page')=='pagecostcenters') active-sub-page @endif">
                      <i class="fa fa-folder-open"></i>
                      <p>مركز التكلفة</p>
                    </a>
                  </li>
                  @endif
                  @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageJournal')->first()->id))
                  <li class="nav-item">
                    <a href="{{route('journals.index')}}"  class="nav-link @if(session('sub-page')=='pageJournal') active-sub-page @endif">
                      <i class="fa fa-folder-open"></i>
                      <p>    القيود اليومية</p>
                    </a>
                  </li>
                  @endif
                  @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageEasyjournals')->first()->id))
                  <li class="nav-item">
                    <a href="{{route('Easyjournals.index')}}"  class="nav-link @if(session('sub-page')=='pageEasyjournals') active-sub-page @endif">
                      <i class="fa fa-folder-open"></i>
                      <p>    القيود السهلة</p>
                    </a>
                  </li>
                  @endif
                  @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageOpeningBalances')->first()->id))
                  <li class="nav-item">
                    <a href="{{route('OpeningBalances.index')}}"  class="nav-link @if(session('sub-page')=='pageOpeningBalances') active-sub-page @endif">
                      <i class="fa fa-folder-open"></i>
                      <p>     الارصدة الافتتاحية </p>
                    </a>
                  </li>
                  @endif
                  @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','pageRoutAccount')->first()->id))
                  <li class="nav-item">
                    <a href="{{route('RoutAccount.index')}}"  class="nav-link @if(session('sub-page')=='pageRoutAccount') active-sub-page @endif">
                      <i class="fa fa-folder-open"></i>
                      <p>      اعادة التوجيه المحاسبي </p>
                    </a>
                  </li>
                  @endif
                  @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','VirtualAccount')->first()->id))
                  <li class="nav-item">
                    <a href="{{route('VirtualAccounts.index')}}"  class="nav-link @if(session('sub-page')=='VirtualAccount') active-sub-page @endif">
                      <i class="fa fa-folder-open"></i>
                      <p>      الحسابات الافتراضية   </p>
                    </a>
                  </li>
                  @endif

                </ul>
              </li>
          @endif

         @if(

            auth()->user()->role->permissions->contains('pageID', $pages->where('code','employees')->first()->id))

            <li class="nav-item @if(session('page')=='HR') menu-open @endif">
              <a href="#" class="nav-link @if(session('page')=='HR') active-page @endif">
                <i class="nav-icon fa fa-cart-arrow-down"></i>
                <p>
                  الموارد البشرية
                  <i class="fas fa-angle-right left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','EmployeesAttendance')->first()->id))
                <li class="nav-item">
                  <a href="{{route('employees.index')}}" class="nav-link @if(session('sub-page')=='employees') active-sub-page @endif">
                    <i class="fa fa-bookmark nav-icon"></i>
                    <p>الموظفين </p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','EmployeesAttendance')->first()->id))
                <li class="nav-item">
                  <a href="{{route('attendance.index')}}" class="nav-link @if(session('sub-page')=='attendances') active-sub-page @endif">
                    <i class="fa fa-bookmark nav-icon"></i>
                    <p>الحضور والإنصراف </p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','empAttendIndex')->first()->id))
                <li class="nav-item">
                  <a href="{{route('attendance.empAttendance')}}" class="nav-link @if(session('sub-page')=='employees') active-sub-page @endif">
                    <i class="fa fa-bookmark nav-icon"></i>
                    <p>الحضور </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('holydays.empIndex')}}" class="nav-link @if(session('sub-page')=='employees') active-sub-page @endif">
                    <i class="fa fa-bookmark nav-icon"></i>
                    <p>طلبات الإجازة </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('advances.empIndex')}}" class="nav-link @if(session('sub-page')=='employees') active-sub-page @endif">
                    <i class="fa fa-bookmark nav-icon"></i>
                    <p>السلفيات </p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','EmployeesAttendance')->first()->id))
                <li class="nav-item">
                  <a href="{{route('attendance.shifts')}}" class="nav-link @if(session('sub-page')=='shifts') active-sub-page @endif">
                    <i class="fa fa-bookmark nav-icon"></i>
                    <p>الدوامات </p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','EmployeesAttendance')->first()->id))
                <li class="nav-item">
                  <a href="{{route('employees.salaries')}}" class="nav-link @if(session('sub-page')=='salaries') active-sub-page @endif">
                    <i class="fa fa-bookmark nav-icon"></i>
                    <p>الرواتب </p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','EmployeesAttendance')->first()->id))
                <li class="nav-item">
                  <a href="{{route('employees.payrolls')}}" class="nav-link @if(session('sub-page')=='payrolls') active-sub-page @endif">
                    <i class="fa fa-bookmark nav-icon"></i>
                    <p>كشوفات الرواتب </p>
                  </a>
                </li>
                @endif
              
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','EmployeesAttendance')->first()->id))
                
                <li class="nav-item">
                  <a href="{{route('employees.departments')}}" class="nav-link @if(session('sub-page')=='departments') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p>الأقسام</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="{{route('employees.jobs')}}" class="nav-link @if(session('sub-page')=='jobs') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p>الوظائف</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('employees.allowances')}}" class="nav-link @if(session('sub-page')=='allowances') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p>البدلات والخصومات</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('employees.documents')}}" class="nav-link @if(session('sub-page')=='documents') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p>المستندات</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('employees.contracts')}}" class="nav-link @if(session('sub-page')=='contracts') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p>العقود الوظيفية</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('employees.custodies')}}" class="nav-link @if(session('sub-page')=='custodies') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p>العهد </p>
                  </a>
                </li>
                <!--<li class="nav-item">
                  <a href="{{route('employees.custodies')}}" class="nav-link @if(session('sub-page')=='custodies') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p>السلفيات </p>
                  </a>
                </li>-->
                @endif
              </ul>
            </li>
            @endif



          @if(
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesList')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesCreate')->first()->id) ||
            auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesType')->first()->id))
            <li class="nav-item @if(session('page')=='outcomes') menu-open @endif">
              <a href="#" class="nav-link @if(session('page')=='outcomes') active-page @endif">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  التذاكر
                  <i class="fas fa-angle-right left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesList')->first()->id))
                <li class="nav-item">
                  <a href="{{route('tickets.create')}}" class="nav-link @if(session('sub-page')=='outcomesList') active-sub-page @endif">
                    <i class="fa fa-list nav-icon"></i>
                    <p>تذكرة جديدة </p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesCreate')->first()->id))
                <li class="nav-item">
                  <a href="{{route('tickets.index')}}" class="nav-link @if(session('sub-page')=='outcomesCreate') active-sub-page @endif">
                    <i class="fa fa-credit-card	nav-icon"></i>
                    <p>التذاكر </p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','outcomesType')->first()->id))
                <li class="nav-item">
                  <a href="{{route('outcomeCategories.index')}}" class="nav-link @if(session('sub-page')=='outcomesType') active-sub-page @endif">
                    <i class="fa fa-book nav-icon"></i>
                    <p>بنود المصروفات</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
            @endif
            @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','organizationView')->first()->id))
            <li class="nav-item @if(session('page')=='Profile') menu-open @endif">
              <a href="#" class="nav-link @if(session('page')=='Profile') active-page @endif">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                   صفحات تعريفية
                  <i class="fas fa-angle-right left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                {{-- @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','salesReport')->first()->id)) --}}
                <li class="nav-item">
                  <a href="{{route('ProfileInfCompany.index')}}" class="nav-link @if(session('sub-page')=='ProfileInfCompany') active-sub-page @endif">
                    <i class="fa fa-asterisk nav-icon"></i>
                    <p> معلومات الشركة</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('ProfileInfCompany.ServicesIndex')}}" class="nav-link @if(session('sub-page')=='ProfileInfServices') active-sub-page @endif">
                    <i class="fa fa-asterisk nav-icon"></i>
                    <p>   خدمتنا  </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('ProfileInfCompany.ContactIndex')}}" class="nav-link @if(session('sub-page')=='ProfileInfContact') active-sub-page @endif">
                    <i class="fa fa-asterisk nav-icon"></i>
                    <p>   معلومات التواصل  </p>
                  </a>
                </li>
                {{-- @endif --}}
              </ul>
            </li>
            @endif







          @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','usersList')->first()->id))
          <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link @if(session('page')=='users') active-page @endif">
              <i class="nav-icon fas fa-users"></i>
              <p>
                المستخدمين
              </p>
            </a>
          </li>
          @endif
          @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','organizationView')->first()->id))
          <li class="nav-item">
            <a href="{{route('organizations.index')}}" class="nav-link @if(session('page')=='organizations') active-page @endif">
              <i class="nav-icon fas fa-info"></i>
              <p>
                معلومات المنشأة
                @if(empty(auth()->user()->organization->CR)) <span class="badge badge-danger">ناقصة</span>@endif
              </p>
            </a>
          </li>
          @endif
           @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','ReportAlLPage')->first()->id))
          <li class="nav-item">
            <a href="{{route('ReportAll.index')}}" class="nav-link @if(session('page')=='Report') active-page @endif">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                التقارير
              </p>
            </a>
          </li>
          @endif
          @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','banners')->first()->id))
          <li class="nav-item">
            <a href="{{route('banners.index')}}" class="nav-link @if(session('page')=='banners') active-page @endif">
              <i class="nav-icon fas fa-info"></i>
              <p>
                الاعلانات
              </p>
            </a>
          </li>
          @endif
          @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','permissionsEdit')->first()->id))
          <li class="nav-item">
            <a href="{{route('roles.index')}}" class="nav-link @if(session('page')=='roles') active-page @endif">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                الصلاحيات
              </p>
            </a>
          </li>
          @endif




          <!--<li class="nav-header text-white">الموارد البشرية والحسابات</li>-->


           {{-- @if(auth()->user()->role->permissions->contains('pageID', $pages->where('code','ReportAlLPage')->first()->id))
          <li class="nav-item">
            <a href="{{route('ReportAll.index')}}" class="nav-link @if(session('page')=='Report') active-page @endif">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                التقارير
              </p>
            </a>
          </li>
          @endif --}}


















          @if(auth()->user()->isadmin == 1)
          <li class="nav-item">
            <a href="{{route('pagecategories.index')}}" class="nav-link @if(session('page')=='pagecategories') active-page @endif">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                تصنيف الصفحات
              </p>
            </a>
          </li>
          @endif
          @if(auth()->user()->isadmin == 1)
          <li class="nav-item">
            <a href="{{route('pages.index')}}" class="nav-link @if(session('page')=='pages') active-page @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                الصفحات
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>








  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    @if (session('subscribtionStatus')==3)
      <div class="alert alert-danger alert-dismissible no-print">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{session('subscribtionMsg')}}
      </div>
    @elseif (session('subscribtionStatus')==2)
      <div class="alert alert-warning alert-dismissible no-print">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{session('subscribtionMsg')}}
      </div>
    @endif
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Password Modal -->
<div class="modal fade modal" id="passwordModel" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">تحديث كلمة المرور</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-12 row mt-3">
        <div class="col-12">
          <form class="user" id="passwordForm" method="POST" action="{{ route('users.password') }}" enctype = "multipart/form-data">
            @csrf
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-8">
                  <div class="form-group">
                    <input type="text"  class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="كلمة المرور الجديدة">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>


                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="حفظ" style="width: 100%">
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

  <footer class="main-footer no-print">
    <strong>Copyleft &copy; {{date('Y')}} <a href="#">eyein code</a>.</strong>
    All lefts reserved.
    <div class="float-left d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<input type="hidden" id="success" value="{{Session::get('success')}}">
<input type="hidden" id="faild" value="{{Session::get('faild')}}">
<!-- ./wrapper -->
<form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">
  @csrf
</form>


<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>


<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
  $(function () {
    $("#RepotAllDataTable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", {
            extend: 'print',
            autoPrint: false,
            exportOptions: {
                modifier: {
                    page: 'current'

                }
            }
            },, "colvis"],
      "oLanguage": {
        "sSearch": "البحث:",
        "sInfo": "عرض _START_ من _END_   صفحة",
        "sLengthMenu": "عرض _MENU_ سجل في الصفحة",
      },
      lengthMenu: [
        [50, -1],
        [50, 'All']
    ]

    }).buttons().container().appendTo('#RepotAllDataTable_wrapper .col-md-6:eq(0)');

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
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
        "sSearch": "البحث:",
        "sInfo": "عرض _START_ من _END_   صفحة",
        "sLengthMenu": "عرض _MENU_ سجل في الصفحة",
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
<link href="{{asset('dist/css/dark.css')}}" rel="stylesheet">
<script src="{{asset('dist/css/sweetalert2.min.js')}}"></script>
<script>
  function handleLogout(){
    Swal.fire({
      title: 'هل انت متأكد من الخروج؟',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: 'نعم، خروج',
      cancelButtonText: 'لا، الغاء'
    }).then((result) => {
      if (result.isConfirmed) {

        document.getElementById('logout-form').submit();
      }
    })
  }

  function endDuration(id){
    Swal.fire({
      title: 'هل انت متأكد من انهاء الدوام؟',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: 'نعم، انهاء',
      cancelButtonText: 'لا، الغاء'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = `/endDuration/${id}`;
      }
    })
  }



 


  if(document.getElementById('success').value){
    Swal.fire(
    'نجاح',
    '<h6  style="color:white">'+document.getElementById('success').value+'</h6>',
    'success'
    )
    document.getElementById('success').value = "";
  }

  if(document.getElementById('faild').value){
    Swal.fire(
    'فشل',
    '<h6  style="color:white">'+document.getElementById('faild').value+'</h6>',
    'error'
    )
    document.getElementById('faild').value = "";
  }
</script>
<script>
  function createReceive(){
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

  function createDeliver(){
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

  function createInvoice(){
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
  function ValidateKey()
    {
      var key=window.event.keyCode;
      var allowed='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890 :;,.?!£$%^&*()_+-*{}@~<>&"\'';

        return allowed.indexOf(String.fromCharCode(key)) !=-1 ;
    }
</script>
</body>
</html>
