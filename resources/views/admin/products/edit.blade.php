@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">  {{ trans('Products.Editanewproduct') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">  {{ trans('Products.Products') }} </a></li>
            <li class="breadcrumb-item active">  {{ trans('Products.Editanewproduct') }} </li>
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
                <h3 class="card-title"> {{ trans('Products.Editanewproduct') }}  </h3>
              </div>
              <div class="card-body">


                <form class="user" method="POST" action="{{ route('products.update',$product->id) }}" enctype = "multipart/form-data">
                  @csrf
                  @method('put')
                  <div class="pl-lg-4">
                    <div class="row">
                      @if(auth()->user()->organization->activity == 2)
                         <div class="col-lg-6">
                          <div class="row">
                            <div class="col-lg-3">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username">  {{ trans('Products.ProductType') }}      </label>



                              </div>
                            </div>
                            <div class="col-lg-3">
                              <div class="form-group">

                                <div class="form-check">
                                    @if($product->TypeProdect == 1)
                                      <input type="hidden" name="TypeProdect" value="{{$product->TypeProdect}}">
                                     <label class="form-check-label" for="credit">  {{ trans('Products.Sales') }} </label>
                                    @elseif($product->TypeProdect == 2)
                                    <input type="hidden" name="TypeProdect" value="{{$product->TypeProdect}}">
                                      <label class="form-check-label" for="credit">  {{ trans('Products.purchases') }} </label>
                                    @elseif($product->TypeProdect == 3)
                                    <input type="hidden" name="TypeProdect" value="{{$product->TypeProdect}}">
                                      <label class="form-check-label" for="credit">  {{ trans('Products.Manufactur') }} </label>
                                    @endif
                                </div>


                              </div>
                            </div>

                            <div class="col-lg-3">

                            </div>
                            <div class="col-lg-3">

                            </div>


                          </div>

                         </div>
                         <div class="col-lg-6">
                         </div>


                      @endif
                       {{-- @if(auth()->user()->organization->activity == 1) --}}
                        <div class="col-lg-6 CodeProdectAll"  @if(auth()->user()->organization->activity == 2) style="display: none" @endif>
                            <div class="form-group">
                            <label class="form-control-label prodDet" for="input-username">  {{ trans('Products.Productcode') }}</label>
                            <input type="text"  class="form-control prodDet @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder=" {{ trans('Products.Productcode') }}">
                            @error('barcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                      {{-- @endif --}}
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Products.ProductName-Arabic') }}        <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;margin: 0px 10px;position: absolute;">*</span></label>
                          <input type="text"  class="form-control @error('nameAr') is-invalid @enderror" id="nameAr" name="nameAr" placeholder=" {{ trans('Products.ProductName-Arabic') }}" value="{{$product->nameAr}}">
                          @error('nameAr')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Products.ProductName-Einglsh') }}</label>
                          <input type="text"  class="form-control @error('nameEn') is-invalid @enderror" id="nameEn"  onkeypress="return ValidateKey();" name="nameEn" placeholder=" {{ trans('Products.ProductName-Einglsh') }}" value="{{$product->nameEn}}">
                          @error('nameEn')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      @if(auth()->user()->organization->activity == 2)
                      @if(($product->saleable == 1) || ($product->TypeProdect == 1))

                      <div class="col-lg-6 prodDet">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Products.CategorydetailsArabic') }}</label>
                          <textarea class="form-control @error('detailsAr') is-invalid @enderror" id="detailsAr" name="detailsAr" placeholder=" {{ trans('Products.CategorydetailsArabic') }}"> {{$product->detailsAr}}</textarea>
                          @error('detailsAr')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6 prodDet" >
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('Products.CategorydetailsEinglsh') }}</label>
                          <textarea class="form-control @error('detailsEn') is-invalid @enderror" id="detailsEn" name="detailsEn" placeholder=" {{ trans('Products.CategorydetailsEinglsh') }}"> {{$product->detailsEn}}</textarea>
                          @error('detailsEn')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6 CaloriesAllitems">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('Products.Calories') }}</label>
                          <input type="number" class="form-control @error('calories') is-invalid @enderror" id="calories" name="calories" placeholder="   {{ trans('Products.Calories') }}" value="{{$product->calories}}">
                          @error('calories')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      @endif
                      @endif

                      @if(auth()->user()->organization->activity == 2)
                      @if($product->TypeProdect !=3)
                      <div class="col-lg-6" id="fscat">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('Products.Productsection') }}            <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;margin: 0px 10px;position: absolute;">*</span></label>
                          <select class="form-control CategouryAllitemsKat select2 @error('categoryID') is-invalid @enderror" id="categoryID" name="categoryID" onchange="route(this)">

                            @if($product->TypeProdect == 2)
                              @foreach (auth()->user()->organization->prodcategoriesKatPuches as $cat)
                              <option value="{{$cat->id}}" @if($product->categoryID == $cat->id) @selected(true) @endif>{{$cat->nameAr}}</option>
                            @endforeach
                            @else
                            @foreach (auth()->user()->organization->prodcategoriesKatcSaller as $cat)
                            <option value="{{$cat->id}}" @if($product->categoryID == $cat->id) @selected(true) @endif>{{$cat->nameAr}}</option>
                            @endforeach
                            @endif

                          </select>
                          @error('categoryID')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      @endif
                      <div class="col-lg-6" id="catSale" style="display:none;">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Products.Productsection') }}           <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;margin: 0px 10px;position: absolute;">*</span></label>
                          <select class="form-control select2 @error('scategoryID') is-invalid @enderror" id="scategoryID" name="scategoryID" onchange="route(this)">
                            <option value="" > </option>
                            @foreach (auth()->user()->organization->prodcategoriesKatcSaller as $cat)
                              <option value="{{$cat->id}}">{{$cat->nameAr}}</option>
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
                      @if($product->TypeProdect ==3)
                      <div class="col-lg-6" id="catTasnee">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('Products.Productsection') }}         <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;margin: 0px 10px;position: absolute;">*</span> </label>
                          <select class="form-control select2 @error('tcategoryID') is-invalid @enderror" id="tcategoryID" name="tcategoryID" onchange="route(this)">

                            @if(auth()->user()->organization->productTsnee != null)
                            @foreach (auth()->user()->organization->productTsnee as $tcat)
                              <option value="{{$tcat->id}}"  @if($product->categoryID == $tcat->id) selected  @endif>{{$tcat->nameAr}}</option>
                            @endforeach
                            @endif

                          </select>
                          @error('categoryID')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      @endif
                      @endif
                      @if(auth()->user()->organization->activity == 1)
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Products.Productsection') }}  </label>
                          <select class="form-control  select2 @error('categoryID') is-invalid @enderror" id="categoryID" name="categoryID" onchange="route(this)">

                            @foreach (auth()->user()->organization->prodcategories as $cat)
                              <option value="{{$cat->id}}">{{$cat->nameAr}}</option>
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
                      @endif

                      @if(auth()->user()->organization->activity == 2)

                      @if(($product->saleable == 1) || ($product->TypeProdect == 1))
                      <div class="col-lg-6  KitChenAllItewms">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Products.kitchen') }}         <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;margin: 0px 10px;position: absolute;">*</span></label>
                          <select class="form-control @error('kitchenID') is-invalid @enderror" id="kitchenID" name="kitchenID" onchange="route(this)">
                            <option value="">  {{ trans('Products.ChooseKitchens') }}</option>
                            @foreach (auth()->user()->organization->kitchens as $kit)
                              <option value="{{$kit->id}}"@if($kit->id ==$product->kitchenID )selected @endif>{{$kit->nameAr}}</option>
                            @endforeach

                          </select>
                          @error('kitchenID')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      @endif
                      @endif
                      <div class="col-lg-6">
                        <div class="form-group">
                          @if(auth()->user()->organization->activity == 1)
                          <label class="form-control-label" for="input-username">  {{ trans('Products.Purchasingprice') }}</label>
                          @elseif($product->TypeProdect != 1)
                          <label class="form-control-label" for="input-username"> {{ trans('Products.Costprice') }}    <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;margin: 0px 10px;position: absolute;">*</span></label>

                          <input type="number" class="form-control @error('costPrice') is-invalid  @enderror" id="costPrice"   step='any' name="costPrice" placeholder="  {{ trans('Products.Purchasingprice') }}  " value="{{$product->costPrice}}">
                          @endif
                          @error('costPrice')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      @if(($product->saleable == 1)|| ($product->TypeProdect == 1))
                      <div class="col-lg-6 ProdectPriceAllItems">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">    {{ trans('Products.sellingprice') }}       <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;margin: 0px 10px;position: absolute;">*</span></label>
                          <input type="number"  step='any'  class="form-control @error('prodPrice') is-invalid @enderror" step='any' id="prodPrice" name="prodPrice" placeholder="  {{ trans('Products.sellingprice') }}" value="{{$product->prodPrice}}">
                          @error('prodPrice')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      @endif

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Products.Tax') }}  %      <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;margin: 0px 10px;position: absolute;">*</span></label>
                          <select class="form-control @error('vat') is-invalid @enderror" id="vat" name="vat">
                          <option value="15">15%</option>
                          <option value="0">0%</option>
                          </select>
                          @error('vat')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6" id="orgUnit">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Products.Salesunit') }}          <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;margin: 0px 10px;position: absolute;">*</span></label>
                          <select class="form-control @error('unitID') is-invalid @enderror" id="unitID" name="unitID" onchange="route2(this)">
                            <option value="">  {{ trans('Products.Chooseunit') }}</option>
                            @foreach (auth()->user()->organization->units as $unit)
                              <option value="{{$unit->id}}::{{$unit->nameAr}}" @if($prdUnits[0]->unitID== $unit->id) @selected(true) @endif>{{$unit->nameAr}}</option>
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

                      {{-- <input type="hidden" name="unitID" value="0">
                      <input type="hidden" name="parentID" value="0">
                      <input type="hidden" name="isParent" value="0">
                      <input type="hidden" name="barcode" value="0"> --}}

                      @if (auth()->user()->organization->activity == 2)
                      @if($product->TypeProdect == 1)
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="availableTime">{{ trans('Products.Isspecifictime') }}</label>
                          <h6>
                            <input type="checkbox" id="availableTime" name="availableTime" value="1" onclick="availableT()"  @if($product->sFrom !=null) @checked(true)  @endif>
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
                      @endif
                      @endif

                      <div class="col-lg-6" id="sfrom"  @if($product->sFrom !=null) style="display:block" @else style="display:none" @endif>
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">زمن توفر المنتج - من الساعة</label>
                          <input type="time"  class="form-control text-right @error('sFrom') is-invalid @enderror" id="sFrom" name="sFrom" placeholder="من الساعة"  @if($product->sFrom !=null) value='{{$product->sFrom}}' @else value=""   @endif>
                          @error('sFrom')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6" id="sto" @if($product->sFrom !=null) style="display:block" @else style="display:none" @endif>
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">زمن توفر المنتج - الى الساعة</label>
                          <input type="time"  class="form-control text-right @error('sTo') is-invalid @enderror" id="sTo" name="sTo" placeholder="الى الساعة" @if($product->sTo !=null) value='{{$product->sTo}}' @else value=""  @endif>
                          @error('sTo')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name"> {{ trans('Products.Productimage') }} </label>
                          <input type="file" class="form-control" name="img" id="img">
                          @error('img')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>

                    </div>

                  </div>
                  </div>
                  <hr class="my-4" />
                  <div class="card-header">
                    <h3 class="card-title">  {{ trans('Products.Measurementunits') }} </h3>
                    {{-- <a class="btn btn-info btnAddsys" onclick="AdduniteProdect()"><i class="fa fa-plus"></i>  {{ trans('Products.Add') }}</a> --}}
                  </div>
                  <br>
                  <div class="col-lg-8" >
                        <h5 style="color: brown;"> {{ trans('Products.fromlargesttosmallest') }} </h5>
                    <table  class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>{{ trans('Products.Productimage') }}</th>
                        <th>  {{ trans('Products.Conversionfactor') }} </th>
                        <th>  {{ trans('Products.Unitcost') }} </th>
                        <th colspan="4">{{ trans('Products.Options') }}</th>


                      </tr>
                      </thead>
                      <tbody id="trow">
                        <?php $count = 0;?>
                        <input type="hidden" id="countunitOld" name="countunitOld" value="{{count($prdUnits)}}">

                         @foreach($prdUnits as $index=> $uitem)
                          <tr>
                              <td>
                                  <select class="form-control  select2 @error('categoryID') is-invalid @enderror" id="prunit" name="prunit{{$count}}" onchange="route(this)" @if($count ==0) @readonly(true) @endif>
                                  <option value="">  {{ trans('Products.Chooseunit') }}</option>
                                  @foreach (auth()->user()->organization->units as $unit)
                                      <option value="{{$unit->id}}::{{$unit->nameAr}}" @if($uitem->unitID == $unit->id ) selected @endif>{{$unit->nameAr}}</option>
                                  @endforeach

                                  </select>
                              </td>
                              <td>
                                  <input type="text" name="uitQuantity{{$count}}"  onchange="setQuan1({{$index}})" id="uitQuantity{{$count}}" class="form-control" value="{{$uitem->quantity}}" @if($count ==0) @readonly(true) @endif>
                              </td>
                              <td>
                              <input type="text" name="pprice{{$count}}" id="pprice{{$count}}" class="form-control"  value="{{$uitem->price}}" @if($count ==0) @readonly(true) @endif>
                              </td>
                              <td>
                              <div class="form-check">
                                  <input id="TypeProdect" name="sales{{$count}}"  type="checkbox"  class="form-check-input salechecked{{$count}}" @if($uitem->sales ==1) @checked(true) @endif onchange="saleechecked({{$count}})">
                                  <label class="form-check-label" for="credit"> {{ trans('Products.Sales') }}</label>
                              </div>

                              </td>
                              <td>
                              <div class="form-check">
                                  <input id="TypeProdect" name="purchase{{$count}}"  type="checkbox"  class="form-check-input purchasechecked{{$count}}"  @if($uitem->purchase ==1) @checked(true) @endif onchange="purchasechecked({{$count}})">
                                  <label class="form-check-label" for="credit">  {{ trans('Products.purchases') }} </label>

                              </div>

                              </td>
                              <td>
                              <div class="form-check">
                                  <input id="TypeProdect" name="report{{$count}}"  type="checkbox"  class="form-check-input reportchecked{{$count}}" @if($uitem->report ==1) @checked(true) @endif onchange="reportchecked({{$count}})">
                                  <label class="form-check-label" for="credit"> {{ trans('Products.Reports') }} </label>

                              </div>

                              </td>
                              <td>
                              <div class="form-check">
                                  <input id="TypeProdect" name="compon{{$count}}"  type="checkbox"  class="form-check-input componchecked{{$count}}"  @if($uitem->compon ==1) @checked(true) @endif onchange="componchecked({{$count}})">
                                  <label class="form-check-label" for="credit">  {{ trans('Products.Ingredients') }}</label>

                              </div>

                              </td>
                          </tr>
                          <?php $count++;?>
                        @endforeach
                           @if ( count($prdUnits) ==1)
                              <tr>
                                <td>
                                    <select class="form-control  select2 @error('categoryID') is-invalid @enderror" id="prunit1" name="prunit1" onchange="route(this)" >
                                    <option value="">  {{ trans('Products.Chooseunit') }}</option>
                                    @foreach (auth()->user()->organization->units as $unit)
                                        <option value="{{$unit->id}}::{{$unit->nameAr}}">{{$unit->nameAr}}</option>
                                    @endforeach

                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="uitQuantity1"  id="uitQuantity1" class="form-control" onchange="setQuan1(1)" >
                                </td>
                                <td>
                                <input type="text" name="pprice1" id="pprice1" class="form-control">
                                </td>
                                <td>
                                <div class="form-check">
                                    <input id="TypeProdect" name="sales1"  type="checkbox"  class="form-check-input salechecked1"  onchange="saleechecked(1)">
                                    <label class="form-check-label" for="credit"> {{ trans('Products.Sales') }}</label>
                                </div>

                                </td>
                                <td>
                                <div class="form-check">
                                    <input id="TypeProdect" name="purchase1"  type="checkbox"  class="form-check-input purchasechecked1" onchange="purchasechecked(1)">
                                    <label class="form-check-label" for="credit">  {{ trans('Products.purchases') }} </label>

                                </div>

                                </td>
                                <td>
                                <div class="form-check">
                                    <input id="TypeProdect" name="report1"  type="checkbox"  class="form-check-input reportchecked1"  onchange="reportchecked(1)">
                                    <label class="form-check-label" for="credit"> {{ trans('Products.Reports') }} </label>

                                </div>

                                </td>
                                <td>
                                <div class="form-check">
                                    <input id="TypeProdect" name="compon1"  type="checkbox"  class="form-check-input componchecked1" onchange="componchecked(1)">
                                    <label class="form-check-label" for="credit">  {{ trans('Products.Ingredients') }}</label>

                                </div>

                                </td>
                              </tr>



                           @endif
                            @if ( count($prdUnits) ==2 || count($prdUnits) ==1)
                              <tr>
                                <td>
                                    <select class="form-control  select2 " id="prunit2" name="prunit2"  >
                                    <option value="">  {{ trans('Products.Chooseunit') }}</option>
                                    @foreach (auth()->user()->organization->units as $unit)
                                        <option value="{{$unit->id}}::{{$unit->nameAr}}" >{{$unit->nameAr}}</option>
                                    @endforeach

                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="uitQuantity2"  id="uitQuantity2" class="form-control" onchange="setQuan1(2)" >
                                </td>
                                <td>
                                <input type="text" name="pprice2" id="pprice2" class="form-control"  >
                                </td>
                                <td>
                                <div class="form-check">
                                    <input id="TypeProdect" name="sales2"  type="checkbox"  class="form-check-input salechecked2"  onchange="saleechecked(2)">
                                    <label class="form-check-label" for="credit"> {{ trans('Products.Sales') }}</label>
                                </div>

                                </td>
                                <td>
                                <div class="form-check">
                                    <input id="TypeProdect" name="purchase2"  type="checkbox"  class="form-check-input purchasechecked2" onchange="purchasechecked(2)" >
                                    <label class="form-check-label" for="credit">  {{ trans('Products.purchases') }} </label>

                                </div>

                                </td>
                                <td>
                                <div class="form-check">
                                    <input id="TypeProdect" name="report2"  type="checkbox"  class="form-check-input reportchecked2" onchange="reportchecked(2)">
                                    <label class="form-check-label" for="credit"> {{ trans('Products.Reports') }} </label>

                                </div>

                                </td>
                                <td>
                                <div class="form-check">
                                    <input id="TypeProdect" name="compon2"  type="checkbox"  class="form-check-input componchecked2" onchange="componchecked(2)" >
                                    <label class="form-check-label" for="credit">  {{ trans('Products.Ingredients') }}</label>

                                </div>

                                </td>
                              </tr>

                            @endif




                      </tbody>
                    </table>

                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name"> </label>
                        <br>
                        <input type="submit" class="btn btn-primary" value=" {{ trans('Products.save') }}" style="width: 100%">
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



    function saleechecked(val)
    {

        // console.log(  $("#sales2").is(':checked'));
        if(val == 0){


            $(".salechecked0").prop("checked", true);
            $(".salechecked1").prop("checked", false);
            $(".salechecked2").prop("checked", false);



        }else if(val == 1){

            $(".salechecked0").prop("checked", false);
            $(".salechecked1").prop("checked", true);
            $(".salechecked2").prop("checked", false);


        }else{
            $(".salechecked0").prop("checked", false);
            $(".salechecked1").prop("checked", false);
            $(".salechecked2").prop("checked", true);

        }


    }



    function purchasechecked(val)
    {

        // console.log(  $("#sales2").is(':checked'));
        if(val == 0){


            $(".purchasechecked0").prop("checked", true);
            $(".purchasechecked1").prop("checked", false);
            $(".purchasechecked2").prop("checked", false);

        }else if(val == 1){

            $(".purchasechecked0").prop("checked", false);
            $(".purchasechecked1").prop("checked", true);
            $(".purchasechecked2").prop("checked", false);


        }else{
            $(".purchasechecked0").prop("checked", false);
            $(".purchasechecked1").prop("checked", false);
            $(".purchasechecked2").prop("checked", true);

        }


    }

    function reportchecked(val)
    {

        // console.log(  $("#sales2").is(':checked'));
        if(val == 0){


            $(".reportchecked0").prop("checked", true);
            $(".reportchecked1").prop("checked", false);
            $(".reportchecked2").prop("checked", false);

        }else if(val == 1){

            $(".reportchecked0").prop("checked", false);
            $(".reportchecked1").prop("checked", true);
            $(".reportchecked2").prop("checked", false);


        }else{
            $(".reportchecked0").prop("checked", false);
            $(".reportchecked1").prop("checked", false);
            $(".reportchecked2").prop("checked", true);

        }


    }

    function componchecked(val)
    {

        // console.log(  $("#sales2").is(':checked'));
        if(val == 0){


            $(".componchecked0").prop("checked", true);
            $(".componchecked1").prop("checked", false);
            $(".componchecked2").prop("checked", false);

        }else if(val == 1){

            $(".componchecked0").prop("checked", false);
            $(".componchecked1").prop("checked", true);
            $(".componchecked2").prop("checked", false);


        }else{
            $(".componchecked0").prop("checked", false);
            $(".componchecked1").prop("checked", false);
            $(".componchecked2").prop("checked", true);

        }


    }
