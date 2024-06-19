@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">موظف جديد</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">قائمة الموظفين</a></li>
          <li class="breadcrumb-item active">اضافة موظف</li>
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
            <form class="user" method="POST" action="{{ route('employees.store') }}" enctype = "multipart/form-data">
              @csrf
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">البيانات الشخصية  </h3>
              </div>
              <div class="card-body">
               
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">اسم الموظف</label>
                          <input type="text"  class="form-control @error('name') is-invalid @enderror" id="nameAr" name="nameAr" placeholder="اكتب اسم الموظف">
                          @error('name')
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
            oninput="this.setCustomValidity('')" minlength="10"  class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="اكتب رقم الجوال">
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
                          <input type="text"  class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="ادخل الايميل">
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
                          <input type="text" class="form-control @error('area') is-invalid @enderror" id="area" name="area" placeholder="اكتب المنطقة">
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
                          <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="اكتب المدينة">
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
                          <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="addressAr" placeholder="اكتب العنوان">
                          @error('address')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الحالة الإجتماعية</label><br>
                          <select class="form-control @error('jobID') is-invalid @enderror" id="marriedStatus" name="marriedStatus">
                            <option value="1">أعزب</option>
                            <option value="2">متزوج</option>
                            <option value="3">منفصل</option>
                          </select>
                          @error('district')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">عدد الأبناء</label>
                          <input type="number" class="form-control @error('sonCount') is-invalid @enderror" id="sonCount" name="sonCount" placeholder="اكتب عدد الابناء">
                          @error('sonCount')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الجنسية</label>
                          <input type="text" class="form-control @error('address') is-invalid @enderror" id="nationality" name="nationality" placeholder="اكتب الجنسية">
                          @error('nationality')
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
                  <h3 class="card-title">بيانات الهوية </h3>
                </div>
                <div class="card-body">
                 
                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">رقم الهوية</label>
                            <input type="text"  class="form-control @error('name') is-invalid @enderror" id="idNo" name="idNo" placeholder="اكتب رقم الهوية ">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">تاريخ الإنتهاء </label>
                            <input type="date"  class="form-control @error('idEndDate') is-invalid @enderror" id="idEndDate" name="idEndDate" placeholder="تاريخ الإنتهاء ">
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
                             
                                <option value="{{$job->id}}">{{$job->nameAr}}</option>
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
                             
                                <option value="{{$depart->id}}">{{$depart->nameAr}}</option>
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
                             
                                <option value="{{$depart->id}}">{{$depart->nameAr}}</option>
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
                            <label class="form-control-label" for="input-username">أيام الإجازة </label>
                            <input type="number"  class="form-control @error('holiday') is-invalid @enderror" id="holiday" name="holiday" placeholder="عدد أيام الإجازة الأساسية">
                            @error('holiday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">أيام الإجازة الإضطرارية </label>
                            <input type="number"  class="form-control @error('urgeholiday') is-invalid @enderror" id="urgeholiday" name="urgeholiday" placeholder="عدد أيام الإجازة الإضطرارية">
                            @error('holiday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">الدرجة الوظيفية(إختياري) </label>
                            <input type="text"  class="form-control @error('name') is-invalid @enderror" id="jobClass" name="jobClass" placeholder="اكتب الدرجة الوظيفية ">
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
                            <input type="date"  class="form-control @error('idEndDate') is-invalid @enderror" id="hireDate" name="hireDate" placeholder="اكتب تاريخ التعيين ">
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
                 <!----------------------------------------------------------------------------------------------------------------------------------------------->

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name"> </label>
                      <br>
                      <input type="submit" class="btn btn-primary" value="حفظ" style="width: 100%">
                    </div>
                  </div>
                </div>
              <!-- /.card-body -->
            </form>
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
