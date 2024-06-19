@extends('layouts.dashboard')
<style>
  td ,th {
    padding: 0px !important;
    text-align: center !important;
  }
</style>
@section('content')
<!-- /.content-header -->



<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row mt-2">
          <div class="col-12">
            <div class="card card-primary" style="height: 800px">

              <div class="card-body">
                <form class="user" method="POST" action="{{route('OfferPrice.store')}}"  target="_blank" enctype = "multipart/form-data" onsubmit="setTimeout(function(){window.location.reload();},10);">
                  @csrf
                <div style="height: 600px;overflow-y: scroll;">
                  <table id="example4" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>المنتج</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        <th>المجموع</th>
                        <th>خيارات</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr id="itemsR1">
                            <td>18</td>
                            <td>18</td>
                            <td>
                                <input type="text" class="form-control" name="itemName1" id="itemName1" onkeyup="doChangSelect(this)" >
                                <div id="prodect_list">

                                </div>
                            </td>
                            <td><input type="number" min="0.00" step=".01" id="price1" name="price1" value="13" onchange="calculate(1)" readonly=""></td>
                            <td><input type="number" min="0.00" step=".01" id="quantity1" name="quantity1" value="1" onchange="calculate(1)"></td>
                            <td id="itotal1">13</td>
                            <td class="text-center">
                              <input type="hidden" name="item1" id="item1" value="18">
                              <input type="hidden" name="cprice1" id="cprice1" value="11">
                              <input type="hidden" name="itemName1" id="itemName1" value="شاهي الكبوس خيط">
                              <input type="hidden" name="discount1" id="discount1" value="0">
                              <input type="hidden" name="rtotal1" id="rtotal1" value="11.3">
                              <input type="hidden" name="rvat1" id="rvat1" value="1.7">
                              <input type="hidden" name="vatValue1" id="vatValue1" value="15">
                              <input type="hidden" name="rtotalwvat1" id="rtotalwvat1" value="13">
                              <a href="#" onclick="removeItem(1)" class="text-danger text-center"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>


                    </tbody>
                  </table>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-8">
                    <div class="row">
                      <div class="col-lg-2">
                        <div class="form-group">
                          <select class="form-control @error('customerID') is-invalid @enderror" id="customerID" name="customerID" onchange="addCustomer(this)">
                            <option value="">اختر العميل</option>
                            @foreach (auth()->user()->organization->customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                            @endforeach
                            <option value="-1">اضافة عميل جديد</option>
                          </select>
                          @error('customerID')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>


                      <div class="col-lg-4 row" id="newcustomer" style="display: none">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="text" class="form-control @error('customerName') is-invalid @enderror" id="customerName" name="customerName" placeholder="اسم العميل">
                            @error('customerName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="number" class="form-control @error('customerVat') is-invalid @enderror" id="customerVat" name="customerVat" placeholder="الرقم الضريبي">
                            @error('customerVat')
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
                            <input type="submit" class="btn btn-primary" value="حفظ" style="width: 100%">
                          </div>
                        </div>
                        @endif
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group text-left">
                      <h6>المجموع</h6>
                      <h6>ضريبة القيمة المضافة</h6>
                      <h6>الاجمالي شامل الضريبة</h6>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group text-right">
                      <h6> <strong id="view-total"></strong></h6>
                      <h6> <strong id="view-vat"></strong></h6>
                      <h6 class="text-danger"> <strong id="view-totalwvat"></strong> ريال</h6>
                    </div>
                  </div>
                </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
</section>


<!------------------------------------add saeed -------------------------------------------------->






@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( document ).ready(function() {

});


function removeItem(trnum){

     var myobj = document.getElementById('itemsR'+1);
    // console.log(myobj);

     myobj.remove();

  }

</script>


<script>
    function doChangSelect(val){



    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
     $.ajax({
            type: 'post',
            url: "/OfferPrice.serach",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {'data' : val.value},
            beforeSend: function(){



            },
            success: function(response){
                //the request is success
                $('#prodect_list').empty();

        // console.log(response);
               $('#prodect_list').append(response);


            },
            complete: function(response){
                //the request is completed

            }
     });


}


function calculate(id){
    var price = document.getElementById('price'+id).value;
    var quantity = document.getElementById('quantity'+id).value;
    var discount = document.getElementById('discount'+id).value;
    var vatValue = document.getElementById('vatValue'+id).value;
                              //price without vat
    var rtotal = +parseFloat(price/(1+(vatValue/100)) * quantity - discount/(1+(vatValue/100))).toFixed(2);//total without vat
    var rvat = +parseFloat(rtotal * (vatValue/100)).toFixed(2);
    var rtotalwvat = +parseFloat(price*quantity-discount).toFixed(2);

    document.getElementById('rtotal'+id).value = rtotal;
    document.getElementById('rvat'+id).value = rvat;
    document.getElementById('rtotalwvat'+id).value = rtotalwvat;
    $( "#itotal"+id ).empty().append(rtotalwvat);

    calculateTotal();
  }



$(document).on('click', '.list-group-item', function(){
        var value = $(this).text();

        var idlink=$(this).attr('data-id');
        var div =$(this).parent().parent();
        var input=div.prev();

        input.attr('data-store',idlink);
        input.val(value);
        div.html("");

     });
</script>

