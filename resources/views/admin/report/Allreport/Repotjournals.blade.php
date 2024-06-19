@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Dailyrestrictions') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Dailyrestrictions') }} </li>
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
                <h3 class="card-title">    {{ trans('Report.Dailyrestrictions') }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="RepotAllDataTable" class="table text-center table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    {{-- <th>رقم القيد</th>
                    <th>التاريخ</th>
                    <th>المستخدم  </th>
                    <th> الاجمالي </th>
                    <th> حالة القيد  </th>
                    <th> الخيارات  </th> --}}
                    <th>  {{ trans('Account.Registrationnumber') }}  </th>
                    <th> {{ trans('Account.date') }}  </th>
                    <th> {{ trans('Account.user') }}    </th>
                    <th>  {{ trans('Account.total') }}   </th>
                    <th>   {{ trans('Account.Status') }}    </th>
                    <th>  {{ trans('Account.Options') }}    </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($Journal) > 0)
                      @foreach ($Journal as $index => $row)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row->id}}</td>
                        <td>{{$row->date}}</td>
                        <td>{{$row->user->name}}</td>
                        <td>{{$row->Total}}</td>
                        <td>@if ($row->kind ==1)
                            {{ trans('Account.certified') }}
                        @else
                        {{ trans('Account.Draft') }}
                        @endif </td>
                         <td>
                          <a href="{{route('journals.show',$row->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>  {{ trans('Report.Show') }}  </a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">{{ trans('Report.NotFounddata') }} </td>
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

