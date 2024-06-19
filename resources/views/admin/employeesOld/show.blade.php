@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">الموظفين</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="{{route('employees.index')}}">قائمة الموظفين</a></li>
          <li class="breadcrumb-item active">عرض تفاصيل موظف</li>
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
                <h3 class="card-title">البيانات الشخصية  </h3>
                <a href="{{route('employees.edit',$employee->id)}}" class="card-title"style="float:left;"><i class="fa fa-edit"></i>   تعديل </a>
              </div>
              <div class="card-body">
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">اسم الموظف</label>
                          <h6>{{$employee->nameAr}}</h6>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">رقم الجوال</label>
                          <h6>{{$employee->phone}}</h6>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الايميل</label>
                          <h6>{{$employee->email}}</h6>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">المنطقة</label>
                          <h6>{{$employee->area}}</h6>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">المدينة</label>
                          <h6>{{$employee->city}}</h6>
                        </div>
                      </div>
                      
                      

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">العنوان</label>
                          <h6>{{$employee->addressAr}}</h6>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الجنسية </label>
                          <h6>{{$employee->nationality}}</h6>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">عدد الأبناء </label>
                          @if($employee->sonCount > 0)
                          <h6>{{$employee->sonCount}}</h6>
                          @else
                            <h6>لا يوجد</h6>
                          @endif
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الحالة الإجتماعية </label>
                          @if($employee->marriedStatus == 1)
                          <h6>أعزب</h6>
                          @elseif($employee->marriedStatus == 2)
                          <h6>متزوج</h6>
                          @elseif($employee->marriedStatus == 3)
                          <h6>منفصل</h6>
                          @endif
                        </div>
                      </div>

                    
                      
                    </div>
                  </div>
                  <hr>
                 
              </div>
              <!-- /.card-body -->
            </div>
              <!----------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">بيانات الهوية  </h3>
              </div>
              <div class="card-body">
                  <div class="pl-lg-4">
                    <div class="row">
                     
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">رقم الهوية </label>
                          <h6>{{$employee->idNo}}</h6>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">تاريخ الإنتهاء</label>
                          <h6>{{$employee->idEndDate}}</h6>
                        </div>
                      </div>

                    </div>
                  </div>
                  <hr>
                 
              </div>
              <!-- /.card-body -->
            </div>

              <!----------------------------------------------------------------------------------------------------------------------------------------------->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">بيانات الوظيفة  </h3>
                </div>
                <div class="card-body">
                    <div class="pl-lg-4">
                      <div class="row">
                       
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">المسمى الوظيفي  </label>
                            <h6>{{$employee->job->nameAr}}</h6>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">القسم </label>
                            <h6>{{$employee->depart->nameAr}}</h6>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">الدوام </label>
                            <h6>{{$employee->shift->nameAr}}</h6>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">الدرجة الوظيفية </label>
                            <h6>{{$employee->jobClass}}</h6>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">تاريخ التعيين  </label>
                            <h6>{{$employee->hireDate}}</h6>
                          </div>
                        </div>
  
                      </div>
                    </div>
                    <hr>
                   
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
