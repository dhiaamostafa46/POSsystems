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
          <div class="col-3">
            <div class="card card-primary" style="height: 70px">
              <div class="card-body">

                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          {{-- <input type="text"  class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="كود المنتج" autofocus onchange="getBarcode(this.value)">
                          @error('barcode')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror --}}
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-5">
            <div class="card card-primary bg-black text-primary" style="height: 70px">
              <div class="card-body">
                <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <h2 class="text-center text-success" id="pname"></h2>
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
            <div class="card card-primary bg-black" style="height: 70px">
              <div class="card-body">
                <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <h1>
                            <strong id="bigtotal">0</strong> <span class="text-small">{{ trans('purchases.Rial') }}</span>
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
            <div class="card card-primary" style="height: 700px">

              <div class="card-body">
                <form class="user" method="POST" action="{{route('credorders.store')}}" enctype = "multipart/form-data">
                  @csrf
                <div style="height: 460px">
                  <table id="example5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>

                      <th style="width: 10%">{{ trans('Sale.ProductName') }} </th>
                      <th style="width: 15%">  {{ trans('Sale.priceofapill') }}</th>
                      <th style="width: 15%">{{ trans('Sale.Quantity') }}</th>
                      <!--<th style="width: 15%"> {{ trans('Sale.Unit') }}</th>-->
                      <th> {{ trans('Sale.description') }}</th>
                      <th style="width: 10%">  {{ trans('Sale.Total') }} </th>
                      <th style="width: 10%"> {{ trans('Sale.Options') }}</th>
                    </tr>
                    </thead>

                    <tbody id="tbody">
                    </tbody>
                  </table>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-8">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <input type="text" class="form-control @error('serial') is-invalid @enderror" value="{{$Purchase->serial}}" id="serial" readonly name="serial" placeholder="رقم الفاتورة">
                          @error('serial')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-2" style="display: none">
                        <div class="form-group">
                            <input type="text" class="form-control" id="Decscontall"
                            onchange="ShowDecscontall()" value="0"   name="Decscontall" placeholder="خصم">
                        </div>
                    </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <select class="form-control @error('customerID') is-invalid @enderror" id="customerID" name="customerID">
                            <option value=""> > {{ trans('Sale.CustomerChoose') }} </option>
                            @foreach (auth()->user()->organization->customers as $customer)
                                <option @if ($Purchase->customerID == $customer->id)  selected  @endif value="{{$customer->id}}">{{$customer->name}}</option>
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
                          <select class="form-control @error('type') is-invalid @enderror" id="type" onchange="showCashCard(this)" name="type">
                            <option value="121" > {{ trans('Sale.Cash') }} </option>
                            <option value="122"> {{ trans('Sale.Net') }} </option>
                          </select>
                          @error('type')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4 row mb-3" id="paymentType"style="display: none" >


                        <div class="col-sm-9">
                            <select class="form-control @error('paymentTypeitems') is-invalid @enderror" id="paymentTypeitems" name="paymentTypeitems" >
                            </select>
                        </div>
                      </div>
                      <input type="hidden" name="total" id="total" value="0" />
                      <input type="hidden" name="vat" id="vat" value="0" />
                      <input type="hidden" name="totalwvat" id="totalwvat" value="0" />
                      <input type="hidden" name="totaldiscount" id="totaldiscount" value="0" />
                      <input type="hidden" name="count" id="count" value="0">
                      <div class="col-lg-5">
                        <div class="form-group">
                          <input type="submit" class="btn btn-primary" value=" {{ trans('Sale.save') }} " style="width: 100%">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <table class="table table-borderless">
                        <tr>
                          <th>  <h6>{{ trans('Sale.Total') }}</h6></th>
                          <th>   <h6 > <strong id="view-total"> </strong> </h6></th>
                        </tr>
                        <tr>
                          <td>  <h6>  {{ trans('Sale.Valueaddedtax') }}</h6> </td>
                          <td>  <h6> <strong id="view-vat"> </strong></h6> </td>
                        </tr>
                        <tr>
                            <td> <h6>  {{ trans('Sale.Totalincludingtax') }}</h6> </td>
                            <td>      <h6 class="text-danger"> <strong id="view-totalwvat"></strong> {{ trans('purchases.Rial') }} </h6> </td>
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



