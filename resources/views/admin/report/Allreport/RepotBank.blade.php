@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Bankaccounts') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Bankaccounts') }} </li>
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
                <h3 class="card-title">    {{ trans('Report.Registerofbankaccounts') }}   </h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="RepotAllDataTable" class="table text-center table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                   
                    <th> {{ trans('Sandat.accountnumber') }}</th>
                    <th> {{ trans('Sandat.BanksName') }} </th>
                    <th>{{ trans('Sandat.currency') }}  </th>
                    <th> {{ trans('Sandat.Status') }} </th>



                  </tr>
                  </thead>
                  <tbody>

                  @if (count($Bank) > 0)
                      @foreach ($Bank as $index => $row)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row->AccountID}}</td>
                        <td>{{$row->nameBank}}</td>
                        <td>{{$row->currency}}</td>

                        <td>
                            @if ($row->status ==1)
                            {{ trans('Sandat.Active') }}
                            @else
                            {{ trans('Sandat.NoActive') }}

                            @endif
                        </td>

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

