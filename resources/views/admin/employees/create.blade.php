@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('HR.Addemployees') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('HR.Addemployees') }}</li>
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
                    <form class="user" method="POST" action="{{ route('employees.store') }}"
                        enctype = "multipart/form-data">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> {{ trans('HR.Personaldata') }} </h3>
                            </div>
                            <div class="card-body">

                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.EmployeeName') }} <span
                                                        class="requiredData">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="nameAr"
                                                    name="nameAr" placeholder="   {{ trans('HR.EmployeeName') }}" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.phone') }} <span class="requiredData">*</span></label>
                                                <input type="phone" pattern="[0-9]{10}" maxlength="10"
                                                    oninvalid="this.setCustomValidity('ادخل رقم جوال حقيقي')"
                                                    oninput="this.setCustomValidity('')" minlength="10"
                                                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                                                    name="phone" placeholder=" {{ trans('HR.phone') }} " required>
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Email') }} ({{ trans('HR.optional') }} )</label>
                                                <input type="text"
                                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                                    name="email" placeholder="  {{ trans('HR.Email') }} ">
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
                                                    name="birthday" placeholder="  {{ trans('HR.birthday') }} ">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                    for="input-username">{{ trans('HR.Erea') }}</label>
                                                <input type="text"
                                                    class="form-control @error('area') is-invalid @enderror" id="area"
                                                    name="area" placeholder=" {{ trans('HR.Erea') }}">
                                                @error('area')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                    for="input-username">{{ trans('HR.city') }}</label>
                                                <input type="text"
                                                    class="form-control @error('city') is-invalid @enderror" id="city"
                                                    name="city" placeholder="{{ trans('HR.city') }}">
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                    for="input-username">{{ trans('HR.Address') }}</label>
                                                <input type="text"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    id="address" name="addressAr"
                                                    placeholder=" {{ trans('HR.Address') }}">
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
                                                    placeholder=" {{ trans('HR.Religion') }}">
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
                                                    <option value="0"> {{ trans('HR.male') }}</option>
                                                    <option value="1"> {{ trans('HR.Female') }}</option>

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
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.maritalstatus') }}</label><br>
                                                <select class="form-control @error('jobID') is-invalid @enderror"
                                                    id="marriedStatus" name="marriedStatus">
                                                    <option value="1"> {{ trans('HR.single') }}</option>
                                                    <option value="2"> {{ trans('HR.Married') }}</option>
                                                    <option value="3"> {{ trans('HR.separate') }}</option>
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
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.numberofchildren') }}</label>
                                                <input type="number"
                                                    class="form-control @error('sonCount') is-invalid @enderror"
                                                    id="sonCount" name="sonCount"
                                                    placeholder="{{ trans('HR.numberofchildren') }}">
                                                @error('sonCount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Nationality') }} <span
                                                        class="requiredData">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    id="nationality" name="nationality" required
                                                    placeholder="{{ trans('HR.Nationality') }}">
                                                @error('nationality')
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
                                                    placeholder="{{ trans('IBN') }}">
                                                @error('IBN')
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
                                <h3 class="card-title"> {{ trans('HR.Identitydata') }} </h3>
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
                                                    <option value="1"> {{ trans('HR.Identity') }}</option>
                                                    <option value="0" selected> {{ trans('HR.iqama') }}</option>
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
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.IDNumber') }} <span class="requiredData">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="idNo" name="idNo"
                                                    placeholder="    {{ trans('HR.IDNumber') }}  ">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.endofidentity') }} <span
                                                        class="requiredData">*</span></label>
                                                <input type="date"
                                                    class="form-control @error('idEndDate') is-invalid @enderror"
                                                    id="idEndDate" name="idEndDate"
                                                    placeholder="  {{ trans('HR.endofidentity') }} " required>
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
                                <h3 class="card-title"> {{ trans('HR.Jobdata') }} </h3>
                            </div>
                            <div class="card-body">

                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Job') }} <span class="requiredData">*</span></label>



                                                <select class="form-control @error('jobID') is-invalid @enderror"
                                                    id="jobID" name="jobID" required>
                                                    <option value="-1"> {{ trans('HR.JobChoose') }}</option>
                                                    @if (count($jobs) > 0)
                                                        @foreach ($jobs as $index => $job)
                                                            <option value="{{ $job->id }}">{{ $job->nameAr }}
                                                            </option>
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
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.department') }} <span
                                                        class="requiredData">*</span></label>

                                                <select class="form-control @error('depID') is-invalid @enderror"
                                                    id="depID" name="depID" required>
                                                    <option value="-1"> {{ trans('HR.departmentChoose') }} </option>
                                                    @if (count($departs) > 0)
                                                        @foreach ($departs as $index => $depart)
                                                            <option value="{{ $depart->id }}">{{ $depart->nameAr }}
                                                            </option>
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
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.permanence') }} <span
                                                        class="requiredData">*</span></label>

                                                <select class="form-control @error('depID') is-invalid @enderror"
                                                    id="shiftID" name="shiftID" onchange="showAddModal(this)" required>
                                                    <option value=""> {{ trans('HR.permanenceChoose') }} </option>
                                                    @if (count(auth()->user()->organization->shifts) > 0)
                                                        @foreach (auth()->user()->organization->shifts as $index => $depart)
                                                            <option value="{{ $depart->id }}">{{ $depart->nameAr }}
                                                            </option>
                                                        @endforeach
                                                    @endif

                                                    <option value="-1">

                                                        أضف دوام

                                                    </option>
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
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Vacationdays') }} </label>
                                                <input type="number"
                                                    class="form-control @error('holiday') is-invalid @enderror"
                                                    id="holiday" name="holiday" value="0"
                                                    placeholder="  {{ trans('HR.Vacationdays') }}">
                                                @error('holiday')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Emergencyleavedays') }} </label>
                                                <input type="number"
                                                    class="form-control @error('urgeholiday') is-invalid @enderror"
                                                    id="urgeholiday" name="urgeholiday" value="0"
                                                    placeholder="  {{ trans('HR.Emergencyleavedays') }}">
                                                @error('holiday')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.advance') }}</label>
                                                <input type="number"
                                                    class="form-control @error('advance') is-invalid @enderror"
                                                    id="advance" name="advance" value="0"
                                                    placeholder="  {{ trans('HR.advance') }}">
                                                @error('advance')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Functionalclass') }} </label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="jobClass" name="jobClass"
                                                    placeholder="{{ trans('HR.Functionalclass') }}">
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
                                                    placeholder="{{ trans('HR.Special') }}">
                                                @error('Special')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Dateofhiring') }} <span
                                                        class="requiredData">*</span></label>
                                                <input type="date"
                                                    class="form-control @error('idEndDate') is-invalid @enderror"
                                                    id="hireDate" name="hireDate"
                                                    placeholder="{{ trans('HR.Dateofhiring') }} " required>
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
                                    <input type="submit" class="btn btn-primary" value="{{ trans('HR.Save') }}"
                                        style="width: 100%">
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
        <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <!-- Create Modal -->
        <div class="modal fade modal" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('HR.Newdepartments') }}
                        </h5>
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>-->
                    </div>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">{{ trans('HR.NameArabic') }}
                                        <span class="requiredData">*</span></label>
                                    <input type="text" class="form-control @error('nameAr') is-invalid @enderror"
                                        id="nameAr" name="nameAr" placeholder="{{ trans('HR.NameArabic') }}">
                                    @error('nameAr')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">{{ trans('HR.NameEnglish') }}
                                        <span class="requiredData">*</span></label>
                                    <input type="text" class="form-control @error('nameEn') is-invalid @enderror"
                                        id="nameEn" onkeypress="return ValidateKey();" name="nameEn"
                                        placeholder="{{ trans('HR.NameEnglish') }}">
                                    @error('nameEn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">
                                        {{ trans('HR.Permanenttype') }} <span class="requiredData">*</span> </label>
                                    <div class="form-check">
                                        <input id="TypeProdect" name="type" value="1" type="radio"
                                            onclick="showTime()" class="form-check-input">
                                        <label class="form-check-label" for="credit">
                                            {{ trans('HR.constant') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="TypeProdect" name="type" value="2" type="radio"
                                            onclick="hideTime()" class="form-check-input">
                                        <label class="form-check-label" for="debit"> {{ trans('HR.flexible') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">
                                        {{ trans('HR.numberofhours') }}</label>
                                    <input type="text" class="form-control @error('hours') is-invalid @enderror"
                                        id="hours" name="hours" placeholder="{{ trans('HR.numberofhours') }}"
                                        required>
                                    @error('hours')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6" id="stTime" style="display: none">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username"> {{ trans('HR.Fromhour') }}
                                        <span class="requiredData">*</span></label>
                                    <input type="time"
                                        class="form-control text-right @error('stTime') is-invalid @enderror"
                                        id="stTime" name="stTime" placeholder="{{ trans('HR.Fromhour') }}">
                                    @error('stTime')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6" id="enTime" style="display: none">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username"> {{ trans('HR.tohour') }}
                                    </label>
                                    <input type="time"
                                        class="form-control text-right @error('enTime') is-invalid @enderror"
                                        id="enTime" name="enTime" placeholder=" {{ trans('HR.tohour') }} ">
                                    @error('enTime')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name"> </label>
                                    <br>
                                    <!--<input type="submit" class="btn btn-primary" value=" {{ trans('HR.Save') }} " style="width: 100%">-->
                                    <button class="btn btn-primary" style="width: 100%"
                                        onclick="addShift()">{{ trans('HR.Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    </section>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        function availableT() {
            if (document.getElementById('availableTime').checked == true) {
                document.getElementById('sfrom').style.display = "block";
                document.getElementById('sto').style.display = "block";
            } else {
                document.getElementById('sfrom').style.display = "none";
                document.getElementById('sto').style.display = "none";
            }
        }

        function showAddModal(obj) {
            //alert('test');
            if (obj.value == -1) {
                $('#CreateModal').modal('show')
            }

        }

        function showTime() {

            document.getElementById('stTime').style.display = "block";
            document.getElementById('enTime').style.display = "block";


        }

        function hideTime() {

            document.getElementById('stTime').style.display = "none";
            document.getElementById('enTime').style.display = "none";

        }

        //   function route(obj){
        //     if(obj.value == -1)
        //     {
        //       window.location.href = "/prodcategories/create"
        //     };
        //   }
        function addShift() {
            alert('test');
            $.post("/storeShift", {
                    nameAr: "shift1",
                    nameEn: "shift1",
                    type: 2,
                    hours: 5,
                    stTime: "Donald Duck",
                    enTime: "Duckburg"
                },
                function(data, status) {
                    alert("Data: " + data + "\nStatus: " + status);
                });
            //   data ="";
            //      @foreach (auth()->user()->organization->prodcategoriesKatcSaller as $product)
            //                 data = data+'<option value="{{ $product->id }}">{{ $product->nameAr }}</option>';
            //      @endforeach

            //      $('.CategouryAllitemsKat').empty();

            //      $('.CategouryAllitemsKat').append(data);
        }
    </script>
@endsection
