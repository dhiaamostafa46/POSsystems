@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Accountstree') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Accountstree') }} </li>
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
                <h3 class="card-title">   {{ trans('Report.Accountstree') }}   </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="RepotAllDataTable"  class="table table-bordered table-hover text-center ">
                  <thead>
                  <tr>
                    <th>#</th>


                    <th>{{ trans('Account.Code') }} </th>
                    <th>{{ trans('Account.Directoryname') }}   </th>

                    <th>{{ trans('Account.Accountaddress') }}  </th>
                    <th>{{ trans('Account.Accountstatus') }}  </th>






                  </tr>
                  </thead>
                  <tbody>

                  @if (count($AccountingGuide) > 0)
                      @foreach ($AccountingGuide as $index => $account)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$account->AccountID}}</td>
                        @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl")
                           <td>{{$account->AccountName}}</td>
                        @else
                           <td>{{$account->AccountNameEn}}</td>
                        @endif

                        <td>
                            @if ($account->typeProcsss ==0)
                            {{ trans('Account.debtor') }}
                            @else
                            {{ trans('Account.Creditor') }}
                            @endif
                        </td>
                        <td>
                            @if ($account->Account_status ==0)
                            {{ trans('Account.Main') }}
                            @else
                            {{ trans('Account.secondary') }}
                            @endif
                        </td>

                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">{{ trans('Report.NotFounddata') }}</td>
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

