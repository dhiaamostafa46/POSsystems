@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Store.Outgoingtransfer') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Store.Inventory') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Store.Outgoingtransfer') }} </li>
          </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>

<!-- /.content-header -->
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">  {{ trans('Store.Outgoingtransfer') }} </h3>
                <a href="#" data-toggle="modal" data-target="#createConvert" class="btn btn-primary btnAddsys"> <i class="fa fa-plus"></i>  {{ trans('Store.Add') }} </a>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>  {{ trans('Store.Registrationnumber') }}</th>
                    <th>   {{ trans('Store.Sendingrepository') }}</th>
                    <th>  {{ trans('Store.Futurewarehouse') }}  </th>
                    <th> {{ trans('Store.user') }}  </th>
                    <th>  {{ trans('Store.description') }} </th>
                    <th>     {{ trans('Store.Numberofproducts') }}  </th>
                    <th>    {{ trans('Store.Transferdate') }}  </th>
                    <th>    {{ trans('Store.Status') }}  </th>
                    <th>  {{ trans('Store.Options') }}  </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($StoreConversion) > 0)
                      @foreach ($StoreConversion as $index => $row)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row->id}}</td>
                        <td>{{$row->DepotStoreOne->name ?? ''}}</td>
                        <td>{{$row->DepotStoretow->name ??''}}</td>
                        <td>{{$row->user->name}}</td>
                        <td>{{$row->comment}}</td>
                        <td>{{$row->items}}</td>
                        <td>{{$row->dateCon}}</td>
                        <td>
                            @if ($row->status ==1)
                            {{ trans('Store.hanging') }}
                            @elseif ($row->status ==2)
                            {{ trans('Store.Partialrecipient') }}
                            @elseif ($row->status ==3)
                            {{ trans('Store.Deleted') }}
                            @else
                            {{ trans('Store.Recipient') }}
                            @endif
                        </td>
                        <td>
                          <a href="{{route('StoreConversion.show',$row->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> </a>
                          @if ($row->status !=4 && $row->status !=3)
                            {{-- <a href="{{route('StoreConversion.edit',$row->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> </a> --}}
                            <a href="#" class="btn btn-danger" onclick="handleDelete({{ $row->id }})"><i class="fa fa-trash"></i></a>
                          @endif

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

    <div  style="display: none">
        <h1 id="titalmesssage">  {{ trans('Store.Areyousuretodeleteconvert') }} </h1>
        <h1 id="confirmButtonText">  {{ trans('Store.confirmButtonText') }} </h1>
        <h1 id="cancelButtonText">  {{ trans('Store.cancelButtonText') }} </h1>
    </div>

    <script>
        function handleDelete(id){
                     ddd= document.getElementById('titalmesssage').innerHTML ;
                    dyes= document.getElementById('confirmButtonText').innerHTML ;
                    dno = document.getElementById('cancelButtonText').innerHTML ;

                        Swal.fire({
                        title: ddd,
                        text: "",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#f8a29e',
                        confirmButtonText: dyes,
                        cancelButtonText: dno
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/StoreConversion.delete/"+id;
                    }
                    })
        }
    </script>
@endsection





<div class="modal fade modal" id="createConvert" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('Store.chooseWarehouses') }} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="get" action="{{ route('StoreConversion.create') }}" enctype = "multipart/form-data">
              @csrf
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">  {{ trans('Store.Warehouses') }}</label>
                <div class="col-sm-8">
                  <select name="AccountSelect" id="AccountSelect"   class="form-control">
                      @foreach ($DepotStore as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary">بحث </button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>






<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

