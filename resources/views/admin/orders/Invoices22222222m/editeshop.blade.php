@extends('layouts.dashboard')
<style>
    td,
    th {
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
                <div class="col-lg-3">
                    <div class="card card-primary" style="height: 110px">
                        <div class="card-body">


                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">


                                            <input type="text"
                                                class="form-control @error('barcode') is-invalid @enderror" id="barcode"
                                                name="barcode" placeholder="{{ trans('purchases.Productcode') }}" autofocus
                                                onchange="getBarcode(this.value)">
                                            <input type="hidden"
                                                class="mt-1 autocomplete form-control @error('prodName') is-invalid @enderror"
                                                id="prodName" name="prodName" style="width: 73%;display:inline-block"
                                                placeholder="اكتب اسم المنتج">
                                            <select class="livesearchprodect form-control" name="sername" id="sername">

                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-lg-5 d-sm-none d-lg-block">
                    <div class="card card-primary  text-primary" style="height: 110px ;    background-color: #aaecdf;">
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
                <div class="col-lg-4 d-sm-none d-lg-block">
                    <div class="card card-primary " style="height: 110px ;    background-color: #aaecdf;">
                        <div class="card-body">
                            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                                @csrf
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <h1>
                                                    <strong id="bigtotal">0</strong> <span
                                                        class="text-small">{{ trans('Sale.Rial') }}</span>
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
                    <div class="card card-primary">

                        <div class="card-body">
                            <form class="user" method="POST" action="{{ route('OrderInvoices.update', $order->id) }}"
                                enctype = "multipart/form-data">
                                @csrf
                                <input type="hidden" name="kind" value="2">
                                <div style="height: 600px;overflow-y: scroll;">
                                    <table id="example4" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>

                                                <th> {{ trans('Sale.ProductName') }} </th>
                                                <th> {{ trans('Sale.priceofapill') }} </th>
                                                <th> {{ trans('Sale.Quantity') }} </th>
                                                <th> {{ trans('Sale.Discount') }} </th>
                                                <th> {{ trans('Sale.Valueaddedtax') }} </th>
                                                <th> {{ trans('Sale.comment') }} </th>
                                                <th> {{ trans('Sale.TotalAftertax') }} </th>
                                                <th> {{ trans('Sale.Options') }} </th>
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
                                                    <select class="form-control @error('customerID') is-invalid @enderror"
                                                        id="costcenter" name="costcenter" onchange="addCustomer(this)"
                                                        required>
                                                        @foreach ($cost as $cost)
                                                            <option value="{{ $cost->id }}">{{ $cost->CostName }}
                                                            </option>
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

                                                    <select class="form-control @error('customerID') is-invalid @enderror"
                                                        id="customerID" name="customerID" onchange="addCustomer(this)">
                                                        <option value=""> {{ trans('Sale.CustomerChoose') }}
                                                        </option>
                                                        @foreach (auth()->user()->organization->customers as $customer)
                                                            <option @if ($order->customerID == $customer->id) selected @endif
                                                                value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                        @endforeach
                                                        <option value="-1"> {{ trans('Sale.CustomerChooseNew') }}
                                                        </option>
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
                                                    <input type="text" class="form-control" id="Decscontall"
                                                        onchange="ShowDecscontall()" name="Decscontall"
                                                        value="{{ $order->ispaied }}">

                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control @error('type') is-invalid @enderror"
                                                        id="type" name="type" onchange="showCashCard(this)"
                                                        required>
                                                        <option value=""> {{ trans('Sale.paymentmethod') }}</option>
                                                        <option @if ($order->type == '121') selected @endif
                                                            value="121"> {{ trans('Sale.Cash') }} </option>
                                                        <option @if ($order->type == '122') selected @endif
                                                            value="122"> {{ trans('Sale.Net') }} </option>

                                                        <option @if ($order->type == '3') selected @endif
                                                            value="3"> {{ trans('Sale.Paylater') }} </option>
                                                    </select>
                                                    @error('type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control @error('type') is-invalid @enderror"
                                                        id="typeINV" name="typeINV" required>
                                                        <option value="1">{{ trans('Sale.Draft') }}</option>
                                                        <option value="2"> {{ trans('Sale.certified') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2" id="paymentType" style="display: none">
                                                <div class="form-group">
                                                    <select class="form-control" id="paymentTypeitems" name="paymentTypeitems"></select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 row" id="cashcard" style="display: none">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="number" min="0.00" step=".01"
                                                            class="form-control @error('cash') is-invalid @enderror"
                                                            id="cash" name="cash" placeholder="النقد">
                                                        @error('cash')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="number" min="0.00" step=".01"
                                                            class="form-control @error('card') is-invalid @enderror"
                                                            id="card" name="card" placeholder="الشبكة">
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
                                            <input type="hidden" name="totaldiscount" id="totaldiscount"
                                                value="0" />
                                            <input type="hidden" name="count" id="count" value="0">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <input type="datetime-local" class="form-control" id="ordertime"
                                                        name="ordertime" value="{{ $order->created_at }}"
                                                        max="{{ date('Y-m-d H:i:s') }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary"
                                                        value=" {{ trans('Sale.save') }} " style="width: 100%">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 row" id="newcustomer" style="display: none">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text"
                                                            class="form-control @error('customerName') is-invalid @enderror"
                                                            id="customerName" name="customerName"
                                                            placeholder=" {{ trans('Sale.customername') }}">
                                                        @error('customerName')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="number"
                                                            class="form-control @error('customerVat') is-invalid @enderror"
                                                            id="customerVat" name="customerVat"
                                                            placeholder=" {{ trans('Sale.TaxNumber') }}">
                                                        @error('customerVat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="number"
                                                            class="form-control @error('phoneVat') is-invalid @enderror"
                                                            id="phoneVat" name="phoneVat"
                                                            placeholder=" {{ trans('Sale.Mobilenumber') }}">
                                                        @error('phoneVat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>
                                                    <h6>{{ trans('Sale.Total') }}</h6>
                                                </th>
                                                <th>
                                                    <h6> <strong id="view-total"> </strong> </h6>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6> {{ trans('Sale.Valueaddedtax') }}</h6>
                                                </td>
                                                <td>
                                                    <h6> <strong id="view-vat"> </strong></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6> {{ trans('Sale.Totalincludingtax') }}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="text-danger"> <strong id="view-totalwvat"></strong>
                                                        {{ trans('purchases.Rial') }} </h6>
                                                </td>
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




    <div style="display: none">
        <h1 id="Theproductisnotinstock"> {{ trans('Sale.Theproductisnotinstock') }} </h1>
        <h1 id="namprodectmessage"> {{ trans('Products.ProductName') }} </h1>

    </div>





    <!-- Customers Modal -->
    <!------------------------------------add saeed -------------------------------------------------->


    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">




    <script>
        $(document).ready(function() {

            data = "";
            count = 0;
            @foreach ($order->orderdetails as $index => $product)
                count = count + 1;
                data = data +
                    '<tr id="tr-{{ $index + 1 }}-"> <td>{{ $index + 1 }}</td> <td>{{ $product->productName }}</td>';
                data = data +
                    ' <td><input type="number" min="0.00" step=".01"  class="form-control text-center"  id="price{{ $index + 1 }}" name="price{{ $index + 1 }}" value="{{ $product->price }}" onchange="calculate({{ $index + 1 }})" ></td>';
                data = data +
                    '<td><input type="number" min="0.00" step=".01"   class="form-control text-center" id="quantity{{ $index + 1 }}" name="quantity{{ $index + 1 }}" value="{{ $product->quantity }}" onchange="calculate({{ $index + 1 }})"></td>';
                data = data +
                    '<td><input type="number" min="0.00" step="0.01"  class="form-control text-center"  id="discountval{{ $index + 1 }}" name="discountval{{ $index + 1 }}" value="{{ $product->discount }}" onchange="calculate({{ $index + 1 }})"></td>';
                data = data +
                    '<td><input type="number" min="0.00" step="0.01"  class="form-control text-center"  id="vatOrder{{ $index + 1 }}" name="vatOrder{{ $index + 1 }}" value="{{ $product->vat }}" onchange="calculate({{ $index + 1 }})" readonly></td>';
                data = data +
                    ' <td><input type="text" min="0.00"   class="form-control text-center"  id="desc{{ $index + 1 }}" name="desc{{ $index + 1 }}" value="{{ $product->desc }}" ></td>';
                data = data + ' <td id="itotal{{ $index + 1 }}">{{ $product->total }}</td>';
                data = data +
                    '   <td class="text-center"><input type="hidden" name="item{{ $index + 1 }}" id="item{{ $index + 1 }}" value="{{ $product->productID }}"/>';
                data = data +
                    ' <input type="hidden"step="any"  name="cprice{{ $index + 1 }}" id="cprice{{ $index + 1 }}" value="{{ $product->totalcost }}" />';
                data = data +
                    '   <input type="hidden"step="any"  name="itemName{{ $index + 1 }}" id="itemName{{ $index + 1 }}" value="{{ $product->productName }}" />';
                data = data +
                    '   <input type="hidden" step="any"  name="discount{{ $index + 1 }}" id="discount{{ $index + 1 }}" value="0" />';
                data = data +
                    '   <input type="hidden" step="any" name="rtotal{{ $index + 1 }}"   id="rtotal{{ $index + 1 }}" value="{{ $product->total }}" />';
                data = data +
                    '   <input type="hidden"step="any"  name="rvat{{ $index + 1 }}"     id="rvat{{ $index + 1 }}" value="{{ $product->total * 0.15 }}"  />';
                data = data +
                    '   <input type="hidden" step="any"  name="vatValue{{ $index + 1 }}" id="vatValue{{ $index + 1 }}" value="{{ $product->vat }}" />';
                data = data +
                    '   <input type="hidden" step="any" name="rtotalwvat{{ $index + 1 }}" id="rtotalwvat{{ $index + 1 }}" value="{{ $product->total }}" />';
                data = data +
                    '  <a href="#" onclick="removeItem({{ $index + 1 }})" class="text-danger text-center"><i class="fa fa-times"></i></a>&nbsp;';
                data = data +
                    ' <a href="#" onclick="CopyItems({{ $index + 1 }})" class="text-info text-center"><i class="fa fa-clone"></i></a></td></tr>';
            @endforeach


            $('#tbody').append(data);
            $('#view-total').append("0");
            $('#view-vat').append("0");
            $('#view-totalwvat').append("0");
            document.getElementById('count').value = count;
            rows = count;
            calculate(count);
            calculateTotal();




            type = document.getElementById('type').value
            if (type == 121) {

                $.ajax({
                    type: 'post',
                    url: "/purchases.SearchAccount/" + type,
                    data: {
                        id: type
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        //the request is success
                        console.log(response.data[0].AccountName);
                        for (let i = 0; i < response.count; i++) {
                            $('#paymentTypeitems').append('<option  value="' + response.data[i].id +
                                '::' + response.data[i].AccountID + '::' + response.data[i]
                                .AccountName + '">' + response.data[i].AccountName + '</option>');
                        }
                    },
                    complete: function(response) {}
                });
                document.getElementById(`paymentType`).style.display = "flex";
                document.getElementById(`cashcard`).style.display = "none";
            } else if (type == 122) {
                $.ajax({
                    type: 'post',
                    url: "/purchases.SearchAccount/" + type,
                    data: {
                        id: type
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        //the request is success
                        console.log(response.data[0].AccountName);
                        for (let i = 0; i < response.count; i++) {

                            $('#paymentTypeitems').append('<option  value="' + response.data[i].id +
                                '::' + response.data[i].AccountID + '::' + response.data[i]
                                .AccountName + '">' + response.data[i].AccountName + '</option>');


                        }
                    },
                    complete: function(response) {}
                });
                document.getElementById(`paymentType`).style.display = "flex";
                document.getElementById(`cashcard`).style.display = "none";
            } else if (type == 4) {
                document.getElementById(`paymentType`).style.display = "none";
                document.getElementById(`cashcard`).style.display = "flex";
            } else {
                document.getElementById(`paymentType`).style.display = "none";
                document.getElementById(`cashcard`).style.display = "none";
            }


        });
    </script>





    <script>
        function showCashCard(obj) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            type = obj.value;
            $('#paymentTypeitems').empty();

            if (obj.value == 121) {

                $.ajax({
                    type: 'post',
                    url: "/purchases.SearchAccount/" + type,
                    data: {
                        id: type
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        //the request is success
                        console.log(response.data[0].AccountName);
                        for (let i = 0; i < response.count; i++) {
                            $('#paymentTypeitems').append('<option value="' + response.data[i].id + '::' +
                                response.data[i].AccountID + '::' + response.data[i].AccountName + '">' +
                                response.data[i].AccountName + '</option>');
                        }
                    },
                    complete: function(response) {}
                });
                document.getElementById(`paymentType`).style.display = "flex";
                document.getElementById(`cashcard`).style.display = "none";
            } else if (obj.value == 122) {
                $.ajax({
                    type: 'post',
                    url: "/purchases.SearchAccount/" + type,
                    data: {
                        id: type
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        //the request is success
                        console.log(response.data[0].AccountName);
                        for (let i = 0; i < response.count; i++) {
                            $('#paymentTypeitems').append('<option value="' + response.data[i].id + '::' +
                                response.data[i].AccountID + '::' + response.data[i].AccountName + '">' +
                                response.data[i].AccountName + '</option>');
                        }
                    },
                    complete: function(response) {}
                });
                document.getElementById(`paymentType`).style.display = "flex";
                document.getElementById(`cashcard`).style.display = "none";
            } else if (obj.value == 4) {
                document.getElementById(`paymentType`).style.display = "none";
                document.getElementById(`cashcard`).style.display = "flex";
            } else {
                document.getElementById(`paymentType`).style.display = "none";
                document.getElementById(`cashcard`).style.display = "none";
            }




        }
    </script>























    <script>
        var count = 0;
        var rows = 0;
        var nameAr = "";
        var existRow = 0;

        $('#barcode').change(function() {
            var barcode = document.getElementById('barcode').value;
            var qntNew = 1;

            getByBarcode(barcode);

        });

        function getByBarcode(barcode) {
            $.ajax({
                url: `/getBarcode/${barcode}`,
                success: data => {

                    if (data.flage == 0) {
                        document.getElementById('barcode').value = "";
                        document.getElementById("barcode").focus();
                        Swal.fire({
                            title: document.getElementById('Theproductisnotinstock').innerHTML,
                            icon: "warning"
                        });

                    } else {

                        qntNew = data.quantity;

                        var exist = 0;
                        document.getElementById('barcode').value = "";
                        document.getElementById('prodName').value = "";
                        document.getElementById("barcode").focus();

                        document.getElementById('pname').innerHTML = "";
                        //$('#prodName').empty()
                        data.items.forEach(item => {
                                if (rows > 0) { //to check if this first row in order or not
                                    for (i = 1; i <= count; i++) {
                                        try {
                                            if (document.getElementById(`item${i}`).value == item.id) {
                                                exist = 1;
                                                existRow = i;
                                            }
                                        } catch {

                                        }
                                    }
                                }


                                document.getElementById('pname').innerHTML = item.nameAr;
                                if (exist == 0) {
                                    count++;
                                    rows++;
                                    $('#tbody').append(`
                            <tr id="tr-${count}-">
                            <td>${count}</td>
                            <td>${item.nameAr}</td>
                            <td><input type="number" min="0.00" step=".01"   class="form-control text-center" id="price${count}" name="price${count}" value="${item.prodPrice}" onchange="calculate(${count})" ></td>>
                            <td><input type="number" min="0.00" step=".01"  class="form-control text-center"  id="quantity${count}" name="quantity${count}" value="${data.quantity}" onchange="calculate(${count})"></td>
                            <td><input type="number" min="0.00" step=".01"  class="form-control text-center"  id="discountval${count}" name="discountval${count}" value="${data.discount}" onchange="calculate(${count})"></td>
                            <td><input type="number" min="0.00" step=".01"  class="form-control text-center"  id="vatOrder${count}" name="vatOrder${count}" value="${item.vat}" readonly></td>
                            <td><input type="text" min="0.00"   class="form-control text-center"  id="desc${count}" name="desc${count}" ></td>
                            <td id="itotal${count}">${item.prodPrice*data.quantity}</td>
                            <td class="text-center">
                                <input type="hidden" step="any" name="item${count}" id="item${count}" value="${item.id}" />
                                <input type="hidden" step="any" name="cprice${count}" id="cprice${count}" value="${item.costPrice}" />
                                <input type="hidden"step="any"  name="itemName${count}" id="itemName${count}" value="${item.nameAr}" />
                                <input type="hidden"step="any"  name="discount${count}" id="discount${count}" value="${item.vat}" />
                                <input type="hidden"step="any"  name="rtotal${count}" id="rtotal${count}" value="0" />
                                <input type="hidden"step="any"  name="rvat${count}" id="rvat${count}" value="${item.vat}" />
                                <input type="hidden"step="any"  name="vatValue${count}" id="vatValue${count}" value="${item.vat}" />
                                <input type="hidden"step="any"  name="rtotalwvat${count}" id="rtotalwvat${count}" value="${item.prodPrice*data.quantity}" />
                                <a href="#" onclick="removeItem(${count})" class="text-danger text-center"><i class="fa fa-times"></i></a>&nbsp;
                                <a href="#" onclick="CopyItems(${count})" class="text-info text-center"><i class="fa fa-clone"></i></a>
                            </td>
                            </tr>
                            `)
                                } else {
                                    qntyUpdate(existRow, qntNew)
                                }


                            }

                        )
                        document.getElementById('count').value = count;
                        calculate(count);
                        calculateTotal();


                    }




                }
            });
        }

        function removeItem(trnum) {
            var myobj = document.getElementById("tr-" + trnum + "-");
            myobj.remove();
            rows--;
            calculateTotal();
        }



        function CopyItems(id) {
            count++;
            rows++;
            $('#tbody').append(`
                            <tr id="tr-${count}-">
                            <td>${count}</td>
                            <td>${$('#itemName'+id).val()}</td>prodPrice
                            <td><input type="number" min="0.00" step="any"   class="form-control text-center" id="price${count}" name="price${count}" value="${$('#price'+id).val()}" onchange="calculate(${count})" ></td>>
                            <td><input type="number" min="0.00" step="any"  class="form-control text-center"  id="quantity${count}" name="quantity${count}" value="${$('#quantity'+id).val()}" onchange="calculate(${count})"></td>
                            <td><input type="number" min="0.00" step="any"  class="form-control text-center"  id="discountval${count}" name="discountval${count}" value="${$('#discountval'+id).val()}" onchange="calculate(${count})"></td>
                            <td><input type="number" min="0.00" step="any"  class="form-control text-center"  id="vatOrder${count}" name="vatOrder${count}" value="${$('#vatOrder'+id).val()}" readonly></td>
                            <td><input type="text" min="0.00"   class="form-control text-center"  id="desc${count}" name="desc${count}" value="${$('#desc'+id).val()}" ></td>
                            <td id="itotal${count}">${$('#rtotalwvat'+id).val()}</td>
                            <td class="text-center">
                                <input type="hidden" name="item${count}" id="item${count}" value="${$('#item'+id).val()}" />
                                <input type="hidden" name="cprice${count}" id="cprice${count}" value="${$('#cprice'+id).val()}" />
                                <input type="hidden" name="itemName${count}" id="itemName${count}" value="${$('#itemName'+id).val()}" />
                                <input type="hidden" name="discount${count}" id="discount${count}" value="${$('#discount'+id).val()}" />
                                <input type="hidden" name="rtotal${count}" id="rtotal${count}" value="${$('#rtotal'+id).val()}"  />
                                <input type="hidden" name="rvat${count}" id="rvat${count}" value="${$('#rvat'+id).val()}" />
                                <input type="hidden" name="vatValue${count}" id="vatValue${count}" value="${$('#vatValue'+id).val()}" />
                                <input type="hidden" name="rtotalwvat${count}" id="rtotalwvat${count}" value="${$('#rtotalwvat'+id).val()}" />
                                <a href="#" onclick="removeItem(${count})" class="text-danger text-center"><i class="fa fa-times"></i></a> &nbsp;
                                <a href="#" onclick="CopyItems(${count})" class="text-info text-center"><i class="fa fa-clone"></i></a>
                            </td>
                            </tr>
             `)

            document.getElementById('count').value = count;
            calculate(count);
            calculateTotal();
        }

        // function calculate(id) {


        //     var discountval = document.getElementById('discountval' + id).value;
        //     var price = document.getElementById('price' + id).value;
        //     var quantity = document.getElementById('quantity' + id).value;
        //     var discount = document.getElementById('discount' + id).value;
        //     var vatValue = document.getElementById('vatValue' + id).value;
        //     //price without vat
        //     var rtotal = +parseFloat(price / (1 + (vatValue / 100)) * quantity - ((price * quantity) * (discountval / 100)))
        //         .toFixed(2); //total without vat
        //     var rvat = +parseFloat(rtotal * (vatValue / 100)).toFixed(2);
        //     var rtotalwvat = +parseFloat(price * quantity - ((price * quantity) * (discountval / 100))).toFixed(2);

        //     document.getElementById('rtotal' + id).value = rtotal;
        //     document.getElementById('rvat' + id).value = rvat;
        //     document.getElementById('rtotalwvat' + id).value = rtotalwvat;
        //     $("#itotal" + id).empty().append(rtotalwvat);

        //     calculateTotal();
        // }


        function calculate(id) {


            var discountval = document.getElementById('discountval' + id).value;



            var price = document.getElementById('price' + id).value;
            var quantity = document.getElementById('quantity' + id).value;
            var discount = document.getElementById('discount' + id).value;
            var vatValue = document.getElementById('vatValue' + id).value;

            var rvat = 0;
            var rtotalwvat = +parseFloat(price * quantity - ((price * quantity) * (discountval / 100)));
            if (vatValue != 0) {
                rvat = parseFloat(rtotalwvat * 15 / 100);

            }

            document.getElementById('rvat' + id).value = rvat;
            document.getElementById('rtotalwvat' + id).value = rtotalwvat;
            $("#itotal" + id).empty().append(rtotalwvat);
            calculateTotal();
        }


        function ShowDecscontall() {
            var descount = document.getElementById("Decscontall").value;

            if (descount == null && descount == 0) {


            } else {
                totalwvat = document.getElementById("totalwvat").value;
                dd = parseFloat(totalwvat - (totalwvat * (descount / 100)));
                // document.getElementById("totalwvat").value=dd;
                $("#view-totalwvat").empty().append(dd.toFixed(2));
            }




        }

        function calculateTotal() {
            totalwvat = 0;
            total = 0;
            vat = 0;

            totaldiscount = 0;
            if (rows > 0) {
                for (i = 1; i <= count; i++) {
                    try {
                        var total1 = document.getElementById("rtotalwvat" + i + "").value;

                        var rvat1 = document.getElementById("rvat" + i + "").value;
                        var discount = document.getElementById("discount" + i + "").value;

                        total += parseFloat(total1);
                        vat += parseFloat(rvat1);



                    } catch {

                    }
                }


                document.getElementById("total").value = parseFloat(total).toFixed(2);
                $("#view-total").empty().append(document.getElementById('total').value);

                document.getElementById("vat").value = parseFloat(vat).toFixed(2);
                $("#view-vat").empty().append(document.getElementById('vat').value);

                document.getElementById("totalwvat").value = parseFloat(vat + total).toFixed(2);
                $("#view-totalwvat").empty().append(document.getElementById('totalwvat').value);
                ShowDecscontall();
            } else {
                document.getElementById("total").value = 0;
                document.getElementById("vat").value = 0;
                document.getElementById("totalwvat").value = 0;
                document.getElementById("totaldiscount").value = 0;
                $("#view-total").empty().append(document.getElementById('total').value);
                $("#view-vat").empty().append(document.getElementById('vat').value);
                $("#view-totalwvat").empty().append(document.getElementById('totalwvat').value);
                $("#bigtotal").empty().append(document.getElementById('totalwvat').value);
                document.getElementById('pname').innerHTML = "";
            }

        }

        function qntyUpdate(qntID, qntNew) {
            var qnt = document.getElementById(`quantity${qntID}`).value;
            qnt = Number(qnt) + Number(qntNew);
            //alert(qnt);
            document.getElementById(`quantity${qntID}`).value = qnt;
            document.getElementById(`rtotalwvat${qntID}`).value = Number(document.getElementById(`price${qntID}`).value) *
                Number(qnt);
            calculate(qntID);
            calculateTotal();
        }

        function addCustomer(obj) {

            //$('#customersModel').modal('show')

            if (obj.value == -1) {
                document.getElementById(`newcustomer`).style.display = "flex";
            } else {
                document.getElementById(`newcustomer`).style.display = "none";
            }

        }



        function storeCustomer() {
            try {
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

                fetch("/../customers-add", {
                        method: "post",
                        body: formData
                    })
                    .then((response) => {

                    })
            } catch {

            }
        }

        $("form").bind("keypress", function(e) {
            if (e.keyCode == 13) {
                $("#barcode").focus()
                //add more buttons here
                return false;
            }
        });

        function startDuration() {
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



        $('.livesearchprodect').select2({
            placeholder: document.getElementById('namprodectmessage').innerHTML,
            ajax: {
                url: '/prod-autocomplete-search',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nameAr,
                                id: item.id + "-" + item.barcode

                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('#sername').change(function() {

            var name = $('#sername :selected').val(); // English

            const myArray = name.split("-", 2);
            //alert(myArray[1])
            getByBarcode(myArray[1]);
        });
    </script>
@endsection
