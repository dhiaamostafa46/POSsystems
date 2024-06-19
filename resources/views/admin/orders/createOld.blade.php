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
                          @if(count(auth()->user()->branch->durations)>0)
                            @if(auth()->user()->branch->durations->first()->status==1)
                            <input type="text"  class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="كود المنتج" autofocus onchange="getBarcode(this.value)">
                            
                            <select name="txtProd" id="txtProd" class="livesearch form-control">

                            </select>
                            @else
                            <h6 class="text-center text-danger">الرجاء بدء الدوام</h6>
                            @endif
                          @else
                          <h6 class="text-center text-danger">الرجاء بدء الدوام</h6>
                          @endif
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
            <div class="card card-primary" style="height: 560px">
              
              <div class="card-body">
                <form class="user" method="POST" action="{{route('orders.store')}}"  target="_blank" enctype = "multipart/form-data" onsubmit="setTimeout(function(){window.location.reload();},10);">
                  @csrf
                <div style="height: 400px;overflow-y: scroll;">
                  <table id="example4" class="table table-bordered table-hover">
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
                      <div class="col-lg-2">
                        <div class="form-group">
                          <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" onchange="showCashCard(this)" required>
                            <option value="">طريقة الدفع</option>
                            <option value="1">نقداً</option>
                            <option value="2">شبكة</option>
                            <option value="4">نقداً وشبكة</option>
                            <option value="3">آجل</option>
                          </select>
                          @error('type')
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
            <!-- /.card -->
            <div class="card">
              <div class="card-body">
                <div class="row col-lg-5 float-left"style="margin:15px">
                  @if(count(auth()->user()->branch->durations)>0)
                    @if(auth()->user()->branch->durations->first()->status==1)
                    <h6 class="col-md-6">حالة الدوام: <strong class='text-success'>مفتوح</strong></h6>
                    <h6 class="col-md-6">زمن بدء الدوام: <strong>{{auth()->user()->branch->durations->first()->created_at}}</strong></h6>
                    <h6 class="col-md-6">رقم الدوام: <strong>{{auth()->user()->branch->durations->first()->durationNo}}</strong></h6>
                    <h6 class="col-md-6">المستخدم: <strong>{{auth()->user()->branch->durations->first()->user->name}}</strong></h6>
                    <h6> <a href="#" onclick="endDuration({{auth()->user()->branch->durations->first()->id}});" class="btn btn-danger"><i class="fa fa-times"></i> انهاء الدوام </a></h6>
                    @else
                    <h6 class="col-md-6">حالة الدوام: <strong class='text-danger'>مغلق</strong></h6>
                    <h6 class="col-md-6"><a href="#" onclick="startDuration();" class="btn btn-primary" style="width:100%">بدء الدوام</a></h6>
                    @endif
                  @else
                  <h6 class="col-md-6">حالة الدوام: <strong class='text-danger'>مغلق</strong></h6>
                  <h6 class="col-md-6"><a href="#" onclick="startDuration();" class="btn btn-primary" style="width:100%">بدء الدوام</a></h6>
                  @endif
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
</section>

