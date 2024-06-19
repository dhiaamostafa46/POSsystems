@extends('layouts.dashboard')
<style>
    td,
    th {
        padding: 0px !important;
        text-align: center !important;
    }

    .menu {
        height: 40px;
        padding-right: 5px;

        color: #000 !important;
    }

    .active1 {
        color: #de0400;
    }

    #calculator {
        width: 480px;
        height: auto;

        margin: 100px auto;
        padding: 20px 20px 9px;

        background: #9dd2ea;
        background: linear-gradient(#9dd2ea, #8bceec);
        border-radius: 6px;
        box-shadow: 0px 8px #009de4, 0px 20px 30px rgba(0, 0, 0, 0.2);
    }

    /* Top portion */
    .top span.clear {
        float: left;
    }

    /* Inset shadow on the screen to create indent */
    .top .screen {
        height: 80px;
        width: 280px;

        float: left;

        padding: 0 10px;

        background: rgba(0, 0, 0, 0.2);
        border-radius: 6px;
        box-shadow: inset 0px 4px rgba(0, 0, 0, 0.2);

        /* Typography */
        font-size: 34px;
        line-height: 80px;
        color: white;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        text-align: right;
        letter-spacing: 1px;
    }

    /* Clear floats */
    .keys,
    .top {
        overflow: hidden;
    }

    /* Applying same to the keys */
    .keys span,
    .top span.clear {
        float: left;
        position: relative;
        top: 0;

        cursor: pointer;

        width: 132px;
        height: 72px;
        font-size: xx-large;
        background: white;
        border-radius: 6px;
        box-shadow: 0px 8px rgba(0, 0, 0, 0.2);

        margin: 0 14px 22px 0;

        color: #888;
        line-height: 72px;
        text-align: center;

        /* prevent selection of text inside keys */
        user-select: none;

        /* Smoothing out hover and active states using css3 transitions */
        transition: all 0.2s ease;
    }

    /* Remove right margins from operator keys */
    /* style different type of keys (operators/evaluate/clear) differently */
    .keys span.operator {
        background: #FFF0F5;
        margin-right: 0;
    }

    .keys span.eval {
        background: #f1ff92;
        box-shadow: 0px 8px #9da853;
        color: #888e5f;
    }

    .top span.clear {
        background: #ff9fa8;
        box-shadow: 0px 8px #ff7c87;
        color: white;
    }

    /* Some hover effects */
    .keys span:hover {
        background: #9c89f6;
        box-shadow: 0px 8px #6b54d3;
        color: white;
    }

    @media only screen and (max-width: 600px) {
        .pos-container {
            height: max-content !important;
        }

        #calculator {
            display: none !important;
        }

        .donBtn {
            display: block !important;
        }
    }

    .keys span.eval:hover {
        background: #abb850;
        box-shadow: 0px 8px #717a33;
        color: #ffffff;
    }

    .top span.clear:hover {
        background: #f68991;
        box-shadow: 0px 8px #d3545d;
        color: white;
    }

    /* Simulating "pressed" effect on active state of the keys by removing the box-shadow and moving the keys down a bit */
    .keys span:active {
        box-shadow: 0px 0px #6b54d3;
        top: 8px;
    }

    .keys span.eval:active {
        box-shadow: 0px 0px #717a33;
        top: 8px;
    }

    .top span.clear:active {
        top: 8px;
        box-shadow: 0px 0px #d3545d;
    }
