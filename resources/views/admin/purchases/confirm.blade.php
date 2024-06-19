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
            <div class="card card-primary" style="height: 70px">
              <div class="card-body">
                
                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <input type="text"  class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="كود المنتج" autofocus onchange="getBarcode(this.value)">
                          @error('barcode')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
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
            <div class="card card-primary bg-warning text-white" style="height: 70px">
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
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <div class="col-4">
            <div class="card card-primary bg-warning" style="height: 70px">
              <div class="card-body">
                <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <h1>
                            <strong id="bigtotal">{{$purchase->totalwvat}}</strong> <span class="text-small">ريال</span>
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
            <div class="card card-primary" style="height: 690px">
              
              <div class="card-body">
                <form class="user" method="POST" action="{{route('sorders.store')}}" enctype = "multipart/form-data">
                  @csrf
                <div style="height: 420px">
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
                      @foreach ($purchase->purchasedetails as $index => $item)
                      <tr id="tr-{{$index+1}}-">
                        <td>{{$item->product->id}}</td>
                        <td>{{$item->product->nameAr}}</td>
                        <td><input type="number" id="price{{$index+1}}" name="price{{$index+1}}" value="{{$item->price}}" onchange="calculate({{$index+1}})" readonly></td>
                        <td><input type="number" id="quantity{{$index+1}}" name="quantity{{$index+1}}" value="{{$item->quantity}}" onchange="calculate({{$index+1}})"></td>
                        <td id="itotal">{{$item->price * $item->quantity}}</td>
                        <td class="text-center">
                          <input type="hidden" name="item{{$index+1}}" id="item{{$index+1}}" value="{{$item->product->id}}" />
                          <input type="hidden" name="discount{{$index+1}}" id="discount{{$index+1}}" value="0" />
                          <input type="hidden" name="rtotal{{$index+1}}" id="rtotal{{$index+1}}" value="0" />
                          <input type="hidden" name="rvat{{$index+1}}" id="rvat{{$index+1}}" value="0" />
                          <input type="hidden" name="rtotalwvat{{$index+1}}" id="rtotalwvat{{$index+1}}" value="{{$item->price * $item->quantity}}" />
                          <a href="#" onclick="removeItem({{$index+1}})" class="text-danger text-center"><i class="fa fa-times"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>

                  </table>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">المورد</label>
                          <select class="form-control @error('supplierID') is-invalid @enderror" id="supplierID" name="supplierID">
                            <option value="">اختر المورد</option>
                            @foreach (auth()->user()->organization->suppliers as $supplier)
                                <option value="{{$supplier->id}}" @if($supplier->id == $purchase->supplierID) selected @endif>{{$supplier->name}}</option>
                            @endforeach
                          </select>
                          @error('supplierID')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">نوع الدفع</label>
                          <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" onchange="payments()">
                            <option value="1" @if($purchase->type == 1) selected @endif>نقداً</option>
                            <option value="2" @if($purchase->type == 2) selected @endif>شبكة</option>
                            <option value="3" @if($purchase->type == 3) selected @endif>آجل</option>
                          </select>
                          @error('type')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">رقم الفاتورة</label>
                          <input type="text" class="form-control @error('serial') is-invalid @enderror" id="serial" name="serial" placeholder="رقم فاتورة المشتريات" value="{{$purchase->serial}}">
                          <input type="hidden" name="purchaseID" value="{{$purchase->id}}">
                          @error('serial')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">المستلم</label>
                          <input type="text" class="form-control @error('reciever') is-invalid @enderror" id="reciever" name="reciever" placeholder="اسم المستلم" value="{{auth()->user()->name}}" required>
                          @error('reciever')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">رقم الجوال</label>
                          <input type="phone" pattern="[0-9]{10}" maxlength="10" oninvalid="this.setCustomValidity('ادخل رقم جوال حقيقي')"
            oninput="this.setCustomValidity('')" minlength="10" class="form-control @error('recieverPhone') is-invalid @enderror" id="recieverPhone" name="recieverPhone" value="{{auth()->user()->phone}}" placeholder="رقم الجوال" required>
                          @error('recieverPhone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="">المسلّم</label>
                          <input type="text" class="form-control @error('deliver') is-invalid @enderror" id="deliver" name="deliver" placeholder="اسم المسلّم" value="{{$purchase->supplier->name}}" required>
                          @error('deliver')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="">التعليق</label>
                          <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" placeholder="اكتب تعليقك" rows="3" required></textarea>
                          @error('comment')
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
                      <input type="hidden" name="count" id="count" value="{{count($purchase->purchasedetails)}}">
                      <input type="hidden" name="rows" id="rows" value="{{count($purchase->purchasedetails)}}">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <input type="submit" class="btn btn-primary" value="حفظ" style="width: 100%">
                        </div>
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
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
</section>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  var count = document.getElementById('count').value;
  var rows = document.getElementById('rows').value;
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
                <td><input type="number" id="price${count}" name="price${count}" value="${item.costPrice}" onchange="calculate(${count})"></td>>
                <td><input type="number" id="quantity${count}" name="quantity${count}" value="1" onchange="calculate(${count})"></td>
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
    var rtotalwvat = +parseFloat(rtotal+rvat).toFixed(2);

    document.getElementById('rtotal'+id).value = rtotal;
    document.getElementById('rvat'+id).value = rvat;
    document.getElementById('rtotalwvat'+id).value = rtotalwvat;
    $( "#itotal" ).empty().append(rtotalwvat);

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

$('#type').change(function(){
  type = document.getElementById('type').value;
  if(type == 3){
    document.getElementById('paymentDate').style.display = "block";
  }else{
    document.getElementById('paymentDate').style.display = "none";
  }
});
</script>
@endsection
