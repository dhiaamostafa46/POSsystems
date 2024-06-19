@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">المنتجات</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">قائمة المنتجات</a></li>
          <li class="breadcrumb-item active">اضافة منتج</li>
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
                <h3 class="card-title">اضافة منتج جديد</h3>
              </div>
              <div class="card-body">
                @if (count(auth()->user()->organization->prodcategories) == 0)
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>عذراً لا يوجد  اقسام للمنتجات </strong> <a href="{{route('prodcategories.create')}}">اضغط هنا لإضافة قسم</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                @if (auth()->user()->organization->activity == 1)
                  @if (count(auth()->user()->organization->units) == 0)
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>عذراً لا يوجد  وحدات للمنتجات </strong> <a href="{{route('units.create')}}">اضغط هنا لإضافة وحدة</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
                @endif
                {{-- @if($err != null)<strong>عفوا يجب  تحديد وحدة المقادير</strong> @endif --}}
                <form class="user" method="POST" action="{{ route('products.store') }}" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      @if(auth()->user()->organization->activity == 2)
                         <div class="col-lg-6">
                          <div class="row">
                            <div class="col-lg-3">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username"> نوع المنتج    </label>
                                  
                                    
                                    
                              </div>
                            </div>
                            <div class="col-lg-3">
                              <div class="form-group">
                                <input type="hidden" id="oldtypeval" value="{{old('TypeProdect')}}">
                                <div class="form-check">
                                  <input id="TypeProdect" name="TypeProdect" value="1" type="radio" onchange="handleChange1(this)" class="form-check-input" @if(old('TypeProdect') ==1 )  @checked(true)  @endif >
                                  <label class="form-check-label" for="credit"> مبيعات</label>
                                  </div>
                                    
                                    
                              </div>
                            </div>
                            
                            <div class="col-lg-3">
                              <div class="form-group">
                              
                                  
                                    
                                    <div class="form-check">
                                    <input id="TypeProdect" name="TypeProdect" value="2" type="radio" onchange="handleChange2(this)" class="form-check-input"  @if(old('TypeProdect') ==2 )  @checked(true)  @endif>
                                    <label class="form-check-label" for="debit"> مشتريات </label>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3">
                              <div class="form-group">
                              
                                  
                                    
                                    <div class="form-check">
                                    <input id="TypeProdect" name="TypeProdect" value="3" type="radio" onchange="handleChange3(this)" class="form-check-input" @if(old('TypeProdect') ==3 )  @checked(true)  @endif>
                                    <label class="form-check-label" for="debit"> تصنيع </label>
                                </div>
                              </div>
                            </div>


                          </div>
                         
                         </div>
                         <div class="col-lg-6">
                         </div>
                         <div class="col-lg-6" id="purQuest" style="display: none;">
                          <input type="hidden" id="oldsaleable" value="{{old('saleable')}}">
                          
                          <div class="row">
                            <div class="col-lg-3">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username">هل المنتج قابل للبيع</label>
                                  
                                    
                                    
                              </div>
                            </div>
                            <div class="col-lg-3">
                              <div class="form-group">
                              
                                <div class="form-check">
                                  <input name="saleable" id="saleable" value="1" type="radio" class="form-check-input"  onchange="issalable()" @if(old('saleable') == 1 )  @checked(true)  @endif>
                                  <label class="form-check-label" for="credit"> نعم</label>
                                </div>
                                    
                                    
                              </div>
                            </div>
                            
                            <div class="col-lg-3">
                              <div class="form-group">
                              
                                  
                                    
                                    <div class="form-check">
                                    <input  name="saleable" value="0" id="notsaleable" type="radio" class="form-check-input" checked="true" onchange="isnotsalable()" @if(old('saleable') == 0 )  @checked(true)  @endif>
                                    <label class="form-check-label" for="debit"> لا </label>
                                </div>
                              </div>
                            </div>
                          
                          </div>
                         
                         </div>
                         {{-- <div class="col-lg-6">
                         </div> --}}
                      @endif
                       {{-- @if(auth()->user()->organization->activity == 1) --}}
                        <div class="col-lg-6 CodeProdectAll"  @if(auth()->user()->organization->activity == 2) style="display: none" @endif>
                            <div class="form-group">
                            <label class="form-control-label prodDet" for="input-username">كود المنتج</label>
                            <input type="text"  class="form-control prodDet @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="ادخل كود المنتج" value="{{ old('barcode') }}">
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
                          <label class="form-control-label" for="input-username">اسم المنتج - عربي</label>
                          <input type="text"  class="form-control @error('nameAr') is-invalid @enderror" id="nameAr" name="nameAr" value="{{ old('nameAr') }}" placeholder="اكتب اسم المنتج - عربي">
                          @error('nameAr')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">اسم المنتج - انجليزي</label>
                          <input type="text"  class="form-control @error('nameEn') is-invalid @enderror" id="nameEn"  onkeypress="return ValidateKey();" name="nameEn" placeholder="اكتب اسم المنتج - انجليزي" value="{{ old('nameEn') }}">
                          @error('nameEn')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      @if(auth()->user()->organization->activity == 2)
                    
                      <div class="col-lg-6 prodDet">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">تفاصيل المنتج - عربي</label>
                          <textarea class="form-control @error('detailsAr') is-invalid @enderror" id="detailsAr" name="detailsAr" placeholder="اكتب تفاصيل المنتج - عربي">
                            @if(old('detailsAr') != null)  {{old('detailsAr')}} @endif
                          </textarea>
                          @error('detailsAr')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6 prodDet" >
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">تفاصيل المنتج - انجليزي</label>
                          <textarea class="form-control @error('detailsEn') is-invalid @enderror" id="detailsEn" name="detailsEn" placeholder="اكتب تفاصيل المنتج - انجليزي">
                            @if(old('detailsEn') != null)  {{old('detailsEn')}} @endif
                          </textarea>
                          @error('detailsEn')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                  
                      <div class="col-lg-6 CaloriesAllitems">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">عدد السعرات</label>
                          <input type="number" class="form-control @error('calories') is-invalid @enderror" id="calories" name="calories" placeholder="ادخل سعرات الصنف" value="{{old('calories')}}">
                          @error('calories')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      @endif

                      @if(auth()->user()->organization->activity == 2)
                      <div class="col-lg-6" id="fscat">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">قسم المنتج</label>
                          <select class="form-control CategouryAllitemsKat select2 @error('categoryID') is-invalid @enderror" id="categoryID" name="categoryID" onchange="route(this)" >
                            <option value=""></option>
                            @foreach (auth()->user()->organization->prodcategoriesKatcSaller as $cat)
                              <option value="{{$cat->id}}" @if(old('categoryID') ==$cat->id )  @selected(true)  @endif>{{$cat->nameAr}}</option>
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
                      <div class="col-lg-6" id="catSale" style="display:none;">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">قسم مبيعات</label>
                          <select class="form-control select2 @error('categoryID') is-invalid @enderror" id="scategoryID" name="scategoryID" onchange="route(this)">
                            <option value="" >اختر القسم</option>
                            @foreach (auth()->user()->organization->prodcategoriesKatcSaller as $cat)
                              <option value="{{$cat->id}}" @if(old('scategoryID') ==$cat->id )  @selected(true)  @endif>{{$cat->nameAr}}</option>
                            @endforeach
                              <option value="-1">اضافة قسم</option>
                          </select>
                          @error('scategoryID')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6" id="catTasnee" style="display:none;">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">القسم  </label>
                          <select class="form-control select2 @error('tcategoryID') is-invalid @enderror" id="tcategoryID" name="tcategoryID" onchange="route(this)">
                            <option value="">اختر القسم</option>
                            @if(auth()->user()->organization->productTsnee != null)
                            @foreach (auth()->user()->organization->productTsnee as $tcat)
                              <option value="{{$tcat->id}}" @if(old('tcategoryID') ==$tcat->id )  @selected(true)  @endif>{{$tcat->nameAr}}</option>
                            @endforeach
                            @endif
                            
                          </select>
                          @error('tcategoryID')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      @endif
                      @if(auth()->user()->organization->activity == 1)
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">قسم المنتج</label>
                          <select class="form-control  select2 @error('categoryID') is-invalid @enderror" id="categoryID" name="categoryID" onchange="route(this)">
                            <option value="">اختر القسم</option>
                            @foreach (auth()->user()->organization->prodcategories as $cat)
                              <option value="{{$cat->id}}" @if(old('categoryID') ==$cat->id )  @selected(true)  @endif>{{$cat->nameAr}}</option>
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
                      <div class="col-lg-6  KitChenAllItewms">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">المطبخ </label>
                          <select class="form-control @error('kitchenID') is-invalid @enderror" id="kitchenID" name="kitchenID" onchange="route(this)">
                            <option value="">اختر المطبخ</option>
                            @foreach (auth()->user()->organization->kitchens as $kit)
                              <option value="{{$kit->id}}" @if(old('kitchenID') ==$kit->id )  @selected(true)  @endif>{{$kit->nameAr}}</option>
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
                      <div class="col-lg-6">
                        <div class="form-group">
                          @if(auth()->user()->organization->activity == 1)
                          <label class="form-control-label" for="input-username">سعر الشراء</label>
                          @else
                          <label class="form-control-label" for="input-username"> سعر التكلفة  (الشراء)</label>
                          @endif
                          <input type="number" class="form-control @error('costPrice') is-invalid  @enderror" id="costPrice" name="costPrice" placeholder="اكتب سعر الشراء" value="{{old('costPrice')}}">
                          @error('costPrice')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6 ProdectPriceAllItems" >
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">سعر البيع شامل الضريبة</label>
                          <input type="number"  step='any'  class="form-control @error('prodPrice') is-invalid @enderror"  id="prodPrice" name="prodPrice" placeholder="اكتب سعر البيع" value="{{old('prodPrice')}}">
                          @error('prodPrice')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الضريبة %</label>
                          <select class="form-control @error('vat') is-invalid @enderror" id="vat" name="vat">
                          <option value="15" @if(old('vat') == 15 )  @selected(true)  @endif>15%</option>
                          <option value="0" @if(old('vat') == 0 )  @selected(true)  @endif>0%</option>
                          </select>
                          @error('vat')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                    
                      <div class="col-lg-6 UniteAllItems" id="orgUnit" @if(auth()->user()->organization->activity == 2) style="display: none" @endif >
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الوحدة</label>
                          <select class="form-control @error('unitID') is-invalid @enderror" id="unitID" name="unitID" onchange="route2(this)">
                            <option value="">اختر الوحدة</option>
                            @foreach (auth()->user()->organization->units as $unit)
                              <option value="{{$unit->id}}::{{$unit->nameAr}}" @if(old('unitID') == $unit->id )  @selected(true)  @endif>{{$unit->nameAr}}</option>
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
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="availableTime">المنتج متوفر في زمن محدد؟</label>
                          <h6>
                            <input type="checkbox" id="availableTime" name="availableTime" value="1" onclick="availableT()">
                            <label for="availableTime">
                              &nbsp;&nbsp;
                                نعم
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

                      <div class="col-lg-6" id="sfrom" style="display: none">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">زمن توفر المنتج - من الساعة</label>
                          <input type="time"  class="form-control text-right @error('sFrom') is-invalid @enderror" id="sFrom" name="sFrom" placeholder="من الساعة">
                          @error('sFrom')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6" id="sto" style="display: none">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">زمن توفر المنتج - الى الساعة</label>
                          <input type="time"  class="form-control text-right @error('sTo') is-invalid @enderror" id="sTo" name="sTo" placeholder="الى الساعة">
                          @error('sTo')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">صورة المنتج</label>
                          <input type="file" class="form-control" name="img" id="img" value="{{old('img')}}">
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
                    <h3 class="card-title">وحدات القياس </h3>
                  </div>
                  <br>
                  <div class="col-lg-8" >
                        <h5 style="color: brown;">(من الأكبر إلى الأصغر)</h5>
                    <table  class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>الوحدة</th>
                        <th>معامل التحويل</th>
                        <th>تكلفة الوحدة</th>
                        <th colspan="4">خيارات</th>
               
                     
                      </tr>
                      </thead>
                      <tbody id="trow">
                        <tr>
                          <td>
                            <select class="form-control  select2 @error('prunit0') is-invalid @enderror" id="prunit" name="prunit0" onchange="route(this)" @readonly(true)>
                              <option value="">اختر الوحدة</option>
                              @foreach (auth()->user()->organization->units as $unit)
                                <option value="{{$unit->id}}::{{$unit->nameAr}}">{{$unit->nameAr}}</option>
                              @endforeach
                               
                            </select>
                          </td>
                        <td>
                          <input type="text" name="uitQuantity0" class="form-control" value="1" readonly>
                        </td>
                        <td>
                          <input type="text" name="pprice0" id="pprice0" class="form-control" readonly>
                        </td>
                        <td>
                          <div class="form-check">
                            <input id="TypeProdect" name="sales0"  type="checkbox"  class="form-check-input">
                            <label class="form-check-label" for="credit"> مبيعات</label>
                          </div>
                            
                        </td>
                        <td>
                          <div class="form-check">
                            <input id="TypeProdect" name="purchase0"  type="checkbox"  class="form-check-input">
                            <label class="form-check-label" for="credit"> مشتريات</label>
                           
                          </div>
                            
                        </td>
                        <td>
                          <div class="form-check">
                            <input id="TypeProdect" name="report0"  type="checkbox"  class="form-check-input">
                            <label class="form-check-label" for="credit"> تقارير</label>
                           
                          </div>
                            
                        </td>
                        <td>
                          <div class="form-check">
                            <input id="TypeProdect" name="compon0"  type="checkbox"  class="form-check-input @error('compon0') is-invalid  @enderror">
                            <label class="form-check-label" for="credit"> مقادير</label>
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
                          <select class="form-control  select2 @error('prunit1') is-invalid @enderror" id="prunit" name="prunit1" onchange="route(this)">
                            <option value="">اختر الوحدة</option>
                            @foreach (auth()->user()->organization->units as $unit)
                              <option value="{{$unit->id}}::{{$unit->nameAr}}">{{$unit->nameAr}}</option>
                            @endforeach
                             
                          </select>
                        </td>
                      <td>
                        <input type="text" name="uitQuantity1" id="uitQuantity1" class="form-control">
                      </td>
                      <td>
                        <input type="text" name="pprice1" id="pprice1" class="form-control" >
                      </td>
                      <td>
                        <div class="form-check">
                          <input id="TypeProdect" name="sales1"  type="checkbox"  class="form-check-input">
                          <label class="form-check-label" for="credit"> مبيعات</label>
                        </div>
                          
                      </td>
                      <td>
                        <div class="form-check">
                          <input id="TypeProdect" name="purchase1"  type="checkbox"  class="form-check-input">
                          <label class="form-check-label" for="credit"> مشتريات</label>
                         
                        </div>
                          
                      </td>
                      <td>
                        <div class="form-check">
                          <input id="TypeProdect" name="report1"  type="checkbox"  class="form-check-input">
                          <label class="form-check-label" for="credit"> تقارير</label>
                         
                        </div>
                          
                      </td>
                      <td>
                        <div class="form-check">
                          <input id="TypeProdect" name="compon1"  type="checkbox"  class="form-check-input">
                          <label class="form-check-label" for="credit"> مقادير</label>
                         
                        </div>
                          
                      </td>
                     
                     
                    </tr>
                    <tr>
                      <td>
                        <select class="form-control  select2 @error('prunit2') is-invalid @enderror" id="prunit" name="prunit2" onchange="route(this)">
                          <option value="">اختر الوحدة</option>
                          @foreach (auth()->user()->organization->units as $unit)
                            <option value="{{$unit->id}}::{{$unit->nameAr}}">{{$unit->nameAr}}</option>
                          @endforeach
                           
                        </select>
                      </td>
                    <td>
                      <input type="text" name="uitQuantity2" id="uitQuantity2" class="form-control">
                    </td>
                    <td>
                      <input type="text" name="pprice2" id="pprice2" class="form-control" >
                    </td>
                    <td>
                      <div class="form-check">
                        <input id="TypeProdect" name="sales2"  type="checkbox"  class="form-check-input">
                        <label class="form-check-label" for="credit"> مبيعات</label>
                      </div>
                        
                    </td>
                    <td>
                      <div class="form-check">
                        <input id="TypeProdect" name="purchase2"  type="checkbox"  class="form-check-input">
                        <label class="form-check-label" for="credit"> مشتريات</label>
                       
                      </div>
                        
                    </td>
                    <td>
                      <div class="form-check">
                        <input id="TypeProdect" name="report2"  type="checkbox"  class="form-check-input">
                        <label class="form-check-label" for="credit"> تقارير</label>
                       
                      </div>
                        
                    </td>
                    <td>
                      <div class="form-check">
                        <input id="TypeProdect" name="compon2"  type="checkbox"  class="form-check-input">
                        <label class="form-check-label" for="credit"> مقادير</label>
                       
                      </div>
                        
                    </td>
                   
                   
                  </tr>
                      </tbody>
                    </table>
                         
                  </div>
                 
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name"> </label>
                        <br>
                        <input type="submit" class="btn btn-primary" id="save" value="حفظ" style="width: 100%" disabled>
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

