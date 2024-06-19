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
            <div class="row">
                <div class="col-12 card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> {{ trans('Sandat.Expenses') }} </h3>
                    </div>
                </div>
            </div>
            <!-- Small boxes (Stat box) -->
            <div class="row mt-2">
                <div class="col-3">
                    <div class="card card-primary" style="height: 110px">
                        <div class="card-body">


                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <select class="livesearch form-control" name="sername" id="sername">
                                                <option style="display: none">  {{ trans('Sandat.Selectitem') }} </option>
                                                @foreach ($outcome as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nameAr }}</option>
                                                @endforeach
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
                                                    <strong id="bigtotal">0</strong> <span class="text-small">
                                                        {{ trans('purchases.Rial') }} </span>
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
                            <form class="user" method="POST" action="{{ route('Expenses.store') }}"
                                enctype = "multipart/form-data">
                                @csrf
                                <div style="height: 600px;overflow-y: scroll;">
                                    <table id="example5" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>

                                                <th> {{ trans('Sandat.Expenseitem') }} </th>
                                                <th> {{ trans('purchases.price') }} </th>
                                                <th> {{ trans('purchases.Quantity') }}</th>
                                                <th> {{ trans('purchases.comment') }} </th>
                                                <th> {{ trans('purchases.Total') }}</th>
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
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">{{ trans('purchases.Bookinvoicenumber') }}
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('serial') is-invalid @enderror"
                                                        id="serial" name="serial"
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
                                                    <label for=""> {{ trans('purchases.Paymenttype') }}</label>
                                                    <select class="form-control @error('type') is-invalid @enderror"
                                                        id="type" name="type" onchange="showCashCard(this)">
                                                        <option value="121"> {{ trans('purchases.Cash') }}</option>
                                                        <option value="122"> {{ trans('purchases.Net') }}</option>
                                                        {{-- <option value="3"> {{ trans('purchases.Paylater') }} </option> --}}
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
                                                    <label for=""> {{ trans('purchases.Invoicedate') }}</label>
                                                    <input type="date"
                                                        class="form-control @error('invoiceDate') is-invalid @enderror"
                                                        value="<?php echo date('Y-m-d'); ?>" id="invoiceDate" name="invoiceDate"
                                                        placeholder=" {{ trans('purchases.Invoicedate') }}">
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
                                             <div class="col-lg-3" id="paymentType" style="display: none">
                                                <div class="form-group">
                                                    <label for="">{{ trans('purchases.Paymentaccount') }}</label>
                                                    <select
                                                        class="form-control @error('paymentTypeitems') is-invalid @enderror"
                                                        id="paymentTypeitems" name="paymentTypeitems">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
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
                                                    <label for=""> {{ trans('Sandat.Imageoftheexpense') }} </label>
                                                    <input type="file" class="form-control" name="img" id="img">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for=""> </label>
                                                    <label for=""> </label>
                                                    <label for=""> </label>
                                                    <input type="submit" class="btn btn-primary"
                                                        value="{{ trans('purchases.save') }}" style="width: 100%">
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


    <!------------------------------------add saeed -------------------------------------------------->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script>
        var rows = 0;

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
                document.getElementById(`paymentType`).style.display = "block";

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
                document.getElementById(`paymentType`).style.display = "block";

            } else {
                document.getElementById(`paymentType`).style.display = "none";

            }




        }
    </script>

    <script>
        $('.livesearch').select2();
        $('#sername').change(function() {

            count = document.getElementById(`count`).value;

            $.ajax({
                url: `/outcomeitmes/${$(this).val()}`,
                success: data => {
                    rows++;
                    count++;
                    $('#tbody').append(`
                              <tr id="tr-${count}-">
                                <td>${count}</td>
                                <td>${data.nameAr}</td>
                                <td class="px-2"><input type="number"    class="form-control text-center"  step='any'  id="price${count}" value="1" name="price${count}" onchange="calculate(${count})"></td>>
                                <td class="px-2"><input type="number"  step='any'   class="form-control text-center" id="quantity${count}"  value="1"  name="quantity${count}"  onchange="calculate(${count})"></td>
                                <td class="px-2"><input type="text"     class="form-control text-center" id="text${count}"  name="text${count}"></td>
                                <td id="itotal${count}">${count}</td>
                                <td class="text-center">
                                  <input type="hidden" name="item${count}" id="item${count}" value="${data.id}" />
                                  <input type="hidden" step="any" name="rtotal${count}" id="rtotal${count}" value="${data.id}" />
                                  <input type="hidden" step="any"  name="count${count}" id="count${count}" value="${count}" />
                                  <input type="hidden" step="any"  name="Account${count}" id="Account${count}" value="${data.AccountID}" />
                                  <input type="hidden" step="any"  name="rvat${count}" id="rvat${count}" value="0" />
                                  <input type="hidden" step="any"  name="rtotalwvat${count}" id="rtotalwvat${count}" />
                                  <a href="#" onclick="removeItem(${count})" class="text-danger text-center"><i class="fa fa-times"></i></a>
                                </td>
                              </tr>
                              `)
                    document.getElementById(`count`).value = count;
                    calculate(count);
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {


            $.ajax({
                type: 'post',
                url: "/purchases.SearchAccount/" + 121,
                data: {
                    id: 121
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
                            response.data[i].AccountID + '::' + response.data[i].AccountName +
                            '">' + response.data[i].AccountName + '</option>');
                    }
                },
                complete: function(response) {}
            });
            document.getElementById(`paymentType`).style.display = "block";

        });




        function removeItem(trnum) {
            var myobj = document.getElementById("tr-" + trnum + "-");
            myobj.remove();
            rows--;
            calculateTotal();
        }


        function calculate(id) {
            var price = parseFloat(document.getElementById('price' + id).value);
            var quantity = parseFloat(document.getElementById('quantity' + id).value);

            var rtotal = (price * quantity).toFixed(2);
            var rvat = (price * quantity * 0.15).toFixed(2);
            var rtotalwvat = (parseFloat(rtotal) + parseFloat(rvat)).toFixed(2);

            console.log(rtotalwvat);

            document.getElementById('rtotal' + id).value = rtotal;
            document.getElementById('rvat' + id).value = rvat;
            document.getElementById('rtotalwvat' + id).value = rtotal;
            $("#itotal" + id).empty().append(rtotal);

            calculateTotal();
        }


        function calculateTotal() {
            var totalwvat = 0;
            var total = 0;
            var vat = 0;
            var totaldiscount = 0;

            for (var i = 1; i <= count; i++) {
                try {
                    var rtotalwvat = parseFloat(document.getElementById("rtotalwvat" + i).value);
                    var rvat = parseFloat(document.getElementById("rvat" + i).value);
                    totalwvat += rtotalwvat;
                    vat += rvat;
                } catch (error) {
                    console.error("Error in calculation:", error);
                }
            }

            document.getElementById("total").value = (totalwvat - vat).toFixed(2);
            document.getElementById("vat").value = vat.toFixed(2);
            document.getElementById("totalwvat").value =totalwvat.toFixed(2);


            $("#view-total").empty().append((totalwvat - vat).toFixed(2));
            $("#view-vat").empty().append(vat.toFixed(2));
            $("#view-totalwvat").empty().append(totalwvat.toFixed(2)) ;

        }
    </script>
@endsection
