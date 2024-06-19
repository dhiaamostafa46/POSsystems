@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">   {{ trans('Report.Customerdata') }}   </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb floatmleft">
                <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Reports') }}</a></li>
                <li class="breadcrumb-item active">   {{ trans('Report.Customerdata') }} </li>
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
                                        <th> Code ID</th>
                                        <th>{{ trans('Report.name') }} </th>
                                        <th>{{ trans('Report.phone') }} </th>
                                        <th> {{ trans('Report.TaxNumber') }} </th>
                                        <th> {{ trans('Report.Datecreated') }} </th>
                                        {{-- <th>خيارات</th> --}}
                                      </tr>
                                </thead>
                                <tbody>

                                                @if (count($customers) > 0)
                                                    @foreach ($customers as $index => $customer)
                                                    <tr>
                                                        <td>{{$index+1}}</td>
                                                        <td>{{$customer->AccountID}}</td>
                                                        <td>{{$customer->name}}</td>
                                                        <td>{{$customer->phone}}</td>
                                                        <td>{{$customer->vatNo}}</td>
                                                        <td>{{$customer->created_at}}</td>
                                                        {{-- <td>
                                                            <a href="{{route('ReportAll.customersShow',$customer->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a>
                                                        </td> --}}
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="7" class="text-center">{{ trans('Report.NotFounddata') }}</td>
                                                    </tr>
                                                @endif
                                </tbody>
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
