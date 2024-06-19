@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('HR.permanences') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('HR.permanences') }}</li>
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
                            <h6 style="display: inline-block"> {{ trans('HR.Listofpermanence') }} </h6>
                            <a href="{{ route('attendance.createShift') }}" class="btn btn-primary floatmleft"><i
                                    class="fa fa-plus"></i> {{ trans('HR.Add') }}</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('HR.permanence') }}</th>
                                        <th> {{ trans('HR.Permanenttype') }}</th>
                                        <th> {{ trans('HR.numberofhours') }}</th>
                                        <th> {{ trans('HR.Fromhour') }} </th>
                                        <th> {{ trans('HR.tohour') }} </th>
                                        <th>{{ trans('HR.Options') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($shifts) > 0)
                                        @foreach ($shifts as $index => $shift)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $shift->nameAr }}</td>

                                                <td>
                                                    @if ($shift->type == 1)
                                                        {{ trans('HR.constant') }}
                                                    @elseif($shift->type == 2)
                                                        {{ trans('HR.flexible') }}
                                                    @endif
                                                </td>
                                                <td>{{ $shift->hours }}</td>
                                                {{-- @if ($shift->type == 1) --}}
                                                <td>{{ $shift->stTime }}</td>
                                                <td>{{ $shift->enTime }}</td>

                                                {{-- @endif --}}
                                                <td>

                                                    <a onclick="showEditModal('EditModal',{{ $shift->id }})"
                                                        class="btn btn-info"><i class="fa fa-edit"></i>
                                                        {{ trans('HR.Edit') }}</a>
                                                    <a href="#" class="btn btn-danger"
                                                        onclick="handleDelete({{ $shift->id }})"><i
                                                            class="fa fa-trash"></i> {{ trans('HR.Delete') }}</a>
                                                </td>

                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade modal" id="EditModal{{ $shift->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center" id="exampleModalLabel">
                                                                {{ trans('HR.Timepermanence') }} </h5>
                                                        </div>
                                                        <form class="user" method="POST"
                                                            action="{{ route('employees.updateInfo', ['id' => $shift->id, 'type' => 'shift']) }}"
                                                            enctype = "multipart/form-data">
                                                            @csrf
                                                            @method('put')
                                                            <div class="pl-lg-4">
                                                                <div class="row">

                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label"
                                                                                for="input-username">{{ trans('HR.NameArabic') }}
                                                                            </label>
                                                                            <input type="text"
                                                                                class="form-control @error('nameAr') is-invalid @enderror"
                                                                                id="nameAr" name="nameAr"
                                                                                value="{{ $shift->nameAr }}">
                                                                            @error('doc')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label"
                                                                                for="input-username">{{ trans('HR.NameEnglish') }}
                                                                            </label>
                                                                            <input type="text"
                                                                                class="form-control @error('nameEn') is-invalid @enderror"
                                                                                id="nameEn" name="nameEn"
                                                                                value="{{ $shift->nameEn }}">
                                                                            @error('doc')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label"
                                                                                for="input-username">
                                                                                {{ trans('HR.Permanenttype') }} </label>
                                                                            <div class="form-check">
                                                                                <input id="TypeProdect" name="type"
                                                                                    value="1" type="radio"
                                                                                    onclick="showTime()"
                                                                                    class="form-check-input"
                                                                                    @if ($shift->type == 1) checked @endif>
                                                                                <label class="form-check-label"
                                                                                    for="credit">
                                                                                    {{ trans('HR.constant') }}</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input id="TypeProdect" name="type"
                                                                                    value="2" type="radio"
                                                                                    onclick="hideTime()"
                                                                                    class="form-check-input"
                                                                                    @if ($shift->type == 2) checked @endif>
                                                                                <label class="form-check-label"
                                                                                    for="debit">
                                                                                    {{ trans('HR.flexible') }} </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label"
                                                                                for="input-username">  {{ trans('HR.Fromhour') }}
                                                                            </label>
                                                                            <input type="text"
                                                                                class="form-control @error('nameEn') is-invalid @enderror"
                                                                                id="stTime" name="stTime"
                                                                                value="{{ $shift->hours }}">
                                                                            @error('doc')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary"
                                                                        style="float:right">
                                                                        {{ trans('HR.Save') }}</button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal"
                                                                        style="float:right">{{ trans('HR.retreat') }}</button>
                                                                </div>
                                                            </div>



                                                    </div>
                                                </div>
                                                <hr class="my-4" />
                                                </form>
                                            </div>
                                            <!-- End Edit Modal -->
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center"> {{ trans('HR.NotFoundData') }} </td>
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


    <div style="display: none">
        <h1 id="HRAreyousure"> {{ trans('HR.Areyousuretodelete') }}</h1>
        <h1 id="HRconfirmButtonText"> {{ trans('HR.confirmButtonText') }}</h1>
        <h1 id="HRcancelButtonText"> {{ trans('HR.cancelButtonText') }}</h1>
    </div>
@endsection


<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
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
                window.location.href = "/deleteItem/" + id + "/" + "shift";
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
