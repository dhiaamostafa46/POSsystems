@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('HR.salaries') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('HR.salaries') }}</li>
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
                            <h3 class="card-title"> {{ trans('HR.details') }} </h3>
                        </div>
                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.basicsalary') }} </label>
                                            <h6>{{ $salaries->basicSalary }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.totalsalary') }} </label>
                                            <h6>{{ $salaries->fullSalary }}</h6>
                                        </div>
                                    </div>

                                    @if (count($salaries->Empallowan) > 0)
                                        @foreach ($salaries->Empallowan as $index => $allowan)
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">
                                                        @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                            {{ $allowan->allow->nameAr ?? '' }}
                                                        @else
                                                            {{ $allowan->allow->nameEn ?? '' }}
                                                        @endif
                                                    </label>
                                                    <h6>{{ $allowan->value }}</h6>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                            <hr>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!----------------------------------------------------------------------------------------------------------------------------------------------->

                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
