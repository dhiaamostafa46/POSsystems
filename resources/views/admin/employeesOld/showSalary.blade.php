@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">الرواتب</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">قائمة الرواتب</a></li>
          <li class="breadcrumb-item active">عرض تفاصيل راتب</li>
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
                <h3 class="card-title">تفاصيل الراتب   </h3>
              </div>
              <div class="card-body">
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الراتب الأساسي </label>
                          <h6>{{$salaries->basicSalary}}</h6>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الراتب الإجمالي </label>
                          <h6>{{$salaries->fullSalary}}</h6>
                        </div>
                      </div>
                      
                               
                              @foreach ($empalown as $index => $allowan)
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label class="form-control-label" for="input-username">{{$allowan->allow->nameAr}}</label>
                                  <h6>{{$allowan->value}}</h6>
                                </div>
                              </div>

                              @endforeach

                     

                      
                      

                    
                      
                    </div>
                  </div>
                  <hr>
                 
              </div>
              <!-- /.card-body -->
            </div>
              <!----------------------------------------------------------------------------------------------------------------------------------------------->
            
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
</section>
@endsection
