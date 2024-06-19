@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('Report.Ledgerforacurrentaccount') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#"> {{ trans('Report.Listofreports') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('Report.Ledgerforacurrentaccount') }} </li>
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
                            <h3 class="card-title"> {{ trans('Report.Ledgerforacurrentaccount') }} </h3>
                            <h3 class="btn btn-primary floatmleft">{{ trans('Report.date') }} :<?php echo date('Y-m-d'); ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered ">
                                    <thead>

                                        <tr class="report-results-head text-center">
                                            <th rowspan="2" style="width: 79px;">
                                                {{ trans('Report.Registrationnumber') }} </th>

                                            <th rowspan="2" style="width: 94px;">{{ trans('Report.date') }}</th>

                                            <th rowspan="2" style="width: 321px;"> {{ trans('Report.description') }}
                                            </th>
                                            <th colspan="2" style="width: 254px;"> {{ trans('Report.Operation') }} </th>
                                            <th colspan="2" style="width: 170px;"> {{ trans('Report.Balance1') }} </th>
                                        </tr>
                                        <tr>
                                            <td class="text-center">{{ trans('Report.Debtor') }} </td>
                                            <td class="text-center">{{ trans('Report.Creditor') }} </td>
                                            <td class="text-center">{{ trans('Report.Debtor') }} </td>
                                            <td class="text-center">{{ trans('Report.Creditor') }} </td>
                                        </tr>
                                        <tr class="sub-head">
                                            <td colspan="7" style =' font-weight: bold;'> {{ $name }} &nbsp;
                                                &nbsp; &nbsp; &nbsp;{{ $code }} </td>
                                        </tr>
                                        <tr>
                                            <?php $Debit = 0;
                                            $balanceDebit = $OpeningBalances->sum('Debit');
                                            $Credit = 0;
                                            $balanceCredit = $OpeningBalances->sum('Credit'); ?>
                                            <td colspan="5"> {{ trans('Report.InitialBalance') }}</td>
                                            <td class="text-center"> <?php echo $balanceDebit; ?> </td>
                                            <td class="text-center"> <?php echo $balanceCredit; ?> </td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (count($Order) > 0)
                                            @foreach ($Order as $index => $account)
                                                <tr class="indent-td">

                                                    <td>
                                                        <strong>
                                                            <a href="/owner/journals/view/1">{{ $account->id }}</a>
                                                        </strong>
                                                    </td>

                                                    <td><?php echo date('d/m/Y', strtotime($account->created_at)); ?></td>

                                                    <td> {{ trans('Report.sales') }} {{ $account->id }} </td>
                                                    @if ($falagesale == 0)
                                                        <td class="text-center">
                                                           
                                                               {{ $account->totaldis }}    <?php $Debit += $account->totaldis;    $balanceDebit += $account->totaldis; ?>

                                                        </td>
                                                        <td class="text-center">0</td>
                                                    @else
                                                        <td class="text-center">0 </td>
                                                        <td class="text-center">{{ $account->totaldis }}
                                                            <?php $Credit += $account->totaldis;
                                                            $balanceCredit += $account->totaldis; ?></td>
                                                    @endif
                                                    <td class="text-center"> <?php echo $balanceDebit; ?> </td>
                                                    <td class="text-center"> <?php echo $balanceCredit; ?> </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if (count($Purchase) > 0)
                                            @foreach ($Purchase as $index => $Purch)
                                                <tr class="indent-td">
                                                    <td><strong><a
                                                                href="/owner/journals/view/1">{{ $Purch->id }}</a></strong>
                                                    </td>
                                                    <td><?php echo date('d/m/Y', strtotime($Purch->created_at)); ?></td>
                                                    <td> {{ trans('Report.Purchases') }} {{ $Purch->id }} </td>
                                                    @if ($falagpurches == 0)
                                                        <td class="text-center">0</td>
                                                        <td class="text-center">{{ $Purch->totaldis }}
                                                            <?php $Credit += $Purch->totaldis;
                                                            $balanceCredit += $Purch->totaldis; ?></td>
                                                    @else
                                                        <td class="text-center">{{ $Purch->totaldis }}
                                                            <?php $Debit += $Purch->totaldis;
                                                            $balanceDebit += $Purch->totaldis; ?></td>
                                                        <td class="text-center">0 </td>
                                                    @endif
                                                    <td class="text-center"> <?php echo $balanceDebit; ?> </td>
                                                    <td class="text-center"> <?php echo $balanceCredit; ?> </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if (count($Invoice) > 0)
                                            @foreach ($Invoice as $index => $Invoic)
                                                <tr class="indent-td">
                                                    <td><strong><a
                                                                href="/owner/journals/view/1">{{ $Invoic->id }}</a></strong>
                                                    </td>
                                                    <td><?php echo date('d/m/Y', strtotime($Invoic->created_at)); ?></td>

                                                    @if ($Invoic->type == 1)
                                                        <td> {{ trans('Report.receipt') }} {{ $Invoic->id }} </td>
                                                        @if ($falagsandat == 1)
                                                            <td class="text-center">0</td>
                                                            <td class="text-center">{{ $Invoic->total }}
                                                                <?php $Credit += $Invoic->total;
                                                                $balanceCredit += $Invoic->total; ?></td>
                                                        @else
                                                            <td class="text-center">{{ $Invoic->total }}
                                                                <?php $Debit += $Invoic->total;
                                                                $balanceDebit += $Invoic->total; ?></td>
                                                            <td class="text-center">0 </td>
                                                        @endif
                                                    @else
                                                        <td> {{ trans('Report.Billsofexchange') }} {{ $Invoic->id }}
                                                        </td>
                                                        @if ($falagsandat == 2)
                                                            <td class="text-center">{{ $Invoic->total }}
                                                                <?php $Debit += $Invoic->total;
                                                                $balanceDebit += $Invoic->total; ?></td>
                                                            <td class="text-center">0 </td>
                                                        @else
                                                            <td class="text-center">0</td>
                                                            <td class="text-center">{{ $Invoic->total }}
                                                                <?php $Credit += $Invoic->total;
                                                                $balanceCredit += $Invoic->total; ?></td>
                                                        @endif
                                                    @endif
                                                    <td class="text-center"> <?php echo $balanceDebit; ?> </td>
                                                    <td class="text-center"> <?php echo $balanceCredit; ?> </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if (count($JournalSub) > 0)
                                            @foreach ($JournalSub as $index => $Journa)
                                                <tr class="indent-td">
                                                    <td><strong><a
                                                                href="/owner/journals/view/1">{{ $Journa->id }}</a></strong>
                                                    </td>
                                                    <td><?php echo date('d/m/Y', strtotime($Journa->date)); ?></td>
                                                    <td> {{ trans('Report.Dailyrestrictions') }} {{ $Journa->id }} </td>
                                                    <td class="text-center">{{ $Journa->Debit }} <?php $Debit += $Journa->Debit;
                                                    $balanceDebit += $Journa->Debit; ?></td>
                                                    <td class="text-center">{{ $Journa->Credit }} <?php $Credit += $Journa->Credit;
                                                    $balanceCredit += $Journa->Credit; ?></td>
                                                    <td class="text-center"> <?php echo $balanceDebit; ?> </td>
                                                    <td class="text-center"> <?php echo $balanceCredit; ?> </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if (count($DepotStore) > 0)
                                            @foreach ($DepotStore[0]->Stock as $index => $DepotSto)
                                                <tr class="indent-td">
                                                    <td><strong><a
                                                                href="/owner/journals/view/1">{{ $DepotSto->id }}</a></strong>
                                                    </td>
                                                    <td><?php echo date('d/m/Y', strtotime($DepotSto->created_at)); ?></td>
                                                    <td> حركة مخزون {{ $DepotSto->id }} </td>
                                                    <td class="text-center">
                                                        {{ $DepotSto->quantityIn * $DepotSto->product->costPrice }}
                                                        <?php $Debit += $DepotSto->quantityIn * $DepotSto->product->costPrice;
                                                        $balanceDebit += $DepotSto->quantityIn * $DepotSto->product->costPrice; ?></td>
                                                    <td class="text-center">
                                                        {{ $DepotSto->quantityOut * $DepotSto->product->costPrice }}
                                                        <?php $Credit += $DepotSto->quantityOut * $DepotSto->product->costPrice;
                                                        $balanceCredit += $DepotSto->quantityOut * $DepotSto->product->costPrice; ?></td>
                                                    <td class="text-center"> <?php echo $balanceDebit; ?> </td>
                                                    <td class="text-center"> <?php echo $balanceCredit; ?> </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if (count($credorders) > 0)
                                            @foreach ($credorders as $index => $credord)
                                                <tr class="indent-td">
                                                    <td><strong><a
                                                                href="/owner/journals/view/1">{{ $credord->id }}</a></strong>
                                                    </td>
                                                    <td><?php echo date('d/m/Y', strtotime($credord->created_at)); ?></td>
                                                    <td> {{ trans('Report.Creditnotes') }} {{ $credord->id }} </td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">{{ $credord->totaldis }} <?php $Credit += $credord->totaldis;
                                                    $balanceCredit += $credord->totaldis; ?>
                                                    </td>
                                                    <td class="text-center"> <?php echo $balanceDebit; ?> </td>
                                                    <td class="text-center"> <?php echo $balanceCredit; ?> </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if (count($OutCome) > 0)
                                            @foreach ($OutCome as $index => $Out)
                                                <tr class="indent-td">
                                                    <td><strong><a
                                                                href="/owner/journals/view/1">{{ $Out->id }}</a></strong>
                                                    </td>
                                                    <td><?php echo date('d/m/Y', strtotime($Out->created_at)); ?></td>
                                                    <td> {{ trans('Report.Expenses') }} {{ $Out->id }} </td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">{{ $Out->total }} <?php $Credit += $Out->total;
                                                    $balanceCredit += $Out->total; ?></td>
                                                    <td class="text-center"> <?php echo $balanceDebit; ?> </td>
                                                    <td class="text-center"> <?php echo $balanceCredit; ?> </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if (count($depiteOrder) > 0)
                                            @foreach ($depiteOrder as $index => $credord)
                                                <tr class="indent-td">
                                                    <td><strong><a
                                                                href="/owner/journals/view/1">{{ $credord->id }}</a></strong>
                                                    </td>
                                                    <td><?php echo date('d/m/Y', strtotime($credord->created_at)); ?></td>
                                                    <td> {{ trans('Report.Citynotices') }} {{ $credord->id }} </td>
                                                    <td class="text-center">{{ $credord->totaldis }} <?php $Debit += $credord->totaldis;
                                                    $balanceDebit += $credord->totaldis; ?>
                                                    </td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center"> <?php echo $balanceDebit; ?> </td>
                                                    <td class="text-center"> <?php echo $balanceCredit; ?> </td>
                                                </tr>
                                            @endforeach
                                        @endif








                                        <tr class="section-net" style =' font-weight: bold;'>
                                            <td colspan="3" class="first-column">{{ trans('Report.Total') }} (SAR)
                                            </td>
                                            <td class="text-center"><?php echo $Debit; ?></td>
                                            <td class="text-center"><?php echo $Credit; ?></td>
                                            <td class="text-center"><?php echo $balanceDebit; ?></td>
                                            <td class="text-center"> <?php echo $balanceCredit; ?></td>
                                        </tr>
                                        <tr class="section-net" style =' font-weight: bold;'>
                                            <td colspan="5" class="first-column">{{ trans('Report.Balance1') }}</td>
                                            <td colspan="2" class="text-center"> <?php echo $balanceDebit - $balanceCredit; ?></td>
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
