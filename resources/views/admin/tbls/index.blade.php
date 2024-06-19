@extends('layouts.dashboard')
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('Products.TableBranch') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('Products.TableBranch') }} </a></li>
                        <li class="breadcrumb-item active"> {{ trans('Products.ListTable') }} </li>
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
                            <h3 class="card-title"> {{ trans('Products.ListTable') }} </h3>
                            <div class="btnAddsys">
                                <a href="#" onclick="handleTbls();" class="btn btn-primary"><i class="fa fa-plus"></i>
                                    {{ trans('Products.AddTable') }} </a>
                                &nbsp;
                                <a href="#" onclick="handleTblsGroup();" class="btn btn-primary"><i
                                        class="fa fa-plus"></i> {{ trans('Products.AddTableGroup') }} </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> {{ trans('Products.Name') }} </th>
                                        <th> {{ trans('Products.branch') }} </th>
                                        <th> {{ trans('Products.amounttable') }}</th>
                                        <th> {{ trans('Products.Datecreated') }}</th>
                                        <th> {{ trans('Products.Options') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($tbls) > 0)
                                        @foreach ($tbls as $index => $tbl)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $tbl->tableNo }}</td>
                                                @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                    <td>{{ $tbl->branch->nameAr }}</td>
                                                @else
                                                    <td>{{ $tbl->branch->nameEn }}</td>
                                                @endif
                                                <td>{{ $tbl->amount }}</td>
                                                <td>{{ $tbl->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('tbls.show', $tbl->id) }}" class="btn btn-primary"><i
                                                            class="fa fa-eye"></i> {{ trans('Products.Show') }} </a>
                                                    <a href="#" onclick="handleTblsEdit({{ $tbl->id }})"
                                                        class="btn btn-info"><i class="fa fa-edit"></i>
                                                        {{ trans('Products.Edite') }} </a>
                                                    <a href="#" class="btn btn-danger"
                                                        onclick="handleDelete({{ $tbl->id }})"><i
                                                            class="fa fa-trash"></i> {{ trans('Products.Delete') }} </a>
                                                @if ( auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d') )->contains('code' ,$package->where('nameEn','menu')->first()->nameEn)  )
                                                    <a href="#" class="btn btn-primary"
                                                        onclick="handleLink({{ $tbl->id }})"><i
                                                            class="fa fa-link"></i> {{ trans('Products.link') }} </a>
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center"> {{ trans('Products.NoFound') }}</td>
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
    @foreach ($tbls as $index => $tbl)
        <!-- Extras Modal -->
        <div class="modal fade" id="tblsModel{{ $tbl->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form class="user" id="tblsForm" method="POST" action="{{ route('tbls.update', $tbl->id) }}"
                    enctype = "multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> {{ trans('Products.AddTableGroup') }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">
                                            {{ trans('Products.nametable') }} </label>
                                        <input type="text" class="form-control @error('tableNo') is-invalid @enderror"
                                            id="tableNo" name="tableNo" placeholder="اكتب اسم الطاولة/رقم الطاولة"
                                            value="{{ $tbl->tableNo }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">
                                            {{ trans('Products.amounttable') }}
                                        </label>
                                        <input type="number" class="form-control" id="amount"
                                            value="{{ $tbl->amount }}" name="amount">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">
                                            {{ trans('Products.branch') }}
                                        </label>
                                        <select id="branch"class="form-control" name="branch">
                                            @foreach (auth()->user()->organization->branches as $key => $item)
                                                <option value="{{ $item->id }}"
                                                    @if ($tbl->tableNo == $item->id) @selected(true) @endif>
                                                    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                        {{ $item->nameAr }}
                                                    @else
                                                        {{ $item->nameEn }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">
                                            {{ trans('Products.areyoudiscount') }} </label>
                                        <select id="TypeProdect"class="form-control" name="discount">
                                            <option @if ($tbl->discount == 0) @selected(true) @endif
                                                value="0"> {{ trans('Products.no') }} </option>
                                            <option @if ($tbl->discount == 1) @selected(true) @endif
                                                value="1"> {{ trans('Products.yes') }} </option>
                                        </select>

                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('Products.Close') }}</button>
                            <input type="submit" class="btn btn-primary" value="{{ trans('Products.save') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- <div class="modal fade modal" id="tblsModel{{ $tbl->id }}" tabindex="-1" role="dialog"
            aria-labelledby="tblsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('Products.EditTable') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-left:0px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="col-12 row mt-3">
                        <div class="col-12">
                            <form class="user" id="tblsForm" method="POST"
                                action="{{ route('tbls.update', $tbl->id) }}" enctype = "multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control @error('tableNo') is-invalid @enderror"
                                                    id="tableNo" name="tableNo"
                                                    placeholder="اكتب اسم الطاولة/رقم الطاولة"
                                                    value="{{ $tbl->tableNo }}">
                                                @error('tableNo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary"
                                                    value="{{ trans('Products.save') }}" style="width: 100%">
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
        </div> --}}

        <!-- Extras Modal -->
    @endforeach
    <!-- Tbl Modal -->
    <!-- link Modal -->
    <div style="display: none">
        <h1 id="titalmesssage"> {{ trans('Products.Areyousuretodelete') }} </h1>
        <h1 id="confirmButtonText"> {{ trans('Products.confirmButtonText') }} </h1>
        <h1 id="cancelButtonText"> {{ trans('Products.cancelButtonText') }} </h1>
    </div>
