Arrangement

@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Inventorytransfers') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Inventorytransfers') }} </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header ">
            {{ trans('Report.Inventorytransfers') }}
          </div>
          <div class="card-body">

            <table id="example2" class="table text-center table-bordered table-hover">
              <thead>
              <tr>
                <th>#</th>
                <th>    {{ trans('Report.Itemcode') }} </th>
                <th>  {{ trans('Report.ProductName') }} </th>
                <th>  {{ trans('Report.lonliness') }} </th>
                <th>    {{ trans('Report.Transferamount') }} </th>
                <th>    {{ trans('Report.Weightedaverage') }} </th>
                <th>     {{ trans('Report.TransactionAmount') }} </th>
                <?php $sum=0;  $guantit=0;?>
              </tr>
              </thead>
              @if (count( $StoreConversion) > 0)
                <tbody>
                    <!--get product transaction on stock-->
                    <?php $count=1;?>

                            @foreach ( $StoreConversion as $index => $details)

                            @if (count( $details->IncomTransfersDetials) > 0)
                                @foreach ( $details->IncomTransfersDetials as $index => $details)
                                    <tr>
                                        <td><?php echo $count++;?></td>
                                        <td>{{$details->product->barcode ?? ''}}</td>
                                        <td>{{$details->product->nameAr ?? ''}}</td>
                                        <td>{{$details->nameunitr ?? ''}}</td>
                                        <td>{{$details->quantity}} </td>
                                        <td>{{$details->costprodect}} </td>
                                        <td>{{number_format($details->quantity *$details->costprodect ,2) }}   <?php $sum +=$details->quantity *$details->costprodect ?></td>
                                    </tr>
                                @endforeach
                            @endif

                            @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6">      {{ trans('Report.Total') }}</th>
                        <th>  <?php echo number_format($sum,2);  ?>   </th>
                    </tr>


                </tfoot>
              @else
                <tr>
                    <td colspan="6" class="text-center"> {{ trans('Report.NotFounddata') }} </td>
                </tr>
               @endif
            </table>
            <div class="row no-print">
                <div class="col-12">
                  <a href="#" onclick="printDiv();" class="btn btn-default"><i class="fas fa-print"></i>    {{ trans('Report.Print') }}</a>
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
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
<script>
    function printDiv(){
      window.print();
    }
  </script>
