@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Fundaccounts') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Fundaccounts') }} </li>
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
                <h3 class="card-title">  {{ trans('Report.Fundaccounts') }}   </h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="RepotAllDataTable" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>#</th>

                    <th> {{ trans('Sandat.accountnumber') }}</th>
                    <th> {{ trans('Sandat.Fundname') }} </th>
                    <th>{{ trans('Sandat.Status') }}  </th>
                    <th>{{ trans('Sandat.Branch') }}  </th>
                    <th> {{ trans('Sandat.description') }} </th>


                  </tr>
                  </thead>
                  <tbody>

                  @if (count($Treasury) > 0)
                      @foreach ($Treasury as $index => $row)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row->AccountCode}}</td>
                        <td>{{$row->name}}</td>
                        <td>
                            @if ($row->status ==0)
                            {{ trans('Sandat.Active') }}
                            @else
                            {{ trans('Sandat.NoActive') }}
                            @endif
                        </td>
                        <td>{{$row->branch->nameAr}}</td>
                        <td>{{$row->desc}}</td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center"> {{ trans('Report.NotFounddata') }}</td>
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
