@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Openingbalances') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Openingbalances') }} </li>
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
                <h3 class="card-title">   {{ trans('Report.Openingbalances') }}  </h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="RepotAllDataTable" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>#</th>
                    {{-- <th>رقم القيد</th>
                    <th>الاسم القيد </th>
                    <th> المدين </th>

                    <th>  التاريخ  </th>
                    <th>   المستخدم</th> --}}
                    <th>  {{ trans('Account.Entrytype') }} </th>
                    <th>  {{ trans('Account.Registrationname') }} </th>
                    <th>  {{ trans('Account.thevalue') }} </th>
                    {{-- <th>  الدائن </th> --}}
                    <th>   {{ trans('Account.date') }}  </th>
                    <th>    {{ trans('Account.user') }}</th>


                  </tr>
                  </thead>
                  <tbody>

                  @if (count($OpeningBalances) > 0)
                      @foreach ($OpeningBalances as $index => $account)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$account->CodeAccount}}</td>
                        <td>{{$account->nameAccount}}</td>
                        <td>{{$account->Debit}}</td>


                        <td>{{$account->date}}</td>
                        <td>{{$account->user->name}}</td>

                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">    {{ trans('Account.NotFounddata') }}  </td>
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
