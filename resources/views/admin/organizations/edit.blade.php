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
                            <h3 class="card-title"> {{ trans('Company.Updatingdata') }}</h3>
                        </div>
                        <div class="card-body">
                            <form class="user" method="POST" action="{{ route('organizations.update', $org->id) }}"
                                enctype = "multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Company.EstablishmentnameArabic') }}</label>
                                                <input type="text"
                                                    class="form-control  @error('CR') is-invalid @enderror" id="nameAr"
                                                    onkeypress="return ValidateKeyArabic();" name="nameAr"
                                                    value="{{ $org->nameAr }}">
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
                                                <input type="text"
                                                    class="form-control  @error('CR') is-invalid @enderror"
                                                    onkeypress="return ValidateKey();" id="nameEn" name="nameEn"
                                                    value="{{ $org->nameEn }}">
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
                                                <input type="text"
                                                    class="form-control  @error('Insbpnmbr') is-invalid @enderror" id="Insbpnmbr"
                                                    name="Insbpnmbr" value="{{ $org->Insbpnmbr }}">
                                                @error('Insbpnmbr')
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
                                                <input type="text"
                                                    class="form-control  @error('Chamber') is-invalid @enderror" id="Chamber"
                                                    name="Chamber" value="{{ $org->Chamber }}">
                                                @error('Chamber')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Company.Nofacility') }}

                                                </label>
                                                <input type="text"
                                                    class="form-control  @error('Nofacility') is-invalid @enderror" id="Nofacility"
                                                    name="Nofacility" value="{{ $org->Nofacility }}">
                                                @error('Nofacility')
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
                                                <input type="text"
                                                    class="form-control  @error('Ntionladdress') is-invalid @enderror" id="Ntionladdress"
                                                    name="Ntionladdress" value="{{ $org->Ntionladdress }}">
                                                @error('Ntionladdress')
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
                                                <input type="text"
                                                    class="form-control  @error('CR') is-invalid @enderror" id="CR"
                                                    name="CR" value="{{ $org->CR }}">
                                                @error('CR')
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
                                                <input type="number"
                                                    class="form-control @error('vatNo') is-invalid @enderror" min="15"
                                                    id="vatNo" name="vatNo" value="{{ $org->vatNo }}">
                                                @error('vatNo')
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
                                                        style="width: 100px;height:100px" alt="">
                                                </h6>
                                                <input type="file"
                                                    class="form-control  @error('img') is-invalid @enderror" id="img"
                                                    name="img">
                                                @error('img')
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
                                                        style="width: 100px;height:100px" alt="">
                                                </h6>
                                                <input type="file"
                                                    class="form-control @error('signature') is-invalid @enderror"
                                                    id="signature" name="signature">
                                                @error('signature')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-primary" style="width: 100%">
                                                {{ trans('Company.save') }}</button>
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

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
    function handleDelete(id) {
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
                window.location.href = "/delete-user/" + id;
            }
        })
    }



    function checkInput(input) {
        // Check if the input is a number and equals 15
        if (!isNaN(input) && Number(input) === 15) {
            return true;
        } else {
            return false;
        }
    }
</script>
