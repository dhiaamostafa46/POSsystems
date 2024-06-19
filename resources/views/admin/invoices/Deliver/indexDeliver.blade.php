@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"> {{ trans('Sandat.SinadatindexDeliver') }} </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb floatmleft">
                <li class="breadcrumb-item"><a href="#">{{ trans('Sandat.Treasurysandbanks') }} </a></li>
                <li class="breadcrumb-item active"> {{ trans('Sandat.SinadatindexDeliver') }} </li>
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
                          
                            <a href="{{ route('Sinadat.createDeliver') }}" class="btn btn-primary btnAddsys"><i class="fa fa-plus"></i>  {{ trans('Sandat.Add') }}</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table text-center table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('Sandat.amount') }}</th>
                                        <th>{{ trans('Sandat.supplier') }}</th>

                                        <th>{{ trans('Sandat.phonenumber') }} </th>
                                        <th>{{ trans('Sandat.user') }} </th>
                                        <th>{{ trans('Sandat.Datecreated') }}</th>
                                        <th>{{ trans('Sandat.Options') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($invoices) > 0)
                                        @foreach ($invoices as $index => $invoice)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $invoice->total }}</td>
                                                <td>{{$invoice->supplier->name ?? ''}}</td>
                                                <td>{{$invoice->supplier->phone ?? ''}}</td>
                                                <td>{{ $invoice->user->name }}</td>
                                                <td>{{ $invoice->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('Sinadat.show', $invoice->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i> </a>
                                                    <a href="{{route('Sinadat.edit',$invoice->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                                                    <!--<a href="#" class="btn btn-danger" onclick="handleDelete({{ $invoice->id }})"><i class="fa fa-trash"></i> حذف</a>-->
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">{{ trans('Sandat.NoFound') }}</td>
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
