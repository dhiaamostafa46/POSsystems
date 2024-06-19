@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">الدوام</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">الدوام</a></li>
          <li class="breadcrumb-item active">تفاصيل الدوام</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">التفاصيل</h3>
          </div>
          <div class="card-body">
            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">رقم الدوام</label>
                      <h1 class="text-primary">{{$duration->durationNo}}</h1>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">حالة الدوام</label>
                      @switch($duration->status)
                          @case(0)
                          <h6 class="text-primary"><span class="badge badge-danger">مغلق</span></h6>
                              @break
                          @case(1)
                          <h6 class="text-primary"><span class="badge badge-success">مفتوح</span></h6>
                              @break
                          @default
                      @endswitch                      
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">بداية الدوام</label>
                      <h6 class="text-primary">{{$duration->created_at}}</h6>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">بواسطة</label>
                      <h6 class="text-primary">{{$duration->user->name}}</h6>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-userdetails">نهاية الدوام</label>
                      <h6 class="text-primary">{{!empty($duration->endAt)?$duration->endAt:'-'}}</h6>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">بواسطة</label>
                      <h6 class="text-primary">{{!empty($duration->endBy)?$duration->endby->name:"-"}}</h6>
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
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@if ($duration->status == 0)
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">تقرير الدوام</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>الرصيد الافتتاحي</th>
                <th><strong>{{$duration->openBalance}} ريال</strong></th>
              </tr>
              </thead>
              <tbody>
                  <tr>
                    <td>اجمالي النقد</td>
                    <td><strong>{{$duration->orders->sum('cash')}} ريال</strong></td>
                  </tr>
                  <tr>
                    <td>اجمالي الشبكة</td>
                    <td><strong>{{$duration->orders->sum('card')}} ريال</strong></td>
                  </tr>
                  <tr>
                    <td>اجمالي الآجل</td>
                    <td><strong>{{$duration->orders->where('type',3)->sum('totalwvat')}} ريال</strong></td>
                  </tr>
                  <tr>
                    <td>اجمالي المبيعات</td>
                    <td><strong>{{$duration->orders->sum('totalwvat')}} ريال</strong></td>
                  </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td class="bg-danger">الاجمالي المطلوب بالصندوق</td>
                  <td class="bg-danger"><strong>{{$duration->orders->sum('cash')+$duration->openBalance}} ريال</strong></td>
                </tr>
              </tfoot>
            </table>
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
@endif


@endsection