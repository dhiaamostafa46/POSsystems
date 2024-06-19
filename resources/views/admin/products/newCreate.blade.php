@extends('layouts.dashboard')

@section('content')


    <div class="modal fade" id="CatguryModalProdect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ trans('Products.ADDprodcategories') }}</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">
                                    {{ trans('Products.ProductType') }} </label>
                                <select id="TypeProdect"class="form-control">
                                    <option value="1"> {{ trans('Products.Sales') }} </option>
                                    <option value="2"> {{ trans('Products.purchases') }} </option>
                                    <option value="3"> {{ trans('Products.Manufactur') }} </option>
                                </select>

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">
                                    {{ trans('Products.DepartmentName-Arabic') }} </label>
                                <input type="text" class="form-control" id="nameArprodcategories"
                                    placeholder="     {{ trans('Products.DepartmentName-Arabic') }} ">

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">
                                    {{ trans('Products.DepartmentName-English') }} </label>
                                <input type="text" class="form-control" id="nameEnprodcategories"
                                    onkeypress="return ValidateKey();"
                                    placeholder="     {{ trans('Products.DepartmentName-English') }} ">

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name"> {{ trans('Products.picture') }}
                                </label>
                                <input type="file" class="form-control" id="imgprodcategories">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">
                                    {{ trans('Products.Orderstore') }}
                                </label>
                                <input type="number" class="form-control" id="Sortprodcategories">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('Products.Close') }}</button>
                    <button type="button" id="SaveAlldataprodcategories" onclick="SaveAlldataprodcategories()"
                        class="btn btn-primary">{{ trans('Products.save') }}</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="KitchanModalProdect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ trans('Products.Allkitchens') }}</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">
                                    {{ trans('Products.CuisinenameArabic') }}</label>
                                <input type="text" class="form-control" id="nameArprodKitchan"
                                    placeholder="    {{ trans('Products.CuisinenameArabic') }} ">

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">
                                    {{ trans('Products.CuisinenameEnglish') }} </label>
                                <input type="text" class="form-control" id="nameEnprodKitchan"
                                    onkeypress="return ValidateKey();"
                                    placeholder="    {{ trans('Products.CuisinenameEnglish') }} ">

                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('Products.Close') }}</button>
                    <button type="button" id="SaveAlldataprodKitchan"
                        class="btn btn-primary">{{ trans('Products.save') }}</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Button trigger modal -->






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
            <div class="row">

                <input type="hidden" id="oldtypeval" value="{{ old('TypeProdect') }}">
                <input type="hidden" id="oldsaleable" value="{{ old('saleable') }}">
                <div class="col-md-12">




                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#sale" data-toggle="tab"
                                        id="saletab"> {{ trans('Products.Sales') }} </a></li>
                                <li class="nav-item"><a class="nav-link" href="#purchase" data-toggle="tab"
                                        id="purchasetab"> {{ trans('Products.purchases') }} </a></li>
                                <li class="nav-item"><a class="nav-link" href="#manufact" data-toggle="tab"
                                        id="manufacttab"> {{ trans('Products.Manufactur') }} </a></li>

                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="sale">
                                    <div class="row">

                                        <form action="{{ route('products.store') }}" method="post" class="col-lg-12"
                                            enctype = "multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="TypeProdect" id="TypeProdect" value="1">
                                            <h2> {{ trans('Products.basicinformation') }} :</h2>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.ProductName-Arabic') }} <span
                                                                class="requiredData">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('nameAr') is-invalid @enderror"
                                                            id="nameAr" name="nameAr" value="{{ old('nameAr') }}"
                                                            placeholder=" {{ trans('Products.ProductName-Arabic') }} ">
                                                        @error('nameAr')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.ProductName-Einglsh') }} <span
                                                                class="requiredData">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('nameEn') is-invalid @enderror"
                                                            id="nameEn" onkeypress="return ValidateKey();"
                                                            name="nameEn"
                                                            placeholder=" {{ trans('Products.ProductName-Einglsh') }} "
                                                            value="{{ old('nameEn') }}" required>
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
                                                            {{ trans('Products.CategorydetailsArabic') }}</label>
                                                        <textarea class="form-control @error('detailsAr') is-invalid @enderror" id="detailsAr" name="detailsAr"
                                                            placeholder="   {{ trans('Products.CategorydetailsArabic') }}">@if (old('detailsAr') != null){{ old('detailsAr') }}@endif </textarea>
                                                        @error('detailsAr')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 prodDet">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.CategorydetailsEinglsh') }}</label>
                                                        <textarea class="form-control @error('detailsEn') is-invalid @enderror" id="detailsEn" name="detailsEn"
                                                            placeholder="{{ trans('Products.CategorydetailsEinglsh') }}"> @if (old('detailsEn') != null){{ old('detailsEn') }}@endif</textarea>
                                                        @error('detailsEn')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 CaloriesAllitems">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.Calories') }}</label>
                                                        <input type="number"
                                                            class="form-control @error('calories') is-invalid @enderror"
                                                            id="calories" name="calories"
                                                            placeholder="   {{ trans('Products.Calories') }} "
                                                            value="{{ old('calories') }}">
                                                        @error('calories')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6" id="fscat">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.Sectiontheitemonthelist') }} <span
                                                                class="requiredData">*</span></label>
                                                        <select
                                                            class="form-control  select2 @error('categoryID') is-invalid @enderror"
                                                            id="categoryID" name="categoryID" onchange="route(this)"
                                                            required>
                                                            <option value=""></option>
                                                            @foreach (auth()->user()->organization->prodcategoriesKatcSaller as $cat)
                                                                <option value="{{ $cat->id }}"
                                                                    @if (old('categoryID') == $cat->id) @selected(true) @endif>
                                                                    {{ $cat->nameAr }}</option>
                                                            @endforeach
                                                            <option value="-1">اضافة قسم</option>
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
                                                            {{ trans('Products.kitchen') }} <span
                                                                class="requiredData">*</span></label>
                                                        <select
                                                            class="form-control @error('kitchenID') is-invalid @enderror"
                                                            id="kitchenID" name="kitchenID" onchange="route(this)"
                                                            required>
                                                            <option value=""> {{ trans('Products.ChooseKitchens') }}
                                                            </option>
                                                            @foreach (auth()->user()->organization->kitchens as $kit)
                                                                <option value="{{ $kit->id }}"
                                                                    @if (old('kitchenID') == $kit->id) @selected(true) @endif>
                                                                    {{ $kit->nameAr }}</option>
                                                            @endforeach
                                                            <option value="-1">اضافة مطبخ</option>
                                                        </select>
                                                        @error('kitchenID')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <hr>
                                            {{-- <h2>السعر   : </h2> --}}

                                            <div class="row">
                                                <div class="col-lg-6 ProdectPriceAllItems">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.sellingprice') }} : <span
                                                                class="requiredData">*</span></label>
                                                        <input type="number" step='any'
                                                            class="form-control @error('prodPrice') is-invalid @enderror"
                                                            id="prodPrice" name="prodPrice"
                                                            placeholder="   {{ trans('Products.sellingprice') }} "
                                                            value="{{ old('prodPrice') }}" required>
                                                        @error('prodPrice')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="vatQuest">
                                                            {{ trans('Products.Doespriceincludetax') }}</label>
                                                        <h6>
                                                            <input type="checkbox" id="vatQuest" name="vatQuest"
                                                                value="1" onclick="" checked>
                                                            <label for="vatQuest">
                                                                &nbsp;&nbsp;
                                                                {{ trans('Products.yes') }}
                                                            </label>
                                                        </h6>
                                                        @error('vatQuest')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.Tax') }}</label>
                                                        <select class="form-control @error('vat') is-invalid @enderror"
                                                            id="vat" name="vat">
                                                            <option value="15"
                                                                @if (old('vat') == 15) @selected(true) @endif>
                                                                15%</option>
                                                            <option value="0">0%</option>
                                                        </select>
                                                        @error('vat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="col-lg-6" id="orgUnit">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.Salesunit') }} : <span
                                                                class="requiredData">*</span></label>
                                                        <select class="form-control @error('unitID') is-invalid @enderror"
                                                            id="unitID" name="unitID" onchange="route2(this,1)"
                                                            required>
                                                            <option value=""> {{ trans('Products.Chooseunit') }}
                                                            </option>
                                                            @foreach (auth()->user()->organization->units as $unit)
                                                                <option value="{{ $unit->id }}::{{ $unit->nameAr }}"
                                                                    @if (old('unitID') == $unit->id) @selected(true) @endif>
                                                                    {{ $unit->nameAr }}</option>
                                                            @endforeach
                                                            <option value="-1">اضافة وحدة</option>
                                                        </select>
                                                        @error('unitID')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label"
                                                            for="input-first-name">{{ trans('Products.Productimage') }}
                                                        </label>
                                                        <input type="file" class="form-control" name="img"
                                                            id="img" value="{{ old('img') }}">
                                                        @error('img')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="availableTime">
                                                            {{ trans('Products.Isspecifictime') }} </label>
                                                        <h6>
                                                            <input type="checkbox" id="availableTime"
                                                                name="availableTime" value="1"
                                                                onclick="availableT()">
                                                            <label for="availableTime">
                                                                &nbsp;&nbsp;
                                                                {{ trans('Products.yes') }}
                                                            </label>
                                                        </h6>
                                                        @error('availableTime')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6"></div>

                                                <div class="col-lg-6" id="sfrom" style="display: none">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">زمن توفر
                                                            المنتج - من الساعة</label>
                                                        <input type="time"
                                                            class="form-control text-right @error('sFrom') is-invalid @enderror"
                                                            id="sFrom" name="sFrom" placeholder="من الساعة">
                                                        @error('sFrom')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6" id="sto" style="display: none">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">زمن توفر
                                                            المنتج - الى الساعة</label>
                                                        <input type="time"
                                                            class="form-control text-right @error('sTo') is-invalid @enderror"
                                                            id="sTo" name="sTo" placeholder="الى الساعة">
                                                        @error('sTo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <!----------</div>------------->
                                            <hr>
                                            <div class="card-header">
                                                <h2> {{ trans('Products.Measurementunits') }} :</h2>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <br>
                                                <div class="col-lg-8">
                                                    <h5 style="color: brown;">
                                                        {{ trans('Products.fromlargesttosmallest') }} </h5>
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ trans('Products.Productimage') }}</th>
                                                                <th> {{ trans('Products.Conversionfactor') }} </th>
                                                                <th> {{ trans('Products.Unitcost') }} </th>
                                                                <th colspan="4">{{ trans('Products.Options') }}</th>


                                                            </tr>
                                                        </thead>
                                                        <tbody id="trow">
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        class="form-control  select2 @error('prunit0') is-invalid @enderror"
                                                                        id="prunit" name="prunit0"
                                                                        onchange="route(this)" @readonly(true)>
                                                                        <option value="">
                                                                            {{ trans('Products.Chooseunit') }}</option>
                                                                        @foreach (auth()->user()->organization->units as $unit)
                                                                            <option
                                                                                value="{{ $unit->id }}::{{ $unit->nameAr }}">
                                                                                {{ $unit->nameAr }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="uitQuantity0"
                                                                        step='any' class="form-control"
                                                                        value="1" readonly
                                                                        value="{{ old('pprice0') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="pprice0" step='any'
                                                                        id="pprice0" class="form-control" readonly
                                                                        value="{{ old('pprice0') }}">
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="sales0" name="sales0"
                                                                            type="checkbox"
                                                                            class="form-check-input salechecked0"
                                                                            @if (old('sales0') == 'on') checked @endif
                                                                            onchange="saleechecked(0)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Sales') }}</label>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="typepto" name="purchase0"
                                                                            type="checkbox"
                                                                            class="form-check-input purchasechecked0"
                                                                            @if (old('purchase0') == 'on') checked @endif
                                                                            onchange="purchasechecked(0)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.purchases') }}</label>

                                                                    </div>


                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="report0"
                                                                            type="checkbox"
                                                                            class="form-check-input reportchecked0"
                                                                            @if (old('report0') == 'on') checked @endif
                                                                            onchange="reportchecked(0)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Reports') }} </label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="compon0"
                                                                            type="checkbox"
                                                                            class="form-check-input componchecked0 @error('compon0') is-invalid  @enderror"
                                                                            @if (old('compon0') == 'on') checked @endif
                                                                            onchange="componchecked(0)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Ingredients') }} </label>
                                                                        @error('compon0')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                </td>


                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        class="form-control  select2 @error('prunit1') is-invalid @enderror"
                                                                        id="prunit" name="prunit1"
                                                                        onchange="route(this)">
                                                                        <option value="">
                                                                            {{ trans('Products.Chooseunit') }}</option>
                                                                        @foreach (auth()->user()->organization->units as $unit)
                                                                            <option
                                                                                value="{{ $unit->id }}::{{ $unit->nameAr }}">
                                                                                {{ $unit->nameAr }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="uitQuantity1"
                                                                        id="uitQuantity1" class="form-control"
                                                                        value="{{ old('uitQuantity1') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="pprice1" step='any'
                                                                        id="pprice1" class="form-control"
                                                                        value="{{ old('pprice1') }}">
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="sales1"
                                                                            type="checkbox"
                                                                            class="form-check-input salechecked1"
                                                                            @if (old('sales1') == 'on') checked @endif
                                                                            onchange="saleechecked(1)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Sales') }}</label>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="purchase1"
                                                                            type="checkbox"
                                                                            class="form-check-input purchasechecked1"
                                                                            @if (old('purchase1') == 'on') checked @endif
                                                                            onchange="purchasechecked(1)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.purchases') }}</label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="report1"
                                                                            type="checkbox"
                                                                            class="form-check-input reportchecked1"
                                                                            @if (old('report1') == 'on') checked @endif
                                                                            onchange="reportchecked(1)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Reports') }}</label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="compon1"
                                                                            type="checkbox"
                                                                            class="form-check-input componchecked1"
                                                                            @if (old('compon1') == 'on') checked @endif
                                                                            onchange="componchecked(1)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Ingredients') }}</label>

                                                                    </div>

                                                                </td>


                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        class="form-control  select2 @error('prunit2') is-invalid @enderror"
                                                                        id="prunit" name="prunit2"
                                                                        onchange="route(this)">
                                                                        <option value="">
                                                                            {{ trans('Products.Chooseunit') }} </option>
                                                                        @foreach (auth()->user()->organization->units as $unit)
                                                                            <option
                                                                                value="{{ $unit->id }}::{{ $unit->nameAr }}">
                                                                                {{ $unit->nameAr }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="uitQuantity2"
                                                                        id="uitQuantity2" class="form-control"
                                                                        value="{{ old('uitQuantity2') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="pprice2" id="pprice2"
                                                                        class="form-control"
                                                                        value="{{ old('pprice2') }}">
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="sales2"
                                                                            type="checkbox"
                                                                            class="form-check-input salechecked2"
                                                                            @if (old('sales2') == 'on') checked @endif
                                                                            onchange="saleechecked(2)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Sales') }}</label>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="purchase2"
                                                                            type="checkbox"
                                                                            class="form-check-input   purchasechecked2"
                                                                            @if (old('purchase2') == 'on') checked @endif
                                                                            onchange="purchasechecked(2)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.purchases') }}</label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="report2"
                                                                            type="checkbox"
                                                                            class="form-check-input reportchecked2"
                                                                            @if (old('report2') == 'on') checked @endif
                                                                            onchange="reportchecked(2)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Reports') }}</label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="compon2"
                                                                            type="checkbox"
                                                                            class="form-check-input componchecked2"
                                                                            @if (old('compon2') == 'on') checked @endif
                                                                            onchange="componchecked(2)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Ingredients') }}</label>

                                                                    </div>

                                                                </td>


                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>



                                            </div>



                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <div class="col-lg-10">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <div class="col-lg-10">
                                                            <input type="submit" class="btn btn-primary" id="save"
                                                                value="{{ trans('Products.save') }}"
                                                                style="width: 100%">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div><!-----------------------end ---------------------------->

                                <div class="tab-pane" id="purchase">

                                    <div class="row">

                                        <form action="{{ route('products.store') }}" method="post" class="col-lg-12">
                                            @csrf
                                            <input type="hidden" value="2" name="TypeProdect">
                                            <h2> {{ trans('Products.basicinformation') }}:</h2>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.ProductName-Arabic') }} <span
                                                                class="requiredData">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('ppnameAr') is-invalid @enderror"
                                                            id="nameAr" name="ppnameAr"
                                                            value="{{ old('ppnameAr') }}"
                                                            placeholder=" {{ trans('Products.ProductName-Arabic') }} "
                                                            required>
                                                        @error('ppnameAr')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.ProductName-Einglsh') }} <span
                                                                class="requiredData">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('ppnameEn') is-invalid @enderror"
                                                            id="nameEn" onkeypress="return ValidateKey();"
                                                            name="ppnameEn"
                                                            placeholder="  {{ trans('Products.ProductName-Einglsh') }} "
                                                            value="{{ old('nameEn') }}" required>
                                                        @error('nameEn')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label"
                                                            for="input-username">{{ trans('Products.Sectiontheitemonthelist') }}
                                                            <span class="requiredData">*</span></label>
                                                        <select
                                                            class="form-control CategouryAllitemsKat select2 @error('ppcategoryID') is-invalid @enderror"
                                                            id="ppcategoryID" name="ppcategoryID" onchange="route(this)"
                                                            required>
                                                            <option value=""></option>
                                                            @foreach (auth()->user()->organization->prodcategoriesKatPuches as $cat)
                                                                <option value="{{ $cat->id }}"
                                                                    @if (old('ppcategoryID') == $cat->id) @selected(true) @endif>
                                                                    {{ $cat->nameAr }}</option>
                                                            @endforeach
                                                            <option value="-1">اضافة قسم</option>
                                                        </select>
                                                        @error('categoryID')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="input-username">
                                                                    {{ trans('Products.Istheproductsalable') }} </label>



                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">

                                                                <div class="form-check">
                                                                    <input name="saleable" id="saleable" value="1"
                                                                        type="radio" class="form-check-input"
                                                                        onchange="issalable()"
                                                                        @if (old('saleable') == 1) @checked(true) @endif>
                                                                    <label class="form-check-label" for="credit">
                                                                        {{ trans('Products.yes') }} </label>
                                                                </div>


                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="form-group">



                                                                <div class="form-check">
                                                                    <input name="saleable" value="0"
                                                                        id="notsaleable" type="radio"
                                                                        class="form-check-input" onchange="isnotsalable()"
                                                                        @if (old('saleable') == 0) @checked(true) @endif>
                                                                    <label class="form-check-label" for="debit">
                                                                        {{ trans('Products.no') }} </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 saleablegroup" style="display: none;">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.Sectiontheitemonthelist') }} <span
                                                                class="requiredData">*</span></label>
                                                        <select
                                                            class="form-control CategouryAllitemsKat select2 @error('ppscategoryID') is-invalid @enderror"
                                                            id="ppscategoryID" name="ppscategoryID">
                                                            <option value=""></option>
                                                            @foreach (auth()->user()->organization->prodcategoriesKatcSaller as $cat)
                                                                <option value="{{ $cat->id }}"
                                                                    @if (old('ppcategoryID') == $cat->id) @selected(true) @endif>
                                                                    {{ $cat->nameAr }}</option>
                                                            @endforeach
                                                            <option value="-1">اضافة قسم</option>
                                                        </select>
                                                        @error('ppscategoryID')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6  saleablegroup" style="display: none;">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.kitchen') }} <span
                                                                class="requiredData">*</span></label>
                                                        <select
                                                            class="form-control @error('kitchenID') is-invalid @enderror"
                                                            id="ppkitchenID" name="ppkitchenID" onchange="route(this)">
                                                            <option value="">
                                                                {{ trans('Products.ChooseKitchens') }}</option>
                                                            @foreach (auth()->user()->organization->kitchens as $kit)
                                                                <option value="{{ $kit->id }}"
                                                                    @if (old('ppkitchenID') == $kit->id) @selected(true) @endif>
                                                                    {{ $kit->nameAr }}</option>
                                                            @endforeach
                                                            <option value="-1">اضافة مطبخ</option>
                                                        </select>
                                                        @error('kitchenID')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <hr>
                                            {{-- <h2>السعر   : </h2> --}}

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">

                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.Costprice') }} <span
                                                                class="requiredData">*</span></label>

                                                        <input type="number" step='any'
                                                            class="form-control @error('ppcostPrice') is-invalid  @enderror"
                                                            id="2costPrice" name="ppcostPrice"
                                                            placeholder="  {{ trans('Products.Costprice') }} "
                                                            value="{{ old('ppcostPrice') }}" onchange="calcuUnit2(2)"
                                                            required>
                                                        @error('ppcostPrice')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 saleablegroup" style="display: none;">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.sellingprice') }} : <span
                                                                class="requiredData">*</span></label>
                                                        <input type="number" step='any'
                                                            class="form-control @error('ppprodPrice') is-invalid @enderror"
                                                            id="ppprodPrice" name="ppprodPrice"
                                                            placeholder="   {{ trans('Products.sellingprice') }} "
                                                            value="{{ old('ppprodPrice') }}">
                                                        @error('prodPrice')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="vatQuest">
                                                            {{ trans('Products.Doespriceincludetax') }} </label>
                                                        <h6>
                                                            <input type="checkbox" id="vatQuest" name="ppvatQuest"
                                                                value="1" onclick="" checked>
                                                            <label for="vatQuest">
                                                                &nbsp;&nbsp;
                                                                {{ trans('Products.yes') }}
                                                            </label>
                                                        </h6>
                                                        @error('vatQuest')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.Tax') }} %</label>
                                                        <select class="form-control @error('vat') is-invalid @enderror"
                                                            id="vat" name="ppvat">
                                                            <option value="15"
                                                                @if (old('ppvat') == 15) @selected(true) @endif>
                                                                15%</option>
                                                            <option value="0">0%</option>
                                                        </select>
                                                        @error('vat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="col-lg-6" id="orgUnit">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.Purchasingunit') }} : <span
                                                                class="requiredData">*</span></label>
                                                        <select
                                                            class="form-control @error('ppunitID') is-invalid @enderror"
                                                            id="unitID" name="ppunitID" onchange="route2(this,2)"
                                                            required>
                                                            <option value="">{{ trans('Products.Chooseunit') }}
                                                            </option>
                                                            @foreach (auth()->user()->organization->units as $unit)
                                                                <option
                                                                    value="{{ $unit->id }}::{{ $unit->nameAr }}"
                                                                    @if (old('ppunitID') == $unit->id) @selected(true) @endif>
                                                                    {{ $unit->nameAr }}</option>
                                                            @endforeach
                                                            <option value="-1">اضافة وحدة</option>
                                                        </select>
                                                        @error('ppunitID')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-first-name">
                                                            {{ trans('Products.Productimage') }}</label>
                                                        <input type="file" class="form-control" name="img"
                                                            id="img" value="{{ old('img') }}">
                                                        @error('img')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>







                                            </div>

                                            <!----------</div>------------->
                                            <hr>
                                            <div class="card-header">
                                                <h2> {{ trans('Products.Measurementunits') }} :</h2>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <br>
                                                <div class="col-lg-8">
                                                    <h5 style="color: brown;">
                                                        {{ trans('Products.fromlargesttosmallest') }}</h5>
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ trans('Products.units') }} </th>
                                                                <th> {{ trans('Products.Conversionfactor') }}</th>
                                                                <th> {{ trans('Products.Unitcost') }}</th>
                                                                <th colspan="4">{{ trans('Products.Options') }} </th>


                                                            </tr>
                                                        </thead>
                                                        <tbody id="trow">
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        class="form-control  select2 @error('prunit0') is-invalid @enderror"
                                                                        id="2prunit" name="prunit0"
                                                                        onchange="route(this)" @readonly(true)>
                                                                        <option value="">
                                                                            {{ trans('Products.Chooseunit') }} </option>
                                                                        @foreach (auth()->user()->organization->units as $unit)
                                                                            <option
                                                                                value="{{ $unit->id }}::{{ $unit->nameAr }}">
                                                                                {{ $unit->nameAr }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" step='any'
                                                                        name="uitQuantity0" class="form-control"
                                                                        value="1" readonly
                                                                        value="{{ old('uitQuantity0') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" step='any' name="pprice0"
                                                                        id="2pprice0" class="form-control" readonly
                                                                        value="{{ old('pprice0') }}">
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="sales0"
                                                                            type="checkbox"
                                                                            class="form-check-input salechecked0"
                                                                            @if (old('sales0') == 'on') checked @endif
                                                                            onchange="saleechecked(0)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Sales') }}</label>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="purchase0" name="purchase0"
                                                                            type="checkbox"
                                                                            class="form-check-input purchasechecked0"
                                                                            @if (old('purchase0') == 'on') checked @endif
                                                                            onchange="purchasechecked(0)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.purchases') }}</label>

                                                                    </div>

                                                                </td>

                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="report0"
                                                                            type="checkbox"
                                                                            class="form-check-input reportchecked0"
                                                                            @if (old('report0') == 'on') checked @endif
                                                                            onchange="reportchecked(0)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Reports') }}</label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="compon0"
                                                                            type="checkbox"
                                                                            class="form-check-input componchecked0 @error('compon0') is-invalid  @enderror"
                                                                            @if (old('compon0') == 'on') checked @endif
                                                                            onchange="componchecked(0)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Ingredients') }}</label>
                                                                        @error('compon0')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                </td>


                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        class="form-control  select2 @error('prunit1') is-invalid @enderror"
                                                                        id="2prunit" name="prunit1"
                                                                        onchange="route(this)">
                                                                        <option value="">
                                                                            {{ trans('Products.Chooseunit') }}</option>
                                                                        @foreach (auth()->user()->organization->units as $unit)
                                                                            <option
                                                                                value="{{ $unit->id }}::{{ $unit->nameAr }}">
                                                                                {{ $unit->nameAr }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="uitQuantity1"
                                                                        id="2uitQuantity1" class="form-control"
                                                                        onchange="setQuan1(2)"
                                                                        value="{{ old('uitQuantity1') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" step='any' name="pprice1"
                                                                        id="2pprice1" class="form-control"
                                                                        value="{{ old('pprice1') }}">
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="sales1"
                                                                            type="checkbox"
                                                                            class="form-check-input salechecked1"
                                                                            @if (old('sales1') == 'on') checked @endif
                                                                            onchange="saleechecked(1)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Sales') }}</label>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="purchase1"
                                                                            type="checkbox"
                                                                            class="form-check-input purchasechecked1"
                                                                            @if (old('purchase1') == 'on') checked @endif
                                                                            onchange="purchasechecked(1)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.purchases') }}</label>

                                                                    </div>


                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="report1"
                                                                            type="checkbox"
                                                                            class="form-check-input reportchecked1"
                                                                            @if (old('report1') == 'on') checked @endif
                                                                            onchange="reportchecked(1)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Reports') }}</label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="compon1"
                                                                            type="checkbox"
                                                                            class="form-check-input componchecked1"
                                                                            @if (old('compon1') == 'on') checked @endif
                                                                            onchange="componchecked(1)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Ingredients') }}</label>

                                                                    </div>

                                                                </td>


                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        class="form-control  select2 @error('prunit2') is-invalid @enderror"
                                                                        id="2prunit2" name="prunit2"
                                                                        onchange="route(this)">
                                                                        <option value="">
                                                                            {{ trans('Products.Chooseunit') }}</option>
                                                                        @foreach (auth()->user()->organization->units as $unit)
                                                                            <option
                                                                                value="{{ $unit->id }}::{{ $unit->nameAr }}">
                                                                                {{ $unit->nameAr }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="uitQuantity2"
                                                                        id="2uitQuantity2" class="form-control"
                                                                        onchange="setQuan2(2)"
                                                                        value="{{ old('uitQuantity2') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" step='any' name="pprice2"
                                                                        id="2pprice2" class="form-control"
                                                                        value="{{ old('pprice2') }}">
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="sales2"
                                                                            type="checkbox"
                                                                            class="form-check-input salechecked2"
                                                                            @if (old('sales2') == 'on') checked @endif
                                                                            onchange="saleechecked(2)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Sales') }}</label>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="purchase2"
                                                                            type="checkbox"
                                                                            class="form-check-input purchasechecked2"
                                                                            @if (old('purchase2') == 'on') checked @endif
                                                                            onchange="purchasechecked(2)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.purchases') }}</label>

                                                                    </div>


                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="report2"
                                                                            type="checkbox"
                                                                            class="form-check-input reportchecked2"
                                                                            @if (old('report2') == 'on') checked @endif
                                                                            onchange="reportchecked(2)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Reports') }}</label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="compon2"
                                                                            type="checkbox"
                                                                            class="form-check-input componchecked2"
                                                                            @if (old('compon2') == 'on') checked @endif
                                                                            onchange="componchecked(2)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Ingredients') }}</label>

                                                                    </div>

                                                                </td>


                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>



                                            </div>



                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <div class="col-lg-10">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <div class="col-lg-10">
                                                            <input type="submit" class="btn btn-primary" id="save"
                                                                value="{{ trans('Products.save') }}"
                                                                style="width: 100%">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>


                                </div>



                                <div class="tab-pane" id="manufact">

                                    <div class="row">

                                        <form action="{{ route('products.store') }}" method="post" class="col-lg-12">
                                            @csrf
                                            <input type="hidden" name="TypeProdect" id="TypeProdect" value="3">
                                            <h2> {{ trans('Products.basicinformation') }}:</h2>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.ProductName-Arabic') }} <span
                                                                class="requiredData">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('ttnameAr') is-invalid @enderror"
                                                            id="ttnameAr" name="ttnameAr"
                                                            value="{{ old('ttnameAr') }}"
                                                            placeholder=" {{ trans('Products.ProductName-Arabic') }}"
                                                            required>
                                                        @error('ttnameAr')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.ProductName-Einglsh') }} <span
                                                                class="requiredData">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('ttnameEn') is-invalid @enderror"
                                                            id="nameEn" onkeypress="return ValidateKey();"
                                                            name="ttnameEn"
                                                            placeholder=" {{ trans('Products.ProductName-Einglsh') }} "
                                                            value="{{ old('nameEn') }}" required>
                                                        @error('ttnameEn')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label"
                                                            for="input-username">{{ trans('Products.Productsection') }}
                                                            <span class="requiredData">*</span></label>
                                                        <select
                                                            class="form-control  select2 @error('tttcategoryID') is-invalid @enderror"
                                                            id="tcategoryID" name="tttcategoryID" onchange="route(this)"
                                                            required>
                                                            <option value=""></option>
                                                            @foreach (auth()->user()->organization->productTsnee as $cat)
                                                                <option value="{{ $cat->id }}"
                                                                    @if (old('tttcategoryID') == $cat->id) @selected(true) @endif>
                                                                    {{ $cat->nameAr }}</option>
                                                            @endforeach
                                                            <option value="-1">اضافة قسم</option>
                                                        </select>
                                                        @error('tttcategoryID')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>




                                            </div>
                                            <hr>
                                            {{-- <h2>السعر   : </h2> --}}

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">

                                                        <label class="form-control-label" for="input-username">
                                                            {{ trans('Products.Costprice') }} <span
                                                                class="requiredData">*</span></label>

                                                        <input type="number" step='any'
                                                            class="form-control @error('ttcostPrice') is-invalid  @enderror"
                                                            id="3costPrice" name="ttcostPrice"
                                                            placeholder="  {{ trans('Products.Costprice') }}"
                                                            value="{{ old('ttcostPrice') }}" onchange="calcuUnit2(3)"
                                                            required>
                                                        @error('ttcostPrice')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <hr>

                                                <div class="col-lg-6" id="orgUnit">
                                                    <div class="form-group">
                                                        <label class="form-control-label"
                                                            for="input-username">{{ trans('Products.Unit') }} : <span
                                                                class="requiredData">*</span></label>
                                                        <select
                                                            class="form-control @error('tunitID') is-invalid @enderror"
                                                            id="unitID" name="tunitID" onchange="route2(this,3)"
                                                            required>
                                                            <option value=""> {{ trans('Products.Chooseunit') }}
                                                            </option>
                                                            @foreach (auth()->user()->organization->units as $unit)
                                                                <option
                                                                    value="{{ $unit->id }}::{{ $unit->nameAr }}"
                                                                    @if (old('tunitID') == $unit->id) @selected(true) @endif>
                                                                    {{ $unit->nameAr }}</option>
                                                            @endforeach
                                                            <option value="-1">اضافة وحدة</option>
                                                        </select>
                                                        @error('tunitID')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-first-name">
                                                            {{ trans('Products.Productimage') }}</label>
                                                        <input type="file" class="form-control" name="img"
                                                            id="img" value="{{ old('img') }}">
                                                        @error('img')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>

                                            <!----------</div>------------->
                                            <hr>
                                            <div class="card-header">
                                                <h2> {{ trans('Products.Measurementunits') }} :</h2>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <br>
                                                <div class="col-lg-8">
                                                    <h5 style="color: brown;">
                                                        {{ trans('Products.fromlargesttosmallest') }}</h5>
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ trans('Products.units') }} </th>
                                                                <th> {{ trans('Products.Conversionfactor') }}</th>
                                                                <th> {{ trans('Products.Unitcost') }}</th>
                                                                <th colspan="4">{{ trans('Products.Options') }} </th>


                                                            </tr>
                                                        </thead>
                                                        <tbody id="trow">
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        class="form-control  select2 @error('prunit0') is-invalid @enderror"
                                                                        id="3prunit" name="prunit0"
                                                                        onchange="route(this)" @readonly(true)>
                                                                        <option value="">
                                                                            {{ trans('Products.Chooseunit') }}</option>
                                                                        @foreach (auth()->user()->organization->units as $unit)
                                                                            <option
                                                                                value="{{ $unit->id }}::{{ $unit->nameAr }}">
                                                                                {{ $unit->nameAr }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="uitQuantity0"
                                                                        class="form-control" value="1" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="pprice0" step='any'
                                                                        id="3pprice0" class="form-control" readonly
                                                                        value="{{ old('pprice0') }}">
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="sales0"
                                                                            type="checkbox"
                                                                            class="form-check-input salechecked0"
                                                                            @if (old('sales0') == 'on') checked @endif
                                                                            onchange="saleechecked(0)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Sales') }}</label>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="purchase0"
                                                                            type="checkbox"
                                                                            class="form-check-input purchasechecked0"
                                                                            @if (old('purchase0') == 'on') checked @endif
                                                                            onchange="purchasechecked(0)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.purchases') }}</label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="report0"
                                                                            type="checkbox"
                                                                            class="form-check-input reportchecked0"
                                                                            @if (old('report0') == 'on') checked @endif
                                                                            onchange="reportchecked(0)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Reports') }}</label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="compon0" name="compon0"
                                                                            type="checkbox"
                                                                            class="form-check-input componchecked0 @error('compon0') is-invalid  @enderror"
                                                                            @if (old('compon0') == 'on') checked @endif
                                                                            onchange="componchecked(0)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Ingredients') }}</label>
                                                                        @error('compon0')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                </td>


                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        class="form-control  select2 @error('prunit1') is-invalid @enderror"
                                                                        id="prunit" name="prunit1"
                                                                        onchange="route(this)">
                                                                        <option value="">
                                                                            {{ trans('Products.Chooseunit') }}</option>
                                                                        @foreach (auth()->user()->organization->units as $unit)
                                                                            <option
                                                                                value="{{ $unit->id }}::{{ $unit->nameAr }}">
                                                                                {{ $unit->nameAr }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="uitQuantity1"
                                                                        id="3uitQuantity1" class="form-control"
                                                                        onchange="setQuan1(3)"
                                                                        value="{{ old('uitQuantity1') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="pprice1"
                                                                        step='any' id="3pprice1"
                                                                        class="form-control"
                                                                        value="{{ old('uitQuantity1') }}"
                                                                        value="{{ old('pprice1') }}">
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="sales1"
                                                                            type="checkbox"
                                                                            class="form-check-input salechecked1"
                                                                            @if (old('sales1') == 'on') checked @endif
                                                                            onchange="saleechecked(1)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Sales') }}</label>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="purchase1"
                                                                            type="checkbox"
                                                                            class="form-check-input purchasechecked1"
                                                                            @if (old('purchase1') == 'on') checked @endif
                                                                            onchange="purchasechecked(1)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.purchases') }}</label>

                                                                    </div>


                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="report1"
                                                                            type="checkbox"
                                                                            class="form-check-input reportchecked1"
                                                                            @if (old('report1') == 'on') checked @endif
                                                                            onchange="reportchecked(1)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Reports') }}</label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="compon1"
                                                                            type="checkbox"
                                                                            class="form-check-input componchecked1"
                                                                            @if (old('compon1') == 'on') checked @endif
                                                                            onchange="componchecked(1)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Ingredients') }}</label>

                                                                    </div>

                                                                </td>


                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <select
                                                                        class="form-control  select2 @error('prunit2') is-invalid @enderror"
                                                                        id="prunit" name="prunit2"
                                                                        onchange="route(this)">
                                                                        <option value="">
                                                                            {{ trans('Products.Chooseunit') }}</option>
                                                                        @foreach (auth()->user()->organization->units as $unit)
                                                                            <option
                                                                                value="{{ $unit->id }}::{{ $unit->nameAr }}">
                                                                                {{ $unit->nameAr }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="uitQuantity2"
                                                                        id="3uitQuantity2" class="form-control"
                                                                        onchange="setQuan2(3)"
                                                                        value="{{ old('uitQuantity2') }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="pprice2"
                                                                        id="3pprice2" step='any'
                                                                        class="form-control"
                                                                        value="{{ old('pprice2') }}">
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="sales2"
                                                                            type="checkbox"
                                                                            class="form-check-input salechecked2"
                                                                            @if (old('sales2') == 'on') checked @endif
                                                                            onchange="saleechecked(2)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Sales') }}</label>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="purchase2"
                                                                            type="checkbox"
                                                                            class="form-check-input purchasechecked2"
                                                                            @if (old('purchase2') == 'on') checked @endif
                                                                            onchange="purchasechecked(2)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.purchases') }}</label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="report2"
                                                                            type="checkbox"
                                                                            class="form-check-input reportchecke2"
                                                                            @if (old('report2') == 'on') checked @endif
                                                                            onchange="reportchecked(2)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Reports') }}</label>

                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input id="TypeProdect" name="compon2"
                                                                            type="checkbox"
                                                                            class="form-check-input componchecked2"
                                                                            @if (old('compon2') == 'on') checked @endif
                                                                            onchange="componchecked(2)">
                                                                        <label class="form-check-label" for="credit">
                                                                            {{ trans('Products.Ingredients') }}</label>

                                                                    </div>

                                                                </td>


                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>



                                            </div>



                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <div class="col-lg-10">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <div class="col-lg-10">
                                                            <input type="submit" class="btn btn-primary"
                                                                id="save" value="{{ trans('Products.save') }}"
                                                                style="width: 100%">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>


                                </div>






                            </div>

                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->

    </section>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Customers Modal -->
    <!------------------------------------add saeed -------------------------------------------------->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">



    <script>
        $(document).ready(function() {
            $('#SaveAlldataprodcategories').click(function() {
                var formData = new FormData();

                var nameEn = $('#nameEnprodcategories').val();
                var nameAr = $('#nameArprodcategories').val();

                sort = $('#Sortprodcategories').val();
                TypeProdect = $('#TypeProdect').val();
                var file = $('#imgprodcategories')[0].files[0];
                formData.append('nameEn', nameEn);
                formData.append('TypeProdect', TypeProdect);
                formData.append('nameAr', nameAr);
                formData.append('sort', sort);
                formData.append('img', file);
                formData.append('flag', 1);



                $.ajax({
                    url: '/saveCatProdect',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        $('#nameEnprodcategories').val('');
                        $('#nameArprodcategories').val('');
                        $('#Sortprodcategories').val('');
                        $('#imgprodcategories').val('');

                        if (response.data.TypeCatagoury == 1) {
                            $('#categoryID').append('<option value="' + response.data.id +
                                '" selected>' + response.data.nameAr + '</option> ');

                        } else if (response.data.TypeCatagoury == 2) {
                            $('#ppcategoryID').append('<option value="' + response.data.id +
                                '" selected>' + response.data.nameAr + '</option> ');

                        } else {
                            $('#tcategoryID').append('<option value="' + response.data.id +
                                '" selected>' + response.data.nameAr + '</option> ');

                        }



                        $('#CatguryModalProdect').modal('hide');
                        // Handle success response
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error
                    }
                });
            });



            $('#SaveAlldataprodKitchan').click(function() {
                var formData = new FormData();
                var nameEn = $('#nameEnprodKitchan').val();
                var nameAr = $('#nameArprodKitchan').val();
                formData.append('nameEn', nameEn);
                formData.append('nameAr', nameAr);




                $.ajax({
                    url: '/saveKitchanProdect',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        $('#nameEnprodKitchan').val('');
                        $('#nameArprodKitchan').val('');
                        $('#kitchenID').append('<option value="' + response.data.id +
                            '" selected>' + response.data.nameAr + '</option> ');

                            $('#ppkitchenID').append('<option value="' + response.data.id +
                            '" selected>' + response.data.nameAr + '</option> ');



                        $('#KitchanModalProdect').modal('hide');
                        // Handle success response
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error
                    }
                });
            });




            $('#categoryID').change(function() {

                if ($(this).val() == -1) {
                    $('#CatguryModalProdect').modal('show');
                }

            });

            $('#kitchenID').change(function() {

                if ($(this).val() == -1) {
                    $('#KitchanModalProdect').modal('show');
                }

            });



            $('#tcategoryID').change(function() {

                if ($(this).val() == -1) {
                    $('#CatguryModalProdect').modal('show');
                }

            });

            $('#ppcategoryID').change(function() {

                if ($(this).val() == -1) {
                    $('#CatguryModalProdect').modal('show');
                }

            });



        });
    </script>

    <script>
        function saleechecked(val) {

            // console.log(  $("#sales2").is(':checked'));
            if (val == 0) {


                $(".salechecked0").prop("checked", true);
                $(".salechecked1").prop("checked", false);
                $(".salechecked2").prop("checked", false);



            } else if (val == 1) {

                $(".salechecked0").prop("checked", false);
                $(".salechecked1").prop("checked", true);
                $(".salechecked2").prop("checked", false);


            } else {
                $(".salechecked0").prop("checked", false);
                $(".salechecked1").prop("checked", false);
                $(".salechecked2").prop("checked", true);

            }


        }



        function purchasechecked(val) {

            // console.log(  $("#sales2").is(':checked'));
            if (val == 0) {


                $(".purchasechecked0").prop("checked", true);
                $(".purchasechecked1").prop("checked", false);
                $(".purchasechecked2").prop("checked", false);

            } else if (val == 1) {

                $(".purchasechecked0").prop("checked", false);
                $(".purchasechecked1").prop("checked", true);
                $(".purchasechecked2").prop("checked", false);


            } else {
                $(".purchasechecked0").prop("checked", false);
                $(".purchasechecked1").prop("checked", false);
                $(".purchasechecked2").prop("checked", true);

            }


        }

        function reportchecked(val) {

            // console.log(  $("#sales2").is(':checked'));
            if (val == 0) {


                $(".reportchecked0").prop("checked", true);
                $(".reportchecked1").prop("checked", false);
                $(".reportchecked2").prop("checked", false);

            } else if (val == 1) {

                $(".reportchecked0").prop("checked", false);
                $(".reportchecked1").prop("checked", true);
                $(".reportchecked2").prop("checked", false);


            } else {
                $(".reportchecked0").prop("checked", false);
                $(".reportchecked1").prop("checked", false);
                $(".reportchecked2").prop("checked", true);

            }


        }

        function componchecked(val) {

            // console.log(  $("#sales2").is(':checked'));
            if (val == 0) {


                $(".componchecked0").prop("checked", true);
                $(".componchecked1").prop("checked", false);
                $(".componchecked2").prop("checked", false);

            } else if (val == 1) {

                $(".componchecked0").prop("checked", false);
                $(".componchecked1").prop("checked", true);
                $(".componchecked2").prop("checked", false);


            } else {
                $(".componchecked0").prop("checked", false);
                $(".componchecked1").prop("checked", false);
                $(".componchecked2").prop("checked", true);

            }


        }
    </script>
    <script>
        $(document).ready(function() {


            var prodval = document.getElementById('oldtypeval').value;
            var saleable = document.getElementById('oldsaleable').value;
            //alert(saleable);
            if (prodval == 1) {
                //handleChange1(prodval);
                $('#saletab').trigger('click');
                //sale saletab
            } else if (prodval == 2) {

                $('#purchasetab').trigger('click');


                // var purtab = document.getElementById("purchasetab");
                // var pur = document.getElementById("sale");

                // var element1 = document.getElementById("sale");
                // var element2 = document.getElementById("saletab");
                // var element3 = document.getElementById("manufact");
                // var element4 = document.getElementById("manufacttab");
                // element1.classList.remove("active");
                // element2.classList.remove("active");
                // element3.classList.remove("active");
                // element4.classList.remove("active");

                // pur.classList.add("active");
                // purtab.classList.add("active");
                if (saleable == 1) {

                    issalable();
                } else {
                    isnotsalable();
                }
            } else if (prodval == 3) {
                $('#manufacttab').trigger('click');
            } else {
                $('#saletab').trigger('click');
            }
        });
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

        function route2(...params) {

            if (params[0].value == -1) {
                window.location.href = "/units/create"
            };
            if (params[1] == 2) {
                document.getElementById('2prunit').value = params[0].value;
                document.getElementById('purchase0').checked = true;
            } else if (params[1] == 3) {
                document.getElementById('3prunit').value = params[0].value;
                document.getElementById('compon0').checked = true;

            } else {
                document.getElementById('prunit').value = params[0].value;
                document.getElementById('sales0').checked = true;

            }

        }




        function issalable() {

            $('.saleablegroup').show();
            document.getElementById('scategoryID').required = true;
            document.getElementById('ppprodPrice').required = true;


        }

        function isnotsalable() {

            $('.saleablegroup').hide();
            document.getElementById('scategoryID').required = false;
            document.getElementById('ppprodPrice').required = false;

        }



        $('#costPrice').change(function() {



            document.getElementById('pprice0').value = document.getElementById('costPrice').value;
        });

        $('#prodPrice').change(function() {

            var cehk = document.getElementById('saleable').value;
            var cehk2 = document.getElementById('TypeProdect').value;


            if ((cehk != 1) && (cehk2 != 2)) {

                document.getElementById('pprice0').value = document.getElementById('prodPrice').value;
            }
            if (cehk2 == 1) {
                document.getElementById('pprice0').value = document.getElementById('prodPrice').value;
            }
        });



        function calcuUnit2(val) {
            if (val == 2) {
                document.getElementById('2pprice0').value = document.getElementById('2costPrice').value;
            } else {
                document.getElementById('3pprice0').value = document.getElementById('3costPrice').value;
            }

        }




        $('#uitQuantity1').change(function() {

            var price = Number(document.getElementById('pprice0').value);
            var qun = Number(document.getElementById('uitQuantity1').value);
            var cost = Number(document.getElementById('prodPrice').value);

            var total = price / qun;
            //alert(total);
            // document.getElementById('pprice1').value = Math.round(total * cost);
            document.getElementById('pprice1').value = total.toFixed(3);
        });
        $('#uitQuantity2').change(function() {

            var price = Number(document.getElementById('pprice1').value);
            var qun = Number(document.getElementById('uitQuantity2').value);
            var cost = Number(document.getElementById('prodPrice').value);

            var total = price / qun;

            //Math.round(total * cost);
            // document.getElementById('pprice2').value =Math.round(total * cost)
            document.getElementById('pprice2').value = total.toFixed(3);
        });

        function setQuan1(val) {
            if (val == 2) {
                var price = Number(document.getElementById('2pprice0').value);
                var qun = Number(document.getElementById('2uitQuantity1').value);
                var cost = Number(document.getElementById('2costPrice').value);

                var total = price / qun;

                document.getElementById('2pprice1').value = total.toFixed(3);
            } else {
                var price = Number(document.getElementById('3pprice0').value);
                var qun = Number(document.getElementById('3uitQuantity1').value);
                var cost = Number(document.getElementById('3costPrice').value);

                var total = price / qun;

                document.getElementById('3pprice1').value = total.toFixed(3);
            }

        }

        function setQuan2(val) {
            if (val == 2) {
                var price = Number(document.getElementById('2pprice1').value);
                var qun = Number(document.getElementById('2uitQuantity2').value);
                var cost = Number(document.getElementById('2costPrice').value);

                var total = price / qun;

                document.getElementById('2pprice2').value = total.toFixed(3);
            } else {
                var price = Number(document.getElementById('3pprice1').value);
                var qun = Number(document.getElementById('3uitQuantity2').value);
                var cost = Number(document.getElementById('3costPrice').value);

                var total = price / qun;

                document.getElementById('3pprice2').value = total.toFixed(3);
            }

        }
    </script>
@endsection
<script>
    $(":input").keypress(function(event) {
        if (event.which == '10' || event.which == '13') {
            event.preventDefault();
        }
    });
</script>
