@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sandat.SinadatindexDeliver') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sandat.Treasurysandbanks') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sandat.SinadatindexDeliver') }} </li>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">   {{ trans('Sandat.AddSinadatindexDeliver') }} </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('Sinadat.store') }}" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Sandat.supplier') }}</label>
                          {{-- <input type="text" class="form-control @error('customerName') is-invalid @enderror" id="customerName" name="customerName" value="" readonly> --}}
                            <select class="form-control @error('supplierID') is-invalid @enderror" id="supplierID" name="customerID">
                                <option value=""> {{ trans('Sandat.Choosesupplier') }}</option>
                                @foreach (auth()->user()->organization->suppliers as $supplier)
                                    <option value="{{$supplier->id}}::{{$supplier->AccountID}}" >{{$supplier->name}}</option>
                                @endforeach
                            </select>

                          {{-- <input type="hidden" name="orderID" value="{{$order->id}}"> --}}

                          @error('customerName')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Sandat.date') }}</label>
                          <input type="date" class="form-control @error('total') is-invalid @enderror" value="<?php echo date('Y-m-d');?>" id="date" name="date" >
                          @error('date')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Sandat.Total') }}</label>
                          <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" onchange="getRest();" placeholder="{{ trans('Sandat.Total') }}">
                          @error('total')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Sandat.Referenceorinvoicenumber') }}   </label>
                          <input type="text" class="form-control @error('Ref') is-invalid @enderror" id="Ref" name="Ref" value="" >
                          @error('Ref')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>


                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Sandat.comment') }}</label>
                          <input type="text" class="form-control text-right @error('comment') is-invalid @enderror" id="comment" name="comment" placeholder=" {{ trans('Sandat.comment') }}">
                          @error('comment')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <input type="hidden" name="type" value="2">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name"> {{ trans('Sandat.Paymenttype') }}</label>
                          <select class="form-control @error('paymentType') is-invalid @enderror" id="paymentType" name="paymentType"  onchange="payments()">
                            <option style="display: none" ></option>
                            <option value="121">{{ trans('Sandat.Cash') }}</option>
                            <option value="122">{{ trans('Sandat.Net') }}</option>
                          </select>
                          @error('type')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3" id="paymentAccount">
                        <div class="form-group">
                          <label for="">  {{ trans('Sandat.Paymentaccount') }}</label>
                          <select class="form-control @error('paymentTypeitems') is-invalid @enderror" id="paymentTypeitems" name="paymentTypeitems" >
                          </select>

                          @error('payDate')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name"> {{ trans('Sandat.Attached') }}</label>
                          <input type="file" class="form-control" name="img" id="img">
                          @error('img')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('Sandat.Costcenter') }}</label>
                          {{-- <input type="text" class="form-control @error('customerName') is-invalid @enderror" id="customerName" name="customerName" value="" readonly> --}}
                          <select class="form-control @error('CostCenter') is-invalid @enderror" id="CostCenter" name="CostCenter">
                       
                            @foreach (auth()->user()->organization->CostCenter as $customer)
                                <option value="{{$customer->id}}" >{{$customer->CostName}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <input type="submit" class="btn btn-primary" value="{{ trans('Sandat.save') }}" style="width: 100%">
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <hr class="my-4" />
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
<script>
  function getRest(){
    document.getElementById('rest').value = document.getElementById('restOld').value - document.getElementById('total').value;
  }




  function payments()
  { type = document.getElementById('paymentType').value;
    console.log(type);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#paymentTypeitems').empty()

 if(type==121){


    $.ajax({
            type: 'post',
            url: "/purchases.SearchAccount/"+type,
            data: {id : type},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(){
                //before sending the request

                //  console.log("sdsdsdfff");

            },
            success: function(response){
                //the request is success
                 console.log(response.data[0].AccountName);

                 for (let i = 0; i <response.count; i++){
                    $('#paymentTypeitems').append('<option value="'+response.data[i].id+'::'+response.data[i].AccountID+'::'+response.data[i].AccountName+'">'+response.data[i].AccountName+'</option>');
                 }





            },
            complete: function(response){
                //the request is completed
                // console.log("fff");
            }
        });

  }
  if(type==122)
  {

    $.ajax({
            type: 'post',
            url: "/purchases.SearchAccount/"+type,
            data: {id : type},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(){
                //before sending the request

                //  console.log("sdsdsdfff");

            },
            success: function(response){
                //the request is success
                 console.log(response.data[0].AccountName);

                 for (let i = 0; i <response.count; i++){
                    $('#paymentTypeitems').append('<option value="'+response.data[i].id+'::'+response.data[i].AccountID+'::'+response.data[i].AccountName+'">'+response.data[i].AccountName+'</option>');
                 }





            },
            complete: function(response){
                //the request is completed
                // console.log("fff");
            }
        });



  }



  }
</script>