<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( document ).ready(function() {

    data ="";
    count=0;
      @if($flage ==0)
            @foreach( $Purchase->orderdetails as $index => $product )
                count=count+1;
                data = data+'<tr id="tr-{{$index+1}}-"> <td>{{$index+1}}</td> <td>{{$product->product->nameAr }}</td>';
                data = data+' <td><input type="number"   class="form-control text-center" id="price{{$index+1}}" name="price{{$index+1}}" value="{{$product->price}}" onchange="calculate({{$index+1}})"></td>';
                data = data+'<td><input type="number"    class="form-control text-center" id="quantity{{$index+1}}" name="quantity{{$index+1}}" value="{{$product->quantity}}" onchange="calculate({{$index+1}})"></td>';
                data = data+'<td><input type="text"   class="form-control text-center" id="desc{{$index+1}}" name="desc{{$index+1}}"  style="width: 90%"></td>';

                data = data+'  <td id="itotal{{$index+1}}">{{$product->total }}</td>';
                // data = data+' <td id="itotal{{$index+1}}">{{$product->quantity * $product->price }}</td>';
                data = data+'   <td class="text-center"><input type="hidden" name="item{{$index+1}}" id="item{{$index+1}}" value="{{$product->productID}}"/>';
                data = data+'   <input type="hidden" name="discount{{$index+1}}" id="discount{{$index+1}}" value="0" />';
                data = data+'   <input type="hidden" name="rtotal{{$index+1}}"   id="rtotal{{$index+1}}" value="0" />';
                data = data+'   <input type="hidden" name="rvat{{$index+1}}"     id="rvat{{$index+1}}" value="0" />';
                data = data+'   <input type="hidden" name="rtotalwvat{{$index+1}}" id="rtotalwvat{{$index+1}}" value="{{$product->total}}" />';
                data = data+'  <a href="#" onclick="removeItem({{$index+1}})" class="text-danger text-center"><i class="fa fa-times"></i></a> </td></tr>';
            @endforeach
        @else
            @foreach( $Purchase->orderdetails as $index => $product )
                    count=count+1;
                    data = data+'<tr id="tr-{{$index+1}}-"> <td>{{$index+1}}</td> <td>{{$product->product->nameAr }}</td>';
                    data = data+' <td><input type="number"   class="form-control text-center" id="price{{$index+1}}" name="price{{$index+1}}" value="{{$product->price}}" onchange="calculate({{$index+1}})"></td>';
                    data = data+'<td><input type="number"    class="form-control text-center" id="quantity{{$index+1}}" name="quantity{{$index+1}}" value="{{$product->quantity}}" onchange="calculate({{$index+1}})"></td>';
                    data = data+'<td><input type="text"   class="form-control text-center"  id="desc{{$index+1}}" name="desc{{$index+1}}"  style="width: 90%"></td>';

                    data = data+'  <td id="itotal{{$index+1}}">{{$product->total }}</td>';
                    // data = data+' <td id="itotal{{$index+1}}">{{$product->quantity * $product->price }}</td>';
                    data = data+'   <td class="text-center"><input type="hidden" name="item{{$index+1}}" id="item{{$index+1}}" value="{{$product->productID}}"/>';
                    data = data+'   <input type="hidden" name="discount{{$index+1}}" id="discount{{$index+1}}" value="0" />';
                    data = data+'   <input type="hidden" name="rtotal{{$index+1}}"   id="rtotal{{$index+1}}" value="0" />';
                    data = data+'   <input type="hidden" name="rvat{{$index+1}}"     id="rvat{{$index+1}}" value="0" />';
                    data = data+'   <input type="hidden" name="rtotalwvat{{$index+1}}" id="rtotalwvat{{$index+1}}" value="{{$product->total}}" />';
                    data = data+'  <a href="#" onclick="removeItem({{$index+1}})" class="text-danger text-center"><i class="fa fa-times"></i></a> </td></tr>';
            @endforeach
        @endif


      $('#tbody').append(data);
      $('#view-total').append("0");
      $('#view-vat').append("0");
      $('#view-totalwvat').append("0");
    document.getElementById('count').value = count;
    rows=count;

    calculateTotal();
});
</script>






















