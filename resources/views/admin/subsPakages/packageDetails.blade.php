@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">الإشتراك</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#"> تفاصيل الإشتراك</a></li>
          <li class="breadcrumb-item active">عرض تفاصيل الإشتراك</li>
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
                <h3 class="card-title">محتويات الباقة </h3>
              </div>
              <div class="card-body">
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-6">
                      <Ul class="form-control">
                        @if (count($packitems) > 0)
                        @foreach ($packitems as $index =>$item)
                          <li>{{$item->nameAr}}</li>
                        @endforeach
                        @endif

                      </Ul>
                    </div>
                      


                    </div>
                  </div>
                  <hr>
                  <div class="pl-lg-4">
                  
                  <hr/>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ميزات إضافية  </h3>
              </div>
              <div class="card-body">
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-6">
                      <Ul class="form-control">
                        @if (count($speifcs) > 0)
                        @foreach ($speifcs as $index =>$item)
                          <li>{{$item->nameAr}}</li>
                        @endforeach
                        @endif

                      </Ul>
                    </div>
                      


                    </div>
                  </div>
                  <hr>
                  <div class="pl-lg-4">
                  
                  <hr/>
                </div>
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
