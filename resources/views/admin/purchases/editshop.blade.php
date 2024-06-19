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
                <div class="col-3">
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
                                            <select class="livesearch form-control" name="sername" id="sername">

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
                <div class="col-5">

                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <div class="col-4">
                    <div class="card card-primary bg-red text-center" style="height: 110px">
                        <div class="card-body">
                            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                                @csrf
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <h1>
                                                    <strong id="bigtotal">0</strong> <span
                                                        class="text-small">{{ trans('purchases.Rial') }} </span>
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
                            <form class="user" method="POST" action="{{ route('purchases.updateedit', $purchase->id) }}"
                                enctype = "multipart/form-data">

                                @csrf


                                <div style="height: 600px;overflow-y: scroll;">
                                    <table id="example5" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> {{ trans('purchases.ProductName') }} </th>
                                                <th> {{ trans('purchases.priceofapill') }} </th>
                                                <th> {{ trans('purchases.Quantity') }}</th>
                                                <th> {{ trans('purchases.Unit') }}</th>
                                                <th> {{ trans('purchases.Total') }} </th>
                                                <th> {{ trans('purchases.Options') }} </th>
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
                                                    <label for="">{{ trans('purchases.supplier') }}</label>
                                                    <select class="form-control @error('supplierID') is-invalid @enderror"
                                                        id="supplierID" name="supplierID">

                                                        @foreach (auth()->user()->organization->suppliers as $supplier)
                                                            <option @if ($purchase->supplierID == $supplier->id) selected @endif
                                                                value="{{ $supplier->id }}::{{ $supplier->AccountID }}">
                                                                {{ $supplier->name }}</option>
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
                                                    <label for=""> {{ trans('purchases.Paymenttype') }}</label>
                                                    <select class="form-control @error('type') is-invalid @enderror"
                                                        id="type" name="type" onchange="showCashCard(this)">
                                                        <option
                                                            @if ($purchase->type == '121') @selected(true) @endif
                                                            value="121">{{ trans('purchases.Cash') }}</option>
                                                        <option
                                                            @if ($purchase->type == '122') @selected(true) @endif
                                                            value="122">{{ trans('purchases.Net') }}</option>
                                                        <option
                                                            @if ($purchase->type == '3') @selected(true) @endif
                                                            value="3">{{ trans('purchases.Paylater') }}</option>
                                                    </select>
                                                    @error('type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3" id="paymentType" style="display: none">
                                                <div class="form-group">
                                                    <label for=""> {{ trans('purchases.Paymentaccount') }}</label>
                                                    <select
                                                        class="form-control @error('paymentTypeitems') is-invalid @enderror"
                                                        id="paymentTypeitems" name="paymentTypeitems">
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
                                                    <label for=""> {{ trans('purchases.Invoicedate') }}</label>
                                                    <input type="date"
                                                        class="form-control @error('payDate') is-invalid @enderror"
                                                        value="{{ $purchase->payDate }}" id="payDate" name="payDate"
                                                        placeholder=" {{ trans('purchases.Invoicedate') }}">
                                                    @error('payDate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-4">
                          <div class="form-group">
                            <label for="">مركز التكلفة </label>
                            <select class="form-control @error('customerID') is-invalid @enderror" id="costcenter" name="costcenter" onchange="addCustomer(this)">
                              <option value=""> مركز التكلفة </option>
                              @foreach ($cost as $cost)
                                  <option value="{{$cost->id}}">{{$cost->CostName}}</option>
                              @endforeach

                            </select>
                          </div>
                        </div> --}}
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">
                                                        {{ trans('purchases.Bookinvoicenumber') }}</label>
                                                    <input type="text"
                                                        class="form-control @error('serial') is-invalid @enderror"
                                                        value="{{ $purchase->serial }}" id="serial" name="serial"
                                                        placeholder="{{ trans('purchases.Bookinvoicenumber') }}">
                                                    @error('serial')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for=""> {{ trans('purchases.Invoicedate') }}</label>
                                                    <input type="date"
                                                        class="form-control @error('invoiceDate') is-invalid @enderror"
                                                        value="{{ $purchase->invoiceDate }}" id="invoiceDate"
                                                        name="invoiceDate"
                                                        placeholder="{{ trans('purchases.Invoicedate') }} ">
                                                    @error('invoiceDate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for=""> {{ trans('Sale.Discount') }}</label>
                                                    <input type="text" class="form-control" id="Decscontall"
                                                        value="{{ $purchase->discount }}" onchange="ShowDecscontall()"
                                                        name="Decscontall" placeholder="خصم">
                                                </div>
                                            </div>
                                            <input type="hidden" name="total" id="total" value="0" />
                                            <input type="hidden" name="vat" id="vat" value="0" />
                                            <input type="hidden" name="totalwvat" id="totalwvat" value="0" />
                                            <input type="hidden" name="totaldiscount" id="totaldiscount"
                                                value="0" />
                                            <input type="hidden" name="count" id="count" value="0">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for=""> {{ trans('purchases.Invoicetype') }} </label>
                                                    <select class="form-control @error('customerID') is-invalid @enderror"
                                                        id="TypeFatorah" name="TypeFatorah">
                                                        <option value="1"> {{ trans('purchases.Draft') }} </option>
                                                        <option value="2"> {{ trans('purchases.certified') }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for=""> </label>
                                                    <label for=""> </label>
                                                    <label for=""> </label>
                                                    <input type="submit" class="btn btn-primary"
                                                        value=" {{ trans('purchases.save') }}" style="width: 100%">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>
                                                    <h6>{{ trans('purchases.Total') }}</h6>
                                                </th>
                                                <th>
                                                    <h6> <strong id="view-total"> </strong> </h6>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6> {{ trans('purchases.Tax') }}</h6>
                                                </td>
                                                <td>
                                                    <h6> <strong id="view-vat"> </strong></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6> {{ trans('purchases.Totalincludingtax') }}</h6>
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
        <h1 id="noFoundmesssage"> {{ trans('purchases.Theproductisnotinstock') }} </h1>
        <h1 id="namprodectmessage"> {{ trans('Products.ProductName') }} </h1>

    </div>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">


    <script>
        var count = 0;
        var rows = 0;
        var nameAr = "";
        $(document).ready(function() {

            data = "";
            county = 0;





            @foreach ($purchase->purchasedetails as $index => $product)
                dataaa = "";
                @foreach ($product->product->unitprodect as $i => $items)
                    dataaa = dataaa +
                        `<option  @if ($product->idxUnit == $i) selected @endif   value="{{ $items->id }}::{{ $i }}::{{ $items->costprodect }}" >{{ $items->unitname }}</option> `;
                @endforeach
                county = county + 1;
                data = data +
                    '<tr id="tr-{{ $index + 1 }}-"> <td>{{ $index + 1 }}</td> <td>{{ $product->product->nameAr ?? '' }}</td>';
                data = data +
                    ' <td class="px-2"><input type="number"  class="form-control text-center"  min="0.00" step=".01" id="price{{ $index + 1 }}" name="price{{ $index + 1 }}" value="{{ number_format($product->price, 2) }}" onchange="calculate({{ $index + 1 }})" ></td>';
                data = data +
                    '<td class="px-2"><input type="number"  class="form-control text-center" min="0.00" step=".01"  id="quantity{{ $index + 1 }}" name="quantity{{ $index + 1 }}" value="{{ $product->quantity }}" onchange="calculate({{ $index + 1 }})"></td>';
                data = data +
                    '<td class="px-2" ><select  class="form-control text-center" onchange="doSomething({{ $index + 1 }});" id="unit{{ $index + 1 }}" required name="unit{{ $index + 1 }}"> ' +
                    dataaa + ' </select></td>';
                data = data +
                    ' <td id="itotal{{ $index + 1 }}">{{ $product->price * $product->quantity }}</td>';
                data = data +
                    '   <td class="text-center"><input type="hidden" name="item{{ $index + 1 }}" id="item{{ $index + 1 }}" value="{{ $product->productID }}"/>';
                data = data +
                    '   <input type="hidden" name="discount{{ $index + 1 }}" id="discount{{ $index + 1 }}" value="0" />';
                data = data +
                    '   <input type="hidden" name="rtotal{{ $index + 1 }}"   id="rtotal{{ $index + 1 }}" value="0" />';
                data = data +
                    '   <input type="hidden" name="rvat{{ $index + 1 }}"     id="rvat{{ $index + 1 }}" value="0" />';
                data = data +
                    '   <input type="hidden" name="rtotalwvat{{ $index + 1 }}" id="rtotalwvat{{ $index + 1 }}" value="{{ $product->price * $product->quantity }}" />';
                data = data +
                    '  <a href="#" onclick="removeItem({{ $index + 1 }})" class="text-danger text-center"><i class="fa fa-times"></i></a> </td></tr>';
            @endforeach



            type = {{ $purchase->type }};




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
                        // console.log(response.data[0].AccountName);
                        for (let i = 0; i < response.count; i++) {
                            $('#paymentTypeitems').append('<option  value="' + response.data[i].id +
                                '::' + response.data[i].AccountID + '::' + response.data[i]
                                .AccountName + '">' + response.data[i].AccountName + '</option>');
                        }
                    },
                    complete: function(response) {}
                });
                document.getElementById(`paymentType`).style.display = "flex";
                // document.getElementById(`cashcard`).style.display = "none";
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
                        // console.log(response.data[0].AccountName);
                        for (let i = 0; i < response.count; i++) {

                            $('#paymentTypeitems').append('<option  value="' + response.data[i].id +
                                '::' + response.data[i].AccountID + '::' + response.data[i]
                                .AccountName + '">' + response.data[i].AccountName + '</option>');


                        }
                    },
                    complete: function(response) {}
                });
                document.getElementById(`paymentType`).style.display = "flex";
                // document.getElementById(`cashcard`).style.display = "none";
            } else if (type == 3) {
                document.getElementById(`paymentType`).style.display = "none";
                // document.getElementById(`cashcard`).style.display = "flex";
            } else {
                document.getElementById(`paymentType`).style.display = "none";
                // document.getElementById(`cashcard`).style.display = "none";
            }

            $('#tbody').append(data);


            document.getElementById('count').value = county;
            rows = county;
            count = county;
            calculateTotal();













        });
    </script>


















































    <script>
        function ShowDecscontall() {
            var descount = document.getElementById("Decscontall").value;
            count = document.getElementById("count").value;
            rows = count;

            if (descount == null && descount == 0) {


            } else {
                totalwvat = document.getElementById("totalwvat").value;
                dd = parseFloat(totalwvat - (totalwvat * (descount / 100)));
                // document.getElementById("totalwvat").value=dd;
                $("#view-totalwvat").empty().append(dd.toFixed(2));

                if (rows > 0) {
                    for (i = 1; i <= count; i++) {
                        console.log(descount);
                        if (descount != '') {
                            document.getElementById("discountval" + i + "").readOnly = true;
                        }
                    }
                }
            }

        }


        $('#barcode').change(function() {

            getByBarcode(document.getElementById('barcode').value);


        });


        function getByBarcode(varcode) {

            document.getElementById("prodName").value = "";
            $.ajax({
                url: `/purchases/getBarcode/${varcode}`,
                success: data => {

                    if (data.flage == 0) {
                        document.getElementById('barcode').value = "";
                        document.getElementById("barcode").focus();
                        Swal.fire({
                            title: document.getElementById('noFoundmesssage').innerHTML,
                            icon: "warning"
                        });

                    } else {
                        count++;
                        rows++;
                        document.getElementById('barcode').value = "";
                        document.getElementById("barcode").focus();


                        dataaa = "";
                        cost = 0;
                        data.unit.forEach((item, index) => {
                            if (index == 0) {
                                cost = item.costprodect;
                            }

                            dataaa = dataaa +
                                `<option  value="${item.id}::${index}::${item.costprodect}" >${item.unitname} </option> `;
                        })

                        //$('#prodName').empty()
                        data.items.forEach(item => {

                                $('#tbody').append(`
                              <tr id="tr-${count}-">
                                <td>${count}</td>
                                <td>${item.nameAr}</td>
                                <td class="px-2"><input type="number"    class="form-control text-center"  step='any'  id="price${count}" name="price${count}" value="${cost}" onchange="calculate(${count})"></td>>
                                <td class="px-2"><input type="number"    class="form-control text-center" id="quantity${count}" name="quantity${count}" value="1" onchange="calculate(${count})"></td>
                                <td class="px-2" ><select     class="form-control text-center" onchange="doSomething(${count});" id="unit${count}" required name="unit${count}"> ${dataaa} </select></td>
                                <td id="itotal${count}">${cost}</td>
                                <td class="text-center">
                                  <input type="hidden" name="item${count}" id="item${count}" value="${item.id}" />
                                  <input type="hidden" name="discount${count}" id="discount${count}" value="0" />
                                  <input type="hidden" name="rtotal${count}" id="rtotal${count}" value="0" />
                                  <input type="hidden" name="rvat${count}" id="rvat${count}" value="0" />
                                  <input type="hidden" name="rtotalwvat${count}" id="rtotalwvat${count}" value="${cost}" />
                                  <a href="#" onclick="removeItem(${count})" class="text-danger text-center"><i class="fa fa-times"></i></a>
                                </td>
                              </tr>
                              `)

                            }

                        )
                        document.getElementById('count').value = count;
                        rows = count;
                        calculateTotal();

                    }

                }
            });

        }



        function doSomething(id) {
            let text = document.getElementById('unit' + id).value;
            data = text.split('::')
            document.getElementById('price' + id).value = data[2];
            calculate(id);

        }

        function removeItem(trnum) {

            var myobj = document.getElementById("tr-" + trnum + "-");
            myobj.remove();
            rows--;
            calculateTotal();
        }

        function calculate(id) {
            var price = document.getElementById('price' + id).value;
            var quantity = document.getElementById('quantity' + id).value;
            var discount = document.getElementById('discount' + id).value;

            var rtotal = +parseFloat(price / 1.15 * quantity - discount / 1.15).toFixed(2);
            var rvat = +parseFloat(rtotal * 0.15).toFixed(2);
            var rtotalwvat = +parseFloat(price * quantity - discount).toFixed(2);

            document.getElementById('rtotal' + id).value = rtotal;
            document.getElementById('rvat' + id).value = rvat;
            document.getElementById('rtotalwvat' + id).value = rtotalwvat;
            $("#itotal" + id).empty().append(rtotalwvat);

            calculateTotal();
        }

        function calculateTotal() {
            totalwvat = 0;
            total = 0;
            vat = 0;

            totaldiscount = 0;
            if (rows > 0) {
                for (i = 1; i <= count; i++) {
                    try {
                        var rtotalwvat = document.getElementById("rtotalwvat" + i + "").value;
                        var discount = document.getElementById("discount" + i + "").value;

                        totalwvat += parseFloat(rtotalwvat);
                        total = +parseFloat(totalwvat / 1.15).toFixed(2);
                        vat = +parseFloat(totalwvat - total).toFixed(2);
                        totaldiscount += parseFloat(discount);


                        //$( "#view-totaldiscount" ).empty().append(document.getElementById('totaldiscount').value);
                    } catch {

                    }
                }


                document.getElementById("total").value = +parseFloat(totalwvat).toFixed(2);
                document.getElementById("vat").value = +parseFloat(totalwvat * 0.15).toFixed(2);
                document.getElementById("totalwvat").value = +parseFloat(totalwvat + (totalwvat * 0.15)).toFixed(2);
                document.getElementById("totaldiscount").value = +parseFloat(totaldiscount).toFixed(2);

                $("#view-total").empty().append(document.getElementById('total').value);
                $("#view-vat").empty().append(document.getElementById('vat').value);
                $("#view-totalwvat").empty().append(document.getElementById('totalwvat').value);
                $("#bigtotal").empty().append(document.getElementById('totalwvat').value);
                ShowDecscontall()
            } else {
                document.getElementById("total").value = 0;
                document.getElementById("vat").value = 0;
                document.getElementById("totalwvat").value = 0;
                document.getElementById("totaldiscount").value = 0;
                $("#view-total").empty().append(document.getElementById('total').value);
                $("#view-vat").empty().append(document.getElementById('vat').value);
                $("#view-totalwvat").empty().append(document.getElementById('totalwvat').value);
                $("#bigtotal").empty().append(document.getElementById('totalwvat').value);

            }

        }



        $("form").bind("keypress", function(e) {
            if (e.keyCode == 13) {
                $("#barcode").focus()
                return false;
            }
        });
    </script>













    <script>
        // -----------------------------------------------------------------------------------------------------------------
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

            } else {
                document.getElementById(`paymentType`).style.display = "none";
            }

        }
    </script>












    <script>
        $('#prodName').change(function() {
            nameAr = document.getElementById("prodName").value;
            arr_index = items.map((el) => el.nameAr).indexOf(nameAr);
            barcode = items[arr_index].barcode;
            getByBarcode(barcode);
            document.getElementById("prodName").value = "";
        });
        var availableTags = <?php echo json_encode($items); ?>;
        var items = <?php echo json_encode($items_all); ?>;
        $(".autocomplete").autocomplete({
            source: availableTags
        });


        $('.livesearch').select2({
            placeholder: document.getElementById('namprodectmessage').innerHTML,
            ajax: {
                url: '/pur-autocomplete-search',
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
