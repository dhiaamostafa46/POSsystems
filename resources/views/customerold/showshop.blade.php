@extends('layouts.eCommerceMasterPage')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        .list-group-item {
            padding: 25px;
            /* border: none; */
            font-size: 20px;
            font-weight: bold;
        }

        .list-group-item.active {
            background-color: #00d798;
            border-color: #00d798;
        }

        .form-label {
            font-size: 20px;
            font-weight: bold;
        }

        * {
            font-weight: bold;
        }
    </style>
    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        <style>
            .spancreatdata {
                float: left;
            }
            .datacompny{
                text-align: left
            }
        </style>
    @else
        <style>
            .spancreatdata {
                float: right;
            }
            .datacompny{
                text-align: right
            }
        </style>
    @endif
    <section class="product spad">
        <div class="container">
            <div class="alert alert-success" role="alert">
                رقم الطلب : {{ $order->id }}
                <span class="spancreatdata"> {{ $order->created_at }} </span>
            </div>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col"> اسم العميل : {{ $order->VirtualCustomer->name ?? '' }} </th>
                        <th scope="col " class="datacompny" style=""> اسم الشركة : {{ $order->Organization->nameAr ?? '' }}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col"> رقم جوال العميل : {{ $order->VirtualCustomer->phone ?? '' }} </th>
                        <th scope="col "class="datacompny" > الرقم الضريبي الشركة :
                            {{ $order->Organization->vatNo ?? '' }} </th>

                    </tr>
                    <tr>
                        <th scope="col"> العنوان : {{ $order->VirtualCustomer->city ?? '' }}
                            ,{{ $order->VirtualCustomer->addressAr ?? '' }} </th>
                        <th scope="col "  class="datacompny"> </th>

                    </tr>
                </thead>

            </table>
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم المنتج </th>
                        <th scope="col"> الكمية </th>
                        <th scope="col">السعر</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($order->orderdetails) > 0)
                        @foreach ($order->orderdetails as $index => $item)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $item->productName }}</td>
                                <td>{{ $item->quantity }} </td>
                                <td>{{ $item->total }} ريال </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="row">
                <div class="col-lg-6 col-md-12">

                </div>
                <div class="col-lg-6 col-md-12">
                    <table class="table table-bordered  text-center">
                        <thead>
                            <tr>
                                <th scope="col"> الاجمالي</th>
                                <th scope="col">{{ $order->totalwvat }} ريال </th>
                            </tr>
                            <tr>
                                <th scope="col"> ضريبة القيمة المضافة </th>
                                <th scope="col">{{ $order->totalvat }} ريال</th>
                            </tr>
                            <tr>
                                <th scope="col"> الاجمالى شامل الضريبة </th>
                                <th scope="col">{{ $order->totalvat + $order->totalwvat }} ريال</th>
                            </tr>
                        </thead>

                    </table>

                </div>
            </div>


        </div>
    </section>
@endsection
