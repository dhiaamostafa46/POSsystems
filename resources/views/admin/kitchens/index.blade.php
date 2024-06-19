@extends('layouts.dashboard')
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('Products.Kitchens') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('Products.Kitchens') }} </a></li>
                        <li class="breadcrumb-item active"> {{ trans('Products.Allkitchens') }} </li>
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
                            <h3 class="card-title"> {{ trans('Products.Allkitchens') }} </h3>
                            <a href="#" onclick="handleKitchens();" class="btn btn-primary btnAddsys"><i
                                    class="fa fa-plus"></i> {{ trans('Products.Add') }} </a>
                            <a href="{{ route('GetExportkitchens') }}" class="btn btn-primary mx-1 btnAddsys"><i
                                    class="fa fa-plus"></i> {{ trans('Products.export') }} </a>
                            <a data-toggle="modal" data-target="#exampleModaleee" class="btn btn-primary mx-1 btnAddsys"><i
                                    class="fa fa-plus"></i> {{ trans('Products.import') }} </a>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                         <th> {{ trans('ID') }} </th>
                                        <th> {{ trans('Products.Arabicname') }} </th>
                                        <th> {{ trans('Products.Englishname') }} </th>
                                        <th> {{ trans('Products.branch') }} </th>
                                        <th> {{ trans('Products.Datecreated') }} </th>
                                        <th> {{ trans('Products.Options') }} </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($kitchens) > 0)
                                        @foreach ($kitchens as $index => $kitchen)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                  <td>{{ $kitchen->id }}</td>
                                                <td>{{ $kitchen->nameAr }}</td>
                                                <td>{{ $kitchen->nameEn }}</td>

                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                    <td>{{ $kitchen->branch->nameAr }}</td>
                                                @else
                                                    <td>{{ $kitchen->branch->nameEn }}</td>
                                                @endif
                                                <td>{{ $kitchen->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('kitchens.show', $kitchen->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-eye"></i>
                                                        {{ trans('Products.Show') }} </a>
                                                    <a href="#"
                                                        onclick="handleKitchensUpdate('{{ $kitchen->id }}','{{ $kitchen->nameAr }}','{{ $kitchen->nameEn }}');"
                                                        class="btn btn-info"><i class="fa fa-edit"></i>
                                                        {{ trans('Products.Edite') }} </a>
                                                    <a href="#" class="btn btn-danger"
                                                        onclick="handleDelete({{ $kitchen->id }})"><i
                                                            class="fa fa-trash"></i> {{ trans('Products.Delete') }} </a>
                                                    <a href="#" class="btn btn-primary"
                                                        onclick="handleLink({{ $kitchen->id }})"><i
                                                            class="fa fa-link"></i> {{ trans('Products.link') }} </a>
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
    <!-- Kitchen Modal -->
    <div class="modal fade modal" id="kitchensModel" tabindex="-1" role="dialog" aria-labelledby="kitchensModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('Products.Addakitchen') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-12 row mt-3">
                    <div class="col-12">
                        <form class="user" id="kitchensForm" method="POST" action="{{ route('kitchens.store') }}"
                            enctype = "multipart/form-data">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('nameAr') is-invalid @enderror"
                                                id="nameAr" name="nameAr"
                                                placeholder="{{ trans('Products.CuisinenameArabic') }}">
                                            @error('nameAr')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('nameEn') is-invalid @enderror"
                                                id="nameEn" onkeypress="return ValidateKey();" name="nameEn"
                                                placeholder="{{ trans('Products.CuisinenameEnglish') }}">
                                            @error('nameEn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary"
                                                value=" {{ trans('Products.save') }} " style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <hr class="my-4" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Kitchen Modal -->

    <!-- Kitchen Modal -->
    <div class="modal fade modal" id="kitchensUpdateModel" tabindex="-1" role="dialog"
        aria-labelledby="kitchensUpdateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('Products.Allkitchens') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="margin-left:0px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-12 row mt-3">
                    <div class="col-12">
                        <form class="user" id="kitchensUpdateForm" method="POST"
                            action="{{ route('kitchensupdate') }}" enctype = "multipart/form-data">
                            @csrf
                            <input type="hidden" name="idkit" id="idkit">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('nameAr') is-invalid @enderror" id="nameArU"
                                                name="nameAr" placeholder="{{ trans('Products.CuisinenameArabic') }}">
                                            @error('nameAr')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('nameEn') is-invalid @enderror" id="nameEnU"
                                                onkeypress="return ValidateKey();" name="nameEn"
                                                placeholder="{{ trans('Products.CuisinenameEnglish') }}">
                                            @error('nameEn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary"
                                                value=" {{ trans('Products.save') }} " style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <hr class="my-4" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Kitchen Modal -->

    <!-- link Modal -->
    <div class="modal fade modal" id="linkModel" tabindex="-1" role="dialog" aria-labelledby="linkModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('Products.linlakitchen') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="margin-left:0px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-12 row mt-3">
                    <div class="col-12">
                        <form class="user" id="linkForm" method="POST" action="#"
                            enctype = "multipart/form-data">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('link') is-invalid @enderror"
                                                id="link" name="link">
                                            @error('link')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="button" onclick="copyFunction()" data-dismiss="modal"
                                                class="btn btn-primary" value=" {{ trans('Products.Copy') }} "
                                                style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <hr class="my-4" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="exampleModaleee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> تحميل ملف Excel </h5>

                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('GetImportkitchens') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1"> تحميل ملف </label>
                            <input type="file" class="form-control" id="exampleInputEmail1" name="file">
                        </div>
                        <ul>
                            <li>
                                <span> يجب عليك إدخال ملف بواسطة النموذج الخاص</span>
                                <a href="{{ asset('public/Excel/Kitchen.xlsx') }}"> تحميل النموذج</a>
                            </li>
                           

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


    <!-- link Modal -->
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
                window.location.href = "/delete-kitchen/" + id;
            }
        })
    }

    function handleKitchens() {
        $('#kitchensModel').modal('show')
    }

    function handleKitchensUpdate(id, nameAr, nameEn) {
        document.getElementById('nameArU').value = nameAr;
        document.getElementById('nameEnU').value = nameEn;
        document.getElementById('idkit').value = id;

        $('#kitchensUpdateModel').modal('show')
    }

    function handleLink(id) {
        document.getElementById('link').value = window.location.protocol + '//' + window.location.host + '/k/' + id;
        $('#linkModel').modal('show')
    }

    function copyFunction() {
        // Get the text field
        var copyText = document.getElementById("link");

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("تم نسخ: " + copyText.value);
    }
</script>
