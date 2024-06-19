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
                <form class="user" method="POST" action="{{ route('products.update',$product->id) }}" enctype = "multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">اسم المنتج - عربي</label>
                          <input type="text"  class="form-control @error('nameAr') is-invalid @enderror" id="nameAr" name="nameAr" placeholder="اكتب اسم القسم - عربي" value="{{$product->nameAr}}">
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
                          <input type="text"  class="form-control @error('nameEn') is-invalid @enderror" id="nameEn"  onkeypress="return ValidateKey();" name="nameEn" placeholder="اكتب اسم القسم - انجليزي" value="{{$product->nameEn}}">
                          @error('nameEn')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">كود المنتج</label>
                          <input type="text"  class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="ادخل كود المنتج" value="{{$product->barcode}}">
                          @error('barcode')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">قسم المنتج</label>
                          <select class="form-control @error('categoryID') is-invalid @enderror" id="categoryID" name="categoryID">
                            <option value="">اختر القسم</option>
                            @foreach (auth()->user()->organization->prodcategories as $cat)
                              <option value="{{$cat->id}}" @if($product->categoryID == $cat->id) selected @endif>{{$cat->nameAr}}</option>
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
                          <label class="form-control-label" for="input-username">سعر الشراء</label>
                          <input type="number" class="form-control @error('costPrice') is-invalid @enderror" id="costPrice" name="costPrice" placeholder="اكتب سعر الشراء" value="{{$product->costPrice}}">
                          @error('costPrice')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">سعر البيع</label>
                          <input type="number" class="form-control @error('prodPrice') is-invalid @enderror" id="prodPrice" name="prodPrice" placeholder="اكتب سعر البيع" value="{{$product->prodPrice}}">
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
                      <div class="col-lg-6">
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
                      <div class="col-lg-6" id="pID">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">المنتج الأب في حالة وجوده</label>
                          <select class="form-control @error('parentID') is-invalid @enderror" id="parentID" name="parentID">
                            <option value="">اختر المنتج</option>
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
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الوحدة</label>
                          <select class="form-control @error('unitID') is-invalid @enderror" id="unitID" name="unitID">
                            <option value="">اختر الوحدة</option>
                            @foreach (auth()->user()->organization->units as $unit)
                              <option value="{{$unit->id}}" @if($product->unitID == $unit->id) selected @endif>{{$unit->nameAr}}</option>
                            @endforeach
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
@endsection

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
</script>