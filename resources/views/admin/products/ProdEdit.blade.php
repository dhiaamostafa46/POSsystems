@extends('layouts.dashboard')

@section('content')
<style>
    .actices {
        color: #fff;
        background-color: #35d5b6;
        border-color: #35d5b6;
        box-shadow: none;
    }
</style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('Products.ListProducts') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#"> {{ trans('Products.Products') }} </a></li>
                        <li class="breadcrumb-item active"> {{ trans('Products.ListProducts') }} </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <form class="user" method="POST" action="{{ route('products.UpdateProdect', $product->id) }}"
                enctype = "multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $countUnit }}" name="countUnit">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> {{ trans('Products.Editanewproduct') }} </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">

                                            <label class="form-control-label" for="input-username">
                                                {{ trans('Products.ProductType') }} :
                                                <span
                                                    style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;"></span>
                                            </label>
                                            <input type="hidden" name="TypePrdectAll" id="TypePrdectAll" value="{{$product->TypeProdect}}">
                                            <a class="btn  @if ($product->TypeProdect ==1)actices @endif " id="typeprodect1" onclick="typeprodectSelect(1)">
                                                {{ trans('Products.Sales') }} </a>
                                            <a class="btn  @if ($product->TypeProdect ==2)actices @endif" id="typeprodect2" onclick="typeprodectSelect(2)">
                                                {{ trans('Products.purchases') }} </a>
                                            <a class="btn  @if ($product->TypeProdect ==3)actices @endif" id="typeprodect3" onclick="typeprodectSelect(3)">
                                                {{ trans('Products.Manufactur') }} </a>

                                            {{-- <input type="text" class="form-control" id="nameAr" name="nameAr" value="{{ old('nameAr') }}" > --}}

                                        </div>
                                    </div>
                                    <div class="col-lg-6 CodeProdectAll">
                                        <div class="form-group">
                                            <label class="form-control-label prodDet" for="input-username">
                                                {{ trans('Products.Productcode') }} </label>
                                            <input type="text"
                                                class="form-control prodDet @error('barcode') is-invalid @enderror"
                                                id="barcode" name="barcode"
                                                placeholder="  {{ trans('Products.Productcode') }}  "
                                                value="{{ $product->barcode }}">
                                            @error('barcode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('Products.ProductName-Arabic') }} <span
                                                    style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*
                                                    </spa></label>
                                            <input type="text" class="form-control @error('nameAr') is-invalid @enderror"
                                                id="nameAr" name="nameAr" value="{{ $product->nameAr }}"
                                                placeholder="{{ trans('Products.ProductName-Arabic') }}  ">
                                            @error('nameAr')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('Products.ProductName-Einglsh') }} </label>
                                            <input type="text" class="form-control @error('nameEn') is-invalid @enderror"
                                                id="nameEn" value="{{ $product->nameEn }}"
                                                onkeypress="return ValidateKey();" name="nameEn"
                                                placeholder="   {{ trans('products.ProductName-Einglsh') }}"
                                                value="{{ old('nameEn') }}">
                                            @error('nameEn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('Products.Productsection') }} </label>
                                            <select class="form-control  select2 @error('categoryID') is-invalid @enderror"
                                                id="categoryID" name="categoryID" onchange="route(this)">
                                                <option value=""> {{ trans('Products.ChooseSection') }}</option>
                                                @foreach (auth()->user()->organization->prodcategories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        @if ($product->categoryID == $cat->id) @selected(true) @endif>
                                                        @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                            {{ $cat->nameAr }}
                                                        @else
                                                            {{ $cat->nameEn }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('categoryID')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('Products.Purchasingprice') }}</label>
                                            <input type="number"
                                                class="form-control prodcostprice @error('costPrice') is-invalid  @enderror"
                                                id="costPrice" name="costPrice" 
                                                placeholder="   {{ trans('Products.Purchasingprice') }}"
                                                value="{{ $product->costPrice }}" step="any">
                                            @error('costPrice')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 ProdectPriceAllItems">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('Products.sellingprice') }} <span
                                                    style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span></label>
                                            <input type="number" step='any'
                                                class="form-control @error('prodPrice') is-invalid @enderror"
                                                id="prodPrice" name="prodPrice"  step='any'
                                                placeholder="   {{ trans('Products.sellingprice') }}"
                                                value="{{ $product->prodPrice }}">
                                            @error('prodPrice')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2" style="display: none">
                                        <div class="form-group">
                                            <label class="form-control-label" for="vatQuest">
                                                {{ trans('Products.Doespriceincludetax') }} </label>
                                            <h6>
                                                <input type="checkbox" id="vatQuest" name="vatQuest" value="1"
                                                    @if ($product->vatQuest == 1) @checked(true) @endif>
                                                <label for="vatQuest"> &nbsp;&nbsp; {{ trans('Products.yes') }} </label>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="input-username">{{ trans('Products.Tax') }} %</label>
                                            <select class="form-control @error('vat') is-invalid @enderror" id="vat"
                                                name="vat">
                                                <option value="15"
                                                    @if ($product->vat == 15) @selected(true) @endif>
                                                    15%</option>
                                                <option value="0"
                                                    @if ($product->vat == 0) @selected(true) @endif>
                                                    0%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 UniteAllItems" id="orgUnit">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('Products.Unit') }} <span
                                                    style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span></label>
                                            <select class="form-control @error('unitID') is-invalid @enderror"
                                                id="unitID" name="unitID" onchange="route2(this)" required>
                                                <option value=""> {{ trans('Products.Chooseunit') }} </option>
                                                @foreach (auth()->user()->organization->units as $unit)
                                                    <option value="{{ $unit->id }}::{{ $unit->nameAr }}"
                                                        @if ($product->unitID == $unit->id) @selected(true) @endif>
                                                        @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                            {{ $unit->nameAr }}
                                                        @else
                                                            {{ $unit->nameEn }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">
                                                {{ trans('Products.Productimage') }} </label>
                                            <input type="file" class="form-control" name="img" id="img"
                                                value="{{ old('img') }}">
                                            @error('img')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title"> {{ trans('Products.Measurementunits') }} </h3>
                                            </div>
                                            <div class="card-body">
                                                <input type="hidden" id="countunitOld" name="countunitOld"
                                                    value="{{ count($prdUnits) }}">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ trans('Products.Productimage') }}</th>
                                                            <th> {{ trans('Products.Conversionfactor') }} </th>
                                                            <th> {{ trans('Products.Unitcost') }} </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $count = 0; ?>
                                                        @foreach ($prdUnits as $uitem)
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        class="form-control  select2 @error('categoryID') is-invalid @enderror"
                                                                        id="prunit" name="prunit{{ $count }}"
                                                                        onchange="route(this)"
                                                                        @if ($count == 0) @readonly(true) @endif>
                                                                        <option value="">
                                                                            {{ trans('Products.Chooseunit') }} </option>
                                                                        @foreach (auth()->user()->organization->units as $unit)
                                                                            <option
                                                                                value="{{ $unit->id }}::{{ $unit->nameAr }}"
                                                                                @if ($uitem->unitID == $unit->id) selected @endif>
                                                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                                                    {{ $unit->nameAr }}
                                                                                @else
                                                                                    {{ $unit->nameEn }}
                                                                                @endif
                                                                            </option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        name="uitQuantity{{ $count }}"
                                                                        id="uitQuantity{{ $count }}"
                                                                        class="form-control"
                                                                        value="{{ $uitem->quantity }}"
                                                                        @if ($count == 0) @readonly(true) @endif>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        name="pprice{{ $count }}"
                                                                        id="pprice{{ $count }}"
                                                                        class="form-control" value="{{ $uitem->price }}"
                                                                        @if ($count == 0) @readonly(true) @endif>
                                                                </td>
                                                            </tr>
                                                            <?php $count++; ?>
                                                        @endforeach
                                                        @if (count($prdUnits) == 1)
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        class="form-control  select2 @error('categoryID') is-invalid @enderror"
                                                                        id="prunit" name="prunit1"
                                                                        onchange="route(this)">
                                                                        <option value="">
                                                                            {{ trans('Products.Chooseunit') }} </option>
                                                                        @foreach (auth()->user()->organization->units as $unit)
                                                                            <option
                                                                                value="{{ $unit->id }}::{{ $unit->nameAr }}">
                                                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                                                    {{ $unit->nameAr }}
                                                                                @else
                                                                                    {{ $unit->nameEn }}
                                                                                @endif
                                                                            </option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="uitQuantity1"
                                                                        id="uitQuantity1" class="form-control">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="pprice1" id="pprice1"
                                                                        class="form-control">
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        @if (count($prdUnits) == 2 || count($prdUnits) == 1)
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        class="form-control  select2 @error('categoryID') is-invalid @enderror"
                                                                        id="prunit" name="prunit2"
                                                                        onchange="route(this)">
                                                                        <option value="">
                                                                            {{ trans('Products.Chooseunit') }} </option>
                                                                        @foreach (auth()->user()->organization->units as $unit)
                                                                            <option
                                                                                value="{{ $unit->id }}::{{ $unit->nameAr }}">
                                                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                                                    {{ $unit->nameAr }}
                                                                                @else
                                                                                    {{ $unit->nameEn }}
                                                                                @endif
                                                                            </option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="uitQuantity2"
                                                                        id="uitQuantity2" class="form-control">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="pprice2" id="pprice2"
                                                                        class="form-control">
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <div class="col-lg-10">
                                                <input type="submit" class="btn btn-primary" id="save"
                                                    value="{{ trans('Products.save') }}" style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">

                    </div>
                </div>
            </form>
        </div>
    </section>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        function typeprodectSelect(num){
            $('#typeprodect1').removeClass('actices');
            $('#typeprodect2').removeClass('actices');
            $('#typeprodect3').removeClass('actices');
            $('#typeprodect'+num).addClass('actices');

            $('#TypePrdectAll').val(num);

        }
    </script>

    <script>
        $(document).ready(function() {

            $('#vatQuest').change(function() {
                var chk = $(this).val();

                if (chk == 1) {
                    $(this).val('0');
                } else {
                    $(this).val('1');
                }

            });

            //alert(document.getElementById('oldtypeval').value);
            var prodval = document.getElementById('oldtypeval').value;
            var saleable = document.getElementById('oldsaleable').value;

            if (prodval == 1) {
                handleChange1(prodval);
            } else if (prodval == 2) {

                handleChange2(prodval);
                if (saleable == 1) {

                    issalable();
                } else {
                    isnotsalable();
                }
            } else if (prodval == 3) {
                handleChange3(prodval);
            } else if (prodval != 3) {
                handleChange1(prodval);
                document.getElementById('TypeProdect').checked = true;
            }
        });

        function handleChange1(val) {


            document.getElementById('save').disabled = false;
            $('.CodeProdectAll').hide();
            $('.PrintALlitems').hide();
            $('.PrisentAllItems').hide();
            $('.UniteAllItems').show();
            $('.prodDet').show();



            $('.prodcostprice').hide();
            $('#catTasnee').hide();
            $('#purQuest').hide();
            $('.CaloriesAllitems').show();
            $('.KitChenAllItewms').show();
            $('.ProdectPriceAllItems').show();
            $('#prodPrice').val('');

            data = "";
            @foreach (auth()->user()->organization->prodcategoriesKatcSaller as $product)
                data = data + '<option value="{{ $product->id }}">{{ $product->nameAr }}</option>';
            @endforeach

            $('.CategouryAllitemsKat').empty();

            $('.CategouryAllitemsKat').append(data);
        }

        function handleChange2(val) {
            document.getElementById('save').disabled = false;
            $('.CodeProdectAll').show();
            $('.PrintALlitems').show();
            $('.PrisentAllItems').show();
            $('.UniteAllItems').show();
            $('.ProdectPriceAllItems').hide();



            $('.prodcostprice').show();
            $('#catTasnee').hide();
            $('#purQuest').show();
            $('.CaloriesAllitems').hide();
            $('.KitChenAllItewms').hide();

            $('#prodPrice').val('0');
            $('.prodDet').hide();
            data = "";
            @foreach (auth()->user()->organization->prodcategoriesKatPuches as $product)
                data = data + '<option value="{{ $product->id }}">{{ $product->nameAr }}</option>';
            @endforeach

            $('.CategouryAllitemsKat').empty();

            $('.CategouryAllitemsKat').append(data);


        }

        function handleChange3(val) {
            document.getElementById('save').disabled = false;
            $('.CodeProdectAll').show();
            $('.PrintALlitems').show();
            $('.PrisentAllItems').show();
            $('.UniteAllItems').show();
            $('#catTasnee').show();


            $('#fscat').hide();
            $('.prodDet').hide();
            $('#purQuest').hide();
            $('.CaloriesAllitems').hide();
            $('.KitChenAllItewms').hide();
            $('.ProdectPriceAllItems').hide();
            $('#prodPrice').val('0');
            data = "";
            @foreach (auth()->user()->organization->prodcategoriesKatPuches as $product)
                data = data + '<option value="{{ $product->id }}">{{ $product->nameAr }}</option>';
            @endforeach

            $('.CategouryAllitemsKat').empty();

            $('.CategouryAllitemsKat').append(data);


        }
    </script>


    <script>
        function availableT() {
            if (document.getElementById('availableTime').checked == true) {
                document.getElementById('sfrom').style.display = "block";
                document.getElementById('sto').style.display = "block";
            } else {
                document.getElementById('sfrom').style.display = "none";
                document.getElementById('sto').style.display = "none";
            }
        }

        //   function route(obj){
        //     if(obj.value == -1)
        //     {
        //       window.location.href = "/prodcategories/create"
        //     };
        //   }

        function route2(obj) {

            if (obj.value == -1) {
                window.location.href = "/units/create"
            };
            document.getElementById('prunit').value = obj.value;
        }

        // function route2(obj){


        //   data=obj.value;
        //   text=data.split('::');
        //     if(obj.value == -1)
        //     {
        //       window.location.href = "/units/create"
        //     };
        //     alert
        //   document.getElementById('prunit').value =text[0];
        //   }

        // function setUnits(obj){
        //    alert();
        //    document.getElementById('prunit').value = =obj.value;
        //   }


        function issalable() {
            $('#catSale').show();
            $('.ProdectPriceAllItems').show();
            $('.KitChenAllItewms').show();
        }

        function isnotsalable() {
            $('#catSale').hide();
            $('.ProdectPriceAllItems').hide();
            $('.KitChenAllItewms').hide();
        }



        $('#costPrice').change(function() {



            document.getElementById('pprice0').value = document.getElementById('costPrice').value;
        });
        $('#uitQuantity1').change(function() {

            var price = Number(document.getElementById('pprice0').value);
            var qun = Number(document.getElementById('uitQuantity1').value);
            var cost = Number(document.getElementById('costPrice').value);

            var total = price / qun;
            //alert(total);
            // document.getElementById('pprice1').value = Math.round(total * cost);
            document.getElementById('pprice1').value = total.toFixed(3);
        });
        $('#prodPrice').change(function() {
            var cehk = document.getElementById('saleable').value;
            var cehk2 = document.getElementById('TypeProdect').value;

            //alert(cehk2);
            if ((cehk != 1) && (cehk2 != 2)) {

                document.getElementById('pprice0').value = document.getElementById('prodPrice').value;
            }
            if (cehk2 == 1) {
                document.getElementById('pprice0').value = document.getElementById('prodPrice').value;
            }
        });
        $('#uitQuantity1').change(function() {

            var price = Number(document.getElementById('pprice0').value);
            var qun = Number(document.getElementById('uitQuantity1').value);
            var cost = Number(document.getElementById('costPrice').value);

            var total = price / qun;
            //alert(total);
            // document.getElementById('pprice1').value = Math.round(total * cost);
            document.getElementById('pprice1').value = total.toFixed(3);
        });
        $('#uitQuantity2').change(function() {

            var price = Number(document.getElementById('pprice1').value);
            var qun = Number(document.getElementById('uitQuantity2').value);
            var cost = Number(document.getElementById('costPrice').value);

            var total = price / qun;

            //Math.round(total * cost);
            // document.getElementById('pprice2').value =Math.round(total * cost)
            document.getElementById('pprice2').value = total.toFixed(3);
        });


        $('#vatQuest').click(function() {

            var price = Number(document.getElementById('pprice1').value);
            var qun = Number(document.getElementById('uitQuantity2').value);
            var cost = Number(document.getElementById('costPrice').value);

        });
    </script>
@endsection
<script>
    $(":input").keypress(function(event) {
        if (event.which == '10' || event.which == '13') {
            event.preventDefault();
        }
    });
</script>
