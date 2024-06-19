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
                <h6 style="display: inline-block">  {{ trans('Report.Productsections') }}</h6>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="RepotAllDataTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Report.name') }}</th>
                    <th> {{ trans('Report.Image') }}</th>
                    <th>  {{ trans('Report.Datecreated') }}</th>
                    <th> {{ trans('Report.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($prodcategories) > 0)
                      @foreach ($prodcategories as $index => $prodcategory)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$prodcategory->nameAr ?? ''}}</td>
                        <td><img src="{{asset('dist/img/productcategories/'.$prodcategory->img)}}" width="30px" alt=""></td>
                        <td>{{$prodcategory->created_at}}</td>
                        <td>
                          <a href="{{route('prodcategories.show',$prodcategory->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>  {{ trans('Report.Show') }} </a>
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
