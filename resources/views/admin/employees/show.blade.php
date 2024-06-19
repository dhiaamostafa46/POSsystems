@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('HR.Employeedetails') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('HR.Employeedetails') }}</li>
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
                            <h3 class="card-title"> {{ trans('HR.Personaldata') }} </h3>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="card-title floatmleft"><i
                                    class="fa fa-edit"></i> {{ trans('HR.Edit') }} </a>
                        </div>
                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.EmployeeName') }} </label>
                                            <h6>{{ $employee->nameAr }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username"> {{ trans('HR.phone') }}
                                            </label>
                                            <h6>{{ $employee->phone }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.birthday') }} </label>
                                            <h6>{{ $employee->birthday }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username"> {{ trans('HR.Email') }}
                                            </label>
                                            <h6>{{ $employee->email }}</h6>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="input-username">{{ trans('HR.Erea') }}</label>
                                            <h6>{{ $employee->area }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="input-username">{{ trans('HR.city') }}</label>
                                            <h6>{{ $employee->city }}</h6>
                                        </div>
                                    </div>



                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="input-username">{{ trans('HR.Address') }}</label>
                                            <h6>{{ $employee->addressAr }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="input-username">{{ trans('HR.Religion') }}</label>
                                            <h6>{{ $employee->Religion }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="input-username">{{ trans('HR.Gender') }}</label>

                                            @if ($employee->Gender == 0)
                                                <h6>{{ trans('HR.male') }}</h6>
                                            @elseif($employee->Gender == 1)
                                                <h6>{{ trans('HR.Female') }}</h6>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.Nationality') }} </label>
                                            <h6>{{ $employee->nationality }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.numberofchildren') }} </label>
                                            @if ($employee->sonCount > 0)
                                                <h6>{{ $employee->sonCount }}</h6>
                                            @else
                                                <h6>لا يوجد</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.maritalstatus') }} </label>
                                            @if ($employee->marriedStatus == 1)
                                                <h6>{{ trans('HR.single') }}</h6>
                                            @elseif($employee->marriedStatus == 2)
                                                <h6>{{ trans('HR.Married') }}</h6>
                                            @elseif($employee->marriedStatus == 3)
                                                <h6>{{ trans('HR.separate') }}</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('IBN') }} </label>
                                            <h6>{{ $employee->IBN }}</h6>
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
                            <h3 class="card-title"> {{ trans('HR.Identitydata') }} </h3>
                        </div>
                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.typeiqama') }} </label>

                                            @if ($employee->typeiqama == 1)
                                                <h6>{{ trans('HR.Identity') }}</h6>
                                            @elseif($employee->typeiqama == 0)
                                                <h6>{{ trans('HR.iqama') }}</h6>

                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.IDNumber') }} </label>
                                            <h6>{{ $employee->idNo }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.endofidentity') }}</label>
                                            <h6>{{ $employee->idEndDate }}</h6>
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
                            <h3 class="card-title"> {{ trans('HR.Jobdata') }} </h3>
                        </div>
                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username"> {{ trans('HR.Job') }}
                                            </label>
                                            <h6>{{ $employee->job->nameAr ?? ''}}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="input-username">{{ trans('HR.department') }} </label>
                                            <h6>{{ $employee->depart->nameAr ?? '' }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="input-username">{{ trans('HR.permanence') }} </label>
                                            <h6>{{ $employee->shift->nameAr ?? '' }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.Functionalclass') }} </label>
                                            <h6>{{ $employee->jobClass }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.Special') }} </label>
                                            <h6>{{ $employee->Special }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.Dateofhiring') }} </label>
                                            <h6>{{ $employee->hireDate }}</h6>
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
