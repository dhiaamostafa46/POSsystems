@extends('layouts.dashboard')
<style>
  td ,th {
    vertical-align: middle !important;
    text-align: center !important;
  }
</style>
@section('content')
<!-- /.content-header -->

<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row mt-2">
          <div class="col-5">
            <div class="card card-primary  text-primary" style="height: 110px ;    background-color: #aaecdf;">
              <div class="card-body">
                <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <h2 class="text-center text-success" id="pname">  {{ trans('Sale.Converttoinvoice') }} </h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <div class="col-4">
            <div class="card card-primary " style="height: 110px ;    background-color: #aaecdf;">
              <div class="card-body">
                <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <h1>
                            <strong id="bigtotal">{{ $order->totalwvat}}</strong> <span class="text-small">  {{ trans('Sale.Rial') }}</span>
                          </h1>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <div class="col-12">
            <div class="card card-primary" style="height: 800px">

              <div class="card-body">
                <form class="user" method="POST" action="{{route('OfferPrice.Store' ,$order->id)}}"   enctype = "multipart/form-data">
                  @csrf
                <input type="hidden" name="kind" value="2">
                <div style="height: 600px;overflow-y: scroll;">
                  <table id="example4" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>  {{ trans('Sale.ProductName') }}   </th>
                        <th>   {{ trans('Sale.priceofapill') }}  </th>
                        <th>   {{ trans('Sale.Quantity') }}  </th>
                        <th>   {{ trans('Sale.Profitmargin') }}  </th>
                        <th>   {{ trans('Sale.Discount') }}  </th>
                        <th> {{ trans('Sale.Total') }} </th>

                    </tr>
                    </thead>

                    <tbody id="tbody">
                        @foreach ($order->OfferPricedetails as $index=> $item)
                          <tr>
                            <th>{{$index+1}}</th>
                            <th>{{$item->productName}}</th>
                            <th>{{$item->price}}</th>
                            <th>{{$item->quantity}}</th>
                            <th>{{$item->Profit}}</th>
                            <th>{{$item->discount ?? '0'}} </th>
                            <th>{{$item->total}}</th>

                          </tr>
                        @endforeach

                    </tbody>
                  </table>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-8">
                    <div class="row">
                      <div class="col-lg-2">
                        <div class="form-group">
                            <select class="form-control @error('customerID') is-invalid @enderror" id="costcenter" name="costcenter" onchange="addCustomer(this)">

                            @foreach (  $cost as $cost)

                                @if ($order->CostCenter == $cost->id)
                                  <option selected value="{{$cost->id}}">{{$cost->CostName}}</option>
                                  @else
                                  <option value="{{$cost->id}}">{{$cost->CostName}}</option>
                                @endif

                            @endforeach

                            </select>
                            @error('customerID')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="col-lg-2">
                        <div class="form-group">
                          <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" onchange="showCashCard(this)" required>
                            <option value="">  {{ trans('Sale.paymentmethod') }} </option>
                            <option value="121"  > {{ trans('Sale.Cash') }} </option>
                            <option value="122"> {{ trans('Sale.Net') }} </option>
                            <option value="3"> {{ trans('Sale.Paylater') }} </option>
                          </select>
                          @error('type')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3" id="paymentType"style="display: none" >
                        <div class="form-group">
                            <select class="form-control @error('paymentTypeitems') is-invalid @enderror" id="paymentTypeitems" name="paymentTypeitems" >
                            </select>
                        </div>
                      </div>

                      {{-- <div class="col-lg-4 row mb-3" id="paymentType"style="display: none" >

                        <label for="inputEmail3" class="col-sm-3 col-form-label">حساب الدفع</label>
                        <div class="col-sm-9">
                            <select class="form-control @error('paymentTypeitems') is-invalid @enderror" id="paymentTypeitems" name="paymentTypeitems" >
                            </select>
                        </div>
                      </div> --}}
                      @if ($order->FlageCustumer==-1)
                      <div class="col-lg-8 row" id="newcustomer" >
                        <div class="col-lg-4">
                          <div class="form-group row">
                            <label class="form-label text-center"> اسم العميل </label>
                            <input type="text" class="form-control @error('customerName') is-invalid @enderror" value="{{$order->VirtualCustomer->name}}" id="customerName" name="customerName" placeholder="اسم العميل">
                            @error('customerName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group row">
                            <label class="form-label text-center">  رقم الضريبي  </label>
                            <input type="number" class="form-control @error('customerVat') is-invalid @enderror"  value="{{$order->VirtualCustomer->vatNo}}" id="customerVat" name="customerVat" placeholder="الرقم الضريبي">
                            @error('customerVat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="form-label text-center"> رقم  الجوال  </label>
                              <input type="number" class="form-control @error('customerPhone') is-invalid @enderror"  value="{{$order->VirtualCustomer->phone}}" id="customerPhone" name="customerPhone" placeholder="الرقم الجوال">
                              @error('customerVat')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>
                      </div>
                      @endif

                      <div class="col-lg-3 row" id="cashcard" style="display: none">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="number" min="0.00" step=".01" class="form-control @error('cash') is-invalid @enderror" id="cash" name="cash" placeholder="النقد">
                            @error('cash')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="number" min="0.00" step=".01" class="form-control @error('card') is-invalid @enderror" id="card" name="card" placeholder="الشبكة">
                            @error('card')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                      </div>


                    </div>
                    <div class="row">
                      <input type="hidden" name="total" id="total" value="0" />
                      <input type="hidden" name="vat" id="vat" value="0" />
                      <input type="hidden" name="totalwvat" id="totalwvat" value="0" />
                      <input type="hidden" name="totaldiscount" id="totaldiscount" value="0" />
                      <input type="hidden" name="count" id="count" value="0">
                      @if(count(auth()->user()->branch->durations)>0)
                        @if(auth()->user()->branch->durations->first()->status==1)
                        <div class="col-lg-3">
                          <div class="form-group">
                            <input type="submit" class="btn btn-primary" value=" {{ trans('Sale.save') }}" style="width: 100%">
                          </div>
                        </div>
                        @endif
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <table class="table table-borderless">
                        <tr>
                          <th>  <h6>{{ trans('Sale.Total') }}</h6></th>
                          <th>   <h6 > <strong id="view-total"> {{$order->totalwvat - $order->totalvat }} </strong> </h6></th>
                        </tr>
                        <tr>
                          <td>  <h6>  {{ trans('Sale.Valueaddedtax') }}</h6> </td>
                          <td>  <h6> <strong id="view-vat">{{$order->totalvat  }}  </strong></h6> </td>
                        </tr>
                        <tr>
                            <td> <h6>  {{ trans('Sale.Totalincludingtax') }}</h6> </td>
                            <td>      <h6 class="text-danger"> <strong id="view-totalwvat"> {{$order->totalwvat  }} </strong> {{ trans('purchases.Rial') }} </h6> </td>
                        </tr>
                    </table>
                  </div>

                </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
</section>


@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    function showCashCard(obj){

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

          type =obj.value;
          $('#paymentTypeitems').empty();

          if (obj.value ==121) {

            $.ajax({
                type: 'post',
                url: "/purchases.SearchAccount/"+type,
                data: {id : type},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(){ },
                success: function(response){
                    //the request is success
                     console.log(response.data[0].AccountName);
                     for (let i = 0; i <response.count; i++){
                        $('#paymentTypeitems').append('<option value="'+response.data[i].id+'::'+response.data[i].AccountID+'::'+response.data[i].AccountName+'">'+response.data[i].AccountName+'</option>');
                     }
                },
                complete: function(response){ }
            });
            document.getElementById(`paymentType`).style.display = "flex";
            document.getElementById(`cashcard`).style.display = "none";
        } else if (obj.value ==122) {
            $.ajax({
                type: 'post',
                url: "/purchases.SearchAccount/"+type,
                data: {id : type},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(){ },
                success: function(response){
                    //the request is success
                     console.log(response.data[0].AccountName);
                     for (let i = 0; i <response.count; i++){
                        $('#paymentTypeitems').append('<option value="'+response.data[i].id+'::'+response.data[i].AccountID+'::'+response.data[i].AccountName+'">'+response.data[i].AccountName+'</option>');
                     }
                },
                complete: function(response){ }
            });
            document.getElementById(`paymentType`).style.display = "flex";
            document.getElementById(`cashcard`).style.display = "none";
        } else if(obj.value == 4){
            document.getElementById(`paymentType`).style.display = "none";
            document.getElementById(`cashcard`).style.display = "flex";
        }else
        {   document.getElementById(`paymentType`).style.display = "none";
            document.getElementById(`cashcard`).style.display = "none";
        }




      }

    </script>
