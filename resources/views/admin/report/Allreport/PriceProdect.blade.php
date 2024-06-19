@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Pricesofminoitems') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Pricesofminoitems') }} </li>
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
                <h3 class="card-title">   {{ trans('Report.Pricesofminoitems') }} </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="RepotAllDataTable" class="table text-center table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>

                    <th>   {{ trans('Report.name') }} </th>
                    {{-- <th>الكود</th> --}}

                    <th>   {{ trans('Report.Image') }} </th>
                    <th> {{ trans('Report.Section') }}</th>
                    <th>{{ trans('Report.Tax') }}</th>
                    <th> {{ trans('Report.price') }} </th>



                  </tr>
                  </thead>
                  <tbody>

                  @if (count($products) > 0)
                      @foreach ($products as $index => $product)
                      <tr>
                        <td>{{$index+1}}</td>
                        @if(LaravelLocalization::getCurrentLocale() =='ar')
                        <td>{{$product->nameAr}}</td>
                        @else
                        <td>{{$product->nameEn}}</td>
                        @endif
                        <td><img src="{{asset('dist/img/products/'.$product->img)}}" width="30px" alt=""></td>
                        <th>{{$product->category->nameAr}}</th>
                        <th>{{$product->vat}}</th>
                        <th>{{$product->prodPrice}}</th>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center"> {{ trans('Report.NotFounddata') }} </td>
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