@endsection



<div class="modal fade" id="tblsModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="user" id="tblsForm" method="POST" action="{{ route('tbls.store') }}"
            enctype = "multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ trans('Products.AddTable') }}</h5>
                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">
                                    {{ trans('Products.nametable') }} </label>
                                <input type="text" class="form-control @error('tableNo') is-invalid @enderror"
                                    id="tableNo" name="tableNo">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">
                                    {{ trans('Products.amounttable') }}
                                </label>
                                <input type="number" class="form-control" id="amount" name="amount">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">
                                    {{ trans('Products.branch') }}
                                </label>
                                <select id="branch"class="form-control" name="branch">
                                    @foreach (auth()->user()->organization->branches as $key => $item)
                                        <option value="{{ $item->id }}">
                                            @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                {{ $item->nameAr }}
                                            @else
                                                {{ $item->nameEn }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">
                                    {{ trans('Products.areyoudiscount') }} </label>
                                <select id="TypeProdect"class="form-control" name="discount">
                                    <option value="0"> {{ trans('Products.no') }} </option>
                                    <option value="1"> {{ trans('Products.yes') }} </option>
                                </select>

                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('Products.Close') }}</button>
                    <input type="submit" class="btn btn-primary" value="{{ trans('Products.save') }}">
                </div>
            </div>
        </form>
    </div>
</div>




<!-- Tbl Modal -->

<!-- Tbl Modal -->

<div class="modal fade" id="tblsGroupModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="user" id="tblsGroupForm" method="POST" action="{{ route('tblsGroup.store') }}"
            enctype = "multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ trans('Products.AddTableGroup') }}</h5>
                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">
                                    {{ trans('Products.counttable') }} </label>
                                <input type="text" class="form-control @error('quantity') is-invalid @enderror"
                                    id="quantity" name="quantity">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">
                                    {{ trans('Products.amounttable') }}
                                </label>
                                <input type="number" class="form-control" id="amount" name="amount">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">
                                    {{ trans('Products.branch') }}
                                </label>
                                <select id="branch"class="form-control" name="branch">
                                    @foreach (auth()->user()->organization->branches as $key => $item)
                                        <option value="{{ $item->id }}">
                                            @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                {{ $item->nameAr }}
                                            @else
                                                {{ $item->nameEn }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">
                                    {{ trans('Products.areyoudiscount') }} </label>
                                <select id="TypeProdect"class="form-control" name="discount">
                                    <option value="0"> {{ trans('Products.no') }} </option>
                                    <option value="1"> {{ trans('Products.yes') }} </option>
                                </select>

                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('Products.Close') }}</button>
                    <input type="submit" class="btn btn-primary" value="{{ trans('Products.save') }}">
                </div>
            </div>
        </form>
    </div>
</div>






<!-- Tbl Modal -->
<!-- link Modal -->
<div class="modal fade modal" id="linkModel" tabindex="-1" role="dialog" aria-labelledby="linkModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('Products.LinkTable') }} </h5>
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
                                            class="btn btn-primary" value="{{ trans('Products.Copy') }}"
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
                window.location.href = "/delete-tbl/" + id;
            }
        })
    }

    function handleTbls() {
        $('#tblsModel').modal('show')
    }

    function handleTblsGroup() {
        $('#tblsGroupModel').modal('show')
    }

    function handleTblsEdit(id) {
        $('#tblsModel' + id).modal('show')
    }

    function handleLink(id) {
        document.getElementById('link').value = window.location.protocol + '//' + window.location.host + '/maintable/' +
            {{ auth()->user()->branchID }} + '/' + id;
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