<script>
  var count = 0;
  var rows = 0;
  var nameAr = "";
  $('#barcode').change(function(){

      $.ajax({
        url: `/getBarcode/${document.getElementById('barcode').value}`,
        success: data => {
          count++;
          rows++;
          document.getElementById('barcode').value = "";
          document.getElementById("barcode").focus();

          document.getElementById('pname').innerHTML = "";
          //$('#prodName').empty()
          data.items.forEach(item =>
            {
              document.getElementById('pname').innerHTML = item.nameAr;
              $('#tbody').append(`
              <tr id="tr-${count}-">
                <td>${item.id}</td>
                <td>${item.nameAr}</td>
                <td><input type="number" id="price${count}" name="price${count}" value="${item.prodPrice}" onchange="calculate(${count})"></td>>
                <td><input type="number" id="quantity${count}" name="quantity${count}" value="1" onchange="calculate(${count})"></td>
                <td><input type="text" id="desc${count}" name="desc${count}"  style="width: 90%"></td>
                <td id="itotal${count}">${item.prodPrice}</td>
                <td class="text-center">
                  <input type="hidden" name="item${count}" id="item${count}" value="${item.id}" />
                  <input type="hidden" name="discount${count}" id="discount${count}" value="0" />
                  <input type="hidden" name="rtotal${count}" id="rtotal${count}" value="0" />
                  <input type="hidden" name="rvat${count}" id="rvat${count}" value="0" />
                  <input type="hidden" name="rtotalwvat${count}" id="rtotalwvat${count}" value="${item.prodPrice}" />
                  <a href="#" onclick="removeItem(${count})" class="text-danger text-center"><i class="fa fa-times"></i></a>
                </td>
              </tr>
              `)

            }

          )
          document.getElementById('count').value = count;
          calculateTotal();
        }
      });


      });

      function removeItem(trnum){
        var myobj = document.getElementById("tr-"+trnum+"-");
        myobj.remove();
        rows--;
        calculateTotal();
      }

    function calculate(id){
    var price = document.getElementById('price'+id).value;
    var quantity = document.getElementById('quantity'+id).value;
    var discount = document.getElementById('discount'+id).value;

    var rtotal = +parseFloat(price/1.15 * quantity - discount/1.15).toFixed(2);
    var rvat = +parseFloat(rtotal * 0.15).toFixed(2);
    var rtotalwvat = +parseFloat(price*quantity-discount).toFixed(2);

    document.getElementById('rtotal'+id).value = rtotal;
    document.getElementById('rvat'+id).value = rvat;
    document.getElementById('rtotalwvat'+id).value = rtotalwvat;
    $( "#itotal"+id ).empty().append(rtotalwvat);

    calculateTotal();
  }

  function calculateTotal(){
    totalwvat = 0;
    total = 0;
    vat = 0;

    totaldiscount = 0;
      if(rows > 0){
        for(i=1;i<=count;i++){
        try{
        var rtotalwvat = document.getElementById("rtotalwvat"+i+"").value;
        var discount = document.getElementById("discount"+i+"").value;

        totalwvat += parseFloat(rtotalwvat);
        total = +parseFloat(totalwvat/1.15).toFixed(2);
        vat = +parseFloat(totalwvat - total).toFixed(2);
        totaldiscount += parseFloat(discount);

        document.getElementById("total").value = +parseFloat(total).toFixed(2);
        document.getElementById("vat").value = +parseFloat(vat).toFixed(2);
        document.getElementById("totalwvat").value = +parseFloat(totalwvat).toFixed(2);
        document.getElementById("totaldiscount").value = +parseFloat(totaldiscount).toFixed(2);
        $( "#view-total" ).empty().append(document.getElementById('total').value);
        $( "#view-vat" ).empty().append(document.getElementById('vat').value);
        $( "#view-totalwvat" ).empty().append(document.getElementById('totalwvat').value);
        $( "#bigtotal" ).empty().append(document.getElementById('totalwvat').value);
        //$( "#view-totaldiscount" ).empty().append(document.getElementById('totaldiscount').value);
        }catch{

        }
      }
      }else{
        document.getElementById("total").value = 0;
        document.getElementById("vat").value = 0;
        document.getElementById("totalwvat").value = 0;
        document.getElementById("totaldiscount").value = 0;
        $( "#view-total" ).empty().append(document.getElementById('total').value);
        $( "#view-vat" ).empty().append(document.getElementById('vat').value);
        $( "#view-totalwvat" ).empty().append(document.getElementById('totalwvat').value);
        $( "#bigtotal" ).empty().append(document.getElementById('totalwvat').value);
        document.getElementById('pname').innerHTML = "";
      }

  }

  $("form").bind("keypress", function (e) {
    if (e.keyCode == 13) {
        $("#barcode").focus()
        //add more buttons here
        return false;
    }
});
</script>



































<script>



$( document ).ready(function() {


             $.ajax({
                type: 'post',
                url: "/purchases.SearchAccount/"+121,
                data: {id : 121},
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

});

// -----------------------------------------------------------------------------------------------------------------
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

        }




      }

    </script>

@endsection
