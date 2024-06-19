Arrangement

@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Pendingtransfers') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Pendingtransfers') }} </li>
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
                {{ trans('Report.Pendingtransfers') }}
          </div>
          <div class="card-body">

            <table id="example2" class="table text-center table-bordered table-hover">
              <thead>
              <tr>
                <th>#</th>
                <th>     {{ trans('Report.Itemcode') }} </th>
                <th>  {{ trans('Report.ProductName') }}  </th>
                <th>   {{ trans('Report.lonliness') }}  </th>
                <th>    {{ trans('Report.Transferamount') }} </th>
                <th>     {{ trans('Report.costoftheproduct') }} </th>
                <th>    {{ trans('Report.comment') }} </th>
                <th>      {{ trans('Report.date') }}  </th>
              </tr>
              </thead>
              <tbody>
                   <!--get product transaction on stock-->
                   <?php $count=1;?>
                    @if (count( $StoreConversion) > 0)
                        @foreach ( $StoreConversion as $index => $detailsitems)

                        @if (count( $detailsitems->StoreConversiondetails) > 0)
                            @foreach ( $detailsitems->StoreConversiondetails as $index => $details)
                                <tr>
                                    <td><?php echo $count++;?></td>
                                    <td>{{$details->product->barcode ?? ''}}</td>
                                    <td>{{$details->product->nameAr ?? ''}}</td>
                                    <td>{{$details->nameunitr ?? ''}}</td>
                                    <td>{{$details->quantity}}</td>
                                    <td>{{$details->quantity * $details->costprodect}}</td>
                                    <td>{{$detailsitems->comment}}</td>
                                    <td>{{$detailsitems->dateCon}}</td>
                                </tr>
                            @endforeach
                        @endif

                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">    {{ trans('Report.NotFounddata') }}  </td>
                        </tr>
                    @endif
              </tbody>
            </table>
            <div class="row no-print">
                <div class="col-12">
                  <a href="#" onclick="printDiv();" class="btn btn-default"><i class="fas fa-print"></i>    {{ trans('Report.Print') }} </a>
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
