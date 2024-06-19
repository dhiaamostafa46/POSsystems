@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('HR.Task') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('HR.Task') }}</li>
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
                            <h3 class="card-title"> {{ trans('HR.Task') }}</h3>

                        </div>
                        <div class="card-body">
                            <form class="user" method="POST" action="{{ route('Task.store') }}"
                                enctype = "multipart/form-data">
                                @csrf
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.EmployeeName') }}</label>
                                                <select class="form-control" id="emp" name="emp">
                                                    @foreach (auth()->user()->organization->Employee as $item)
                                                        <option value="{{ $item->id }}"> {{ $item->nameAr }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.titketask') }}</label>
                                                <input type="text" id="title" name="tital" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <textarea id="summernote" rows="3" name="desc" id="desc">
                                            </textarea>
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
