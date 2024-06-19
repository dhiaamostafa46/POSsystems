@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">قائمة المنتجات</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">قائمة المنتجات</a></li>
          <li class="breadcrumb-item active">تعديل منتج</li>
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
                <h3 class="card-title">تعديل منتج</h3>
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

                <form class="user" method="POST" action="{{ route('products.UpdateAll',$product->id) }}" enctype = "multipart/form-data">
                    @csrf
                   {{-- @method('PUT') --}}
                  <div class="pl-lg-4">
                    <div class="row">
                      @if(auth()->user()->organization->activity == 2)
                         <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username"> نوع المنتج    </label>
                                <div class="form-check">
                                <input id="TypeProdect" @if ($product->TypeProdect==1) checked="" @endif name="TypeProdect" value="1" type="radio" onchange="handleChange1(this)" class="form-check-input" >
                                <label class="form-check-label" for="credit"> مبيعات</label>
                                </div>
                                <div class="form-check">
                                <input id="TypeProdect" @if ($product->TypeProdect==2) checked="" @endif name="TypeProdect" value="2" type="radio" onchange="handleChange2(this)" class="form-check-input" >
                                <label class="form-check-label" for="debit"> مشتريات </label>
                            </div>
                          </div>
                         </div>
                      @endif
                       {{-- @if(auth()->user()->organization->activity == 1) --}}
                        <div class="col-lg-6 CodeProdectAll"  @if(auth()->user()->organization->activity == 2) style="display: none" @endif>
                            <div class="form-group">
                            <label class="form-control-label" for="input-username">كود المنتج</label>
                            <input type="text"  class="form-control @error('barcode') is-invalid @enderror" id="barcode" value="{{$product->barcode}}" name="barcode" placeholder="ادخل كود المنتج">
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
                          <input type="text"  class="form-control @error('nameAr') is-invalid @enderror" id="nameAr" name="nameAr" value="{{$product->nameAr}}" placeholder="اكتب اسم المنتج - عربي">
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
                          <input type="text"  class="form-control @error('nameEn') is-invalid @enderror" id="nameEn" value="{{$product->nameEn}}"  onkeypress="return ValidateKey();" name="nameEn" placeholder="اكتب اسم المنتج - انجليزي">
                          @error('nameEn')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      @if(auth()->user()->organization->activity == 2)
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">تفاصيل المنتج - عربي</label>
                          <textarea class="form-control @error('detailsAr') is-invalid @enderror" id="detailsAr" name="detailsAr" placeholder="اكتب تفاصيل المنتج - عربي">{{$product->detailsAr}}</textarea>
                          @error('detailsAr')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">تفاصيل المنتج - انجليزي</label>
                          <textarea class="form-control @error('detailsEn') is-invalid @enderror" id="detailsEn" name="detailsEn" placeholder="اكتب تفاصيل المنتج - انجليزي">{{$product->detailsEn}}</textarea>
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
                          <input type="number" class="form-control @error('calories') is-invalid @enderror" id="calories" value="{{$product->calories}}" name="calories" placeholder="ادخل سعرات الصنف">
                          @error('calories')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      @endif

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">قسم المنتج</label>
                          <select class="form-control CategouryAllitemsKat select2 @error('categoryID') is-invalid @enderror" id="categoryID" name="categoryID" onchange="route(this)">
                            <option value="">اختر القسم</option>
                            @foreach (auth()->user()->organization->prodcategoriesKatcSaller as $cat)
                              <option value="{{$cat->id}}" @if($product->categoryID == $cat->id) selected @endif>{{$cat->nameAr}}</option>
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

                      @if(auth()->user()->organization->activity == 2)
                      <div class="col-lg-6  KitChenAllItewms">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">مطبخ الصنف</label>
                          <select class="form-control @error('kitchenID') is-invalid @enderror" id="kitchenID" name="kitchenID" onchange="route(this)">
                            <option value="">اختر المطبخ</option>
                            @foreach (auth()->user()->organization->kitchens as $kit)
                              <option value="{{$kit->id}}">{{$kit->nameAr}}</option>
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
                      @endif
                      <div class="col-lg-6">
                        <div class="form-group">
                          @if(auth()->user()->organization->activity == 1)
                          <label class="form-control-label" for="input-username">سعر الشراء</label>
                          @else
                          <label class="form-control-label" for="input-username">سعر التكلفة</label>
                          @endif
                          <input type="number" class="form-control @error('costPrice') is-invalid @enderror" id="costPrice" name="costPrice" placeholder="اكتب سعر الشراء" value="{{$product->costPrice}}">
                          @error('costPrice')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6 ProdectPriceAllItems">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">سعر البيع</label>
                          <input type="number"  step='any'  class="form-control @error('prodPrice') is-invalid @enderror" id="prodPrice" name="prodPrice" placeholder="اكتب سعر البيع"  value="{{$product->prodPrice}}">
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
                          <input type="number" class="form-control @error('vat') is-invalid @enderror" id="vat" name="vat"  value="{{$product->vat}}">
                          @error('vat')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6 PrintALlitems"  @if(auth()->user()->organization->activity == 2) style="display: none" @endif>
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">رتبة المنتج</label>
                          <select class="form-control @error('isParent') is-invalid @enderror" id="isParent" name="isParent" onchange="setPID()">
                            <option value="">اختر رتبة المنتج</option>
                            <option value="0" @if($product->isParent == 0) selected @endif>ابن</option>
                            <option value="1" @if($product->isParent == 1) selected @endif>أب</option>
                            <option value="1">جد</option>
                          </select>
                          @error('isParent')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6 PrisentAllItems" id="pID" @if(auth()->user()->organization->activity == 2) style="display: none" @endif>
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">المنتج الأب في حالة وجوده</label>
                          <select class="form-control @error('parentID') is-invalid @enderror" id="parentID" name="parentID">
                            <option value="0">اختر المنتج</option>
                            @foreach (auth()->user()->organization->pProducts as $item)

                                <option value="{{$item->id}}" @if($product->parentID == $item->id) selected @endif>{{$item->nameAr}}</option>
                            @endforeach
                          </select>
                          @error('parentID')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6 UniteAllItems"  @if(auth()->user()->organization->activity == 2) style="display: none" @endif>
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الوحدة</label>
                          <select class="form-control @error('unitID') is-invalid @enderror" id="unitID" name="unitID" onchange="route2(this)">
                            <option value="0">اختر الوحدة</option>
                            @foreach (auth()->user()->organization->units as $unit)
                              <option value="{{$unit->id}}" @if($product->unitID == $unit->id) selected @endif>{{$unit->nameAr}}</option>
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
                          <input type="time"  class="form-control text-right @error('sFrom') is-invalid @enderror" id="sFrom" name="sFrom" placeholder="من الساعة" value="{{$product->sFrom}}">
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
                          <input type="time"  class="form-control text-right @error('sTo') is-invalid @enderror" id="sTo" name="sTo" placeholder="الى الساعة" value="{{$product->sTo}}">
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
                          <input type="file" class="form-control" name="img" id="img">
                          @error('img')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <input type="submit" class="btn btn-primary" value="حفظ" style="width: 100%">
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <hr class="my-4" />
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
// window.addEventListener('DOMContentLoaded', function() {
//   console.log('window - DOMContentLoaded - capture'); // 1st
// }, true);
// document.addEventListener('DOMContentLoaded', function() {
//   console.log('document - DOMContentLoaded - capture'); // 2nd
// }, true);
// document.addEventListener('DOMContentLoaded', function() {
//   console.log('document - DOMContentLoaded - bubble'); // 2nd
// });
// window.addEventListener('DOMContentLoaded', function() {
//   console.log('window - DOMContentLoaded - bubble'); // 3rd
// });