<!-- Customers Modal -->
<div class="modal fade modal" id="customersModel" tabindex="-1" role="dialog" aria-labelledby="customersModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">اضافات عميل</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="col-12 row mt-3">
        <div class="col-12">
          <form class="user" id="customerForm" action="#" enctype = "multipart/form-data">
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text"  class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="اسم العميل">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text"  class="form-control @error('area') is-invalid @enderror" id="area" name="area" placeholder="اكتب المنطقة">
                    @error('area')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text"  class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="اكتب المدينة">
                    @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text"  class="form-control @error('district') is-invalid @enderror" id="district" name="district" placeholder="اكتب المدينة">
                    @error('district')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text"  class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="اكتب العنوان">
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text"  class="form-control @error('vatNo') is-invalid @enderror" id="vatNo" name="vatNo" placeholder="اكتب الرقم الضريبي">
                    @error('vatNo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="tel"  class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="اكتب رقم الجوال">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="اكتب البريد الالكتروني">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              
                <input type="hidden" name="productID" value="">
                <div class="col-lg-6">
                  <div class="form-group">
                    <button type="button" class="btn btn-primary" style="width: 100%" onclick="storeCustomer()">حفظ</button>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <hr class="my-4" />
          </form>
        </div>
      </div>
      

    </div>
  </div>
</div>
<!-- Customers Modal -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  var count = 0;
  var rows = 0;
  var nameAr = "";
  var existRow=0;
  $('#barcode').change(function(){
    var barcode = document.getElementById('barcode').value;
    var qntNew = 1;
      $.ajax({
        url: `/getBarcode/${document.getElementById('barcode').value}`,
        success: data => {
          qntNew = data.quantity;
          
          var exist = 0;
          document.getElementById('barcode').value = "";
          document.getElementById("barcode").focus();
          
          document.getElementById('pname').innerHTML = "";
          //$('#prodName').empty()
          data.items.forEach(item =>
            {
              if(rows > 0){//to check if this first row in order or not
                  for(i=1;i<=count;i++){
                  try{
                    if(document.getElementById(`item${i}`).value == item.id) {
                      exist = 1;
                      existRow =i;
                    }
                  }catch{
                    
                  }
                }
              }

              
              document.getElementById('pname').innerHTML = item.nameAr;
              if(exist == 0){
                count++;
                rows++;
                $('#tbody').append(`
                <tr id="tr-${count}-">
                  <td>${item.id}</td>
                  <td>${item.nameAr}</td>
                  <td><input type="number" min="0.00" step=".01" id="price${count}" name="price${count}" value="${item.prodPrice}" onchange="calculate(${count})" readonly></td>>
                  <td><input type="number" min="0.00" step=".01"  id="quantity${count}" name="quantity${count}" value="${data.quantity}" onchange="calculate(${count})"></td>
                  <td id="itotal${count}">${item.prodPrice*data.quantity}</td>
                  <td class="text-center">
                    <input type="hidden" name="item${count}" id="item${count}" value="${item.id}" />
                    <input type="hidden" name="cprice${count}" id="cprice${count}" value="${item.costPrice}" />
                    <input type="hidden" name="itemName${count}" id="itemName${count}" value="${item.nameAr}" />
                    <input type="hidden" name="discount${count}" id="discount${count}" value="0" />
                    <input type="hidden" name="rtotal${count}" id="rtotal${count}" value="0" />
                    <input type="hidden" name="rvat${count}" id="rvat${count}" value="0" />
                    <input type="hidden" name="vatValue${count}" id="vatValue${count}" value="${item.vat}" />
                    <input type="hidden" name="rtotalwvat${count}" id="rtotalwvat${count}" value="${item.prodPrice*data.quantity}" />
                    <a href="#" onclick="removeItem(${count})" class="text-danger text-center"><i class="fa fa-times"></i></a>
                  </td>
                </tr>
                `)
              }else{
                qntyUpdate(existRow,qntNew)
              }
              
              
            }
            
          )
          document.getElementById('count').value = count;
          calculate(count);
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

  function calculateTotal(){
    totalwvat = 0;
    total = 0;
    vat = 0;
    
    totaldiscount = 0;
      if(rows > 0){
        for(i=1;i<=count;i++){
        try{
        var rtotalwvat = document.getElementById("rtotalwvat"+i+"").value;
        var rtotal = document.getElementById("rtotal"+i+"").value;
        var rvat = document.getElementById("rvat"+i+"").value;
        var discount = document.getElementById("discount"+i+"").value;
        
        totalwvat += Number(rtotalwvat);
        total += Number(rtotal);
        vat += Number(rvat);
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

  function qntyUpdate(qntID,qntNew){
    var qnt = document.getElementById(`quantity${qntID}`).value;
    qnt=Number(qnt)+Number(qntNew);
    //alert(qnt);
    document.getElementById(`quantity${qntID}`).value = qnt;
    document.getElementById(`rtotalwvat${qntID}`).value = Number(document.getElementById(`price${qntID}`).value) * Number(qnt);
    calculate(qntID);
    calculateTotal();
  }

  function addCustomer(obj){
    
      //$('#customersModel').modal('show')

      if(obj.value == -1)
      {
        document.getElementById(`newcustomer`).style.display = "flex";
      }else{
        document.getElementById(`newcustomer`).style.display = "none";
      }
    
  }

  function showCashCard(obj){
    if(obj.value == 4)
    {
      document.getElementById(`cashcard`).style.display = "flex";
    }else{
      document.getElementById(`cashcard`).style.display = "none";
    }
  }

  function storeCustomer() {
      try{
       var form = document.querySelector('form');
        var formData = new FormData(form);
        formData.append("name", "فوزي");
        formData.append("area", "area");
        formData.append("city", "city");
        formData.append("district", "district");
        formData.append("address", "address");
        formData.append("vatNo", "vatNo");
        formData.append("phone", "phone");
        formData.append("email", "email");

        fetch("/../customers-add",{
            method: "post",
            body: formData
        })
        .then((response)=>{

        })
      }catch{

      }
   }

  $("form").bind("keypress", function (e) {
    if (e.keyCode == 13) {
        $("#barcode").focus()
        //add more buttons here
        return false;
    }
});
    function startDuration(){
        Swal.fire({
        title: 'ادخل الرصيد الافتتاحي للصندوق',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'تأكيد',
        cancelButtonText: 'الغاء',
        showLoaderOnConfirm: true,
        preConfirm: (amount) => {
          window.location.href = `/createDuration/${amount}`;
        },
        allowOutsideClick: () => !Swal.isLoading()
      })
      }

    ////////////////////////////////////////////////add by saeed/////////////////////////////////////////////////////
   
      
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

</script>
@endsection

