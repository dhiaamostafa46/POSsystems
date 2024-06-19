@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">لوحة تحكم الموظف</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="{{route('employees.index')}}">الرئيسية </a></li>
          <li class="breadcrumb-item active">تفاصيل الوظيفة الحالية</li>
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
                <h3 class="card-title">تفاصيل الموظف  - الوظيقة الحالية</h3>
                {{-- <a href="{{route('employees.edit',$employee->id)}}" class="card-title"style="float:left;"><i class="fa fa-edit"></i>   تعديل </a> --}}
              </div>
              <div class="card-body">
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الإسم </label>
                          <h6>{{$employee->nameAr}}</h6>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">رقم الجوال</label>
                          <h6>{{$employee->phone}}</h6>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الايميل</label>
                          <h6>{{$employee->email}}</h6>
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">رقم الهوية </label>
                          <h6>{{$employee->idNo}}</h6>
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الجنسية </label>
                          <h6>{{$employee->nationality}}</h6>
                        </div>
                      </div>
                      
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الوظيفة الحالية </label>
                          <h6>{{$employee->job->nameAr}}</h6>
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">القسم </label>
                          <h6>{{$employee->depart->nameAr}}</h6>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">تاريخ التعيين  </label>
                          <h6>{{$employee->hireDate}}</h6>
                        </div>
                      </div>
                      <div class="col-lg-6"></div>
                     
                      <div class="col-lg-3">
                        <div class="form-group">
                      
                          <a href="{{asset('dist/empDocs/contracts/'.$employee->contract($employee->id)->file)}}" target="_blank"  class="btn btn-primary" style="float:left"><i class="fa fa-show"></i> إستعراض عقد العمل </a>
                        </div>
                      </div>
                      
                      <div class="col-lg-3">
                        <div class="form-group">
                      
                          <a href="#" target="_blank"  class="btn btn-primary" style="float:left"><i class="fa fa-show"></i>طباعة التعريف الوظيفي</a>
                        </div>
                      </div>
                      <div class="col-lg-3"></div>
                      <div class="col-lg-3"></div>
                    </div>
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
