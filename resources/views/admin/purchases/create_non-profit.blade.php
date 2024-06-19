@extends('layouts.dashboard')
<style>
    td,
    th {
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

                </div>


                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
        </div>
        <div class="col-12">
            <div class="card card-primary" style="height: 690px">

                <div class="card-body">
                    <form class="user" method="POST" action="{{ route('purchases.store_enon_profit') }}"
                        enctype = "multipart/form-data">
                        @csrf
                        <div style="height: 420px;overflow-y: scroll;">
                            <table id="example5" class="table table-bordered table-hover">


                                <tbody>


                                    <table class="table table-bordered" id="dynamicAddRemove">
                                        <tr>
                                            <th>المنتج</th>
                                            <th>الكمية</th>
                                            <th>السعر</th>

                                            <th>المجموع</th>
                                            <th>خيارات</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="addMoreInputFields[0][item_name]"
                                                    placeholder="اسم المنتج " class="form-control" /> </td>
                                            <td><input type="text" name="addMoreInputFields[0][quantity]" id="quantity"
                                                    placeholder="الكمية" class="form-control" /> </td>
                                            <td><input type="text" name="addMoreInputFields[0][price]" id="price"
                                                    placeholder="السعر" class="form-control" /> </td>
                                            <td> <input type="" id="totle" name="addMoreInputFields[0][totle]" placeholder=" "
                                                    class="form-control" /></td>
                                            <input type="hidden" name="addMoreInputFields[0][discount]" placeholder=" "
                                                class="form-control" />
                                            <td><button type="button" name="add" id="dynamic-ar"
                                                    class="btn btn-outline-primary">اضافة عنصر جديد </button></td>
                                        </tr>
                                    </table>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">المورد</label>
                                            <select class="form-control @error('supplierID') is-invalid @enderror"
                                                id="supplierID" name="supplierID">
                                                <option value="">اختر المورد</option>
                                                @foreach (auth()->user()->organization->suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
                                            <label for="">نوع الدفع</label>
                                            <select class="form-control @error('type') is-invalid @enderror" id="type"
                                                name="type" onchange="payments()">
                                                <option value="1">نقداً</option>
                                                <option value="2">شبكة</option>
                                                <option value="3">آجل</option>
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3" id="paymentDate" style="display: none">
                                        <div class="form-group">
                                            <label for="">تاريخ السداد</label>
                                            <input type="date"
                                                class="form-control @error('payDate') is-invalid @enderror" id="payDate"
                                                name="payDate" placeholder="تاريخ الفاتورة">
                                            @error('payDate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">رقم الفاتورة</label>
                                            <input type="text" class="form-control @error('serial') is-invalid @enderror"
                                                id="serial" name="serial" placeholder="رقم فاتورة المشتريات">
                                            @error('serial')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">تاريخ الفاتورة</label>
                                            <input type="date"
                                                class="form-control @error('invoiceDate') is-invalid @enderror"
                                                id="invoiceDate" name="invoiceDate" placeholder="تاريخ الفاتورة">
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
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" value="حفظ"
                                                style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group text-left">
                                    <h6>المجموع</h6>
                                    <h6>ضريبة القيمة المضافة</h6>
                                    <h6>الاجمالي شامل الضريبة</h6>
                                </div>
                            </div>
                            <div class="col-lg-3">
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
        $('#barcode').change(function() {

            $.ajax({
                url: `/getBarcode/${document.getElementById('barcode').value}`,
                success: data => {
                    count++;
                    rows++;
                    document.getElementById('barcode').value = "";
                    document.getElementById("barcode").focus();

                    document.getElementById('pname').innerHTML = "";
                    //$('#prodName').empty()
                    data.items.forEach(item => {
                            document.getElementById('pname').innerHTML = item.nameAr;
                            $('#tbody').append(`
              <tr id="tr-${count}-">
                <td>${item.id}</td>
                <td>${item.nameAr}</td>
                <td><input type="number" min="0.00" step=".01" id="price${count}" name="price${count}" value="${item.costPrice}" onchange="calculate(${count})"></td>>
                <td><input type="number" id="quantity${count}" name="quantity${count}" value="1" onchange="calculate(${count})"></td>
                <td id="itotal${count}">${item.costPrice}</td>
                <td class="text-center">
                  <input type="hidden" name="item${count}" id="item${count}" value="${item.id}"
                  <input type="hidden" name="vat${count}" id="vat${count}" value="${item.vat/100}" />
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
            var vat_value = document.getElementById('vat' + id).value;

            var rtotal = +parseFloat(price / (1 + vat_value) * quantity - discount / (1 + vat_value)).toFixed(2);
            var rvat = +parseFloat(rtotal * vat_value).toFixed(2);
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

                        document.getElementById("total").value = +parseFloat(total).toFixed(2);
                        document.getElementById("vat").value = +parseFloat(vat).toFixed(2);
                        document.getElementById("totalwvat").value = +parseFloat(totalwvat).toFixed(2);
                        document.getElementById("totaldiscount").value = +parseFloat(totaldiscount).toFixed(2);
                        $("#view-total").empty().append(document.getElementById('total').value);
                        $("#view-vat").empty().append(document.getElementById('vat').value);
                        $("#view-totalwvat").empty().append(document.getElementById('totalwvat').value);
                        $("#bigtotal").empty().append(document.getElementById('totalwvat').value);
                        //$( "#view-totaldiscount" ).empty().append(document.getElementById('totaldiscount').value);
                    } catch {

                    }
                }
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

        $("form").bind("keypress", function(e) {
            if (e.keyCode == 13) {
                $("#barcode").focus()
                //add more buttons here
                return false;
            }
        });

        $('#type').change(function() {
            type = document.getElementById('type').value;
            if (type == 3) {
                document.getElementById('paymentDate').style.display = "block";
            } else {
                document.getElementById('paymentDate').style.display = "none";
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
                '][item_name]" placeholder="اسم المنتج " class="form-control" /></td><td><input type="text" name="addMoreInputFields[' +
                i +
                '][quantity]" id="quantity' + i +
                '" placeholder="الكمية" class="form-control" /></td><td><input type="text" name="addMoreInputFields[' +
                i +
                '][price]" id="price' + i +
                '"  placeholder="السعر" class="form-control" /></td><td><input type="text" id="totle' + i +
                '"  name="addMoreInputFields[' + i + '][totle]" class="form-control" /></td>   <input type="hidden" name="addMoreInputFields[' + i +'][discount]" placeholder=" "class="form-control" /><td><button type="button" class="btn btn-outline-danger remove-input-field">حذف</button></td></tr>'
            );
            const el = document.getElementById("quantity" + i + "");
            const box = document.getElementById("price" + i + "");
            console.log(box.value);
            box.addEventListener('change', function handleChange(event) {
                var totle = box.value * el.value;
                console.log(totle);
                document.getElementById("totle" + i + "").value = totle;

            });
        });

        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
    </script>

    <script>
        const el = document.getElementById('quantity');
        const box = document.getElementById('price');
        box.addEventListener('change', function handleChange(event) {
            var totle = box.value * el.value;
            console.log(totle);
            document.getElementById('totle').value = totle;

        });
    </script>
@endsection
