@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('Packages.Package') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('Packages.Packagesandsubscription') }} </a>
                        </li>
                        <li class="breadcrumb-item active"> {{ trans('Packages.Package') }} </li>
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
                            <h3 class="card-title"> {{ trans('Packages.Package') }} </h3>
                        </div>
                        <div class="card-body">

                            <style>
                                .customRadioInline {
                                    margin-right: 10px;
                                    transform: scale(2);
                                }
                            </style>
                            <div class="d-flex justify-content-center">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="myRadio"
                                        class="custom-control-input customRadioInline" checked value="0">
                                    <label class="custom-control-label" for="customRadioInline1">
                                        {{ trans('Packages.annual') }} </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="myRadio"
                                        class="custom-control-input customRadioInline" value="1">
                                    <label class="custom-control-label" for="customRadioInline2">
                                        {{ trans('Packages.Monthly') }} </label>
                                </div>

                            </div>

                            <hr>
                            <div class="row mt-2">
                                @if (count($packages) > 0)
                                    @foreach ($packages as $index => $item)
                                        <div class="col-lg-3 col-6 text-center ">
                                            <div class="card mb-4 rounded-3 shadow-sm card-primary">
                                                <div class="card-header py-3">
                                                    <h4 class="my-0 fw-normal">
                                                        @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                            {{ $item->nameAr }}
                                                        @else
                                                            {{ $item->nameEn }}
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <h1 class=" pricing-card-title">
                                                        <div class="annual" id="annual{{ $index }}">
                                                            {{ $item->pricemounth - $item->pricemounth * ($item->discount / 100) }}
                                                            {{ trans('Packages.Rial') }}
                                                            <small>{{ trans('Packages.Monthly') }}</small>
                                                        </div>
                                                        <div class="Monthly" id="Monthly{{ $index }}"
                                                            style="display:none">
                                                            {{ $item->pricemounth }} {{ trans('Packages.Rial') }}
                                                            <small>{{ trans('Packages.Monthly') }}</small>
                                                        </div>
                                                    </h1>
                                                    <ul class="list-group mt-3 mb-4" id="Unitelist{{ $index }}"
                                                        style="font-size: 23px; display:none">
                                                    </ul>
                                                    <button type="button" onclick="displaylist({{ $index }})"
                                                        class="w-100 btn mb-2 btn-lg btn-outline-primary">
                                                        {{ trans('Packages.details') }} </button>
                                                    <button type="button" class="w-100 btn btn-lg btn-outline-primary">
                                                        {{ trans('Packages.Subscription') }} </button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-3 col-6">

                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <h4>
                                                        @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                            {{ $item->nameAr }}
                                                        @else
                                                            {{ $item->nameEn }}
                                                        @endif
                                                    </h4>

                                                    <p> {{ $item->price }}
                                                        {{ trans('Packages.Rial') }} </p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-bag"></i>
                                                </div>

                                                <a class="small-box-footer"> {{ trans('Packages.details') }} <i
                                                        class="fas fa-arrow-circle-left"></i></a>

                                            </div>
                                        </div> --}}
                                    @endforeach
                                @endif




                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- /.card -->
                    </div>
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> {{ trans('Packages.Extras') }} </h3>
                                <a onclick="paymentExtras()" class="btn btn-info btnAddsys"><i class="fa fa-plus"></i>
                                    {{ trans('Packages.Subscription') }} </a>
                            </div>
                            <div class="card-body">


                                <input type="hidden" id="total" value="0">
                                <hr>
                                <div class="row mt-2">
                                    @if (count($subs) > 0)
                                        @foreach ($subs as $index => $item)
                                            <div class="col-md-3" onclick="clickfunitems({{ $index }})">
                                                <!-- Widget: user widget style 1 -->
                                                <div class="card card-widget widget-user">
                                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                                    <div class="widget-user-header text-white"
                                                        style="background: url('https://admin.evix.com.sa/dist/img/package/{{ $item->img }}') center center; height: 120px;width:250px; object-fit: cover;object-position: 15% 100%;     background-repeat: no-repeat; background-size: cover; background-attachment: local;">
                                                    </div>
                                                    <div
                                                        class="card-body border-right text-center widget-user widget-user-username ">
                                                        @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                            {{ $item->nameAr }}
                                                        @else
                                                            {{ $item->nameEn }}
                                                        @endif

                                                    </div>

                                                    <div class="card-footer">
                                                        <input type="hidden" value="0"
                                                            id="chackitme{{ $index }}"
                                                            name="chackitme{{ $index }}">
                                                        <input type="hidden"
                                                            value="{{ $item->price - $item->price * ($item->descount / 100) }}"
                                                            id="price{{ $index }}" name="price{{ $index }}">
                                                        <div class="row">
                                                            <div class="col-sm-4 border-right">
                                                                <div class="description-block">
                                                                    <span
                                                                        class="description-text">{{ trans('Packages.price') }}
                                                                    </span>
                                                                    <h5 class="description-header"
                                                                        style="text-decoration: line-through;">
                                                                        {{ $item->price }} {{ trans('Packages.Rial') }}
                                                                    </h5>

                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-sm-4 border-right">
                                                                <div class="description-block">
                                                                    <span
                                                                        class="description-text">{{ trans('Packages.decount') }}
                                                                    </span>
                                                                    <h5 class="description-header">
                                                                        {{ $item->price - $item->price * ($item->descount / 100) }}
                                                                        {{ trans('Packages.Rial') }} </h5>

                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-sm-4  border-right">
                                                                <div class="description-block">
                                                                    <i class="fa  fa-cart-arrow-down fa-2x"
                                                                        id="iconchechitems{{ $index }}"
                                                                        aria-hidden="true"></i>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                </div>
                                                <!-- /.widget-user -->
                                            </div>
                                        @endforeach
                                    @endif


                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>

                    {{-- <img src="https://admin.evix.com.sa/dist/img/package/عرض_سعر_1715605361.PNG" alt=""> --}}
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
    </section>


    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{asset('payment/paylink.src.js')}}"></script>
    <script src="https://paylink.sa/assets/js/paylink.js"></script>

    <script>
            let payment = new PaylinkPayments({mode: 'test', defaultLang: 'ar', backgroundColor: '#EEE'});
          //  let payment = new PaylinkPayments({mode: 'test', supportedCards: [CardBrand.MADA]});
        function paymentExtras() {

            total = $('#total').val();

            let order = new Order({
            callBackUrl: 'https://evix.com.sa/ar/packages', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
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


        }
    </script>
    <script>
        function displaylist(id) {
            $('#Unitelist' + id).show();
        }

        function clickfunitems(id) {

            if ($('#chackitme' + id).val() == 0) {
                $('#chackitme' + id).val(1);
                $('#iconchechitems' + id).css('color', '#35d5b6');
                total = parseFloat($('#total').val()) + parseFloat($('#price' + id).val());
                $('#total').val(total);

            } else {

                $('#chackitme' + id).val(0);
                $('#iconchechitems' + id).css('color', 'black');
                total = parseFloat($('#total').val()) - parseFloat($('#price' + id).val());
                $('#total').val(total);

            }

        }
        $(document).ready(function() {
            @if (count($packages) > 0)
                @foreach ($packages as $index => $item)
                    $.ajax({
                        url: '/packagesitems/{{ $item->id }}',
                        type: 'get',
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {

                            console.log(response);

                            response.package.forEach(element => {
                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                    $('#Unitelist{{ $index }}').append(
                                        ' <li  class="list-group-item">' +
                                        element[0] + '</li>');
                                @else
                                    $('#Unitelist{{ $index }}').append(
                                        '<li  class="list-group-item">' +
                                        element[1] + '</li> ');
                                @endif
                            });


                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            // Handle error
                        }
                    });
                @endforeach
            @endif



            $('input[name="myRadio"]').change(function() {
                // Code to execute when a radio button is checked
                var selectedValue = $(this).val();
                if ($(this).val() == 0) {


                    @if (count($packages) > 0)
                        @foreach ($packages as $index => $item)
                            $('#annual{{ $index }}').show();
                            $('#Monthly{{ $index }}').hide();
                        @endforeach
                    @endif

                } else {

                    @if (count($packages) > 0)
                        @foreach ($packages as $index => $item)
                            $('#annual{{ $index }}').hide();
                            $('#Monthly{{ $index }}').show();
                        @endforeach
                    @endif
                }

                // You can add any code you want to execute here
            });
        });
    </script>
@endsection
