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
          <li class="breadcrumb-item active">خطأ</li>
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
          <div class="col-6" style="margin: auto">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">فشلت العملية</h3>
              </div>
              <div class="card-body">
                <form class="user" action="#" enctype = "multipart/form-data">
                 
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="alert alert-warning">
                          <strong>حدث خطأ!</strong> {{session('paymentError')}}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6" style="float: left">
                        <div class="form-group">
                          <a href="{{route('payment.partners')}}" class="btn btn-primary" style="width: 100%;">المحاولة مرة أخرى</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
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