</script>


<script>

function setQuan1(val)
{




        var price = Number (document.getElementById('pprice'+(val-1)).value);
        var qun = Number (document.getElementById('uitQuantity'+val).value);


        var total = price /qun;

        document.getElementById('pprice'+val).value = total.toFixed(3);


}


    function AdduniteProdect(){


        countunitnew=  document.getElementById('countunitnew').value;

        if(parseInt(countunitnew)+1 <3 ){

            countunitnew =parseInt(countunitnew)+1;
            data="";
            data=data+'<tr><td>  <select class="form-control select2" id="prunit'+countunitnew+'" name="prunit'+countunitnew+'"><option value="">  {{ trans("Products.Chooseunit") }}</option>';
            @foreach (auth()->user()->organization->units as $unit)
            data=data+'<option value="{{$unit->id}}::{{$unit->nameAr}}">{{$unit->nameAr}}</option>';
            @endforeach
            data=data+' </select>  </td>   <td> <input type="text"  name="uitQuantity'+countunitnew+'" onchange="setQuan1('+countunitnew+')" id="uitQuantity'+countunitnew+'" class="form-control">  </td>';
            data=data+'</td>   <td> <input type="text" name="pprice'+countunitnew+'" id="pprice'+countunitnew+'"  class="form-control">  </td>';
            data=data+'<td>   <div class="form-check">    <input id="sales0" name="sales'+countunitnew+'"  type="checkbox"  class="form-check-input" >    <label class="form-check-label" for="credit"> {{ trans("Products.Sales") }}</label>  </div> </td>';
            data=data+' <td> <div class="form-check">  <input id="typepto" name="purchase'+countunitnew+'"  type="checkbox"  class="form-check-input" ><label class="form-check-label" for="credit"> {{ trans("Products.purchases") }}</label>  </div>     </td>';
            data=data+' <td>  <div class="form-check">  <input id="TypeProdect" name="report'+countunitnew+'"  type="checkbox"  class="form-check-input" ><label class="form-check-label" for="credit">  {{ trans("Products.Reports") }} </label>   </div>  </td>'
            data=data+'  <td> <div class="form-check"> <input id="TypeProdect" name="compon'+countunitnew+'"  type="checkbox"  class="form-check-inputr" > <label class="form-check-label" for="credit">  {{ trans("Products.Ingredients") }} </label> </div>    </td> </tr>';

        $('#trow').append(data);
        document.getElementById('countunitnew').value=countunitnew;
       }else{

       }


    }

    function handleChange1(val)
    {

     $('.CodeProdectAll').hide();
     $('.PrintALlitems').hide();
     $('.PrisentAllItems').hide();
     $('.UniteAllItems').hide();
     $('.prodDet').show();

     $('#catTasnee').hide();
     $('#purQuest').hide();
     $('.CaloriesAllitems').show();
     $('.KitChenAllItewms').show();
     $('.ProdectPriceAllItems').show();
     $('#prodPrice').val('');

     data ="";
     @foreach(auth()->user()->organization->prodcategoriesKatcSaller as $product )
                data = data+'<option value="{{$product->id}}">{{$product->nameAr }}</option>';
     @endforeach

     $('.CategouryAllitemsKat').empty();

     $('.CategouryAllitemsKat').append(data);
    }

    function handleChange2(val)
    {

     $('.CodeProdectAll').show();
     $('.PrintALlitems').show();
     $('.PrisentAllItems').show();
     $('.UniteAllItems').show();
     $('.ProdectPriceAllItems').hide();

     $('#catTasnee').hide();
     $('#purQuest').show();
     $('.CaloriesAllitems').hide();
     $('.KitChenAllItewms').hide();

     $('#prodPrice').val('0');
     $('.prodDet').hide();
     data ="";
     @foreach(auth()->user()->organization->prodcategoriesKatPuches as $product )
                data = data+'<option value="{{$product->id}}">{{$product->nameAr }}</option>';
     @endforeach

     $('.CategouryAllitemsKat').empty();

     $('.CategouryAllitemsKat').append(data);


    }
    function handleChange3(val)
    {

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
     data ="";
     @foreach(auth()->user()->organization->prodcategoriesKatPuches as $product )
                data = data+'<option value="{{$product->id}}">{{$product->nameAr }}</option>';
     @endforeach

     $('.CategouryAllitemsKat').empty();

     $('.CategouryAllitemsKat').append(data);


    }


