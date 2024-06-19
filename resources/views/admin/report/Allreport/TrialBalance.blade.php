@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.TrialBalance') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.TrialBalance') }} </li>
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
                <h3 class="card-title">     {{ trans('Report.TrialBalance') }}   </h3>
                <h3 class="btn btn-primary floatmleft" > {{ trans('Report.date') }}  :<?php echo date('Y-m-d');?></h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="border:1pt solid #00000036; border: 1pt solid #00000036">
                            <tr>
                                <th> {{ trans('Report.account') }} </th>
                                <th class="text-center" colspan="2"> {{ trans('Report.InitialBalance') }} </th>
                                <th class="text-center" colspan="2">  {{ trans('Report.Movementsduringtheperiod') }} </th>
                                <th class="text-center" colspan="2"> {{ trans('Report.Closingbalance') }} </th>
                                <th class="text-center" colspan="2">{{ trans('Report.Balance') }}  </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th class="text-center">{{ trans('Report.Debtor') }}</th>
                                <th class="text-center">{{ trans('Report.Creditor') }}</th>
                                <th class="text-center">{{ trans('Report.Debtor') }}</th>
                                <th class="text-center">{{ trans('Report.Creditor') }}</th>
                                <th class="text-center">{{ trans('Report.Debtor') }}</th>
                                <th class="text-center">{{ trans('Report.Creditor') }}</th>
                                <th class="text-center">{{ trans('Report.Debtor') }}</th>
                                <th class="text-center">{{ trans('Report.Creditor') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $sumdeptfrist=0; $sumcreditfrist=0; $sumdebitSecond=0;$sumcreditSecond=0; $sumdebitThird=0; $sumcreditThird=0; ?>
                            @foreach ($TrialBalance as $item)
                                <tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <tr style="border-bottom:1pt solid #00000036;border-top:1pt solid #00000036">
                                    <th>   @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif</th>
                                    <td class="text-center">{{ $item->ReportData->debitFrist}} <?php $sumdeptfrist=$sumdeptfrist+$item->ReportData->debitFrist ;  ?></td>
                                    <td class="text-center">{{ $item->ReportData->creditFrist}}<?php $sumcreditfrist=$sumcreditfrist+$item->ReportData->creditFrist;   ?> </td>
                                    <td class="text-center">{{ $item->ReportData->debitSecond}} <?php $sumdebitSecond=$sumdebitSecond+$item->ReportData->debitSecond ;  ?></td>
                                    <td class="text-center">{{ $item->ReportData->creditSecond}}<?php $sumcreditSecond=$sumcreditSecond+$item->ReportData->creditSecond;   ?></td>
                                    <td class="text-center">{{ $item->ReportData->debitThird}} <?php $sumdebitThird=$sumdebitThird+$item->ReportData->debitThird ;  ?></td>
                                    <td class="text-center">{{ $item->ReportData->creditThird}} <?php $sumcreditThird=$sumcreditThird+$item->ReportData->creditThird  ; ?> </td>
                                    <td class="text-center">{{  ($item->ReportData->debitFrist + $item->ReportData->debitSecond +$item->ReportData->debitThird) }}</td>
                                    <td class="text-center">{{ ($item->ReportData->creditFrist + $item->ReportData->creditSecond +$item->ReportData->creditThird)}}</td>
                                </tr>

                            @endforeach
                            <tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <tr style="border-bottom:1pt solid #00000036;border-top:1pt solid #00000036">
                                <th>{{ trans('Report.Total') }}</th>
                                <td class="text-center"><?php echo $sumdeptfrist;?></td>
                                <td class="text-center"><?php echo $sumcreditfrist;?></td>
                                <td class="text-center"><?php echo $sumdebitSecond;?></td>
                                <td class="text-center"><?php echo $sumcreditSecond;?></td>
                                <td class="text-center"><?php echo $sumdebitThird;?></td>
                                <td class="text-center"><?php echo $sumcreditThird;?></td>
                                <td class="text-center"><?php echo ($sumdeptfrist+$sumdebitSecond +$sumdebitThird);?></td>
                                <td class="text-center"><?php echo ($sumcreditfrist + $sumcreditSecond +  $sumcreditThird );?></td>

                            </tr>
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
