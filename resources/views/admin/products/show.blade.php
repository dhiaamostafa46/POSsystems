@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">  {{ trans('Products.ListProducts') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">  {{ trans('Products.Products') }} </a></li>
            <li class="breadcrumb-item active">  {{ trans('Products.ListProducts') }}</li>
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
            <h3 class="card-title">{{ trans('Products.details') }}</h3>
          </div>
          <div class="card-body">
            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('Products.ProductName-Arabic') }}</label>
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
                      <label class="form-control-label" for="input-username">  {{ trans('Products.ProductName-Einglsh') }}</label>
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
                      <label class="form-control-label" for="input-username">  {{ trans('Products.CategorydetailsArabic') }}</label>
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
                      <label class="form-control-label" for="input-userdetails"> {{ trans('Products.CategorydetailsEinglsh') }}</label>
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
                      <label class="form-control-label" for="input-username">{{ trans('Products.Calories') }}</label>
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
                      <label class="form-control-label" for="input-username"> {{ trans('Products.Purchasingprice') }}</label>
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
                      <label class="form-control-label" for="input-username">  {{ trans('Products.sellingprice') }}</label>
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
                      <label class="form-control-label" for="input-username"> {{ trans('Products.Productsection') }}</label>
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
                      <label class="form-control-label" for="input-username">{{ trans('Products.Productcode') }}</label>
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
                      <label class="form-control-label" for="input-username">{{ trans('Products.Tax') }}</label>
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
                      <label class="form-control-label" for="input-username"> {{ trans('Products.Datecreated') }}</label>
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
                      <label class="form-control-label" for="input-username"> {{ trans('Products.Sectionpicture') }} </label>
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
              <!--<div class="pl-lg-4">-->

              <!--      <h5 class="text-center">   بيانات المنتج بالمخزون        </h5>-->

              <!--  <hr/>-->
              <!--  <table  class="table table-bordered table-hover text-center" style="width: 90%;margin:auto">-->
              <!--      <thead>-->
              <!--      <tr>-->

              <!--      <th> المتوفر بالمخزون </th>-->
              <!--      {{-- <th>  تكلفة المتوفر من المخزون</th> --}}-->
              <!--      <th> متوسط تكلفة الوحدة</th>-->
              <!--      <th>تكلفة  المباع</th>-->
              <!--      <th>تكلفة المنتج المخزن</th>-->
              <!--      </tr>-->
              <!--      </thead>-->
              <!--      <tbody>-->

              <!--      @if ($product->CostStore != null)-->

              <!--          <tr>-->
              <!--              <td>{{$product->CostStore->count - $product->CostStore->saller  ?? ''}}</td>-->
              <!--              {{-- <td>{{$product->CostStore->countSaller ?? ''}}</td> --}}-->
              <!--              <td>{{$product->CostStore->costprodect ?? ''}}</td>-->
              <!--              <td>{{($product->CostStore->costprodect * $product->CostStore->saller)?? ''}}</td>-->
              <!--              <td>{{($product->CostStore->costprodect *($product->CostStore->count -$product->CostStore->saller))?? ''}}</td>-->
              <!--          </tr>-->

              <!--      @else-->
              <!--          <tr>-->
              <!--          <td colspan="6" class="text-center">لا يوجد حركات</td>-->
              <!--          </tr>-->
              <!--      @endif-->
              <!--      </tfoot>-->
              <!--  </table>-->
              <!--</div>-->

              <hr class="my-4" />

              <div class="card-header">
                <h3 class="card-title">  {{ trans('Products.Measurementunits') }}  </h3>
              </div>
              <br>
              <div class="col-lg-8" >
                    <h5 style="color: brown;"> {{ trans('Products.fromlargesttosmallest') }}</h5>
                <table  class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th> {{ trans('Products.Unit') }}</th>
                    <th>  {{ trans('Products.Conversionfactor') }}</th>
                    <th>  {{ trans('Products.Unitcost') }}</th>
                    <th colspan="4"> {{ trans('Products.Options') }}</th>


                  </tr>
                  </thead>
                  <tbody id="trow">
                    <?php $count = 0;?>
                    @foreach($prdUnits as $uitem)
                    <tr>
                      <td>

                          @foreach (auth()->user()->organization->units as $unit)
                            @if($uitem->unitID == $unit->id )
                            <label class="form-control">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$unit->nameAr}} @else {{$unit->nameEn}} @endif</label>
                            @endif
                          @endforeach


                      </td>
                    <td>

                      <label class="form-control">{{$uitem->quantity}}</label>

                    </td>
                    <td>
                      <label class="form-control">{{$uitem->price}}</label>

                    </td>
                    <td>
                      <div class="form-check">
                        <input id="TypeProdect" name="sales{{$count}}"  type="checkbox"  class="form-check-input" @if($uitem->sales ==1) @checked(true) @endif @disabled(true)>
                        <label class="form-check-label" for="credit">  {{ trans('Products.Sales') }}</label>
                      </div>

                    </td>
                    <td>
                      <div class="form-check">
                        <input id="TypeProdect" name="purchase{{$count}}"  type="checkbox"  class="form-check-input"  @if($uitem->purchase ==1) @checked(true) @endif @disabled(true)>
                        <label class="form-check-label" for="credit">  {{ trans('Products.purchases') }}</label>

                      </div>

                    </td>
                    <td>
                      <div class="form-check">
                        <input id="TypeProdect" name="report{{$count}}"  type="checkbox"  class="form-check-input" @if($uitem->report ==1) @checked(true) @endif @disabled(true)>
                        <label class="form-check-label" for="credit">  {{ trans('Products.Reports') }}</label>

                      </div>

                    </td>
                    <td>
                      <div class="form-check">
                        <input id="TypeProdect" name="compon{{$count}}"  type="checkbox"  class="form-check-input"  @if($uitem->compon ==1) @checked(true) @endif @disabled(true)>
                        <label class="form-check-label" for="credit">  {{ trans('Products.Ingredients') }}</label>

                      </div>

                    </td>


                  </tr>
                  <?php $count++;?>
                  @endforeach
                  </tbody>
                </table>

              </div>
              <hr class="my-4" />

              <div class="card-header">
                <h3 class="card-title"> {{ trans('Products.listIngredients') }}</h3>
              </div>
              <br>
              <div class="col-lg-8" >
                @if ($copmons != null)
                    <h5 style="color: brown;"> {{ trans('Products.Totalcostoftheproduct') }} {{$copmons->totalPrice}}</h5>
                @endif
                <table  class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>  {{ trans('Products.ProductName') }} </th>
                    <th>  {{ trans('Products.Costprice') }} </th>
                    <th> {{ trans('Products.Quantity') }}</th>
                    <th>  {{ trans('Products.Unittype') }}</th>


                  </tr>
                  </thead>
                  <tbody id="trow">
                    @if (($copmons != null) && (count($copmons->VolumeDetail) > 0))
                    @foreach($copmons->VolumeDetail as $index => $vitem)
                    <tr>
                      <td>{{$index+1}}</td>
                      <td>{{$vitem->product->nameAr}}</td>
                      <td>{{$vitem->QuantityTotal}} </td>
                      <td>{{$vitem->Quantity}}</td>
                      <td>{{$vitem->product->compUnit->nameAr}}</td>


                  </tr>
                    @endforeach
                    @endif
                  </tbody>
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
