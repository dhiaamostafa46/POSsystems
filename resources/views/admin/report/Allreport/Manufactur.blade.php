@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">   {{ trans('Report.Manufacturingorderreports') }}   </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb floatmleft">
                <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
                <li class="breadcrumb-item active">   {{ trans('Report.Manufacturingorderreports') }} </li>
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
                <h3 class="card-title">   {{ trans('Report.Manufacturingorderreports') }}  </h3>

              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>#</th>

                    <th>  {{ trans('Store.ProductName') }} </th>
                    <th>    {{ trans('Store.Quantity') }}    </th>
                    <th>     {{ trans('Store.Totalcostoftheproduct') }}   </th>
                    <th>    {{ trans('Store.branch') }}     </th>
                    <th>    {{ trans('Store.Datecreated') }}     </th>
                    <th> {{ trans('Store.Options') }}  </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($Manufactur) > 0)
                      @foreach ($Manufactur as $index => $row)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row->nameprodect }}</td>
                        <td>{{$row->Quantity }}</td>
                        <td>{{$row->totalcost }}</td>
                        <td>{{$row->branch->nameAr??'' }}</td>
                        <td>{{$row->date }}</td>
                         <td>
                            <a href="{{route('Manufactur.show',$row->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> </a>

                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">      {{ trans('Store.NotFounddata') }}</td>
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








