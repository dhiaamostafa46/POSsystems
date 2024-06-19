@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('HR.Editemployees') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
            <li class="breadcrumb-item active"> {{ trans('HR.Editemployees') }}</li>
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
                <h3 class="card-title">  {{ trans('HR.Personaldata') }}   </h3>
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
                          <label class="form-control-label" for="input-username">  {{ trans('HR.EmployeeName') }}</label>
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
                          <label class="form-control-label" for="input-username"> {{ trans('HR.phone') }} </label>
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
                          <label class="form-control-label" for="input-username">{{ trans('HR.Email') }}  ({{ trans('HR.optional') }} ) </label>
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
                            <label class="form-control-label" for="input-username">
                                {{ trans('HR.birthday') }} ({{ trans('HR.optional') }} )</label>
                            <input type="date"
                                class="form-control @error('email') is-invalid @enderror" id="birthday"
                                name="birthday" placeholder="  {{ trans('HR.birthday') }} " value="{{$employee->birthday}}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('HR.Erea') }}</label>
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
                          <label class="form-control-label" for="input-username">{{ trans('HR.city') }}</label>
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
                          <label class="form-control-label" for="input-username">{{ trans('HR.Address') }}</label>
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
                            <label class="form-control-label"
                                for="input-username">{{ trans('HR.Religion') }}</label>
                            <input type="text"
                                class="form-control @error('Religion') is-invalid @enderror"
                                id="Religion" name="Religion"
                                placeholder=" {{ trans('HR.Religion') }}"  value="{{$employee->Religion}}">
                            @error('Religion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label"
                                for="input-username">{{ trans('HR.Gender') }}</label>

                            <select class="form-control @error('jobID') is-invalid @enderror"
                                id="Gender" name="Gender">
                                <option @if ($employee->Gender ==0 ) @selected(true) @endif value="0"> {{ trans('HR.male') }}</option>
                                <option   @if ($employee->Gender ==1) @selected(true) @endif  value="1"> {{ trans('HR.Female') }}</option>

                            </select>
                            @error('Gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('HR.Nationality') }} </label>
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
                          <label class="form-control-label" for="input-username">  {{ trans('HR.numberofchildren') }} </label>
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
                          <label class="form-control-label" for="input-username">{{ trans('HR.maritalstatus') }} </label>
                          <select class="form-control @error('jobID') is-invalid @enderror" id="marriedStatus" name="marriedStatus">
                            <option value="1" @if($employee->marriedStatus == 1) @selected(true) @endif>{{ trans('HR.single') }}</option>
                            <option value="2" @if($employee->marriedStatus == 2) @selected(true) @endif>{{ trans('HR.Married') }}</option>
                            <option value="3" @if($employee->marriedStatus == 3) @selected(true) @endif> {{ trans('HR.separate') }}</option>
                          </select>
                          @error('vatNo')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-username">
                                {{ trans('IBN') }}</label>
                            <input type="text"
                                class="form-control @error('address') is-invalid @enderror"
                                id="IBN" name="IBN" required
                                placeholder="{{ trans('IBN') }}" value="{{$employee->IBN }}">
                            @error('IBN')
                                <span class="invalid-feedback" role="alert" >
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    </div>
                    <!----------------------------------------------------------------------------------------------------------------------------------------------->

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">   {{ trans('HR.Identitydata') }}  </h3>
                </div>
                <div class="card-body">

                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">
                                    {{ trans('HR.typeiqama') }} <span
                                        class="requiredData">*</span></label>
                                <select class="form-control @error('typeiqama') is-invalid @enderror"
                                    id="typeiqama" name="typeiqama">
                                    <option   @if($employee->typeiqama == 1) @selected(true) @endif value="1"> {{ trans('HR.Identity') }}</option>
                                    <option   @if($employee->typeiqama == 0) @selected(true) @endif value="0" selected> {{ trans('HR.iqama') }}</option>
                                </select>
                                @error('typeiqama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">  {{ trans('HR.IDNumber') }} </label>
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
                            <label class="form-control-label" for="input-username">  {{ trans('HR.endofidentity') }} </label>
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
                  <h3 class="card-title">  {{ trans('HR.Jobdata') }}  </h3>
                </div>
                <div class="card-body">

                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">{{ trans('HR.Job') }} </label>



                            <select class="form-control @error('jobID') is-invalid @enderror" id="jobID" name="jobID">
                                <option value="-1"> {{ trans('HR.JobChoose') }}</option>
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
                            <label class="form-control-label" for="input-username">{{ trans('HR.department') }} </label>

                            <select class="form-control @error('depID') is-invalid @enderror" id="depID" name="depID">
                              <option value="-1">  {{ trans('HR.departmentChoose') }} </option>
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
                            <label class="form-control-label" for="input-username"> {{ trans('HR.permanence') }}  </label>

                            <select class="form-control @error('depID') is-invalid @enderror" id="shiftID" name="shiftID">
                              <option value="">  {{ trans('HR.permanenceChoose') }}</option>
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
                            <label class="form-control-label" for="input-username">  {{ trans('HR.Functionalclass') }} </label>
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
                                <label class="form-control-label" for="input-username">
                                    {{ trans('HR.Special') }} </label>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="Special" name="Special"
                                    placeholder="{{ trans('HR.Special') }}" value="{{$employee->Special}}">
                                @error('Special')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username"> {{ trans('HR.Dateofhiring') }} </label>
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
                          <input type="submit" class="btn btn-primary" value="{{ trans('HR.Save') }}" style="width: 100%">
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
