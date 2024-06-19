@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Productsections') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Productsections') }} </li>
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
                <h3 class="card-title">     {{ trans('Report.Productsections') }}    </h3>

              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>  {{ trans('Store.Registrationnumber') }}</th>
                    <th> {{ trans('Store.warehouse') }} </th>
                    <th> {{ trans('Store.user') }}  </th>
                    <th>  {{ trans('Store.description') }} </th>
                    <th>    {{ trans('Store.Numberofproducts') }}  </th>
                    <th>    {{ trans('Store.Reasonsforsettlement') }}  </th>
                    <th>   {{ trans('Store.Datecreated') }}   </th>
                    <th>  {{ trans('Store.Options') }}  </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($Tainted) > 0)
                      @foreach ($Tainted as $index => $row)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row->id}}</td>
                        <td>{{$row->DepotStore->name}}</td>
                        <td>{{$row->user->name}}</td>
                        <td>{{$row->comment}}</td>
                        <td>{{$row->items}}</td>
                        <td>{{$row->reasonname}}</td>
                        <td>{{$row->dateCon}}</td>
                         <td>
                          <a href="{{route('Arrangement.show',$row->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> </a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">لا يوجد   تسوية </td>
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

