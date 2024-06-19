@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">الصلاحيات</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">قائمة الصلاحيات</a></li>
          <li class="breadcrumb-item active">عرض تفاصيل الصلاحيات</li>
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
                <h3 class="card-title">تفاصيل الصلاحيات</h3>
              </div>
              <div class="card-body">
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">اسم الصلاحيات عربي</label>
                          <h6>{{$role->nameAr}}</h6>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">اسم الصلاحيات انجليزي</label>
                          <h6>{{$role->nameEn}}</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="pl-lg-4">
                  <hr/>
                  <h5>تفاصيل الصفحات</h5>
                  <hr/>
                  <table id="example2" class="table table-bordered table-hover" style="width: 90%;margin:auto">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>الصلاحيات</th>
                      <th>الصفحة</th>
                    </tr>
                    </thead>
                    <tbody>
                   
                    @if (count($role->permissions) > 0)
                        @foreach ($role->permissions as $index => $permission)
                        <tr>
                          <td>{{$index+1}}</td>
                          <td>{{$permission->role->nameAr}}</td>
                          <td>{{$permission->page->nameAr}}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                          <td colspan="6" class="text-center">لا يوجد صفحات</td>
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
