@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Store.Damagedinventory') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Store.Inventory') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Store.Damagedinventory') }} </li>
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
                <h3 class="card-title"> {{ trans('Store.Damagedinventory') }}   </h3>
                {{-- <a href="#" onclick="createConvert();" class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a> --}}
                <a href="#" data-toggle="modal" data-target="#createConvert"  class="btn btn-primary btnAddsys"> <i class="fa fa-plus"></i>  {{ trans('Store.Add') }} </a>
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
                        <td>{{$row->DepotStoreOne->name ??''}}</td>
                        <td>{{$row->user->name ?? ''}}</td>
                        <td>{{$row->comment}}</td>
                        <td>{{$row->items}}</td>
                        <td>{{$row->dateCon}}</td>
                         <td>
                          <a href="{{route('Tainted.show',$row->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> </a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">   </td>
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





<div class="modal fade modal" id="createConvert" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('Store.chooseWarehouses') }}  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="get" action="{{ route('Tainted.createTainted') }}" enctype = "multipart/form-data">
              @csrf
              @method('POST')
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label">  {{ trans('Store.Warehouses') }} </label>
                <div class="col-sm-9">
                  <select name="AccountSelect" id="AccountSelect"   class="form-control">
                      @foreach ($DepotStore as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary"> {{ trans('Store.Search') }} </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>








