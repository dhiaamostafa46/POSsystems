@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">   {{ trans('Report.Dailysales') }}  </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
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

          </div>
          <div class="card-body">

            <table id="example2" class="table text-center table-bordered table-hover">
              <thead>
              <tr>
                <th>#</th>
                <th>    {{ trans('Report.invoicenumber') }}  </th>
                <th>   {{ trans('Report.productname') }}  </th>
                <th>  {{ trans('Report.Quantity') }} </th>
                <th>   {{ trans('Report.priceofapill') }} </th>
              </tr>
              </thead>
              <tbody>
                   <!--get product transaction on stock-->
                   <?php $count=1;?>
                    @if (count( $sales) > 0)
                        @foreach ( $sales as $index => $details)
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td>{{$details->Order->serial ?? ''}}</td>
                                <td>{{$details->productName ?? ''}}</td>
                                <td>{{$details->quantity ?? ''}}</td>
                                <td>{{$details->price ?? ''}}</td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">  {{ trans('Report.NotFounddata') }}  </td>
                        </tr>
                    @endif
              </tbody>
            </table>
            <div class="row no-print">
                <div class="col-12">
                  <a href="#" onclick="printDiv();" class="btn btn-default"><i class="fas fa-print"></i> {{ trans('Report.Print') }}  </a>
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
