@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('Products.Productunits') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('Products.Productunits') }} </a></li>
                        <li class="breadcrumb-item active"> {{ trans('Products.ListUnit') }} </li>
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
                            <h3 class="card-title">{{ trans('Products.ListUnit') }} </h3>
                            <a type="button" onclick="showModal()" class="btn btn-primary btnAddsys"><i
                                    class="fa fa-plus"></i> {{ trans('Products.Add') }} </a>
                            <a href="{{ route('GetExportUnit') }}" class="btn btn-primary mx-1 btnAddsys"><i
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
                                          <th> {{ trans('ID') }} </th>
                                        <th> {{ trans('Products.Name') }} </th>

                                        <th> {{ trans('Products.Datecreated') }}</th>
                                        <th> {{ trans('Products.Options') }} </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($units) > 0)
                                        @foreach ($units as $index => $unit)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                  <td>{{ $unit->id }}</td>
                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                    <td>{{ $unit->nameAr }}</td>
                                                @else
                                                    <td>{{ $unit->nameEn }}</td>
                                                @endif



                                                <td>{{ $unit->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('units.show', $unit->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-eye"></i>
                                                        {{ trans('Products.Show') }} </a>
                                                    <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-info"><i
                                                            class="fa fa-edit"></i> {{ trans('Products.Edite') }}</a>
                                                    <a href="#" class="btn btn-danger"
                                                        onclick="handleDelete({{ $unit->id }})"><i
                                                            class="fa fa-trash"></i> {{ trans('Products.Delete') }} </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">لا يوجد وحدات</td>
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


    <!-- Create Modal -->

    <div class="modal" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> {{ trans('Products.AddUnite') }} </h5>
                </div>
                <form class="user" method="POST" action="{{ route('units.store') }}" enctype = "multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="input-username">{{ trans('Products.NameArabic') }} </label>
                                    <input type="text" class="form-control @error('nameAr') is-invalid @enderror"
                                        id="nameAr" name="nameAr" required>
                                    @error('nameAr')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="input-username">{{ trans('Products.NameEnglish') }} </label>
                                    <input type="text" class="form-control @error('nameEn') is-invalid @enderror"
                                        id="nameEn" name="nameEn">
                                    @error('nameEn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ trans('Products.save') }} </button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('Products.Close') }}</button>
                    </div>
                </form>
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
                    <form method="post" action="{{ route('GetImportUnit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1"> تحميل ملف </label>
                            <input type="file" class="form-control" id="exampleInputEmail1" name="file">
                        </div>
                        <ul>
                            <li>
                                <span> يجب عليك إدخال ملف بواسطة النموذج الخاص</span>
                                <a href="{{ asset('public/Excel/Unit.xlsx') }}"> تحميل النموذج</a>
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
                window.location.href = "/delete-unit/" + id;
            }
        })
    }

    function showModal() {
        //console.log('star.', id)
        // var form = document.getElementById('deleteCategoryForm')
        // form.action = '/user/delete/' + id
        // form.action = '/Bills/' + id
        $('#CreateModal').modal('show')
    }
</script>
