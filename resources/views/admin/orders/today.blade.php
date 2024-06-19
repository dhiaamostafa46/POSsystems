@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sale.Orders') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sale.sales') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sale.Orders') }} </li>
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
              <div class="row mt-2 col-12">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{count($orders->where('status',1))}}</h3>
                      <p>   {{ trans('Sale.underpreparing') }} </p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('orders.index')}}" class="small-box-footer">{{ trans('Sale.details') }} <i class="fas fa-arrow-circle-left"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>{{count($orders->where('status',2))}}</h3>
                      <p>{{ trans('Sale.ready') }} </p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('orders.index')}}" class="small-box-footer">{{ trans('Sale.details') }} <i class="fas fa-arrow-circle-left"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>{{count($orders->where('type',2))}}</h3>
                      <p>  {{ trans('Sale.Pickupfromtherestaurant') }}</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('stocks.index')}}" class="small-box-footer">{{ trans('Sale.details') }} <i class="fas fa-arrow-circle-left"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>{{count($orders->where('type',1))}}</h3>
                      <p>{{ trans('Sale.delivery') }}</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('orders.index')}}" class="small-box-footer">{{ trans('Sale.details') }} <i class="fas fa-arrow-circle-left"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
            </div>
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table text-center table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Sale.invoicenumber') }}</th>
                    <th> {{ trans('Sale.TypeofRequest') }}</th>
                    <th>{{ trans('Sale.value') }}</th>
                    <th>{{ trans('Sale.Type') }}</th>
                    <th>{{ trans('Sale.user') }}</th>
                    <th> {{ trans('Sale.Ordertime') }}</th>
                    <th>{{ trans('Sale.Table') }}</th>
                    <th>{{ trans('Sale.Status') }}</th>
                    <th>  {{ trans('Sale.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody id="tbody">

                  @if (count($orders) > 0)
                      @foreach ($orders as $index => $items)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$items->id}}</td>
                        <td>
                        @switch($items->orderType)
                            @case(1)
                            <span class="badge badge-warning">{{ trans('Sale.recive') }}</span>
                                @break
                            @case(2)
                            <span class="badge badge-danger">{{ trans('Sale.delivery') }}</span>
                                @break
                            @case(3)
                            <span class="badge badge-info">{{ trans('Sale.local') }}</span>
                                @break
                            @case(4)
                            <span class="badge badge-primary">{{ trans('Sale.travel') }}</span>
                                @break
                            @default
                        @endswitch
                        </td>
                        <td>{{$items->totalwvat}}</td>
                        <td>{{$items->type==121? trans('Sale.Cash') :($items->type==122? trans('Sale.Net') : trans('Sale.Paylater')  )}}</td>
                        <td>{{$items->user->name}}</td>
                        <td>{{$items->created_at->diffForHumans()}}</td>
                        <td>{{$items->table->tableNo ?? ''}}</td>
                        <td>
                          @switch($items->status)
                            @case(1)
                                <span class="badge badge-info">{{ trans('Sale.underpreparing') }} </span>
                                @break
                            @case(2)
                                <span class="badge badge-success">{{ trans('Sale.ready') }}</span>
                                @break
                            @default
                        @endswitch
                        </td>
                        <td>
                            <a href="{{route('today.show',$items->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('Sale.Show') }}</a>
                            <a data-toggle="modal" data-target="#OrderMove" onclick="MoveOrder({{ $items->id }})"   class="btn btn-success"><i class="fa fa-reply"></i>  {{ trans('Sale.Transfertherequest') }} </a>
                          @if ($items->orderType ==1)
                              <a  onclick="handleDelete({{ $items->id }})" class="btn btn-primary"><i class="fa fa-check-circle"></i> {{ trans('Sale.Done') }}</a>
                          @endif


                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="8" class="text-center">{{ trans('Sale.NoFound') }} </td>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



{{-- <script>


function MoveOrder(id){


    document.getElementById('idOrder').value = id;

    $('#OrderMove').show();

}
    $( document ).ready(function() {
        loaditems()
});
  function loaditems(){

        $.ajax({
            url: `/today.show`,
            success: data => {
            console.log(data)
            $('#tbody').empty()
            var counter=0;
            data.items.forEach(item =>
                {
                    console.log(item)
                    var orderType = "";
                    switch(item.orderType)
                        {
                          case 1:
                            orderType = `<span class="badge badge-warning">استلام</span>`;
                                break;
                            case 2:
                            orderType = `<span class="badge badge-danger">توصيل</span>`;
                                break;
                            case 3:
                            orderType = `<span class="badge badge-info">محلي</span>`;
                                break;
                            case 4:
                            orderType = `<span class="badge badge-primary">سفري</span>`;
                                break;
                            default:

                        }

                    switch(item.status)
                    {
                      case 1:
                        status = `<span class="badge badge-info">تحت التجهيز</span>`;
                            break;
                        case 2:
                        status = `<span class="badge badge-success">جاهز</span>`;
                            break;
                        default:
                    }
                    var id = item.id;


                     var route   =`/orders.show/${item.id}`;
                    $('#tbody').append(`<tr>
                        <td>${counter=counter+1}</td>
                        <td>${item.id}</td>
                        <td>${orderType}</td>
                        <td>${item.totalwvat}</td>
                        <td>${item.type}</td>
                        <td>${item.userName}</td>
                        <td>${item.created_at}</td>
                        <td>${status}</td>
                        <td>
                          <a href="${route}" class="btn btn-info"><i class="fa fa-eye"></i> عرض</a>
                          <a data-toggle="modal" data-target="#OrderMove" onclick="MoveOrder({{ $items->id }})"   class="btn btn-success"><i class="fa fa-reply"></i> نقل الطلب </a>
                        </td>
                      </tr>`);
                });
            }});
        }

        setInterval(function(){
            loaditems() // this will run after every 5 seconds
            //alert('hello');
        }, 100000);
</script> --}}



<div class="modal fade modal" id="OrderMove" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('Sale.Choosethetable') }}  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="POST" action="{{ route('ChangeTable') }}" enctype = "multipart/form-data">
              @csrf
              <input type="hidden"  name="idOrder"  id="idOrder" >
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label"> {{ trans('Sale.table') }}</label>
                <div class="col-sm-10">
                  <select name="Tableid" id="Tableid"   class="form-control">
                     @if (count($table)>0)
                        @foreach ($table as $item)
                              <option value="{{$item->id}}"> {{$item->tableNo}} </option>
                        @endforeach
                     @endif
                  </select>
                </div>
              </div>
                  <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary">  {{ trans('Sale.Transfertherequest') }} </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

