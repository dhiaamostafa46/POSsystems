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
          <li class="breadcrumb-item active">تأكيد بيانات المنشأة</li>
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
                <h3 class="card-title">تأكيد البيانات</h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                  @method('POST')
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">

                      <div class="col-lg-12">
                        <div class="alert alert-success">
                          <strong>نجاح!</strong> تهانينا، اكتملت عملية الربط بنجاح
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="bankName">الاسم</label>
                          <h6>{{session('licenseName')}}</h6>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="bankName">الجوال</label>
                          <h6>{{session('mobile')}}</h6>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="bankName">البريد الإلكتروني</label>
                          <h6>{{session('email')}}</h6>
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <input type="submit" class="btn btn-primary" value="التالي" style="width: 100%">
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

@endsection
