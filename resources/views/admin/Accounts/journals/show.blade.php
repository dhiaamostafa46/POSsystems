@extends('layouts.dashboard')

@section('content')
<style>
    .form-control{
        height: 30px;
    }
</style>
<form class="user" method="POST" action="{{route('journals.update',$Journal->id)}}"  enctype = "multipart/form-data">
    @csrf
    <section class="content">
        <div class="container-fluid">
            <input type="hidden" name="flagCounter" id="flagCounter" value="{{$Journal->Items}}">
            <input type="hidden" name="journalsTotal" id="journalsTotal" value="{{$Journal->Total}}" >
        <!-- Small boxes (Stat box) -->
        <div class="row mt-2">
            <div class="col-12">
            <div class="card card-primary" style="height: 110px">
                <div class="card-body">

                    <div>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                            <label class="form-control-label" for="input-username">     {{ trans('Account.Registrationnumber') }}    :</label>
                            <input type="text" name="journalsID"  class="form-control"id="journalsID" value="{{$Journal->id}}" readonly>
                            @error('datejournals')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                            <label class="form-control-label" for="input-username">   {{ trans('Account.Ref') }}     :</label>
                            <input type="text"  class="form-control @error('Refjournals') is-invalid @enderror" readonly value="{{$Journal->Ref}}" id="Ref" name="Refjournals" placeholder=" المرجع">
                            @error('Refjournals')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                            <label class="form-control-label" for="input-username">   {{ trans('Account.date') }}   :</label>
                            <input type="date"  value="<?php echo date('Y-m-d'); ?>" class="form-control @error('datejournals') is-invalid @enderror" readonly  value="{{$Journal->Ref}}" id="datejournals" name="datejournals" placeholder=" اسم البنك ">
                            @error('Refjournals')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                            <label class="form-control-label" for="input-username">    {{ trans('Account.description') }}   :</label>
                            <input type="text"  class="form-control @error('dec') is-invalid @enderror" value="{{$Journal->dec}}"readonly value="dec" id="dec" name="dec" placeholder=" وصف ">
                            @error('dec')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">    </label>

                                <a href="{{route('journals.pdf',$Journal->id)}}" type="button" onclick="SaveALlJournals()" id="buttonSave"   class="btn btn-primary" style="width: 100%">   {{ trans('Account.Print') }} </a>
                           </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">    </label>

                                <a href="{{route('journals.index')}}" type="button" onclick="SaveALlJournals()" id="buttonSave"   class="btn btn-primary" style="width: 100%">   {{ trans('Account.Back') }} </a>
                           </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>

            <div class="col-12">
            <div class="card card-primary" style="min-height: 250px">

                <div class="card-body">
                <div style="height: 370px;overflow-y: scroll;">
                    <table id="example4" class="table table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 5%;">  {{ trans('Account.accountnumber') }} </th>
                        <th style="width: 30%;">  {{ trans('Account.accountname') }} </th>
                        <th style="width: 10%;">{{ trans('Account.debtor') }}</th>
                        <th style="width: 10%;"> {{ trans('Account.Creditor') }} </th>
                        <th style="width: 40%;"> {{ trans('Account.comments') }}</th>
                    </tr>
                    </thead>

                    <tbody id="JournalsSub">
                        @foreach ($Journal->JournalChild  As $key=>$item)

                            <tr>
                                <th style="width: 5%;">{{$key+1}}</th>
                                <th style="width: 10%;">{{$item->CodeAccount}}</th>
                                <th style="width: 30%;">{{$item->nameAccount}}</th>
                                <th style="width: 10%;">{{$item->Debit}}</th>
                                <th style="width: 10%;">{{$item->Credit	}}</th>
                                <th style="width: 35%;">{{$item->dec}}</th>
                            </tr>

                        @endforeach

                    </tbody>
                    </table>
                </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card" >

                <div class="card-body">

                    <table class="table text-center" >
                        <tbody>
                            <tr>
                                <th style="width: 5%;"> </th>
                                <th style="width: 10%;"></th>
                                <th style="width: 30%;"> {{ trans('Account.total') }}  </th>
                                <th style="width: 10%;" id="totalDebit">{{$Journal->Total}}</th>
                                <th style="width: 10%;" id="totalCredit">{{$Journal->Total}}</th>
                                <th style="width: 35%;"></th>

                            </tr>
                        </tbody>
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
</form>






























@endsection
