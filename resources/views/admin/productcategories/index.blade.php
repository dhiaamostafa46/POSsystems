@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('Products.Productsections') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#"> {{ trans('Products.Productsections') }} </a></li>
                        <li class="breadcrumb-item active"> {{ trans('Products.Productsections') }} </li>
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
                            <h6 style="display: inline-block"> {{ trans('Products.Productsections') }} </h6>
                            <a href="{{ route('prodcategories.create') }}" class="btn btn-primary mx-1 btnAddsys"><i
                                    class="fa fa-plus"></i> {{ trans('Products.Add') }} </a>
                            <a href="{{ route('GetExportprodcategories') }}" class="btn btn-primary mx-1 btnAddsys"><i
                                    class="fa fa-plus"></i> {{ trans('Products.export') }} </a>
                            <a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mx-1 btnAddsys"><i
                                    class="fa fa-plus"></i> {{ trans('Products.import') }} </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> {{ trans('ID') }}</th>
                                        <th> {{ trans('Products.Name') }}</th>
                                        <th> {{ trans('Products.Orderstore') }}</th>
                                        <th> {{ trans('Products.picture') }}</th>
                                        <th>{{ trans('Products.Type') }} </th>
                                        <th> {{ trans('Products.Datecreated') }}</th>
                                        <th>{{ trans('Products.Options') }} </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($prodcategories) > 0)
                                        @foreach ($prodcategories as $index => $prodcategory)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $prodcategory->id }}</td>
                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                    <td>{{ $prodcategory->nameAr }}</td>
                                                @else
                                                    <td>{{ $prodcategory->nameEn }}</td>
                                                @endif
                                                <td>{{ $prodcategory->sort }}</td>
                                                <td><img src="{{ asset('dist/img/productcategories/' . $prodcategory->img) }}"
                                                        width="30px" alt=""></td>
                                                <td>
                                                    @if ($prodcategory->TypeCatagoury == 1)
                                                        {{ trans('Products.Sales') }}
                                                    @elseif($prodcategory->TypeCatagoury == 2)
                                                        {{ trans('Products.purchases') }}
                                                    @elseif($prodcategory->TypeCatagoury == 3)
                                                        {{ trans('Products.Manufactur') }}
                                                    @endif
                                                </td>
                                                <td>{{ $prodcategory->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('prodcategories.show', $prodcategory->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-eye"></i>
                                                        {{ trans('Products.Show') }} </a>
                                                    <a href="{{ route('prodcategories.edit', $prodcategory->id) }}"
                                                        class="btn btn-info"><i class="fa fa-edit"></i>
                                                        {{ trans('Products.Edite') }}</a>
                                                    <a href="#" class="btn btn-danger"
                                                        onclick="handleDelete({{ $prodcategory->id }})"><i
                                                            class="fa fa-trash"></i> {{ trans('Products.Delete') }} </a>

                                                    <a href="#" data-toggle="modal" data-target="#exampleModalprice{{$prodcategory->id}}"
                                                        class="btn btn-primary"><i class="fa fa-money"></i> تعديل السعر </a>

                                                        <div class="modal fade" id="exampleModalprice{{$prodcategory->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel"> تعديل جميع المنتجات المتصلة بهذا القسم </h5>

                                                                    </div>
                                                                    <form action="{{route('Prodcategoriesprice')}}" method="post">
                                                                        @csrf

                                                                        <div class="modal-body">
                                                                            <input type="hidden" value="{{ $prodcategory->id}}" name="id">
                                                                           <div class="form-group">
                                                                                <label for="exampleInputEmail1">  علما انه يمكن إدخال قيمة واحدة السعر او النسبة  </label>

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputEmail1">  نوع التعديل  </label>
                                                                                <select name="type" id="" class="form-control">
                                                                                    <option value="1"> زيادة السعر </option>
                                                                                    <option value="2"> تنقيص السعر </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputEmail1"> السعر (اختياري) </label>
                                                                                <input type="number" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputPassword1"> نسبة (إختياري) </label>
                                                                                <input type="number" class="form-control" name="percentage" id="exampleInputPassword1">
                                                                            </div>


                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> إغلاق </button>
                                                                            <button type="submit" class="btn btn-primary"> حفظ </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>



                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center"> {{ trans('Products.NoFound') }} </td>
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

    <!-- Button trigger modal -->


    <!-- Modal -->


    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> تحميل ملف Excel </h5>

                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('GetImportprodcategories') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1"> تحميل ملف </label>
                            <input type="file" class="form-control" id="exampleInputEmail1" name="file">
                        </div>
                        <ul>
                            <li>
                                <span> يجب عليك إدخال ملف بواسطة النموذج الخاص</span>
                                <a href="{{ asset('public/Excel/Prodcategory.xlsx') }}"> تحميل النموذج</a>
                            </li>
                            <li> وضع مسار الصورة كامل </li>
                            <li>
                                نوع القسم يتم ادخالها ارقام على حسب التالي
                                <ol>
                                    <li>مبيعات </li>
                                    <li>مشتريات </li>
                                    <li> تصنيع </li>
                                </ol>
                            </li>
                            <li> ترتيب المنتجات في المتجر إختياري</li>

                        </ul>


                        <button type="submit" class="btn btn-primary"> تحميل </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div style="display: none">
        <h1 id="titalmesssage"> {{ trans('Products.Areyousuretodelete') }} </h1>
        <h1 id="confirmButtonText"> {{ trans('Products.confirmButtonText') }} </h1>
        <h1 id="cancelButtonText"> {{ trans('Products.cancelButtonText') }} </h1>
    </div>
@endsection
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
    function handleDelete(id) {
        ddd = document.getElementById('titalmesssage').innerHTML;
        dyes = document.getElementById('confirmButtonText').innerHTML;
        dno = document.getElementById('cancelButtonText').innerHTML;

        Swal.fire({
            title: ddd,
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#f8a29e',
            confirmButtonText: dyes,
            cancelButtonText: dno
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/delete-productcategory/" + id;
            }
        })
    }
</script>
