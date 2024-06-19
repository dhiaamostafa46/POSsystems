@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('HR.Asset') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('HR.Asset') }}</li>
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
                            <h3 class="card-title"> {{ trans('HR.details') }}</h3>

                        </div>
                        <div class="card-body">
                            <form class="user" method="POST" action="{{ route('assetses.store') }}"
                                enctype = "multipart/form-data">
                                @csrf
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.NameArabic') }}</label>
                                                <input type="text"
                                                    class="form-control @error('nameAr') is-invalid @enderror"
                                                    id="nameAr" name="nameAr" required
                                                    placeholder=" {{ trans('HR.NameArabic') }}">
                                                @error('nameAr')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.NameEnglish') }}</label>
                                                <input type="text"
                                                    class="form-control @error('nameEn') is-invalid @enderror"
                                                    id="nameEn" onkeypress="return ValidateKey();" name="nameEn"
                                                    placeholder="  {{ trans('HR.NameEnglish') }}" required>
                                                @error('nameEn')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Modelnumber') }}</label>
                                                <input type="tel" class="form-control" id="deviceNo" name="deviceNo" placeholder="mdxxxxxxx" required pattern="[0-9]{10}" title="Please enter a 10-digit phone number">

                                                @error('deviceNo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Branch') }}</label>
                                                <select class="form-control @error('branchID') is-invalid @enderror"
                                                    id="branchID" name="branchID" required>
                                                    <option value=""> {{ trans('HR.Selectthebranch') }}</option>
                                                    @foreach (auth()->user()->organization->branches as $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->nameAr }}</option>
                                                    @endforeach
                                                </select>
                                                @error('branchID')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Assettype') }} : </label>

                                                <select class="form-control" name="typeID" id="typeID">
                                                    <option value=""> {{ trans('HR.ChooseType') }} </option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->nameAr }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Status1') }} : </label>
                                                <div class="form-check">
                                                    <input id="TypeProdect" name="assetStatus"
                                                        value="{{ trans('HR.New') }} " type="radio"
                                                        class="form-check-input" checked>
                                                    <label class="form-check-label" for="credit"> {{ trans('HR.New') }}
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input id="TypeProdect" name="assetStatus"
                                                        value="{{ trans('HR.User') }}" type="radio"
                                                        class="form-check-input">
                                                    <label class="form-check-label" for="credit"> {{ trans('HR.User') }}
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Additionaldetails') }} : </label>
                                                <br>
                                                <textarea name="details" class="form-control" id="" cols="100" rows="10"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name"> </label>
                                                <br>
                                                <input type="submit" class="btn btn-primary"
                                                    value=" {{ trans('HR.Save') }} " style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <hr class="my-4" />
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

<script>
    function showTime() {

        document.getElementById('stTime').style.display = "block";
        document.getElementById('enTime').style.display = "block";


    }

    function hideTime() {

        document.getElementById('stTime').style.display = "none";
        document.getElementById('enTime').style.display = "none";

    }
</script>
