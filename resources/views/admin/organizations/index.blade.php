@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('Company.Facilityinformation') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('Company.Establishmentdata') }} </a></li>
                        <li class="breadcrumb-item active"> {{ trans('Company.Facilityinformation') }} </li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('Company.details') }}</h3>
                            <div class="btnAddsys">
                                <a href="{{ route('organizations.edit', $org->id) }}" class="btn btn-secondary"><i
                                        class="fa fa-edit"></i> {{ trans('Company.Updatingdata') }}</a>
                                {{-- <a href="#" onclick="getLink();" class="btn btn-info"><i class="fa fa-link"></i>
                                    {{ trans('Company.Facilitylink') }}</a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Company.EstablishmentnameArabic') }}</label>
                                                <h6 class="text-primary">{{ $org->nameAr }}</h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Company.EstablishmentnameEnglish') }}</label>
                                                <h6 class="text-primary">{{ $org->nameEn }}</h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Company.CommercialRegistrationNo') }}</label>
                                                <h6 class="text-primary">{{ $org->CR }}</h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Company.TaxNumber') }}</label>
                                                <h6 class="text-primary">{{ $org->vatNo }}</h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Company.Insbpnmbr') }}</label>
                                                <h6 class="text-primary">{{ $org->Insbpnmbr }}</h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Company.Chamber') }}</label>
                                                <h6 class="text-primary">{{ $org->Chamber }}</h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Company.Nofacility') }}</label>
                                                <h6 class="text-primary">{{ $org->Nofacility }}</h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Company.Ntionladdress') }}</label>
                                                <h6 class="text-primary">{{ $org->Ntionladdress }}</h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Company.Establishmentlogo') }}</label>
                                                <h6 class="text-primary">
                                                    <img src="{{ asset('public/dist/img/organizations/' . $org->logo) }}"
                                                        style="width: 100px" alt="">
                                                </h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Company.Establishmentseal') }}</label>
                                                <h6 class="text-primary">
                                                    <img src="{{ asset('public/dist/img/organizations/' . $org->signature) }}"
                                                        style="width: 100px" alt="">
                                                </h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @if (auth()->user()->organization->activity === 3)
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">
                                                        {{ trans('Company.Openingbalance') }} </label>
                                                    <h6 class="text-primary">{{ $org->opening_balance }}</h6>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">
                                                        {{ trans('Company.Availablebalance') }} </label>
                                                    <h6 class="text-primary">{{ $org->available_balance }}</h6>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @else
                                        @endif

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                    for="input-username">{{ trans('Company.Unauthorizedpayment') }}</label>
                                                <h6 class="text-danger">
                                                    {{ trans('Company.Electronicpaymentisnotlinked') }} &nbsp;&nbsp;
                                                    <a href="{{ route('payment.partners') }}" class="btn btn-success"><i
                                                            class="fa fa-link"></i>
                                                        {{ trans('Company.Paymentgatewaylink') }}</a>
                                                    <a href="https://my.paylink.sa/auth/login" class="btn btn-info"
                                                        target="_blank"><i class="fa fa-link"></i>
                                                        {{ trans('Company.Mywalletisinpaylink') }} </a>
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
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                @if ( auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d') )->contains('code' ,$package->where('nameEn','branches')->first()->nameEn)  )
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('Company.Branches') }} </h3>
                            <a href="{{ route('branches.create') }}" class="btn btn-secondary btnAddsys"><i
                                    class="fa fa-plus"></i> {{ trans('Company.Addbranches') }}</a>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> {{ trans('Company.branchname') }} </th>
                                        <th> {{ trans('Company.Dateadded') }} </th>
                                        <th>{{ trans('Company.Options') }} </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($org->branches) > 0)
                                        @foreach ($org->branches as $index => $branch)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $branch->nameAr }}</td>
                                                <td>{{ $branch->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('branches.show', $branch->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-eye"></i>
                                                        {{ trans('Company.Show') }} </a>
                                                    <a href="{{ route('branches.edit', $branch->id) }}"
                                                        class="btn btn-info"><i class="fa fa-edit"></i>
                                                        {{ trans('Company.Edit') }} </a>
                                                    <a href="#" class="btn btn-danger"
                                                        onclick="handleDelete({{ $branch->id }})"><i
                                                            class="fa fa-trash"></i> {{ trans('Company.delete') }} </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                {{ trans('Company.delNotfoundDataete') }} </td>
                                        </tr>
                                    @endif
                                    </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                @endif
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- link Modal -->
    <div class="modal fade modal" id="linkModel" tabindex="-1" role="dialog" aria-labelledby="linkModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('Company.Facilitylink') }}</h5>
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
                                                id="link" name="link"
                                                placeholder="{{ trans('Company.Facilitylink') }}">
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
                                                class="btn btn-primary" value="{{ trans('Company.copy') }}"
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


    <div style="display: none">
        <h1 id="titalmesssage"> {{ trans('Company.Areyousuretodelete') }} </h1>
        <h1 id="confirmButtonText"> {{ trans('Company.confirmButtonText') }} </h1>
        <h1 id="cancelButtonText"> {{ trans('Company.cancelButtonText') }} </h1>
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
                window.location.href = "/delete-user/" + id;
            }
        })
    }

    function getLink(id) {
        document.getElementById('link').value = window.location.protocol + '//' + window.location.host +
            '/restaurant/' + {{ auth()->user()->orgID }};
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
