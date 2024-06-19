Arrangement

@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Damagedinventory') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Damagedinventory') }} </li>
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
            {{ trans('Report.Damagedinventory') }}
          </div>
          <div class="card-body">

            <table id="example2" class="table text-center table-bordered table-hover">
              <thead>
              <tr>
                <th>#</th>
                <th>   {{ trans('Report.ProductName') }} </th>
                <th>   {{ trans('Report.Productprice') }} </th>
                <th>    {{ trans('Report.Unit') }} </th>
                <th>     {{ trans('Report.quantitythatwasdamaged') }} </th>

              </tr>
              </thead>
              <tbody>
                   <!--get product transaction on stock-->
                    @if (count( $Tainted) > 0)
                        @foreach ( $Tainted as $index => $details)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$details->product->nameAr ?? ''}}</td>
                            <td>{{$details->product->costPrice ?? ''}}</td>
                            <td>{{$details->nameunitr ?? ''}}</td>
                            <td>{{$details->quantity}}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center"> {{ trans('Report.NotFounddata') }}  </td>
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
