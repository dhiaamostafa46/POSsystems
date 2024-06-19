@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.accountstatement') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.accountstatement') }} </li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">    {{ trans('Report.accountstatement') }}  </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example4"  class="table table-bordered table-hover text-center ">
                  <thead>
                  <tr>
                    <th> {{ trans('Report.number') }}</th>
                    <th > {{ trans('Report.date') }} </th>
                    <th>  {{ trans('Report.Operationtype') }}   </th>
                    <th>  {{ trans('Report.Registrationnumber') }}   </th>
                    <th>   {{ trans('Report.details') }} </th>
                    <th>  {{ trans('Report.Debtor') }}  </th>
                    <th>  {{ trans('Report.Creditor') }}   </th>
                    <th>  {{ trans('Report.Debitbalance') }} </th>
                    <th>   {{ trans('Report.creditbalance') }} </th>
                    <th>     {{ trans('Report.accountname') }}   </th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $sumdept=0; $sumCredit=0;  $countALL=1;?>
                    @if (count($OpeningBalances) > 0)
                        @foreach ($OpeningBalances as $index => $OpeningBal)
                            <tr>
                                <th><?php echo $countALL++ ;?> </th>
                                <td><?php echo date("d-m-Y", strtotime( $OpeningBal->date)); ?></td>
                                <td>  {{ trans('Report.InitialBalance') }} </td>
                                <td>{{$OpeningBal->id}}</td>
                                <td>{{$OpeningBal->desc}}</td>
                                <td>- <?php  $sumdept += $OpeningBal->Debit;?></td>
                                <td>-</td>
                                <th> <?php  echo $sumdept ;?>  </th>
                                <th> <?php  echo $sumCredit ;?>  </th>
                                <td>{{$OpeningBal->nameAccount}}</td>
                            </tr>
                        @endforeach
                    @endif

                  @if (count($Order) > 0)
                      @foreach ($Order as $index => $account)
                      <tr>
                        <th><?php echo $countALL++ ;?> </th>
                        <td><?php echo date("d-m-Y", strtotime( $account->created_at)); ?></td>
                        <td> {{ trans('Report.sales') }}</td>
                        <td>{{$account->id}}</td>
                        <td> {{ trans('Report.sales') }}</td>
                            @if ($falagesale ==0)
                                <td>{{$account->totaldis}}  <?php  $sumdept +=$account->totaldis ;?> </td>
                                <td>0</td>
                                <th>  <?php  echo $sumdept ;?>  </th>
                                <th>  <?php  echo $sumCredit ;?>  </th>
                                <td>{{$account->NameAcount}}</td>
                            @else
                                <td>0 </td>
                                <td>{{$account->totaldis}}  <?php  $sumCredit +=$account->totaldis ;?></td>
                                <th>  <?php  echo $sumdept ;?>  </th>
                                <th>  <?php  echo $sumCredit ;?>  </th>
                                <td> {{ trans('Report.sales') }}</td>
                            @endif
                            {{-- <td><?php  echo $sumdept ;?></td> --}}
                      </tr>
                      @endforeach
                  @endif

                    @if (count($Purchase) > 0)
                        @foreach ($Purchase as $index => $Purch)
                            <tr>
                                <th><?php echo $countALL++ ;?> </th>
                                <td><?php echo date("d-m-Y", strtotime( $Purch->created_at)); ?></td>
                                <td> {{ trans('Report.Purchases') }}</td>
                                <td>{{$Purch->id}}</td>
                                <td> {{ trans('Report.Purchases') }}</td>
                                    @if ($falagpurches ==0)
                                        <td>0</td>
                                        <td>{{$Purch->totaldis}}   <?php  $sumCredit +=$Purch->totaldis ;?> </td>
                                        <th>  <?php  echo $sumdept ;?>  </th>
                                        <th>  <?php  echo $sumCredit ;?>  </th>
                                        <td>{{$Purch->NameAcount}}</td>
                                    @else
                                        <td>{{$Purch->totaldis}}   <?php  $sumCredit +=$Purch->totaldis ;?> </td>
                                        <td>0</td>
                                        <th>  <?php  echo $sumdept ;?>  </th>
                                        <th>  <?php  echo $sumCredit ;?>  </th>
                                        <td> {{ trans('Report.Purchases') }}</td>
                                    @endif
                            </tr>
                        @endforeach
                    @endif
                    @if (count($Invoice) > 0)
                        @foreach ($Invoice as $index => $Invoic)
                            <tr>
                                <th><?php echo $countALL++ ;?> </th>
                                <td><?php echo date("d-m-Y", strtotime( $Invoic->created_at)); ?></td>
                                @if ($Invoic->type==1)
                                    <td>  {{ trans('Report.receipt') }}</td>
                                    <td>{{$Invoic->id}}</td>
                                    <td> {{$Invoic->comment}}</td>
                                    <td>0</td>
                                    <td>{{$Invoic->total}}  <?php  $sumCredit +=$Invoic->total;?> </td>

                                @else
                                    <td>  {{ trans('Report.Billsofexchange') }}</td>
                                    <td>{{$Invoic->id}}</td>
                                    <td> {{$Invoic->comment}}</td>
                                    @if ($falagsandat ==2)
                                        <td>{{$Invoic->total}}  <?php  $sumdept +=$Invoic->total;?> </td>
                                        <td>0</td>
                                    @else
                                      <td>0</td>
                                      <td>{{$Invoic->total}}  <?php  $sumCredit +=$Invoic->total;?> </td>
                                    @endif
                                @endif

                                <th>  <?php  echo $sumdept ;?>  </th>
                                <th>  <?php  echo $sumCredit ;?>  </th>

                                @if ($falagsandat ==0)
                                   <td>{{$Invoic->nameAccount	}}</td>
                                @else
                                   <td>{{ $name	}}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    
                 
                    @if (count($OutCome) > 0)
                        @foreach ($OutCome as $index => $OutCom)
                            <tr>
                                <th><?php echo $countALL++ ;?> </th>
                                <td><?php echo date("d-m-Y", strtotime( $OutCom->created_at)); ?></td>
                                <td> {{ trans('Report.Expenses') }}</td>
                                <td>{{$OutCom->id}}</td>
                                <td>{{ trans('Report.Expenses') }}</td>
                                <td>0</td>
                                <td>{{$OutCom->total}}    <?php  $sumCredit +=$OutCom->total;?></td>
                                <th>  <?php  echo $sumdept ;?>  </th>
                                <th>  <?php  echo $sumCredit ;?>  </th>
                                <td>{{ $name}}</td>
                            </tr>
                        @endforeach
                    @endif

                    @if (count($JournalSub) > 0)
                        @foreach ($JournalSub as $index => $Journa)
                            <tr>
                                <th><?php echo $countALL++ ;?> </th>
                                <td><?php echo date("d-m-Y", strtotime( $Journa->date)); ?></td>
                                <td> {{ trans('Report.Dailyrestrictions') }} </td>
                                <td>{{$Journa->id}}</td>
                                <td>{{$Journa->dec}}</td>
                                <td>{{$Journa->Debit}}  <?php  $sumdept   += $Journa->Debit;?></td>
                                <td>{{$Journa->Credit}} <?php  $sumCredit += $Journa->Credit;?></td>
                                <th>  <?php  echo $sumdept ;?>  </th>
                                <th>  <?php  echo $sumCredit ;?>  </th>
                                <td>{{$Journa->nameAccount}}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if (count($DepotStore) > 0)
                        @foreach ($DepotStore[0]->Stock as $index => $DepotSto)
                            <tr>
                                <th><?php echo $countALL++ ;?> </th>
                                <td><?php echo date("d-m-Y", strtotime( $DepotSto->date)); ?></td>
                                <td> حركات المخزون </td>
                                <td>{{$DepotSto->id}}</td>
                                <td>{{$DepotSto->comment}} </td>
                                <td>{{$DepotSto->quantityIn*$DepotSto->product->costPrice}}   <?php  $sumdept     +=$DepotSto->quantityIn*$DepotSto->product->costPrice;?> </td>
                                <td>{{$DepotSto->quantityOut*$DepotSto->product->costPrice}}  <?php  $sumCredit   +=$DepotSto->quantityOut*$DepotSto->product->costPrice?>  </td>
                                <th>  <?php  echo $sumdept ;?>  </th>
                                <th>  <?php  echo $sumCredit ;?>  </th>
                                <td>{{$DepotStore[0]->name}}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if (count($credorders) > 0)
                        @foreach ($credorders as $index => $credord)
                            <tr>
                                <th><?php echo $countALL++ ;?> </th>
                                <td><?php echo date("d-m-Y", strtotime( $credord->created_at)); ?></td>
                                <td>  {{ trans('Report.Citynotices') }} </td>
                                <td>{{$credord->id}}</td>
                                <td>    {{ trans('Report.Creditnotes') }}</td>
                                <td>0</td>
                                <td>{{$credord->totaldis}}   <?php  $sumCredit += $credord->totaldis;?></td>
                                <th>  <?php  echo $sumdept ;?>  </th>
                                <th>  <?php  echo $sumCredit ;?>  </th>
                                <td>{{$credord->nameAccount}}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if (count($depiteOrder) > 0)
                        @foreach ($depiteOrder as $index => $credord)
                            <tr>
                                <th><?php echo $countALL++ ;?> </th>
                                <td><?php echo date("d-m-Y", strtotime( $credord->created_at)); ?></td>
                                <td>   {{ trans('Report.Citynotices') }} </td>
                                <td>{{$credord->id}}</td>
                                <td>    {{ trans('Report.Creditnotes') }}</td>
                                <td>{{$credord->totaldis}} <?php  $sumdept   += $credord->totaldis ;?></td>
                                <td>0</td>
                                <th>  <?php  echo $sumdept ;?>  </th>
                                <th>  <?php  echo $sumCredit ;?>  </th>
                                <td>{{$credord->nameAccount}}</td>
                            </tr>
                        @endforeach
                    @endif
                  </tbody>
                  <tfoot>
                        {{-- <tr>
                            <th> -------</th>
                            <td>-------</td>
                            <td> الاجمالي</td>
                            <td>--------</td>
                            <td> ----------</td>
                            <td></td>
                            <td></td>
                            <th>  <?php echo  $sumdept ;?></th>
                            <th>  <?php echo  $sumCredit ;?> </th>
                            <td>---------</td>
                        </tr> --}}
                        <tr>
                            <th>------- </th>
                            <td>-------</td>
                            <td>      {{ trans('Report.accountname') }}</td>
                            <td>--------</td>
                            <td> ----------</td>
                            <td></td>
                            <td> </td>
                            <th>  <?php echo  $sumdept ;?></th>
                            <th>  <?php echo  $sumCredit ;?> </th>
                            <td>---------</td>
                        </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
@endsection

<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script>
    $(document).ready( function () {
    $("#example4").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", {
            extend: 'print',
            autoPrint: false,
            exportOptions: {
                modifier: {
                    page: 'current'

                }
            }
            },, "colvis"],
      "oLanguage": {
        "sSearch": "البحث:",
        "sInfo": "عرض _START_ من _END_   صفحة",
        "sLengthMenu": "عرض _MENU_ سجل في الصفحة",
      },
      lengthMenu: [
        [50, -1],
        [50, 'All']
    ]

    }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');

} );
</script>
