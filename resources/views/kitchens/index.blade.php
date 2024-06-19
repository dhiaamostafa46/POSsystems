@extends('layouts.kitchenMasterPage')
<style>
    .no-js .owl-carousel, .owl-carousel.owl-loaded{
        display: contents !important;
    }
    .border-right-solid{
        border-right: 5px solid;
    }
    .nav-item {
        font-size: 20px;
        font-weight: bold;
    }




</style>


@if (LaravelLocalization::getCurrentLocaleDirection() =="rtl")
<style>
.latest-product__item__text{
    float: right;
    padding: 30px;
}
</style>
@else
<style>
.latest-product__item__text{
    float: left;
    padding: 30px;
}
</style>
@endif
@section('content')

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">

    </div>
</section>
<!-- Hero Section End -->



    <!-- Featured Section Begin -->
    <section style="background-color:#00d798" dir="{{LaravelLocalization::getCurrentLocaleDirection()}}">
        <div class="col-11 shadow" style="padding: 20px;height:100%;background-color:#fff;margin-top:0px;padding-top:20px;margin:auto">
            <div class="row col-12">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>مطبخ {{$kitchen->nameAr}}</h2>
                    </div>

                    <div class="featured__controls">
                        <nav>
                            <div class="nav nav-tabs justify-content-center " id="nav-tab" role="tablist">
                              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"> اصناف قيد الانتظار</a>
                              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"> اصناف مكتملة</a>

                            </div>
                          </nav>
                          <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="row" id="processUnderDone" style="padding:15px">
                                    @if(count($doneitems) > 0)
                                        @foreach ($doneitems as $item)

                                        <a href="#" onclick="itemDoneReturn('{{$item->id}}');" class="latest-product__item shadow-sm rounded-lg border-right-solid border-success col-3" style="margin:10px">
                                            <div class="latest-product__item__text">
                                                <h6>{{ \Illuminate\Support\Str::limit($item->productName, 60, $end='...') }}</h6>
                                                <span style="display:inline-block">الكمية {{$item->quantity}}x</span>
                                                <span style="font-size:small;margin:5px">#{{$item->id}}#</span>
                                            </div>
                                        </a>
                                        @endforeach
                                    @else
                                        <h6>لا يوجد أصناف</h6>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="row" id="processUnder" >
                                    @if(count($items) > 0)
                                        @foreach ($items as $item)
                                        <a href="#" class="shadow-sm rounded-lg border-right-solid border-danger col-3" onclick="itemDone('{{$item->id}}');" style="margin:10px">
                                            <div class="latest-product__item__text">
                                                <h6>{{ \Illuminate\Support\Str::limit($item->productName, 60, $end='...') }}</h6>
                                                <span style="display:inline-block">الكمية {{$item->quantity}}x</span>
                                                <span style="font-size:small;margin:5px">#{{$item->id}}#</span>
                                            </div>
                                        </a>
                                        @endforeach
                                    @else
                                    <h6>لا يوجد أصناف</h6>
                                    @endif
                                </div>
                            </div>
                          </div>

                        {{-- <ul class="nav justify-content-center nav-tabs"  style="    font-size: 20px;">
                              <a class=" nav-item nav-link active"  data-filter=".wait">اصناف قيد الانتظار</a>
                              <a class="nav-item nav-link" data-filter=".done"> اصناف مكتملة</a>
                        </ul> --}}

                    </div>
                </div>
            </div>
            {{-- <div class="row featured__filter">
                <div class="col-lg-12 col-md-12 col-sm-12 mix done" style="display: none">
                    <div>
                        <div class="row" id="processUnderDone" style="direction: rtl;padding:15px">
                            @if(count($doneitems) > 0)
                                @foreach ($doneitems as $item)

                                <a href="#" onclick="itemDoneReturn('{{$item->id}}');" class="latest-product__item shadow-sm rounded-lg border-right-solid border-success col-3" style="margin-bottom:5px">
                                    <div class="latest-product__item__text">
                                        <h6>{{ \Illuminate\Support\Str::limit($item->productName, 60, $end='...') }}</h6>
                                        <span style="direction: rtl;display:inline-block">الكمية {{$item->quantity}}x</span>
                                        <span style="float: left;font-size:small;margin:5px">#{{$item->id}}#</span>
                                    </div>
                                </a>
                                @endforeach
                            @else
                                <h6>لا يوجد أصناف</h6>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mix wait">
                    <div>
                        <div class="row" id="processUnder" style="direction: rtl">
                            @if(count($items) > 0)
                                @foreach ($items as $item)
                                <a href="#" class="shadow-sm rounded-lg border-right-solid border-danger col-3" onclick="itemDone('{{$item->id}}');" style="margin-bottom:5px">
                                    <div class="latest-product__item__text">
                                        <h6>{{ \Illuminate\Support\Str::limit($item->productName, 60, $end='...') }}</h6>
                                        <span style="direction: rtl;display:inline-block">الكمية {{$item->quantity}}x</span>
                                        <span style="float: left;font-size:small;margin:5px">#{{$item->id}}#</span>
                                    </div>
                                </a>
                                @endforeach
                            @else
                            <h6>لا يوجد أصناف</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!-- Featured Section End -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        function itemDone(id){
            $.ajax({
            url: `/itemDone/${id}`,
            success: data => {
            $('#processUnder').empty()
            $('#processUnderDone').empty()
            data.items.forEach(item =>
                {
                    console.log(item)
                    $('#processUnder').append(`<a href="#" class="shadow-sm rounded-lg border-right-solid border-danger col-3" onclick="itemDone('${item.id}');">
                        <div class="latest-product__item__text">
                            <h6>${item.productName}</h6>
                            <span style="display:inline-block">الكمية ${item.quantity}x</span>
                            <span style="font-size:small;margin:5px">#${item.id}#</span>
                        </div>
                    </a>`)
                });

                data.items2.forEach(item2 =>
                {
                    $('#processUnderDone').append(`<a href="#" class="shadow-sm rounded-lg border-right-solid border-success col-3" onclick="itemDoneReturn('${item2.id}');">
                        <div class="latest-product__item__text">
                            <h6>${item2.productName}</h6>
                            <span style="display:inline-block">الكمية ${item2.quantity}x</span>
                            <span style="font-size:small;margin:5px">#${item2.id}#</span>
                        </div>
                    </a>`)
                });
            }});
        }
    </script>


@endsection

<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
    function itemDoneReturn(id){
        Swal.fire({
        title: 'هل انت متأكد من ارجاع الصنف لقائمة الانتظار؟',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#f8a29e',
        confirmButtonText: 'نعم، ارجاع',
        cancelButtonText: 'لا، الغاء'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: `/itemDone/${id}`,
            success: data => {
            $('#processUnder').empty()
            $('#processUnderDone').empty()
            data.items.forEach(item =>
                {
                    console.log(item)
                    $('#processUnder').append(`<a href="#" class="shadow-sm rounded-lg border-right-solid border-danger col-3" onclick="itemDone('${item.id}');">
                        <div class="latest-product__item__text">
                            <h6>${item.productName}</h6>
                            <span style="display:inline-block">الكمية ${item.quantity}x</span>
                            <span style="font-size:small;margin:5px">#${item.id}#</span>
                        </div>
                    </a>`)
                });

                data.items2.forEach(item2 =>
                {
                    $('#processUnderDone').append(`<a href="#" class="shadow-sm rounded-lg border-right-solid border-success col-3" onclick="itemDoneReturn('${item2.id}');">
                        <div class="latest-product__item__text">
                            <h6>${item2.productName}</h6>
                            <span style="display:inline-block">الكمية ${item2.quantity}x</span>
                            <span style="font-size:small;margin:5px">#${item2.id}#</span>
                        </div>
                    </a>`)
                });
            }});
        }
        })
        }

    function loaditems(){

        $.ajax({
            url: `/kitchen-items/{{$kitchen->id}}`,
            success: data => {
            console.log(data)
            $('#processUnder').empty()
            $('#processUnderDone').empty()
            data.items.forEach(item =>
                {
                    console.log(item)
                    $('#processUnder').append(`<a href="#" class="shadow-sm rounded-lg border-right-solid border-danger col-3" onclick="itemDone('${item.id}');">
                        <div class="latest-product__item__text">
                            <h6>${item.productName}</h6>
                            <span style="display:inline-block">الكمية ${item.quantity}x</span>
                            <span style="font-size:small;margin:5px">#${item.id}#</span>
                        </div>
                    </a>`)
                });

                data.items2.forEach(item2 =>
                {
                    $('#processUnderDone').append(`<a href="#" class="shadow-sm rounded-lg border-right-solid border-success col-3" onclick="itemDoneReturn('${item2.id}');">
                        <div class="latest-product__item__text">
                            <h6>${item2.productName}</h6>
                            <span style="display:inline-block">الكمية ${item2.quantity}x</span>
                            <span style="font-size:small;margin:5px">#${item2.id}#</span>
                        </div>
                    </a>`)
                });
            }});
        }

        setInterval(function(){
            loaditems() // this will run after every 5 seconds
            //alert('hello');
        }, 10000);
</script>
