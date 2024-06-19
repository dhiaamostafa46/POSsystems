@extends('layouts.dashboard')

@section('content')
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
                        <li class="breadcrumb-item active"> {{ trans('Products.ListProducts') }}</li>
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
                            <h3 class="card-title"> {{ trans('Products.ListProducts') }} </h3>
                            <a href="{{ route('products.create') }}" class="btn btn-primary btnAddsys"><i
                                    class="fa fa-plus"></i> {{ trans('Products.Add') }}</a>
                            <a href="{{ route('GetExportprodect') }}" class="btn btn-primary mx-1 btnAddsys"><i
                                    class="fa fa-plus"></i> {{ trans('Products.export') }} </a>
                            <a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mx-1 btnAddsys"><i
                                    class="fa fa-plus"></i> {{ trans('Products.import') }} </a>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                           <th>{{ trans('ID') }}</th>
                                        <th>{{ trans('Products.Name') }}</th>
                                        <th>{{ trans('Products.Productcode') }}</th>
                                        <th>{{ trans('Products.price') }}</th>
                                        <th>{{ trans('Products.picture') }}</th>
                                        @if (auth()->user()->organization->activity == 2)
                                            <th> {{ trans('Products.ProductType') }}</th>
                                        @endif
                                        <th> {{ trans('Products.Datecreated') }}</th>
                                        <th>{{ trans('Products.Options') }} </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($products) > 0)
                                        @foreach ($products as $index => $product)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                   <td>{{ $product->id }}</td>
                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                    <td>{{ $product->nameAr }}</td>
                                                @else
                                                    <td>{{ $product->nameEn }}</td>
                                                @endif
                                                <td>{{ $product->barcode }}</td>
                                                <td>

                                                    @if (auth()->user()->organization->activity == 1)
                                                        {{ $product->prodPrice }}
                                                    @else
                                                        @if ($product->TypeProdect == 1)
                                                            {{ $product->prodPrice }}
                                                        @else
                                                            {{ $product->costPrice }}
                                                        @endif
                                                    @endif

                                                </td>
                                                <td><img src="{{ asset('public/dist/img/products/' . $product->img) }}"
                                                        width="30px" alt=""></td>
                                                @if (auth()->user()->organization->activity == 2)
                                                    <td>
                                                        @if ($product->TypeProdect == 1)
                                                            {{ trans('Products.Sales') }}
                                                        @elseif ($product->TypeProdect == 2)
                                                            @if ($product->saleable == 0)
                                                                {{ trans('Products.purchases') }}
                                                            @else
                                                                {{ trans('Products.purchasesSale') }}
                                                            @endif
                                                        @elseif ($product->TypeProdect == 3)
                                                            {{ trans('Products.Manufactur') }}
                                                        @endif
                                                    </td>
                                                @endif
                                                <td>{{ $product->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('products.show', $product->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-eye"></i>
                                                        {{ trans('Products.Show') }}</a>
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-info"><i class="fa fa-edit"></i>
                                                        {{ trans('Products.Edite') }}</a>
                                                    <a href="#" class="btn btn-danger"
                                                        onclick="handleDelete({{ $product->id }})"><i
                                                            class="fa fa-trash"></i> {{ trans('Products.Delete') }}</a>
                                                    <a href="{{ route('productsCopy', $product->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-edit"></i>
                                                        {{ trans('Products.Copy') }} </a>
                                                    @if (auth()->user()->organization->activity == 2)
                                                        <a class="btn btn-warning"
                                                            href="{{ route('extras.index', $product->id) }}"><i
                                                                class="fa fa-plus"></i> {{ trans('Products.Extras') }}</a>
                                                        @if ($product->status == 1)
                                                            <a href="{{ route('products.hide', $product->id) }}"
                                                                class="btn btn-danger"><i class="fa fa-eye-slash"></i>
                                                                {{ trans('Products.Hide') }}</a>
                                                        @else
                                                            <a href="{{ route('products.unhide', $product->id) }}"
                                                                class="btn btn-primary"><i class="fa fa-eye"></i>
                                                                {{ trans('Products.display') }}</a>
                                                        @endif
                                                    @endif
                                                    @if (auth()->user()->organization->activity == 1)
                                                        {{-- <a href="#" class="btn btn-dark" style="background-color: black" onclick="handleBarcode('{{ $product->barcode }}')"><i class="fa fa-qrcode"></i>  {{ trans('Products.ParCode') }}</a> --}}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center"></td>
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
        <div class="modal fade modal" id="extrasModel{{ $product->id }}" tabindex="-1" role="dialog"
            aria-labelledby="extrasModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">اضافات الصنف</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-left:0px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="col-12 row mt-3">
                        <div class="col-12">
                            <form class="user" id="extrasForm" method="POST"
                                action="{{ route('extras.store', $product->id) }}" enctype = "multipart/form-data">
                                @csrf
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('nameAr') is-invalid @enderror"
                                                    id="nameAr" name="nameAr" placeholder="اكتب اسم الاضافة - عربي">
                                                @error('nameAr')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('nameEn') is-invalid @enderror"
                                                    id="nameEn" onkeypress="return ValidateKey();" name="nameEn"
                                                    placeholder="اكتب اسم الاضافة - انجليزي">
                                                @error('nameEn')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="number"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    id="price" name="price" placeholder="اكتب سعر البيع">
                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <input type="hidden" name="productID" value="{{ $product->id }}">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary" value="حفظ"
                                                    style="width: 100%">
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
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $extra->nameAr }}</td>
                                        <td>{{ $extra->price }}</td>
                                        <td>
                                            <!-- <a href="{{ route('products.edit', $extra->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> تعديل</a> -->
                                            <a href="#" class="btn btn-danger"
                                                onclick="handleDelete({{ $extra->id }})"><i class="fa fa-trash"></i>
                                                حذف</a>
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
    <div class="modal fade modal" id="barcodeModel" tabindex="-1" role="dialog" aria-labelledby="barcodeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">باركود الصنف</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="margin-left:0px">
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




    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> تحميل ملف Excel </h5>

                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('GetImportprodect') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1"> تحميل ملف </label>
                            <input type="file" class="form-control" id="exampleInputEmail1" name="file">
                        </div>
                        <ul>
                            <li>
                                <span> يجب عليك إدخال ملف بواسطة النموذج الخاص</span>
                                  @if (auth()->user()->organization->activity == 2)
     <a href="{{ asset('public/Excel/Productrest.xlsx') }}"> تحميل النموذج</a>
                                @else
     <a href="{{ asset('public/Excel/Product.xlsx') }}"> تحميل النموذج</a>
                                @endif
                           
                            </li>
                            <li> يتم تحميل اقسام المنتجات اولأ ثم يتم تعبة الحقل الاقسام من خلال رقم القسم في جدول الاقسام </li>
                            <li> يتم تحميل الوحدات المنتجات اولأ ثم يتم تعبة الحقل الوحدات من خلال رقم الوحدة في جدول الوحدات </li>
                            <li> وضع مسار الصورة كامل </li>
                            <li>
                                نوع المنتج  يتم ادخالها ارقام على حسب التالي
                                <ol>
                                    <li>مبيعات </li>
                                    <li>مشتريات </li>
                                    <li> تصنيع </li>
                                </ol>
                            </li>
                            <li> علما انه يتم ربط المنتج بوحدة فقط  </li>

                        </ul>


                        <button type="submit" class="btn btn-primary"> تحميل </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div style="display: none">
        <h1 id="noFoundmesssage"> {{ trans('Products.Areyousuretodelete') }} </h1>
        <h1 id="confirmButtonText"> {{ trans('Products.confirmButtonText') }} </h1>
        <h1 id="cancelButtonText"> {{ trans('Products.cancelButtonText') }} </h1>


    </div>
    <!-- Extras Modal -->
@endsection

<script>
    function handleDelete(id) {
        Swal.fire({
            title: document.getElementById('noFoundmesssage').innerHTML,
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#f8a29e',
            confirmButtonText: document.getElementById('confirmButtonText').innerHTML,
            cancelButtonText: document.getElementById('cancelButtonText').innerHTML
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/delete-product/" + id;
            }
        })
    }

    function handleExtras(id) {
        //console.log('star.', id)
        var form = document.getElementById('extrasForm')
        // form.action = '/user/delete/' + id
        form.action = '/extras-store/' + id
        $('#extrasModel' + id).modal('show')
    }

    function handleBarcode(barcode) {
        JsBarcode("#barcode", '125');
        $('#barcodeModel').modal('show')
    }
</script>
