@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Allproducts') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Allproducts') }} </li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> {{ trans('Report.Allproducts') }} </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="RepotAllDataTable" class="table text-center table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Products.Datecreated') }}</th>
                    <th>{{ trans('Products.Name') }}</th>
                    <th>{{ trans('Products.picture') }}</th>
                    <th>{{ trans('Products.Productsections') }}</th>
                    <th>{{ trans('Products.Tax') }}</th>
                    <th>{{ trans('Products.Options') }} </th>


                  </tr>
                  </thead>
                  <tbody>

                  @if (count($products) > 0)
                      @foreach ($products as $index => $product)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$product->created_at}}</td>
                        @if(LaravelLocalization::getCurrentLocale() =='ar')
                        <td>{{$product->nameAr}}</td>
                        @else
                        <td>{{$product->nameEn}}</td>
                        @endif


                        <td><img src="{{asset('public/dist/img/products/'.$product->img)}}" width="30px" alt=""></td>
                        <th>{{$product->category->nameAr}}</th>
                        <th>{{$product->vat}}</th>

                        <td>
                            <a href="{{route('ReportAll.showpredectdetail',$product->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> </a>
                            <a href="{{route('ReportAll.processprdect',$product->id)}}" class="btn btn-info"><i class="fa fa-cog" aria-hidden="true"></i> </a>
                        </td>


                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center">{{ trans('Report.NotFounddata') }}</td>
                      </tr>
                  @endif
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    @foreach ($products as $index => $product)
    <!-- Extras Modal -->
    <div class="modal fade modal" id="extrasModel{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="extrasModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">اضافات الصنف</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="col-12 row mt-3">
            <div class="col-12">
              <form class="user" id="extrasForm" method="POST" action="{{ route('extras.store',$product->id) }}" enctype = "multipart/form-data">
                @csrf
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="text"  class="form-control @error('nameAr') is-invalid @enderror" id="nameAr" name="nameAr" placeholder="اكتب اسم الاضافة - عربي">
                        @error('nameAr')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="text"  class="form-control @error('nameEn') is-invalid @enderror" id="nameEn"  onkeypress="return ValidateKey();" name="nameEn" placeholder="اكتب اسم الاضافة - انجليزي">
                        @error('nameEn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="اكتب سعر البيع">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <input type="hidden" name="productID" value="{{$product->id}}">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="حفظ" style="width: 100%">
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                <hr class="my-4" />
              </form>
            </div>
            <div class="col-12">
              <h6>الاضافات</h6>
            </div>
            <div class="col-12">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>الاسم</th>
                  <th>السعر</th>
                  <th>خيارات</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($product->extras as $extra)
                  <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$extra->nameAr}}</td>
                    <td>{{$extra->price}}</td>
                    <td>
                      <!-- <a href="{{route('products.edit',$extra->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> تعديل</a> -->
                      <a href="#" class="btn btn-danger" onclick="handleDelete({{ $extra->id }})"><i class="fa fa-trash"></i> حذف</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
            </div>
          </div>


        </div>
      </div>
    </div>
    <!-- Extras Modal -->
    @endforeach

    <!-- Extras Modal -->
    <div class="modal fade modal" id="barcodeModel" tabindex="-1" role="dialog" aria-labelledby="barcodeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">باركود الصنف</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="col-12 row mt-3">
            <div class="col-12">
              <svg id="barcode"></svg>
            </div>
          </div>


        </div>
      </div>
    </div>
    <!-- Extras Modal -->
@endsection

<script>
  function handleDelete(id){
    Swal.fire({
      title: 'هل انت متأكد من الحذف؟',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: 'نعم، حذف',
      cancelButtonText: 'لا، الغاء'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/delete-product/"+id;
      }
    })
  }

  function handleExtras(id) {
        //console.log('star.', id)
      var form = document.getElementById('extrasForm')
      // form.action = '/user/delete/' + id
      form.action = '/extras-store/' + id
      $('#extrasModel'+id).modal('show')
    }

    function handleBarcode(barcode) {
      JsBarcode("#barcode", '125');
      $('#barcodeModel').modal('show')
    }

</script>
