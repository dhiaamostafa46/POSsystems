@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Creditnotes') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Creditnotes') }} </li>
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


              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="RepotAllDataTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>   {{ trans('Report.Client') }}</th>
                    <th>   {{ trans('Report.value') }}</th>
                    <th>   {{ trans('Report.tax') }}</th>
                    <th>   {{ trans('Report.by') }}</th>
                    <th>   {{ trans('Report.Datecreated') }} </th>
                    <th>   {{ trans('Report.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($orders) > 0)
                      @foreach ($orders as $index => $order)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$order->customer->name ??""}}</td>
                        <td>{{$order->totaldis}}</td>
                        <td>{{$order->totalvat}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                          <a href="{{route('credorders.show',$order->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>  {{ trans('Report.Show') }}</a>

                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="8" class="text-center"> {{ trans('Report.NotFounddata') }}  </td>
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
