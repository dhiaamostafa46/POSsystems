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
          <li class="breadcrumb-item active">تفاصيل المنتج</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">التفاصيل</h3>
          </div>
          <div class="card-body">
            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">اسم المنتج - عربي</label>
                      <h6 class="text-primary">{{$product->nameAr}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">اسم المنتج - انجليزي</label>
                      <h6 class="text-primary">{{$product->nameEn}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">تفاصيل المنتج - عربي</label>
                      <h6 class="text-primary">{{$product->detailsAr}}</h6>
                      @error('details')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-userdetails">تفاصيل المنتج - انجليزي</label>
                      <h6 class="text-primary">{{$product->detailsEn}}</h6>
                      @error('details')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">السعرات</label>
                      <h6 class="text-primary">{{$product->calories}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">سعر الشراء</label>
                      <h6 class="text-primary">{{$product->costPrice}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">سعر البيع</label>
                      <h6 class="text-primary">{{$product->prodPrice}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">القسم</label>
                      <h6 class="text-primary">{{$product->category->nameAr}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">الباركود</label>
                      <h6 class="text-primary">{{$product->barcode}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">الضريبة</label>
                      <h6 class="text-primary">{{$product->vat}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">اضافة بواسطة</label>
                      <h6 class="text-primary">{{$product->user->name}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">تاريخ الاضافة</label>
                      <h6 class="text-primary">{{$product->created_at}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  @if (!empty($product->sFrom))
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">من الساعة</label>
                      <h6 class="text-primary">{{$product->sFrom}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">الى الساعة</label>
                      <h6 class="text-primary">{{$product->sTo}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  @endif


                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">صورة المنتج</label>
                      <h6 class="text-primary">
                        <img src="{{asset('../dist/img/products/'.$product->img)}}" style="width: 20%" alt="">
                      </h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                </div>
              </div>
              <div class="pl-lg-4">

                    <h5 class="text-center">   بيانات المنتج بالمخزون        </h5>

                <hr/>
                <table  class="table table-bordered table-hover text-center" style="width: 90%;margin:auto">
                    <thead>
                    <tr>

                    <th> المتوفر بالمخزون </th>
                    {{-- <th>  تكلفة المتوفر من المخزون</th> --}}
                    <th> متوسط تكلفة الوحدة</th>
                    <th>تكلفة  المباع</th>
                    <th>تكلفة المنتج المخزن</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if ($product->CostStore != null)

                        <tr>
                            <td>{{$product->CostStore->count - $product->CostStore->saller  ?? ''}}</td>
                            {{-- <td>{{$product->CostStore->countSaller ?? ''}}</td> --}}
                            <td>{{$product->CostStore->costprodect ?? ''}}</td>
                            <td>{{($product->CostStore->costprodect * $product->CostStore->saller)?? ''}}</td>
                            <td>{{($product->CostStore->costprodect *($product->CostStore->count -$product->CostStore->saller))?? ''}}</td>
                        </tr>

                    @else
                        <tr>
                        <td colspan="6" class="text-center">لا يوجد حركات</td>
                        </tr>
                    @endif
                    </tfoot>
                </table>
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
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
