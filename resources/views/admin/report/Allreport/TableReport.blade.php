@extends('layouts.dashboard')
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Reporttables') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Reporttables') }} </li>
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
                <h3 class="card-title">  {{ trans('Report.Listoftables') }} </h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table text-center table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>{{ trans('Report.name') }}</th>
                    <th>{{ trans('Report.mainbranch') }}</th>
                    <th>{{ trans('Report.Datecreated') }}</th>
                    <th> {{ trans('Report.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($tbls) > 0)
                      @foreach ($tbls as $index => $tbl)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$tbl->tableNo}}</td>
                        <td>{{$tbl->branch->nameAr ??''}}</td>
                        <td>{{$tbl->created_at}}</td>
                        <td>
                          <a href="{{route('ReportAll.ShowTableReport',$tbl->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('Report.ShowOrder') }} </a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center"> {{ trans('Report.NotFounddata') }} </td>
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

