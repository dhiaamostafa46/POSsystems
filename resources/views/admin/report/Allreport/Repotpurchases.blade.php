@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Purchasingreport') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Purchasingreport') }} </li>
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

                    <th> {{ trans('purchases.supplier') }} </th>
                    <th> {{ trans('purchases.value') }} </th>
                    <th> {{ trans('purchases.Tax') }} </th>

                    <th> {{ trans('purchases.Invoicetype') }}  </th>
                    <th> {{ trans('purchases.by') }} </th>
                    <th> {{ trans('purchases.Datecreated') }} </th>
                    <th> {{ trans('purchases.Options') }} </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($purchases) > 0)
                      @foreach ($purchases as $index => $purchase)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{!empty($purchase->supplierID)?$purchase->supplier->name:""}}</td>
                        <td>{{$purchase->totalwvat}}</td>
                        <td>{{$purchase->totalvat}}</td>
                        <td>{{$purchase->type==121?  trans('purchases.Cash') :($purchase->type==122?  trans('purchases.Net')  :  trans('purchases.Paylater')   )}}</td>
                        <td>{{$purchase->user->name}}</td>
                        <td>{{$purchase->created_at}}</td>
                        <td> <a href="{{route('purchases.show',$purchase->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('purchases.Show') }}</a> </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center"> {{ trans('Report.NotFounddata') }}</td>
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