<!-- Customers Modal -->
<!------------------------------------add saeed -------------------------------------------------->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">





<script>

$(document).ready(function(){

  //alert(document.getElementById('oldtypeval').value);
  var prodval = document.getElementById('oldtypeval').value;
  var saleable = document.getElementById('oldsaleable').value;
  if(prodval == 1)
  {
    handleChange1(prodval);
  }else if(prodval == 2)
  {
    
    handleChange2(prodval);
    if(saleable  == 1)
    {
      
      issalable();
    }else
    {
      isnotsalable();
    }
  }
});
    function handleChange1(val)
    {
   

      document.getElementById('save').disabled = false;
     $('.CodeProdectAll').hide();
     $('.PrintALlitems').hide();
     $('.PrisentAllItems').hide();
     $('.UniteAllItems').show();
     $('.prodDet').show();
     
     
     
      //$('#costPrice').hide();
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
      document.getElementById('save').disabled = false;
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


   function issalable() 
   {
    $('#catSale').show();
    $('.ProdectPriceAllItems').show();
    $('.KitChenAllItewms').show();
   }

   function isnotsalable() 
   {
    $('#catSale').hide();
    $('.ProdectPriceAllItems').hide();
    $('.KitChenAllItewms').hide();
   }
  

  
  $('#costPrice').change(function(){

   

     document.getElementById('pprice0').value =  document.getElementById('costPrice').value;
  });
  $('#uitQuantity1').change(function(){
   
    var price = Number (document.getElementById('pprice0').value);
    var qun = Number (document.getElementById('uitQuantity1').value);
    var cost = Number (document.getElementById('costPrice').value);

    var total = price /qun;
   //alert(total);
   // document.getElementById('pprice1').value = Math.round(total * cost);
    document.getElementById('pprice1').value = total.toFixed(3);
});
$('#prodPrice').change(function(){
    var cehk =document.getElementById('saleable').value;
    var cehk2 =document.getElementById('TypeProdect').value;
    
    //alert(cehk2);
    if((cehk !=1) && (cehk2 !=2))
    {
      
        document.getElementById('pprice0').value =  document.getElementById('prodPrice').value;
     }
     if (cehk2 == 1)
     {
                 document.getElementById('pprice0').value =  document.getElementById('prodPrice').value;
     }
});
$('#uitQuantity1').change(function(){

var price = Number (document.getElementById('pprice0').value);
var qun = Number (document.getElementById('uitQuantity1').value);
var cost = Number (document.getElementById('costPrice').value);

var total = price /qun;
//alert(total);
// document.getElementById('pprice1').value = Math.round(total * cost);
document.getElementById('pprice1').value = total.toFixed(3);
});
$('#uitQuantity2').change(function(){
    
    var price = Number (document.getElementById('pprice1').value);
    var qun = Number (document.getElementById('uitQuantity2').value);
    var cost = Number (document.getElementById('costPrice').value);

    var total = price /qun;
 
    //Math.round(total * cost);
   // document.getElementById('pprice2').value =Math.round(total * cost)
    document.getElementById('pprice2').value = total.toFixed(3);
});
   
$('.livesearch').select2({
        placeholder: 'أدخل كود الإطار',
        ajax: {
            url: '/prod-autocomplete-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nameAr+"-"+item.prodPrice,
                            id: item.id
                           
                        }
                    })
                };
            },
            cache: true
        }
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
