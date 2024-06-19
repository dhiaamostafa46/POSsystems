@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Ledgersummary') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Ledgersummary') }} </li>
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
                <h3 class="card-title">     {{ trans('Report.Ledgersummary') }}    </h3>
                <h3 class="btn btn-primary floatmleft" >{{ trans('Report.date') }}  :<?php echo date('Y-m-d');?></h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="border:1pt solid #00000036; border: 1pt solid #00000036">
                            <tr>
                                <th> {{ trans('Report.number') }}  </th>
                                <th>  {{ trans('Report.accountnumber') }} </th>
                                <th> {{ trans('Report.theaccount') }}</th>
                                <th class="text-center">{{ trans('Report.Debtor') }}</th>
                                <th class="text-center">{{ trans('Report.Creditor') }}</th>
                                <th class="text-center"> {{ trans('Report.Balance') }} </th>

                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($TrialBalance as $index=>$item)
                                <tr>
                                    <th> {{ $index}}</th>
                                    <th> {{$item->AccountID}}</th>
                                    <th>    @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif </th>

                                    <th class="text-center">{{ $item->ReportData->debitFrist + $item->ReportData->debitSecond +$item->ReportData->debitThird}}</th>
                                    <th class="text-center">{{ $item->ReportData->creditFrist + $item->ReportData->creditSecond +$item->ReportData->creditThird}}</th>
                                    <th class="text-center">{{ ($item->ReportData->creditFrist + $item->ReportData->creditSecond +$item->ReportData->creditThird)-
                                                               ($item->ReportData->debitFrist + $item->ReportData->debitSecond +$item->ReportData->debitThird)}}</th>


                                </tr>

                            @endforeach

                        </tbody>
                    </table>
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
