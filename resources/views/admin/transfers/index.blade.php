@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Store.Incomingtransfer') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Store.Inventory') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Store.Incomingtransfer') }} </li>
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
                <h3 class="card-title">  {{ trans('Store.Incomingtransfer') }}   </h3>
                <a href="#" data-toggle="modal" data-target="#createConvert"  class="btn btn-primary btnAddsys"> <i class="fa fa-plus"></i>  {{ trans('Store.Add') }} </a>
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
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">    {{ trans('Store.Recipient') }}</td>
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
    <div class="modal-dialog modal-lg  modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('Store.chooseWarehouses') }} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">

              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">  {{ trans('Store.Warehouses') }} </label>
                <div class="col-sm-8">
                  <select name="AccountSelect" id="AccountSelect"   class="form-control">
                      @foreach ($DepotStore as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                  </select>

                </div>
                <input type="button"  onclick="SereachStore()" id="buttonSereachStore" class="btn col-sm-2  btn-primary" value=" {{ trans('Store.Show') }}">
              </div>
              <div style="height: 600px">
                <table class="table table-hover overflow-auto" >
                    <thead>
                      <tr>
                        <th scope="col" id="chooseStore">{{ trans('Store.choose') }}</th>
                        <th>  {{ trans('Store.Registrationnumber') }}</th>
                        <th>   {{ trans('Store.Sendingrepository') }}</th>
                        <th>  {{ trans('Store.Futurewarehouse') }}  </th>
                      </tr>
                    </thead>
                    <tbody  id="bodyitmesTransltate">


                    </tbody>
                  </table>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>



  <div  style="display: none">
    <h1 id="noFoundmesssage">  {{ trans('Store.Therethiswarehouse') }} </h1>


</div>


<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


<script>
    function SereachStore(){

        Store=document.getElementById('AccountSelect').value;
        if(Store !=null)
        {

            $.ajax({
                    url: `/Intransfers.StockSum/${Store}`,
                    data:{id:Store},
                    success: data => {

                        console.log( data.Store);
                        if(data.flage ==0){
                            $('#bodyitmesTransltate').empty();
                            Swal.fire({
                                    title: document.getElementById('noFoundmesssage').innerHTML,
                                    icon: "warning"
                                });

                        }else{

                            $('#bodyitmesTransltate').empty();

                              data.items.forEach((item , index  )=>{

                                        $('#bodyitmesTransltate').append(`
                                        <tr>
                                            <th> <button   class="btn btn-primary" onclick="getidOrderinfo(${item.id})">${ document.getElementById('chooseStore').innerHTML}</button></th>
                                            <td>${item.id}</td>
                                            <td>${ data.Store[index][0]}</td>
                                            <td>${data.Store[index][1]}</td>
                                        </tr>

                                        `)
                                })


                        }

                     }
               });

        }
    }

    function getidOrderinfo(id)
    {


       window.location.href = "/Intransfers.create/"+id;
    }
</script>



