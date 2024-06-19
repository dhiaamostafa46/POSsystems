@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Store.Manufacturingorder') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Store.Inventory') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Store.Manufacturingorder') }} </li>
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
                <h3 class="card-title">  {{ trans('Store.Manufacturingorder') }}  </h3>
                <a href="#" data-toggle="modal" data-target="#AcountGridel" class="btn btn-primary btnAddsys" ><i class="fa fa-plus"></i> {{ trans('Store.Add') }}</a>
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
                            @if ($row->kind ==1)
                              {{-- <a href="{{route('Manufactur.edit',$row->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> </a> --}}
                              <a  onclick="handleDelete({{$row->id}})" class="btn btn-warning"><i class="fa fa-check-square"></i></a>
                            @endif
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">{{ trans('Store.NoFound') }}    </td>
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

    <div  style="display: none">
        <h1 id="titalmesssage2222">  {{ trans('Dadhoard.Doyouwanttoconfirm222') }} </h1>
        <h1 id="confirmButtonText333">  {{ trans('Dadhoard.balanceText222') }} </h1>
        <h1 id="cancelButtonText333">  {{ trans('Dadhoard.balanceCancel222') }} </h1>
    </div>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    dddmd= document.getElementById('titalmesssage2222').innerHTML ;
 dddyes= document.getElementById('confirmButtonText333').innerHTML ;
 ddddno = document.getElementById('cancelButtonText333').innerHTML ;
  function handleDelete(id){
    Swal.fire({
      title: dddmd,
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText:dddyes,
      cancelButtonText:ddddno
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "/Manufactur.confirm/"+id;
        }
      })
  }
  </script>
@endsection


<div class="modal fade modal" id="AcountGridel" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('Store.chooseproduct') }}  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="get" action="{{ route('Manufactur.create') }}" enctype = "multipart/form-data">
              @csrf
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
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label">{{ trans('Store.product') }}</label>
                <div class="col-sm-9">
                  <select name="Prodect" id="Prodect"   class="form-control">
                     @if (count($Volume)>0)
                        @foreach ($Volume as $item)
                            <option value="{{$item->id}}">{{$item->nameprodect}}</option>
                        @endforeach
                     @endif
                  </select>
                </div>
              </div>
              <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary">{{ trans('Store.Search') }} </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>





