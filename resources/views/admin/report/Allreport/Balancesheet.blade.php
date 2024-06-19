@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Balancesheet') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">    {{ trans('Report.Balancesheet') }} </li>
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
                <h3 class="card-title">      {{ trans('Report.Balancesheet') }}</h3>
                <h3 class="btn btn-primary floatmleft" >  {{ trans('Report.date') }} :<?php echo date('Y-m-d');?></h3>
              </div>
              <div class="card-body">
                <div class="row rptpg">
                    <div class="col-6">
                        <h2 class="text-muted"> {{ trans('Report.Assets') }}</h2>
                        <table cellspacing="0" cellpadding="4" width="100%"  class="report-table-dashed ">

                            <tbody>
                                <?php $sumOrigins =0;?>
                                @foreach ($Origins as $item)
                                  <tr class=" ">
                                    <td><span class="cell-space">{{$item->AccountID}} --     @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif</td>
                                    <td class="text-right cell-head">{{ ($item->ReportData->creditFrist + $item->ReportData->creditSecond +$item->ReportData->creditThird)-
                                                                           ($item->ReportData->debitFrist + $item->ReportData->debitSecond +$item->ReportData->debitThird) }}</td>
                                  </tr>
                                  <?php  $sumOrigins= $sumOrigins+($item->ReportData->creditFrist + $item->ReportData->creditSecond +$item->ReportData->creditThird)-
                                                                   ($item->ReportData->debitFrist + $item->ReportData->debitSecond +$item->ReportData->debitThird); ?>
                                @endforeach
                                <tr class="h5">
                                    <td><span class="">  {{ trans('Report.Total') }}  </td>
                                    <td class="text-right cell-head"><?php echo $sumOrigins; ?></td>
                                  </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <h2 class="text-muted"> {{ trans('Report.Adversaries') }}</h2>
                        <table cellspacing="0" cellpadding="4" width="100%"  class="report-table-dashed ">
                            <tbody>
                                <?php $sumOpponents =0;?>
                                @foreach ($Opponents as $item)
                                  <tr class=" ">
                                    <td><span class="cell-space">{{$item->AccountID}} --     @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif</td>
                                    <td class="text-right cell-head">{{ ($item->ReportData->creditFrist + $item->ReportData->creditSecond +$item->ReportData->creditThird)-
                                                                         ($item->ReportData->debitFrist + $item->ReportData->debitSecond +$item->ReportData->debitThird) }}</td>
                                  </tr>
                                  <?php  $sumOpponents= $sumOpponents+($item->ReportData->creditFrist + $item->ReportData->creditSecond +$item->ReportData->creditThird)-
                                  ($item->ReportData->debitFrist + $item->ReportData->debitSecond +$item->ReportData->debitThird); ?>
                                @endforeach
                                <tr class="h5">
                                    <td><span class="">   {{ trans('Report.Total') }} </td>
                                    <td class="text-right cell-head"><?php echo $sumOpponents; ?></td>
                                </tr>
                                <tr class="mt-5">
                                    <td><span class="text-muted h3">    {{ trans('Report.Propertyrights') }}</td>
                                    <td class="text-right cell-head"></td>

                                </tr>
                                <?php $sumcapital =0;?>
                                @foreach ($capital as $item)
                                    <tr class=" ">
                                    <td><span class="cell-space">{{$item->AccountID}} --     @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif</td>
                                    <td class="text-right cell-head">{{ ($item->ReportData->creditFrist + $item->ReportData->creditSecond +$item->ReportData->creditThird)-
                                                     ($item->ReportData->debitFrist + $item->ReportData->debitSecond +$item->ReportData->debitThird)  }}</td>
                                    </tr>
                                    <?php  $sumcapital= $sumcapital+($item->ReportData->creditFrist + $item->ReportData->creditSecond +$item->ReportData->creditThird)-
                                    ($item->ReportData->debitFrist + $item->ReportData->debitSecond +$item->ReportData->debitThird); ?>
                                @endforeach
                                <tr class="h5">
                                    <td><span class="">     {{ trans('Report.Total') }} </td>
                                    <td class="text-right cell-head"><?php echo $sumcapital; ?></td>
                                </tr>
                            </tbody>
                        </table>

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
