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
          <li class="breadcrumb-item"><a href="#">قائمة الموظفين</a></li>
          <li class="breadcrumb-item active">تحديث بيانات موظف</li>
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
                <h3 class="card-title">البينات الشخصية  </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('employees.update',$employee->id) }}" enctype = "multipart/form-data">
                  @csrf

                  @method('PUT')
                  <!--<input type="hidden" value="" name="AccountID" >-->
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">اسم الموظف</label>
                          <input type="text"  class="form-control @error('name') is-invalid @enderror" id="name" name="nameAr" placeholder="اكتب اسم الموظف" value="{{$employee->nameAr}}">
                          @error('nameAr')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">رقم الجوال</label>
                          <input type="phone" pattern="[0-9]{10}" maxlength="10" oninvalid="this.setCustomValidity('ادخل رقم جوال حقيقي')"
            oninput="this.setCustomValidity('')" minlength="10"  class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="اكتب رقم الجوال" value="{{$employee->phone}}">
                          @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الايميل (اختياري)</label>
                          <input type="text"  class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="ادخل الايميل" value="{{$employee->email}}">
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">المنطقة</label>
                          <input type="text" class="form-control @error('area') is-invalid @enderror" id="area" name="area" placeholder="اكتب المنطقة" value="{{$employee->area}}">
                          @error('area')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">المدينة</label>
                          <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="اكتب المدينة" value="{{$employee->city}}">
                          @error('city')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">العنوان</label>
                          <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="اكتب العنوان" value="{{$employee->nameAr}}">
                          @error('address')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الجنسية </label>
                          <input type="text" class="form-control @error('nationality') is-invalid @enderror" id="nationality" name="nationality" placeholder="اكتب الجنسية " value="{{$employee->nationality}}">
                          @error('vatNo')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">عدد الأبناء </label>
                          <input type="number" class="form-control @error('sonCount') is-invalid @enderror" id="sonCount" name="sonCount" placeholder="اكتب عدد الابناء " value="{{$employee->sonCount}}">
                          @error('vatNo')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الحالة الإجتماعية </label>
                          <select class="form-control @error('jobID') is-invalid @enderror" id="marriedStatus" name="marriedStatus">
                            <option value="1" @if($employee->marriedStatus == 1) @selected(true) @endif>أعزب</option>
                            <option value="2" @if($employee->marriedStatus == 2) @selected(true) @endif>متزوج</option>
                            <option value="3" @if($employee->marriedStatus == 3) @selected(true) @endif>منفصل</option>
                          </select>
                          @error('vatNo')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>


                    </div>
                    <!----------------------------------------------------------------------------------------------------------------------------------------------->

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">بيانات الهوية </h3>
                </div>
                <div class="card-body">
                 
                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">رقم الهوية</label>
                            <input type="text"  class="form-control @error('idNo') is-invalid @enderror" id="idNo" name="idNo" placeholder="اكتب رقم الهوية " value="{{$employee->idNo}}">
                            @error('idNo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">تاريخ الإنتهاء </label>
                            <input type="date"  class="form-control @error('idEndDate') is-invalid @enderror" id="idEndDate" name="idEndDate" placeholder="تاريخ الإنتهاء " value="{{$employee->idEndDate}}">
                            @error('idEndDate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                   
                      </div>
                      
                    </div>
                    </div>
                    <hr class="my-4" />
               
                </div>
                <!----------------------------------------------------------------------------------------------------------------------------------------------->

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">بيانات الوظيفة </h3>
                </div>
                <div class="card-body">
                 
                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">الوظيفة </label>
                            
                            
                             
                            <select class="form-control @error('jobID') is-invalid @enderror" id="jobID" name="jobID">
                              <option value="-1">اختر الوظيفة</option>
                              @if (count($jobs) > 0)
                              @foreach ($jobs as $index => $job)
                             
                                <option value="{{$job->id}}" @if($employee->jobID == $job->id) @selected(true) @endif>{{$job->nameAr}}</option>
                              @endforeach
                              @endif
                               
                            </select>
                            @error('jobID')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">القسم </label>
                            
                            <select class="form-control @error('depID') is-invalid @enderror" id="depID" name="depID">
                              <option value="-1">اختر القسم</option>
                              @if (count($departs) > 0)
                              @foreach ($departs as $index => $depart)
                             
                                <option value="{{$depart->id}}" @if($employee->depID == $depart->id) @selected(true) @endif>{{$depart->nameAr}}</option>
                              @endforeach
                              @endif
                            </select>
                            @error('depID')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username"> الدوام </label>
                          
                            <select class="form-control @error('depID') is-invalid @enderror" id="shiftID" name="shiftID">
                              <option value="">اختر الدوام</option>
                              @if (count(auth()->user()->organization->shifts) > 0)
                              @foreach (auth()->user()->organization->shifts as $index => $depart)
                             
                                <option value="{{$depart->id}}" @if($employee->shiftID == $depart->id) @selected(true) @endif>{{$depart->nameAr}}</option>
                              @endforeach
                              @endif
                            </select>
                            @error('depID')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">الدرجة الوظيفية(إختياري) </label>
                            <input type="text"  class="form-control @error('name') is-invalid @enderror" id="jobClass" name="jobClass" placeholder="اكتب الدرجة الوظيفية " value="{{$employee->jobClass}}">
                            @error('jobClass')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">تاريخ التعيين </label>
                            <input type="date"  class="form-control @error('idEndDate') is-invalid @enderror" id="hireDate" name="hireDate" placeholder="اكتب تاريخ التعيين " value="{{$employee->hireDate}}">
                            @error('hireDate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        
                   
                      </div>
                      
                    </div>
                    </div>
                    <hr class="my-4" />
                
                </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <input type="submit" class="btn btn-primary" value="حفظ" style="width: 100%">
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