// window.addEventListener('load', function() {
//   console.log('window - load - capture'); // 4th
// }, true);
// document.addEventListener('load', function(e) {
//   /* Filter out load events not related to the document */
//   if(['style','script'].indexOf(e.target.tagName.toLowerCase()) < 0)
//     console.log('document - load - capture'); // DOES NOT HAPPEN
// }, true);
// document.addEventListener('load', function() {
//   console.log('document - load - bubble'); // DOES NOT HAPPEN
// });
// window.addEventListener('load', function() {
//   console.log('window - load - bubble'); // 4th
// });

// window.onload = function() {
//   console.log('window - onload'); // 4th
// };
// document.onload = function() {
//   console.log('document - onload'); // DOES NOT HAPPEN
// };
</script>



<script>
    function handleChange1(val)
    {

     $('.CodeProdectAll').hide();
     $('.PrintALlitems').hide();
     $('.PrisentAllItems').hide();
     $('.UniteAllItems').hide();

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

  function route(obj){
    if(obj.value == -1)
    {
      window.location.href = "/prodcategories/create"
    };
  }

  function route2(obj){
    if(obj.value == -1)
    {
      window.location.href = "/units/create"
    };
  }


</script>
@endsection
<script>
    $(":input").keypress(function(event){
    if (event.which == '10' || event.which == '13') {
        event.preventDefault();
    }
});
</script>