</style>
@section('content')
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> {{ trans('Sale.SalesPoS') }} </h3>
                    </div>
                </div>
            </div>
            <!-- Small boxes (Stat box) -->
            <div class="row mt-2">
                <div class="col-lg-3">
                    <div class="card pos-container" style="height: 650px">
                        <div class="card-header bg-danger">
                            <h6> {{ trans('Sale.list') }} </h6>
                        </div>
                        <div class="card-body">
                            @foreach (auth()->user()->organization->prodcategoriesKatcSaller as $index => $cat)
                                <a href="#" onclick="setCat({{ $cat->id }});" class="menu">
                                    <h6 class="text-menu" @if ($index == 0) style="color:red" @endif>
                                        <li id="li{{ $cat->id }}" class="li list-unstyled"><i
                                                class="fa fa-bookmark"></i> {{ $cat->nameAr }}
                                    </h6>
                                </a>
                                <hr style="margin-top: 5px;margin-bottom: 5px">
                            @endforeach
                        </div>
                    </div>
                    {{-- <button type="button" style="width: 100%;"   data-bs-toggle="modal" data-bs-target="#TableAllOrder" class=" btn btn-info">الطاولات</button> --}}
                </div>
                <div class="col-lg-6">
                    <div class="card pos-container" style="height: 650px">
                        <div class="card-header bg-danger">
                            <h6>{{ trans('Sale.Items') }}</h6>
                        </div>
                        <div class="card-body tab-content overflow-auto">
                            @if (count(auth()->user()->branch->durations) > 0)
                                @if (auth()->user()->branch->durations->first()->status == 1)
                                    @foreach (auth()->user()->organization->prodcategoriesKatcSaller as $index => $cat)
                                        <div class="cat" id="cat{{ $cat->id }}"
                                            @if ($index > 0) style="display: none" @endif>
                                            <div class="row">
                                                @if (count($prds) > 0)
                                                    @foreach ($prds as $item)
                                                        @if ($item->saleable == 1)
                                                            <?php $checkCat = $item->saleCat; ?>
                                                        @else
                                                            <?php $checkCat = $item->categoryID; ?>
                                                        @endif
                                                        @if ($checkCat == $cat->id)
                                                            <div class="col-6 col-md-3">
                                                                <a href="#"
                                                                    onclick="addItem('{{ $item->id }}','{{ $item->nameAr }}','{{ $item->prodPrice }}','{{ $item->costPrice }}','{{ $item->kitchenID }}');"
                                                                    class="card shadow">
                                                                    <div class="card-header bg-warning">
                                                                        <h6
                                                                            style="margin: auto;text-align:center;font-size:small">
                                                                            {{ $item->nameAr }}</h6>
                                                                    </div>
                                                                    <div class="card-body" style="padding:0px">
                                                                        <img src="{{ asset('public/dist/img/products/' . $item->img) }}"
                                                                            height="100px" width="100%" alt="">
                                                                    </div>
                                                                    <div class="card-footer bg-warning">
                                                                        <h6
                                                                            style="margin: auto;text-align:center;font-size:small">
                                                                            <strong>{{ $item->prodPrice }}
                                                                                {{ trans('Sale.Rial') }}</strong>
                                                                        </h6>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>



                    <div class="card border-top border-success border-3" style="height: 85px;">
                        <div class="row"style="margin:15px">
                            @if (count(auth()->user()->branch->durations) > 0)
                                @if (auth()->user()->branch->durations->first()->status == 1)
                                    <h6 class="col-md-6"> {{ trans('Sale.Permanencystatus') }}: <strong
                                            class='text-success'> {{ trans('Sale.open') }}</strong></h6>
                                    <h6 class="col-md-6"> {{ trans('Sale.StartofworkTime') }}:
                                        <strong>{{ auth()->user()->branch->durations->first()->created_at }}</strong>
                                    </h6>
                                    <h6 class="col-md-6"> {{ trans('Sale.Worknumber') }}:
                                        <strong>{{ auth()->user()->branch->durations->first()->durationNo }}</strong>
                                        <a href="#"
                                            onclick="endDuration({{ auth()->user()->branch->durations->first()->id }});"
                                            class="btn btn-primary"> {{ trans('Sale.Endofwork') }}</a>
                                    </h6>
                                    <h6 class="col-md-6">{{ trans('Sale.user') }}:
                                        <strong>{{ auth()->user()->branch->durations->first()->user->name }}</strong>
                                    </h6>
                                @else
                                    <h6 class="col-md-6"> {{ trans('Sale.Permanencystatus') }}: <strong
                                            class='text-danger'> {{ trans('Sale.closed') }}</strong></h6>
                                    <h6 class="col-md-6"><a href="#" onclick="startDuration();"
                                            class="btn btn-primary" style="width:100%"> {{ trans('Sale.Startofwork') }}</a>
                                    </h6>
                                @endif
                            @else
                                <h6 class="col-md-6"> {{ trans('Sale.Permanencystatus') }}: <strong class='text-danger'>
                                        {{ trans('Sale.closed') }}</strong></h6>
                                <h6 class="col-md-6"><a href="#" onclick="startDuration();" class="btn btn-primary"
                                        style="width:100%"> {{ trans('Sale.Startofwork') }}</a></h6>
                            @endif
                        </div>
                    </div>
                </div>
                <form action="{{ route('orders.storeRest') }}" target="_blank" method="POST" class="col-lg-3"
                    onsubmit="setTimeout(function(){window.location.reload();},10);">
                    @csrf
                    <div class="card pos-container" style="height: 700px">
                        <div class="card-header bg-danger">
                            <h6 class="row">
                                <span class="col-6">{{ trans('Sale.item') }}</span>
                                <span class="col-3">{{ trans('Sale.number') }}</span>
                                <span class="col-3">{{ trans('Sale.price') }}</span>

                            </h6>
                        </div>

                        <div class="card-body" id="items">
                        </div>

                        <div class="card-footer">
                            <div id="tr-${count}-">
                                <h6 class="text-menu row">
                                    <span class="col-9">{{ trans('Sale.total') }}</span>
                                    <span class="col-3"><strong id="view-total">0</strong></span>
                                </h6>
                                <h6 class="text-menu row">
                                    <span class="col-9"> {{ trans('Sale.Valueaddedtax') }}</span>
                                    <span class="col-3"><strong id="view-vat">0</strong></span>
                                </h6>
                                <hr>
                                <h6 class="text-menu row">
                                    <span class="col-9"> {{ trans('Sale.Totalincludingtax') }}</span>
                                    <span class="col-3"><strong id="view-totalwvat">0</strong></span>
                                </h6>
                                <input type="hidden" name="total" id="total" value="0" />
                                <input type="hidden" name="vat" id="vat" value="0" />
                                <input type="hidden" name="totalwvat" id="totalwvat" value="0" />
                                <input type="hidden" name="totaldiscount" id="totaldiscount" value="0" />
                                <input type="hidden" name="count" id="count" value="0">

                            </div>
                        </div>
                    </div>
                    <select name="type" id="type" class="form-control paymentTypeMultiTotal"
                        onchange="showCashCard(this)" style="width: 49%;display:inline-block" required>
                        <option value=""> {{ trans('Sale.Choosepaymenttype') }}</option>
                        <option value="121"> {{ trans('Sale.Cash') }}</option>
                        <option value="122"> {{ trans('Sale.Net') }}</option>
                        <option value="7"> {{ trans('Sale.CashNet') }}</option>
                        <option value="3"> {{ trans('Sale.Paylater') }}</option>
                    </select>
                    {{-- <input type="text" id="tblNo" name="tblNo" class="form-control" style="width: 49%;display:inline-block" placeholder="رقم الطاولة"> --}}
                    <select class="form-control"id="tblNo" name="tblNo" style="width: 49%;display:inline-block">
                        <option value="" style="display: none"> {{ trans('Sale.Choosethetable') }} </option>
                        @if (count($table) > 0)
                            @foreach ($table as $item)
                                <option value="{{ $item->id }}"> {{ $item->tableNo }} </option>
                            @endforeach
                        @endif
                    </select>

                    <select name="orderType" id="orderType" class="form-control mt-1" required>
                        <option value=""> {{ trans('Sale.ChooseTypeOrder') }}</option>
                        <option value="1">{{ trans('Sale.recive') }}</option>
                        <option value="2">{{ trans('Sale.delivery') }}</option>
                        <option value="3">{{ trans('Sale.local') }}</option>
                        <option value="4">{{ trans('Sale.travel') }}</option>
                    </select>

                    <div class="col-lg-9 row mb-3" id="paymentType" style="display: none">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">حساب الدفع</label>
                        <div class="col-sm-9">
                            <select class="form-control @error('paymentTypeitems') is-invalid @enderror"
                                id="paymentTypeitems" name="paymentTypeitems">
                            </select>
                        </div>
                    </div>
                    <button class="col-12 btn btn-primary mt-2" style="width: 100%"> {{ trans('Sale.save') }}</button>
            </div>
        </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>




















    <!-- Qnty Modal -->
    <div class="modal fade modal" id="qntyModel" tabindex="-1" role="dialog" aria-labelledby="qntyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('Sale.Extras') }} </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="col-12 row mt-3">

                    <div class="col-12 mt-2 mb-2" id="extras">
                    </div>
                    <div class="col-12 mt-2 mb-2">
                        <a href="#" onclick="setQnty()" class="btn btn-warning donBtn" data-dismiss="modal"
                            style="display: none"> {{ trans('Sale.Done') }}</a>
                    </div>
                </div>


            </div>
        </div>
    </div>






    <!-- Modal -->
    <div class="modal fade" id="paymentmullti" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"> {{ trans('Sale.CashNet') }} </h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"> {{ trans('Sale.Cash') }}</label>
                        <input type="hidden" id="oldmulticatch">
                        <div class="col-sm-10">
                            <input type="number" class="form-control" step="any" id="CashMulti" name="CashMulti"
                                onchange="numdividedCach()">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">{{ trans('Sale.Net') }}</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" step="any" id="NetMulti" name="NetMulti"
                                autofocus value="0" onkeyup="numdividedNet()">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal"
                        class="btn btn-primary">{{ trans('Sale.save') }}</button>
                    <button type="button" class="btn btn-secondary" onclick="Closepaymentmulti()"
                        data-bs-dismiss="modal">{{ trans('Sale.Close') }}</button>
                </div>
            </div>
        </div>
    </div>






    <!-- Modal -->
    <div class="modal fade" id="TableAllOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="card pos-container">
                    <div class="card-header bg-danger">
                        <h6>الطاولات </h6>
                    </div>
                    <div class="card-body">
                        <input type="text" id="idextraprodect">
                        @if (count($table) > 0)
                            <div class="row">
                                @foreach ($table as $item)
                                    <div class="col-3 m-2">
                                        <button type="button" onclick="AddtableMarket({{ $item->id }})"
                                            style="width: 18rem;" class="btn btn-success">{{ $item->tableNo }} </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>




































    <div style="display: none">
        <h1 id="titalmesssage"> {{ trans('Sale.Entertheopeningbalanceofthefund') }} </h1>
        <h1 id="confirmButtonText"> {{ trans('Sale.balanceText') }} </h1>
        <h1 id="cancelButtonText"> {{ trans('Sale.balanceCancel') }} </h1>
    </div>






    <!-- Qnty Modal -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        function Closepaymentmulti() {
            $(".paymentTypeMultiTotal").prop("selectedIndex", 0).change();

        }

        function numdividedCach() {

            old = document.getElementById('oldmulticatch').value;
            cash = document.getElementById('CashMulti').value;
            if (cash == '') {

                document.getElementById('NetMulti').value = old;

            } else if (parseFloat(old) < parseFloat(cash)) {
                document.getElementById('CashMulti').value = old;
                document.getElementById('NetMulti').value = 0;

            } else {

                document.getElementById('NetMulti').value = parseFloat(old) - parseFloat(cash);
            }


        }



        function numdividedNet() {


            old = document.getElementById('oldmulticatch').value;
            net = document.getElementById('NetMulti').value;


            console.log(net);
            if (net == '') {

                document.getElementById('CashMulti').value = old;

            } else if (parseFloat(old) < parseFloat(net)) {
                document.getElementById('NetMulti').value = old;
                document.getElementById('CashMulti').value = 0;

            } else {

                document.getElementById('CashMulti').value = parseFloat(old) - parseFloat(net);
            }


        }
    </script>

    <script>
        function AddtableMarket(id) {

            console.log(id);

        }

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
                        for (let i = 0; i < response.count; i++) {
                            $('#paymentTypeitems').append('<option value="' + response.data[i].AccountID +
                                '::' + response.data[i].AccountName + '">' + response.data[i].AccountName +
                                '</option>');
                        }
                    },
                    complete: function(response) {}
                });


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

                        for (let i = 0; i < response.count; i++) {
                            $('#paymentTypeitems').append('<option value="' + response.data[i].AccountID +
                                '::' + response.data[i].AccountName + '">' + response.data[i].AccountName +
                                '</option>');
                        }
                    },
                    complete: function(response) {}
                });


            } else if (obj.value == 7) {

                $('#paymentmullti').modal('show');
                document.getElementById('CashMulti').value = document.getElementById('totalwvat').value;
                document.getElementById('oldmulticatch').value = document.getElementById('totalwvat').value;
                $('#NetMulti').focus();

            }




        }
    </script>

































    <script>
        var count = 0;
        var rows = 0;
        var nameAr = "";

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

            }

        }
    </script>
    <script>
        flagechange = 0;
        $(function() {
            $("li").click(function() {
                // remove classes from all
                $("li").removeClass("active");
                // add class to the one we clicked
                $(this).addClass("active");
            });
        });

        function setCat(id) {
            document.querySelectorAll('.cat').forEach(function(el) {
                el.style.display = 'none';
            });
            document.querySelectorAll('.li').forEach(function(el) {
                el.style.color = 'black';
            });
            document.getElementById(`cat${id}`).style.display = 'block';
            document.getElementById(`li${id}`).style.color = 'red';
        }



        function addItem(id, name, price, cprice, kitchenID) {

            if (count == 0) {
                addProdectAll(id, name, price, cprice, kitchenID);
            } else {

                flage = 0;
                mark = 0;
                for (let i = 1; i <= count; i++) {
                    if (document.getElementById('item' + i).value == id) {
                        flage = 1;
                        mark = i;
                        break;
                    }
                }
                //****************************************************************
                //********************** get Extras ******************************
                //****************************************************************

                if (flage == 0) {
                    addProdectAll(id, name, price, cprice, kitchenID);
                } else {
                    qntyAdd(mark);
                }

            }
        }



        function addProdectAll(id, name, price, cprice, kitchenID) {

            count++;
            rows++;
            flagechange = 1;


            //****************************************************************
            //********************* End Extras *******************************
            //****************************************************************

            $('#items').append(`
            <div  id="tr-${count}-">
            <h6 class="text-menu row">
              <span class="col-4" style="font-size:small" id="name${count}">${name}</span>
              <span class="col-4 row">
                <a class"btn btn-success col-2" onclick="qntyAdd('${count}')"><i class="fa fa-plus-square" style="line-height:2"></i></a>
                <input type="number" class="form-control col-8" name="quantity${count}" id="quantity${count}" value="1" style="padding:1px;text-align:center"  onchange="changeitemscount('${count}')">
                <a class"btn btn-success col-2" onclick="qntyMinus('${count}')"><i class="fa fa-minus-square" style="line-height:2"></i></a>
              </span>
              <span class="col-3"><input type="text" class="form-control" id="rtotalwvat${count}" value="${price}" readonly></span>
              <span class="col-1"> <a class"btn btn-success" onclick="Extra('${count}')"><i class="fa fa-list-ol" style="line-height:2"></i></a></span>
            </h6>
            <h6 class="text-menu row" id="menuExt${count}">
            </h6>
            <input type="hidden" name="item${count}" id="item${count}" value="${id}" />
            <input type="hidden" name="kitchenID${count}" id="kitchenID${count}" value="${kitchenID}" />
            <input type="hidden" name="itemName${count}" id="itemName${count}" value="${name}" />
            <input type="hidden" name="discount${count}" id="discount${count}" value="0" />
            <input type="hidden" name="rtotal${count}" id="rtotal${count}" value="0" />
            <input type="hidden" name="rvat${count}" id="rvat${count}" value="0" />
            <input type="hidden" name="price${count}" id="price${count}" value="${price}" />
            <input type="hidden" name="cprice${count}" id="cprice${count}" value="${cprice}" />
            <input type="hidden" name="Exitetprice${count}" id="Exitetprice${count}" value="0" />
            <input type="hidden" name="Exitetcount${count}" id="Exitetcount${count}" value="0" />
            <hr>
            </div>
            `)
            document.getElementById('count').value = count;
            calculateTotal();
        }



        function Extra(idx) {

            id = document.getElementById('item' + idx).value;

            //****************************************************************
            //********************** get Extras ******************************
            //****************************************************************
            $.ajax({
                url: `/getExtras/${id}`,
                success: data => {
                    $('#extras').empty()
                    data.items.forEach(item => {
                        $('#extras').append(
                            `<button class="btn btn-danger" onclick="addToItem('${item.id}','${item.nameAr}',${item.price},${item.items})">${item.nameAr}</button>&nbsp`
                        )
                    })
                }
            });

            $('#qntyModel').modal('show')

            document.getElementById('idextraprodect').value = idx;


        }






        var flage = true;

        function addToScreen(num) {
            if (flage) {
                document.getElementById(`screen`).innerHTML = "";
                flage = false;
            }
            var old = document.getElementById(`screen`).innerHTML;
            var newNum = old + num;
            $("#screen").empty().append(newNum);
        }

        function clearScreen() {
            $("#screen").empty();
        }

        function setQnty() {
            var qnt = document.getElementById(`screen`).innerHTML;
            document.getElementById(`quantity${count}`).value = qnt;
            document.getElementById(`rtotalwvat${count}`).value = Number(document.getElementById(`price${count}`).value) *
                Number(qnt);
            calculateTotal();
        }

        function qntyAdd(qntID) {

            var qnt = document.getElementById(`quantity${qntID}`).value;
            qnt++;
            document.getElementById(`quantity${qntID}`).value = qnt;
            document.getElementById(`rtotalwvat${qntID}`).value = Number(document.getElementById(`price${qntID}`).value) *
                Number(qnt) + Number(document.getElementById(`Exitetprice${qntID}`).value);
            calculateTotal();
        }

        // -----------------------------------------------------------------

        function qntyAddextra(idx, id) {

            var qnt = document.getElementById("quantity" + idx + "-" + id + "").value;
            qnt++;
            document.getElementById("quantity" + idx + "-" + id + "").value = qnt;
            // priceExtra =qnt  * Number(document.getElementById("extrapriceItems"+id+"-"+idx+"").value);
            // console.log(priceExtra);

            document.getElementById(`Exitetprice${idx}`).value = Number(document.getElementById("extrapriceItems" + idx +
                "-" + id + "").value) + Number(document.getElementById(`Exitetprice${idx}`).value);
            document.getElementById(`rtotalwvat${idx}`).value = Number(document.getElementById("extrapriceItems" + idx +
                "-" + id + "").value) + Number(document.getElementById(`rtotalwvat${idx}`).value);
            calculateTotal();
            // document.getElementById(`rtotalwvat${qntID}`).value = Number(document.getElementById(`price${qntID}`).value) * Number(qnt);
            // calculateTotal();
        }


        function qntyMinusextra(idx, id, itemsid) {

            var qnt = document.getElementById("quantity" + idx + "-" + id + "").value;
            if (qnt > 1) {
                qnt--;
                document.getElementById("quantity" + idx + "-" + id + "").value = qnt;
                document.getElementById(`Exitetprice${idx}`).value = Number(document.getElementById(`Exitetprice${idx}`)
                    .value) - Number(document.getElementById("extrapriceItems" + idx + "-" + id + "").value);
                document.getElementById(`rtotalwvat${idx}`).value = Number(document.getElementById(`rtotalwvat${idx}`)
                    .value) - Number(document.getElementById("extrapriceItems" + idx + "-" + id + "").value);;
                calculateTotal();
                //   document.getElementById(`rtotalwvat${qntID}`).value = document.getElementById(`price${qntID}`).value * qnt;
                //  calculateTotal();
            } else {
                if (qnt == 1) {

                    document.getElementById(`Exitetprice${idx}`).value = Number(document.getElementById(`Exitetprice${idx}`)
                        .value) - Number(document.getElementById("extrapriceItems" + idx + "-" + id + "").value);
                    document.getElementById(`rtotalwvat${idx}`).value = Number(document.getElementById(`rtotalwvat${idx}`)
                        .value) - Number(document.getElementById("extrapriceItems" + idx + "-" + id + "").value);
                    calculateTotal();
                    removeItemExtra(idx, itemsid);
                }
            }

        }


        function removeItemExtra(idx, id) {
            var myobj = document.getElementById("ext-" + idx + "-" + id + "");
            document.getElementById(`Exitetcount${idx}`).value = Number(document.getElementById(`Exitetcount${idx}`)
                .value) - 1;
            myobj.remove();
            rows--;
        }


        // -----------------------------------------------------------------


        function qntyMinus(qntID) {

            var qnt = document.getElementById(`quantity${qntID}`).value;
            if (qnt > 1) {
                qnt--;
                document.getElementById(`quantity${qntID}`).value = qnt;
                document.getElementById(`rtotalwvat${qntID}`).value = document.getElementById(`price${qntID}`).value * qnt +
                    Number(document.getElementById(`Exitetprice${qntID}`).value);
                calculateTotal();
            } else {
                if (qnt == 1) {
                    removeItem(qntID);
                }
            }

        }

        function changeitemscount(qntID) {

            var qnt = document.getElementById(`quantity${qntID}`).value;
            if (qnt > 1) {
                document.getElementById(`rtotalwvat${qntID}`).value = document.getElementById(`price${qntID}`).value * qnt +
                    Number(document.getElementById(`Exitetprice${qntID}`).value);
                calculateTotal();
            } else {
                if (qnt == 1) {
                    removeItem(qntID);
                }
            }
        }


        function addToItem(id, name, price, itemse) {

            idx = document.getElementById('idextraprodect').value;



            countextra = Number(document.getElementById('Exitetcount' + idx).value);

            if (document.getElementById("ext-" + idx + "-" + id + "") == null) {
                countextra = countextra + 1;

                $('#menuExt' + idx).append(`
            <h6 class="text-menu row" id="ext-${idx}-${id}" style="margin: 0px;">
              <span class="col-5" style="font-size:small" id="name11${idx}">${name} (${price})</span>
              <span class="col-6 row">
                <a class"btn btn-success col-3" style="position: relative; top: -7px;" onclick="qntyAddextra('${idx}',${countextra})"><i class="fa fa-plus-square" style="line-height:2"></i></a>
                <input type="text" class=" col-6 text-center" style="height: 20px" name="quantity${idx}-${countextra}" id="quantity${idx}-${countextra}" value="1" style="text-align:center" readonly>
                <a class"btn btn-success col-3" style="position: relative; top: -7px;"  onclick="qntyMinusextra('${idx}',${countextra},${id})"><i class="fa fa-minus-square" style="line-height:2"></i></a>
                <input type="hidden" name="extraitem${idx}-${countextra}" id="extraitem${idx}-${countextra}" value="${itemse}" />
                <input type="hidden" name="extraname${idx}-${countextra}" id="extraname${idx}-${countextra}" value="${name}" />
                <input type="hidden" name="extrapriceItems${idx}-${countextra}" id="extrapriceItems${idx}-${countextra}" value="${price}" />
              </span>
            </h6>
            `)


                document.getElementById(`Exitetcount${idx}`).value = Number(document.getElementById(`Exitetcount${idx}`)
                    .value) + 1;
                document.getElementById(`Exitetprice${idx}`).value = Number(document.getElementById("extrapriceItems" +
                    idx + "-" + countextra + "").value) + Number(document.getElementById(`Exitetprice${idx}`).value);
                document.getElementById(`rtotalwvat${idx}`).value = Number(document.getElementById("extrapriceItems" + idx +
                    "-" + countextra + "").value) + Number(document.getElementById(`rtotalwvat${idx}`).value);
                calculateTotal();

            } else {

                document.getElementById("quantity" + idx + "-" + countextra + "").value = parseInt(document.getElementById(
                    "quantity" + idx + "-" + countextra + "").value) + 1;
                document.getElementById(`Exitetprice${idx}`).value = Number(document.getElementById("extrapriceItems" +
                    idx + "-" + countextra + "").value) + Number(document.getElementById(`Exitetprice${idx}`).value);
                document.getElementById(`rtotalwvat${idx}`).value = Number(document.getElementById("extrapriceItems" + idx +
                    "-" + countextra + "").value) + Number(document.getElementById(`rtotalwvat${idx}`).value);
                calculateTotal();

            }




            // var proName = document.getElementById(`name${count}`).innerHTML;
            // document.getElementById(`name${count}`).innerHTML = proName+" <br>+ "+name+" ("+price+" ريال) <input type='hidden' id='ext"+count+"ext"+id+"' value='"+id+"'>";
            // document.getElementById(`itemName${count}`).value = proName+" + "+name+" ("+price+" ريال)";
            // document.getElementById(`price${count}`).value = Number(document.getElementById(`price${count}`).value) + Number(price);
            // document.getElementById(`rtotalwvat${count}`).value =  document.getElementById(`price${count}`).value;

        }

        $('#tblNo').change(function() {

            document.getElementById('orderType').value = 3;
        });





        function removeItem(trnum) {
            var myobj = document.getElementById("tr-" + trnum + "-");
            myobj.remove();
            rows--;
            calculateTotal();
        }

        function startDuration() {

            ddd = document.getElementById('titalmesssage').innerHTML;
            dyes = document.getElementById('confirmButtonText').innerHTML;
            dno = document.getElementById('cancelButtonText').innerHTML;

            Swal.fire({
                title: ddd,
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: dyes,
                cancelButtonText: dno,
                showLoaderOnConfirm: true,
                preConfirm: (amount) => {
                    window.location.href = `/createDuration/${amount}`;
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }
    </script>
@endsection
