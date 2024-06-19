@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('HR.Jobs') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('HR.Jobs') }}</li>
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
                            <h6 style="display: inline-block">{{ trans('HR.Jobs') }} </h6>
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
                                        <th> {{ trans('HR.Dateadded') }}</th>
                                        <th>{{ trans('HR.Options') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($jobs) > 0)
                                        @foreach ($jobs as $index => $job)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $job->nameAr }}</td>
                                                <td>{{ $job->nameEn }}</td>
                                                <td>{{ $job->created_at }}</td>
                                                <td>

                                                    <a type="button"
                                                        onclick="showEditModal('EditModal',{{ $job->id }})"
                                                        class="btn btn-info"><i class="fa fa-edit"></i>
                                                        {{ trans('HR.Edit') }}</a>
                                                    <a href="#" class="btn btn-danger"
                                                        onclick="handleDelete({{ $job->id }})"><i
                                                            class="fa fa-trash"></i> {{ trans('HR.Delete') }}</a>
                                                </td>
                                            </tr>
                                            <!-- Edit Modal -->
                                            <div class="modal fade modal" id="EditModal{{ $job->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center" id="exampleModalLabel">
                                                                {{ trans('HR.EditJobs') }} </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="user" method="POST"
                                                                action="{{ route('employees.updateInfo', ['id' => $job->id, 'type' => 'job']) }}"
                                                                enctype = "multipart/form-data">
                                                                @csrf
                                                                @method('put')
                                                                <div class="pl-lg-4">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label"
                                                                                    for="input-username">{{ trans('HR.NameArabic') }}</label>
                                                                                <input type="text"
                                                                                    class="form-control @error('nameAr') is-invalid @enderror"
                                                                                    id="nameAr" name="nameAr"
                                                                                    value="{{ $job->nameAr }}">
                                                                                @error('nameAr')
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label"
                                                                                    for="input-username">{{ trans('HR.NameEnglish') }}</label>
                                                                                <input type="text"
                                                                                    class="form-control @error('nameEn') is-invalid @enderror"
                                                                                    id="nameEn" name="nameEn"
                                                                                    value="{{ $job->nameEn }}">
                                                                                @error('nameEn')
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary"
                                                                            style="float:right">{{ trans('HR.Save') }}</button>
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-dismiss="modal"
                                                                            style="float:right">{{ trans('HR.retreat') }}</button>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
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




    <!-- Create Modal -->
    <div class="modal fade modal" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('HR.NewJobs') }} </h5>
                </div>
                <div class="modal-body">
                    <form class="user" method="POST" action="{{ route('employees.storeJob') }}"
                        enctype = "multipart/form-data">
                        @csrf
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                            for="input-username">{{ trans('HR.NameArabic') }}</label>
                                        <input type="text" class="form-control @error('nameAr') is-invalid @enderror"
                                            id="nameAr" name="nameAr">
                                        @error('nameAr')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                            for="input-username">{{ trans('HR.NameEnglish') }}</label>
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

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"
                                    style="float:right">{{ trans('HR.Save') }}</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    style="float:right">{{ trans('HR.retreat') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


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

        $('#CreateModal').modal('show')
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
                window.location.href = "/deleteItem/" + id + "/" + "job";
            }
        })
    }

   function showEditModal(...params)
   {
        // alert(modelName);
        var modelName = '#'+params[0]+params[1];
     //alert(modelName);
       $(modelName).modal('show');

   }
</script>
