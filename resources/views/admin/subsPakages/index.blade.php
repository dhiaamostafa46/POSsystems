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
                <h3 class="card-title">تفاصيل المنشأة</h3>
              </div>
              <div class="card-body">
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">اسم المنشأة</label>
                          <h6>{{$organization->nameAr}}</h6>
                        </div>
                      </div>
                     
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">إنتهاء الإشتراك</label>
                          <h6>{{$endDate->endDate}}</h6>
                        </div>
                      </div>
                      


                    </div>
                  </div>
                  <hr>
                  <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-2">
                      <h5>
                      الباقة :
                    </h5>
                    </div>
                    <div class="col-3">
                    @if($packName !=null)
                    <h5 class="col-lg-6">{{$packName}}</h5>
                    @endif
                  </div>
                  
                    
                  </div>
                  <hr/>
                  <table class="table table-bordered table-hover" style="width: 70%;margin:auto">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>الوحدة</th>
                   
                    </tr>
                    </thead>
                    <tbody>
                   
                    @if (count( $orgsubs) > 0)
                        @foreach ($orgsubs as $index =>  $orgsub)
                        <tr>
                          <td>{{$index+1}}</td>
                          <td>{{$orgsub->nameAr}}</td>
                        
                      
                        </tr>
                        @endforeach
                    @else
                        <tr>
                          <td colspan="6" class="text-center">لا يوجد</td>
                        </tr>
                    @endif
                    </tfoot>
                  </table>
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
