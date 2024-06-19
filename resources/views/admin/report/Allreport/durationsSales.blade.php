@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Report.Shiftsales') }}  </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Report.Reports') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Report.Shiftsales') }} </li>
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
              <!-- /.card-header -->
              <div class="card-body">
                <table id="salesfatorahReport" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>    {{ trans('Report.Startby') }} </th>
                      <th>   {{ trans('Report.StartDate') }}</th>
                      <th>  {{ trans('Report.Balance1') }}</th>
                      <th>  {{ trans('Report.sales') }}</th>
                      <th>  {{ trans('Report.Total') }}</th>
                      <th>  {{ trans('Report.Endby') }}</th>
                      <th>  {{ trans('Report.Expirydate') }}</th>
                      <th> {{ trans('Report.Options') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if (count($duration) > 0)
                        @foreach ($duration as $index => $order)
                        <tr>
                          <td>{{$index+1}}</td>
                          <td>{{$order->user->name ?? ''}}</td>
                          <td>{{$order->created_at }}</td>
                          <td>{{$order->openBalance}}</td>
                          <td>{{$order->Saller}}</td>
                          <td>{{$order->Saller+ $order->openBalance}}</td>
                          <td>{{$order->endby->name ?? ''}}</td>
                          <td>{{$order->endAt}}</td>
                          <td>
                            <a href="{{route('ReportAll.ShowdurationsSales',$order->durationNo)}}" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('Report.Show') }}</a>
                          </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                          <td colspan="8" class="text-center"> {{ trans('Report.NotFounddata') }}</td>
                        </tr>
                    @endif
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






