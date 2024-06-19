@extends('layouts.dashboard')

@section('content')
{{-- @dd($payment_token) --}}
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">الإشتراك</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#"> تفاصيل الباقة والدفع</a></li>
          <li class="breadcrumb-item active">عرض تفاصيل الإشتراك</li>
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
                <h3 class="card-title">   {{ trans('Products.ADDprodcategories') }}  </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST"  enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> الإسم </label>
                          <input type="text"  class="form-control @error('nameAr') is-invalid @enderror" id="name" name="nameAr" placeholder="الإسم رباعي">
                          @error('nameAr')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">    رقم الجوال  </label>
                          <input type="text"  class="form-control @error('nameEn') is-invalid @enderror" id="phone"  onkeypress="return ValidateKey();" name="nameEn" placeholder="رقم الجوال">
                          @error('nameEn')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">  الباقة  </label>
                         
                          <select name="package" id="package" class="form-control" onchange="getPrice(this)">
                             <option value="">إختر الباقة</option>
                             @foreach ($packages as $item)
                             <option value="{{$item->id}}" data-price="{{$item->price}}" >{{$item->nameAr}} - {{$item->price}} </option>
                             @endforeach
                          </select>
                          @error('amount')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">  المبلغ  </label>
                          <input type="text" class="form-control" name="amount" id="amount" value="0" readonly>
                          @error('amount')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                     
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <button type="button" class="btn btn-info" style="letter-spacing: 0px" onclick="payNow();"> {{ trans('Online.Paymentbycard') }}   <img src="{{asset('dist/img/payments/visa.png')}}" style="width: 40px;height:40px" alt=""></button>
                            <!--<button type="button" class="btn btn-white" style="letter-spacing: 0px" onclick="applePayNow();">   {{ trans('Online.PPayviaApple') }} <img src="{{asset('dist/img/payments/apple.png')}}" style="width: 40px;height:40px" alt=""></button>-->
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
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
</section>
<script src="{{asset('payment/paylink.src.js')}}"></script>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script>
   
    function successCallback() {
        console.log('success');
    }

    let payment = new PaylinkPayments({mode: 'test', defaultLang: 'ar', backgroundColor: '#EEE'});

    function payNow() 
    {
       



        // 3) Send the generated token value to client side.
        const token ='<?= $payment_token ?>';///assign login tokin
        
    var total=document.getElementById("amount").value;
    if(total == 0)
     {
          alert('عفوا يرجى إختيار الباقية أولا');
     }else
     {
       
       
          var package=document.getElementById("package").value;
      
        // var form = document.querySelector('form');
        // var formData = new FormData(form);
        // formData.append("name", {{session('tableNo')}});
        // formData.append("phone", {{session('branch')}});
        // formData.append("total", document.getElementById("total").value);
        // formData.append("orgID", document.getElementById("orgID").value);
        // send order to insert in db and get response of inserted order details
        // fetch("/storeTableClient",{
        //     method: "post",
        //     body: formData
        // })
        // .then((response)=> response.json())
        // .then((response)=>{
            //console.log(response);
         
           // if (response.status == 'success') {
            
                let order = new Order({
                callBackUrl: 'http://evix.com.sa/package-payment-response/'+package,  // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
                clientName: document.getElementById("name").value, // the name of the buyer. (mandatory)
                clientMobile: document.getElementById("phone").value, // the mobile of the buyer. (mandatory)
                amount: total,
                clientEmail: 'info@evix.com.sa', // the email of the buyer (optional) // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
                orderNumber: '<?= $orderno ?>', // the order number in your system. (mandatory)
                });
                   //alert(order);

                // document.getElementById("result").value =order.clientMobile;
                //console.log(order);
                //console.log('saeed');
                payment.openPayment(token, order, successCallback);
           /// } else {

             

           // }
        //});

        /*
        let order = new Order({
            callBackUrl: 'http://localhost:6655/processPayment.php', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
            clientName: 'Zaid Matooq', // the name of the buyer. (mandatory)
            clientMobile: '0509200900', // the mobile of the buyer. (mandatory)
            amount: 5, // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
            orderNumber: '12301230123', // the order number in your system. (mandatory)
            clientEmail: 'myemail@example.com', // the email of the buyer (optional)
            products: [ // list of products (optional)
                {title: 'Dress 1', price: 120, qty: 2},
                {title: 'Dress 2', price: 120, qty: 2},
                {title: 'Dress 3', price: 70, qty: 2}
            ],
        });
        */
      }
    }
     function applePayNow() {
        alert('apple pay test');
        // 4) Check if the current browser support apple pay.
        if (payment.isApplePayAllowed()) {
        // var myModalEl = document.getElementById('exampleModal');
        // var modal = bootstrap.Modal.getInstance(myModalEl); // Returns a Bootstrap modal instance
        // modal.hide();
        // document.getElementById('main').style.display="none";
        // document.getElementById('footer').style.display="none";
        // 3) Send the generated token value to client side.
        const token = '<?= $payment_token ?>';

        // var form = document.querySelector('form');
        // var formData = new FormData(form);
        // formData.append("add_order", true);
        // formData.append("from_js", true);

        // fetch("/storeTableClient",{
        //     method: "post",
        //     body: formData
        // })
        // .then((response)=> response.json())
        // .then((response)=>{
        //     console.log(response);
            // if (response.status == 'success') {
                let order = new Order({
                callBackUrl: 'https://evix.com.sa/payment-response', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
                clientName: document.getElementById("name").value, // the name of the buyer. (mandatory)
                clientMobile: document.getElementById("phone").value, // the mobile of the buyer. (mandatory)
                amount:5,
                clientEmail: 'info@evix.com.sa', // the email of the buyer (optional) // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
                orderNumber: <?= $orderno ?>, // the order number in your system. (mandatory)
                });

                payment.openApplePay(token, order, successCallback);
            // } else {
            //     alert(response.msg);
            // }
        // });

        // } else {
        //     alert('This browser does not support ApplePay. Please use Safari on any Apple Device.');
        // }
    }
     }
   function getPrice (type)
   {
    //alert('tst');
      var price =$(type).find("option:selected").data('price');
      document.getElementById("amount").value = price;
   }
</script>

@endsection
