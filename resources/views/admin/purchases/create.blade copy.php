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
            <div class="col-3">
                <div class="card card-primary" style="height: 110px">
                    <div class="card-body">
                        <div>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                                @if(count(auth()->user()->branch->durations)>0)
                                  @if(auth()->user()->branch->durations->first()->status==1)
                                  <input type="text"  class="form-control" id="barcode" name="barcode" placeholder="كود المنتج" autofocus onchange="getBarcode(this.value)">
                                  <input type="text" class="mt-1 autocomplete form-control " id="prodName" name="prodName" style="width: 73%;display:inline-block" placeholder="اكتب اسم المنتج">
                                  <a href="#" class="btn btn-primary" style="width: 25%;display:inline-block">بحث</a>
                                  @else
                                  <h6 class="text-center text-danger">الرجاء بدء الدوام</h6>
                                  @endif
                                @else
                                <h6 class="text-center text-danger">الرجاء بدء الدوام</h6>
                                @endif

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
            {{-- <div class="card card-primary bg-danger text-white" style="height: 70px">
              <div class="card-body">
                <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <h2 class="text-center text-white" id="pname"></h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div> --}}
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <div class="col-4">
            <div class="card card-primary bg-danger" style="height: 110px">
              <div class="card-body">
                <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <h1>
                            <strong id="bigtotal">0</strong> <span class="text-small">ريال</span>
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
            <div class="card card-primary" style="height: 750px">

              <div class="card-body">
                <form class="user" method="POST" action="{{route('purchases.store')}}" enctype = "multipart/form-data">
                  @csrf
                <div style="height: 420px;overflow-y: scroll;">
                  <table id="example5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>المنتج</th>
                      <th>السعر</th>
                      <th>الكمية</th>
                      <th>المجموع</th>
                      <th>خيارات</th>
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
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="">المورد</label>
                          <select class="form-control @error('supplierID') is-invalid @enderror" id="supplierID" name="supplierID">
                            <option value="">اختر المورد</option>
                            @foreach (auth()->user()->organization->suppliers as $supplier)
                                <option value="{{$supplier->id}}::{{$supplier->AccountID}}">{{$supplier->name}}</option>
                            @endforeach
                          </select>
                          @error('supplierID')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label for="">خطة الدفع</label>
                          <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" onchange="payments()">
                            <option value="" style="display:none" ></option>
                            <option value="121">نقداً</option>
                            <option value="122">شبكة</option>
                            <option value="3">آجل</option>
                          </select>
                          @error('type')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3" id="paymentType" style="display: none" >
                        <div class="form-group">
                          <label for=""> حساب الدفع</label>
                          <select class="form-control @error('paymentTypeitems') is-invalid @enderror" id="paymentTypeitems" name="paymentTypeitems" >
                          </select>

                          @error('payDate')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3" id="paymentDate" style="display: none">
                        <div class="form-group">
                          <label for="">تاريخ السداد</label>
                          <input type="date" class="form-control @error('payDate') is-invalid @enderror" id="payDate" name="payDate" placeholder="تاريخ الفاتورة">
                          @error('payDate')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">مركز التكلفة </label>
                          <select class="form-control @error('customerID') is-invalid @enderror" id="costcenter" name="costcenter" onchange="addCustomer(this)">
                            <option value=""> مركز التكلفة </option>
                            @foreach (  $cost as $cost)
                                <option value="{{$cost->id}}">{{$cost->CostName}}</option>
                            @endforeach

                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">رقم الفاتورة</label>
                          <input type="text" class="form-control @error('serial') is-invalid @enderror" id="serial" name="serial" placeholder="رقم فاتورة المشتريات">
                          @error('serial')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">تاريخ الفاتورة</label>
                          <input type="date" class="form-control @error('invoiceDate') is-invalid @enderror" id="invoiceDate" name="invoiceDate" placeholder="تاريخ الفاتورة">
                          @error('invoiceDate')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <input type="hidden" name="total" id="total" value="0" />
                      <input type="hidden" name="vat" id="vat" value="0" />
                      <input type="hidden" name="totalwvat" id="totalwvat" value="0" />
                      <input type="hidden" name="totaldiscount" id="totaldiscount" value="0" />
                      <input type="hidden" name="count" id="count" value="0">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for=""> نوع الفاتورة </label>
                          <select class="form-control @error('customerID') is-invalid @enderror" id="TypeFatorah" name="TypeFatorah" >
                            <option value="1">  مسودة </option>
                            <option value="2"> مرحل  </option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">  </label>
                          <label for="">  </label>
                          <label for="">  </label>
                          <input type="submit" class="btn btn-primary" value="حفظ" style="width: 100%">
                        </div>
                      </div>

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
  var count = 0;
  var rows = 0;
  var nameAr = "";
  $('#barcode').change(function(){

getByBarcode( document.getElementById('barcode').value);


  });


function getByBarcode( varcode)
{

    document.getElementById("prodName").value ="";
    $.ajax({
    url: `/getBarcode/${varcode}`,
    success: data => {
      count++;
      rows++;
      document.getElementById('barcode').value = "";
      document.getElementById("barcode").focus();


      //$('#prodName').empty()
      data.items.forEach(item =>
        {

          $('#tbody').append(`
          <tr id="tr-${count}-">
            <td>${item.id}</td>
            <td>${item.nameAr}</td>
            <td><input type="number" id="price${count}" name="price${count}" value="${item.costPrice}" onchange="calculate(${count})"></td>>
            <td><input type="number" id="quantity${count}" name="quantity${count}" value="1" onchange="calculate(${count})"></td>
            <td><input type="text" id="desc${count}" name="desc${count}"  style="width: 90%"></td>
            <td id="itotal">${item.costPrice}</td>
            <td class="text-center">
              <input type="hidden" name="item${count}" id="item${count}" value="${item.id}" />
              <input type="hidden" name="discount${count}" id="discount${count}" value="0" />
              <input type="hidden" name="rtotal${count}" id="rtotal${count}" value="0" />
              <input type="hidden" name="rvat${count}" id="rvat${count}" value="0" />
              <input type="hidden" name="rtotalwvat${count}" id="rtotalwvat${count}" value="${item.costPrice}" />
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

      }

  }

  $("form").bind("keypress", function (e) {
    if (e.keyCode == 13) {
        $("#barcode").focus()
        //add more buttons here
        return false;
    }
});






$('#type').change(function(){
  type = document.getElementById('type').value;

  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#paymentTypeitems').empty();

  if(type==121)
  {


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


    document.getElementById('paymentType').style.display = "block";
    document.getElementById('paymentDate').style.display = "none";

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

    document.getElementById('paymentType').style.display = "block";
    document.getElementById('paymentDate').style.display = "none";

  }

  if(type==3)
  {
    document.getElementById('paymentDate').style.display = "block";
    document.getElementById('paymentType').style.display = "none";
  }


});
</script>

<script>
    $('#prodName').change(function(){
      nameAr = document.getElementById("prodName").value;
      arr_index = items.map((el) => el.nameAr).indexOf(nameAr);
      barcode = items[arr_index].barcode;
      getByBarcode(barcode);
       document.getElementById("prodName").value ="";
    });
    var availableTags = <?php echo json_encode($items); ?>;
    var items = <?php echo json_encode($items_all); ?>;
      $( ".autocomplete" ).autocomplete({
      source: availableTags
    });
  </script>
@endsection

