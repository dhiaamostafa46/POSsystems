@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('HR.Allowances') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('HR.Allowances') }}</li>
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
                            <h6 style="display: inline-block">{{ trans('HR.Allowances') }} </h6>
                            <a type="button" onclick="showModal()" class="btn btn-primary floatmleft"><i
                                    class="fa fa-plus"></i> {{ trans('HR.Add') }}</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('HR.NameArabic') }}</th>
                                        <th>{{ trans('HR.NameEnglish') }}</th>
                                        <th>{{ trans('HR.allowance/discount') }}</th>
                                        <th> {{ trans('HR.Dateadded') }}</th>
                                        <th>{{ trans('HR.Options') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($allowances) > 0)
                                        @foreach ($allowances as $index => $allowance)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $allowance->nameAr }}</td>
                                                <td>{{ $allowance->nameEn }}</td>
                                                <td>
                                                    @if ($allowance->type == 'allown')
                                                        {{ trans('HR.allowance') }}
                                                    @else
                                                        {{ trans('HR.discount') }}
                                                    @endif
                                                </td>
                                                <td>{{ $allowance->created_at }}</td>
                                                <td>

                                                    <a type="button" onclick="showEditModal({{ $allowance->id }})"
                                                        class="btn btn-info"><i class="fa fa-edit"></i>
                                                        {{ trans('HR.Edit') }}</a>
                                                    <a href="#" class="btn btn-danger"
                                                        onclick="handleDelete({{ $allowance->id }})"><i
                                                            class="fa fa-trash"></i> {{ trans('HR.Delete') }}</a>
                                                </td>
                                            </tr>
                                            <!-- Edit Modal -->

                                            <!-- End Edit Modal -->
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">{{ trans('HR.NotFoundData') }}</td>
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


    @if (count($allowances) > 0)
        @foreach ($allowances as $index => $allowance)
            <div class="modal fade modal" id="EditModal{{ $allowance->id }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel">
                                {{ trans('HR.Edit') }}{{ trans('HR.allowance/discount') }}
                            </h5>

                        </div>
                        <form class="user" method="POST"
                            action="{{ route('employees.updateInfo', ['id' => $allowance->id, 'type' => 'allown']) }}"
                            enctype = "multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">

                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="input-username">{{ trans('HR.NameArabic') }}</label>
                                            <input type="text" class="form-control @error('nameAr') is-invalid @enderror"
                                                id="nameAr" name="nameAr" value="{{ $allowance->nameAr }}" required>
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
                                                for="input-username">{{ trans('HR.NameEnglish') }}</label>
                                            <input type="text" class="form-control @error('nameEn') is-invalid @enderror"
                                                id="nameEn" name="nameEn" value="{{ $allowance->nameEn }}" required>
                                            @error('nameEn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="input-username">{{ trans('HR.allowance/discount') }}
                                            </label>
                                            <select class="form-control" name="type">
                                                <option value="allown" @if ($allowance->type == 'allown') selected @endif>
                                                    {{ trans('HR.allowance') }}</option>
                                                <option value="deducts" @if ($allowance->type == 'deducts') selected @endif>
                                                    {{ trans('HR.discount') }}</option>
                                            </select>
                                            @error('nameEn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary"
                                        style="float:right">{{ trans('HR.Save') }}</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"
                                        style="float:right">{{ trans('HR.retreat') }}</button>
                                </div>
                            </div>



                    </div>
                </div>
                <hr class="my-4" />
                </form>
            </div>
        @endforeach
    @endif


    <div class="modal fade" id="exampleModal_Select" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exampleModalLabel">


                        Enquiry Form
                    </h5>


                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">


                </div>

            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade modal" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">
                        {{ trans('HR.Add') }}{{ trans('HR.allowance/discount') }} </h5>
                    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>-->
                </div>
                <form class="user" method="POST" action="{{ route('employees.storeAllow') }}"
                    enctype = "multipart/form-data">
                    @csrf
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">

                                    <label class="form-control-label"
                                        for="input-username">{{ trans('HR.NameArabic') }}</label>
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
                                        for="input-username">{{ trans('HR.NameEnglish') }}</label>
                                    <input type="text" class="form-control @error('nameEn') is-invalid @enderror"
                                        id="nameEn" name="nameEn" required>
                                    @error('nameEn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="input-username">{{ trans('HR.allowance/discount') }} </label>
                                    <select class="form-control" name="type">
                                        <option value="allown">{{ trans('HR.allowance') }} </option>
                                        <option value="deducts">{{ trans('HR.discount') }}</option>
                                    </select>
                                    @error('nameEn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"
                                style="float:right">{{ trans('HR.Save') }}</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                style="float:right">{{ trans('HR.retreat') }}</button>
                        </div>
                    </div>



            </div>
        </div>
        <hr class="my-4" />
        </form>



        <div style="display: none">
            <h1 id="HRAreyousure"> {{ trans('HR.Areyousuretodelete') }}</h1>
            <h1 id="HRconfirmButtonText"> {{ trans('HR.confirmButtonText') }}</h1>
            <h1 id="HRcancelButtonText"> {{ trans('HR.cancelButtonText') }}</h1>
            {{-- document.getElementById('HRAreyousure').innerHTML --}}
        </div>
    @endsection
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        function showModal() {
            //console.log('star.', id)
            // var form = document.getElementById('deleteCategoryForm')
            // form.action = '/user/delete/' + id
            // form.action = '/Bills/' + id
            $('#CreateModal').modal('show')
        }

        function showEditModal(id) {
            $('#EditModal' + id).modal('show')

        }

        function handleDelete(id) {
            Swal.fire({
                title: document.getElementById('HRAreyousure').innerHTML,
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#f8a29e',
                confirmButtonText: document.getElementById('HRconfirmButtonText').innerHTML,
                cancelButtonText: document.getElementById('HRcancelButtonText').innerHTML
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/deleteItem/" + id + "/" + "allowance";
                }
            })
        }
    </script>
