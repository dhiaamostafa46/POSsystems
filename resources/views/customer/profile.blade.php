@extends('layouts.eCommerceMasterPage')

@section('content')


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        a {
            text-decoration: none;
        }

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
    </style>


    <section class="product spad">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success" id="message">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-3">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list"
                            href="#list-home" role="tab" aria-controls="list-home"> إعدادات الحساب </a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list"
                            href="#list-profile" role="tab" aria-controls="list-profile"> قائمة المشتريات </a>
                        @if ($Online->activity == 2)
                            <a class="list-group-item list-group-item-action" id="list-table-list" data-bs-toggle="list"
                                href="#list-table" role="tab" aria-controls="list-table"> حجز الطاولات </a>
                        @endif
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list"
                            href="#list-settings" role="tab" aria-controls="list-settings"> تغير كلمة المرور </a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                            aria-labelledby="list-home-list">

                            <form class="row g-3" method="POST" action="{{ route('SaveCustomerShop') }}">
                                @csrf
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">الاسم :</label>
                                    <input type="name" class="form-control" id="inputEmail4" name="name"
                                        value="{{ auth()->guard('Shop')->user()->name }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputPassword4" class="form-label"> البريد الالكتروني :</label>
                                    <input type="email" class="form-control" id="inputPassword4" name="email"
                                        value="{{ auth()->guard('Shop')->user()->email }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label"> الجوال :</label>
                                    <input type="phone" class="form-control" id="inputAddress" name="phone"
                                        value="{{ auth()->guard('Shop')->user()->phone }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label"> الدولة :</label>
                                    <input type="text" class="form-control" id="inputAddress2" name="country"
                                        value="{{ auth()->guard('Shop')->user()->area }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputCity" class="form-label"> المدينة : </label>
                                    <input type="text" class="form-control" id="inputCity" name="city"
                                        value="{{ auth()->guard('Shop')->user()->city }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputCity" class="form-label"> العنوان : </label>
                                    <input type="text" class="form-control" id="inputCity" name="address"
                                        value="{{ auth()->guard('Shop')->user()->addressAr }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputCity" class="form-label"> رابط map : </label>
                                    <input type="text" class="form-control" id="inputCity" name="addresslink"
                                        value="{{ auth()->guard('Shop')->user()->addressEn }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputCity" class="form-label"> </label>
                                    <button type="submit" class=" form-control btn "
                                        style="   background-color: #00d798">
                                        حفظ </button>
                                </div>

                            </form>

                        </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel"
                            aria-labelledby="list-profile-list">
                            <table class="table table-striped table-hover table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">القيمة </th>
                                        <th scope="col">التاريخ </th>
                                        <th scope="col">الحالة </th>
                                        <th scope="col">خيارات </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Order as $item)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $item->totalwvat }} ريال</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    قيد الانتظار
                                                @elseif ($item->status == 2)
                                                    تحت التجهيز
                                                @elseif ($item->status == 3)
                                                    قيد التوصيل
                                                @elseif ($item->status == 4)
                                                    مكتمل
                                                @elseif ($item->status == 5)
                                                    ملغي
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('ShowTemporderOrder', $item->id) }}" class="btn "
                                                    style="background-color: #00d798"> عرض
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="list-table" role="tabpanel" aria-labelledby="list-table-list">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary mb-3" style="   background-color: #00d798"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                حجز طاولة
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"> حجز طاولة </h1>

                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="POST" action="{{ route('savebooktable') }}">
                                                @csrf
                                                <div class="col-12">
                                                    <label for="inputEmail4" class="form-label"> إختار الفرع :</label>

                                                    <select class="form-control" name="branch" id="branches"
                                                        onchange="branchesslected(this)">
                                                        @foreach ($Online->branches as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nameAr }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputPassword4" class="form-label"> إختار الطاولة
                                                        :</label>

                                                    <select class="form-control" name="table" id="table">
                                                        @foreach ($Online->branches[0]->table as $item)
                                                            <option value="{{ $item->id }}" data-price="{{$item->amount }}">{{ $item->tableNo }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputPassword4" class="form-label"> الوقت :</label>
                                                    <input type="time" class="form-control" id="time"
                                                        name="time">
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputPassword4" class="form-label"> اليوم :</label>
                                                    <input type="date" class="form-control" id="day"
                                                        name="day">
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputPassword4" class="form-label"> عدد الاشخاص :</label>
                                                    <input type="number" class="form-control" id="countperson"
                                                        name="countperson">
                                                </div>

                                                <div class="col-12">

                                                    <button type="submit" class="  btn "
                                                        style="   background-color: #00d798"> حفظ </button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">إغلاق</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-hover table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">الفرع </th>
                                        <th scope="col">الطاولة </th>
                                        <th scope="col">الوقت </th>
                                        <th scope="col">تاريخ </th>
                                        <th scope="col">عدد الاشخاص </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($table) > 0)
                                        @foreach ($table as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $item->branch->nameAr ?? '' }} </td>
                                                <td>{{ $item->tableGrd->tableNo ?? '' }}</td>
                                                <td>{{ $item->time }}</td>
                                                <td>{{ $item->day }}</td>
                                                <td>{{ $item->count }}</td>

                                            </tr>
                                        @endforeach
                                    @endif


                                </tbody>
                            </table>




                        </div>

                        <div class="tab-pane fade" id="list-settings" role="tabpanel"
                            aria-labelledby="list-settings-list">

                            <form class="row g-3" method="POST" action="{{ route('SavePasswordShop') }}">
                                @csrf
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">كلمة المرور القديمة :</label>
                                    <input type="password" class="form-control" id="inputEmail4" name="passwordold">
                                </div>
                                <div class="col-12">
                                    <label for="inputPassword4" class="form-label"> كلمة المرور الجديده :</label>
                                    <input type="password" class="form-control" id="inputPassword4" name="passwordnew">
                                </div>

                                <div class="col-12">
                                    <label for="inputCity" class="form-label"> </label>
                                    <button type="submit" class=" form-control btn "
                                        style="   background-color: #00d798"> حفظ </button>
                                </div>
                            </form>



                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function branchesslected(org) {


        }

        $(document).ready(function() {
            // Attach change event handler to the select element
            $('#table').change(function() {
                // Get the selected option
                var selectedOption = $(this).find('option:selected');

                // Get the data-price attribute value
                var price = selectedOption.data('price');

                // Log the price to the console (or you can do anything else with it)
                console.log('Selected option price:', price);
            });
        });
    </script>
    <script>
        // Show the message when the page loads
        window.onload = function() {
            document.getElementById('message').style.display = 'block';

            // Hide the message after 100 seconds
            setTimeout(function() {
                document.getElementById('message').style.display = 'none';
            }, 100000); // 100 seconds = 100000 milliseconds
        };
    </script>
    <input type="hidden" value="{{ $orgID }}" id="orgID">
    <!-- Checkout Section End -->

    <script src="{{ asset('payment/paylink.src.js') }}"></script>


@endsection