</script>


<script>
  function availableT() {
    if(document.getElementById('availableTime').checked == true){
      document.getElementById('sfrom').style.display = "block";
      document.getElementById('sto').style.display = "block";
    }else{
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

function route2(obj){

    if(obj.value == -1)
    {
      window.location.href = "/units/create"
    };
   document.getElementById('prunit').value =obj.value;
  }

// function setUnits(obj){
//    alert();
//    document.getElementById('prunit').value = =obj.value;
//   }



  $('#saleable').change(function(){


    $('#catSale').show();
    $('.ProdectPriceAllItems').show();



  });
  $('#notsaleable').change(function(){


    $('#catSale').hide();
    $('.ProdectPriceAllItems').hide();

  });


  $('#costPrice').change(function(){

     document.getElementById('pprice0').value =  document.getElementById('costPrice').value;

     var price = Number (document.getElementById('pprice0').value);
    var qun = Number (document.getElementById('uitQuantity1').value);
    var cost = Number (document.getElementById('costPrice').value);
    var total = price /qun;
    document.getElementById('pprice1').value = total.toFixed(3);

    ////////////////////////////////////////////////////////////////
    var price = Number (document.getElementById('pprice1').value);
    var qun = Number (document.getElementById('uitQuantity2').value);
    var cost = Number (document.getElementById('costPrice').value);

    var total = price /qun;


    document.getElementById('pprice2').value = total.toFixed(3);

  });

  $('#prodPrice').change(function(){

document.getElementById('pprice0').value =  document.getElementById('prodPrice').value;

var price = Number (document.getElementById('pprice0').value);
var qun = Number (document.getElementById('uitQuantity1').value);
var cost = Number (document.getElementById('prodPrice').value);
var total = price /qun;
document.getElementById('pprice1').value = total.toFixed(3);

////////////////////////////////////////////////////////////////
var price = Number (document.getElementById('pprice1').value);
var qun = Number (document.getElementById('uitQuantity2').value);
var cost = Number (document.getElementById('prodPrice').value);

var total = price /qun;


document.getElementById('pprice2').value = total.toFixed(3);

});

  $('#uitQuantity1').change(function(){

    var price = Number (document.getElementById('pprice0').value);
    var qun = Number (document.getElementById('uitQuantity1').value);
    var cost = Number (document.getElementById('costPrice').value);

    var total = price /qun;

    document.getElementById('pprice1').value = total.toFixed(3);

    //////////////

    var qun2 = Number (document.getElementById('uitQuantity2').value);
    if((qun2 != null) && (qun2 > 0) )
    {
        var total2 = total.toFixed(3) /qun2;

    document.getElementById('pprice2').value = total2.toFixed(3);
    }
});
$('#uitQuantity2').change(function(){

    var price = Number (document.getElementById('pprice1').value);
    var qun = Number (document.getElementById('uitQuantity2').value);
    var cost = Number (document.getElementById('costPrice').value);

    var total = price /qun;


    document.getElementById('pprice2').value = total.toFixed(3);
});


</script>
@endsection
<script>
    $(":input").keypress(function(event){
    if (event.which == '10' || event.which == '13') {
        event.preventDefault();
    }
});

</script>
