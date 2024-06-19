@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('Dadhoard.Dashboard') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#"> {{ trans('Dadhoard.Dashboard') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('Dadhoard.main') }} </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
           
            <form class="row col-6" method="POST" action="{{ route('setPeriod') }}">
                @csrf
                <div class="col-lg-4">
                    <label for=""> {{ trans('Dadhoard.Fromthedateof') }} </label>
                    <input type="date" name="dateFrom" class="form-control" value="{{ session('dateFrom') }}">
                </div>
                <div class="col-lg-4" style="float: none">
                    <label for=""> {{ trans('Dadhoard.Todate') }}</label>
                    <input type="date" name="dateTo" class="form-control" value="{{ session('dateTo') }}">
                </div>
                <div class="col-lg-4" style="float: none">
                    <label for="">&nbsp;</label>
                    <input type="submit" class="form-control btn btn-primary" value=" {{ trans('Dadhoard.search') }}">
                </div>
            </form>
            <div class="row mt-2">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $Inv->Inv}}</h3>
                            <p> {{ trans('Dadhoard.Numberofinvoices') }} </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('orders.index') }}" class="small-box-footer"> {{ trans('Dadhoard.details') }} <i
                                class="fas fa-arrow-circle-left"></i></a>
                        <input type="hidden" name="s1" id="s1" value="{{ $s1 }}">
                        <input type="hidden" name="s2" id="s2" value="{{ $s2 }}">
                        <input type="hidden" name="s3" id="s3" value="{{ $s3 }}">
                        <input type="hidden" name="s4" id="s4" value="{{ $s4 }}">
                        <input type="hidden" name="s5" id="s5" value="{{ $s5 }}">
                        <input type="hidden" name="s6" id="s6" value="{{ $s6 }}">
                        <input type="hidden" name="s7" id="s7" value="{{ $s7 }}">
                        <input type="hidden" name="s8" id="s8" value="{{ $s8 }}">
                        <input type="hidden" name="s9" id="s9" value="{{ $s9 }}">
                        <input type="hidden" name="s10" id="s10" value="{{ $s10 }}">
                        <input type="hidden" name="s11" id="s11" value="{{ $s11 }}">
                        <input type="hidden" name="s12" id="s12" value="{{ $s12 }}">
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                {{ $ordersdetails->sum('total') - $ordersdetails->sum('totalcost') - $outcomes->sum('total') }}
                                <sup style="font-size: 20px">{{ trans('Dadhoard.Rial') }}</sup>
                            </h3>

                            <p> {{ trans('Dadhoard.Netprofit') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('orders.index') }}" class="small-box-footer"> {{ trans('Dadhoard.details') }} <i
                                class="fas fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalStock }}
                                <sup style="font-size: 20px">{{ trans('Dadhoard.Rial') }}</sup>
                            </h3>

                            <p> {{ trans('Dadhoard.Inventoryvalue') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('stocks.index') }}" class="small-box-footer"> {{ trans('Dadhoard.details') }}
                            <i class="fas fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $outcomes->sum('total') }}
                                <sup style="font-size: 20px">{{ trans('Dadhoard.Rial') }}</sup>
                            </h3>

                            <p> {{ trans('Dadhoard.Expenses') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('outcomes.index') }}" class="small-box-footer">
                            {{ trans('Dadhoard.details') }} <i class="fas fa-arrow-circle-left"></i></a>
                        <input type="hidden" name="o1" id="o1" value="{{ $o1 }}">
                        <input type="hidden" name="o2" id="o2" value="{{ $o2 }}">
                        <input type="hidden" name="o3" id="o3" value="{{ $o3 }}">
                        <input type="hidden" name="o4" id="o4" value="{{ $o4 }}">
                        <input type="hidden" name="o5" id="o5" value="{{ $o5 }}">
                        <input type="hidden" name="o6" id="o6" value="{{ $o6 }}">
                        <input type="hidden" name="o7" id="o7" value="{{ $o7 }}">
                        <input type="hidden" name="o8" id="o8" value="{{ $o8 }}">
                        <input type="hidden" name="o9" id="o9" value="{{ $o9 }}">
                        <input type="hidden" name="o10" id="o10" value="{{ $o10 }}">
                        <input type="hidden" name="o11" id="o11" value="{{ $o11 }}">
                        <input type="hidden" name="o12" id="o12" value="{{ $o12 }}">
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- right col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card" style="height: 500px">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                {{ trans('Dadhoard.Salesandexpenses') }}
                            </h3>
                            <div class="card-tools">
                                <input type="hidden" name="cash" id="cash"
                                    value="{{ $month_orders->where('type', 1)->sum('totalwvat') }}">
                                <input type="hidden" name="acc" id="acc"
                                    value="{{ $month_orders->where('type', 2)->sum('totalwvat') }}">
                                <input type="hidden" name="post" id="post"
                                    value="{{ $month_orders->where('type', 3)->sum('totalwvat') }}">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">
                                            {{ trans('Dadhoard.Monthly') }} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sales-chart" data-toggle="tab">
                                            {{ trans('Dadhoard.cashnetwork') }} </a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative; height: 300px;">
                                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.right col -->
                <!-- left col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">
                    <!-- solid sales graph -->
                    <div class="card bg-gradient-info" style="height: 500px">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-th mr-1"></i>
                                {{ trans('Dadhoard.Monthlyprofits') }}
                            </h3>
                            <input type="hidden" name="r1" id="r1" value="{{ $s1 - $v1 - $o1 }}">
                            <input type="hidden" name="r2" id="r2" value="{{ $s2 - $v1 - $o1 }}">
                            <input type="hidden" name="r3" id="r3" value="{{ $s3 - $v1 - $o1 }}">
                            <input type="hidden" name="r4" id="r4" value="{{ $s4 - $v1 - $o1 }}">
                            <input type="hidden" name="r5" id="r5" value="{{ $s5 - $v1 - $o1 }}">
                            <input type="hidden" name="r6" id="r6" value="{{ $s6 - $v1 - $o1 }}">
                            <input type="hidden" name="r7" id="r7" value="{{ $s7 - $v1 - $o1 }}">
                            <input type="hidden" name="r8" id="r8" value="{{ $s8 - $v1 - $o1 }}">
                            <input type="hidden" name="r9" id="r9" value="{{ $s9 - $v1 - $o1 }}">
                            <input type="hidden" name="r10" id="r10" value="{{ $s10 - $v1 - $o1 }}">
                            <input type="hidden" name="r11" id="r11" value="{{ $s11 - $v1 - $o1 }}">
                            <input type="hidden" name="r12" id="r12" value="{{ $s12 - $v1 - $o1 }}">
                            <div class="card-tools">
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas class="chart" id="line-chart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <input type="text" class="knob" data-readonly="true"
                                        value="{{ $orders->sum('totalwvat') }}" data-width="60" data-height="60"
                                        data-fgColor="#39CCCC">

                                    <div class="text-white"> {{ trans('Dadhoard.sales') }}</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <input type="text" class="knob" data-readonly="true"
                                        value="{{ $orders->sum('totalvat') }}" data-width="60" data-height="60"
                                        data-fgColor="#39CCCC">

                                    <div class="text-white"> {{ trans('Dadhoard.Tax') }}</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <input type="text" class="knob" data-readonly="true"
                                        value="{{ $orders->sum('totalwvat') - $orders->sum('totalvat') }}"
                                        data-width="60" data-height="60" data-fgColor="#39CCCC">

                                    <div class="text-white"> {{ trans('Dadhoard.Netsales') }} </div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- left col -->
            </div>
            <!-- /.row (main row) -->
            <div class="row">

                @foreach (auth()->user()->organization->branches as $branch)
                  <div class="col-lg-3 col-md-12 ">
                    <div class="card">
                      <div class="card-header">
                        {{$branch->nameAr}}
                      </div>
                      <div class="card-body">
                        <div class="row">

                          <div class="col-7 text-left"> {{ trans('Report.sales') }}</div><div class="col-5">{{$branch->sales->sum('totalwvat') +$branch->salesInv->sum('totalwvat')}}</div>
                          <div class="col-7 text-left">  {{ trans('Report.Creditnotes') }}</div><div class="col-5">{{$branch->Credorder->sum('totalwvat') }}</div>
                          <div class="col-7 text-left"> {{ trans('Report.Purchases') }}</div><div class="col-5">{{$branch->purchases->sum('totalwvat')}}</div>
                          <div class="col-7 text-left">  {{ trans('Report.Citynotices') }}</div><div class="col-5">{{$branch->Debitorder->sum('totalwvat') }}</div>
                          <div class="col-7 text-left"> {{ trans('Report.Expenses') }} </div><div class="col-5">{{$branch->outcomes->sum('total')}}</div>
                          <div class="col-7 text-left">{{ trans('Sale.tax') }}  {{ trans('Report.sales') }}</div><div class="col-5">{{$branch->sales->sum('totalvat') + $branch->salesInv->sum('totalvat')}}</div>
                          <div class="col-7 text-left"> {{ trans('Sale.tax') }}  {{ trans('Report.Purchases') }}</div><div class="col-5">{{$branch->purchases->sum('totalvat')}}</div>
                        </div>
                      </div>
                    </div>
                </div>
              @endforeach
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        <input type="hidden" id="monthidvaluname"
            value="يناير,فبراير,مارس,ابريل,مايو,يونيو,يوليو,اغسطس,سبتمبر,اكتوبر,نوفمبر,ديسمبر">
    @else
        <input type="hidden" id="monthidvaluname"
            value='January,February,March,April,May,June,July,August,September,October,November,December'>
    @endif



    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="MassageCompleteOrgansetion" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> عزيزي العميل هل تريد إكمال بيانات المنشأة</h1>

                </div>
                <div class="modal-footer">
                    <button type="button" onclick="CloseModel()" class="btn btn-secondary" data-bs-dismiss="modal">
                        تخطي </button>
                    <a type="button" href="{{ route('organizations.edit', auth()->user()->orgID) }}"
                        class="btn btn-primary"> إكمال </a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            @if ($Orgflagcomplate == 1)
                $('#MassageCompleteOrgansetion').modal('show');
            @endif
        });

        function CloseModel() {
            $('#MassageCompleteOrgansetion').modal('hide');
        }
    </script>
@endsection
