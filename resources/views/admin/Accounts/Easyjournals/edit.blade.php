@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Account.Dailyrestrictions') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Account.accounts') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Account.Dailyrestrictions') }} </li>
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
                <h3 class="card-title">    {{ trans('Account.editentry') }}    </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('Easyjournals.update',$data->id) }}" enctype = "multipart/form-data">
                  @csrf
                  <input type="hidden" name="idProcessor" id="" value="{{$data->Type}}">
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('Account.date') }}   :</label>
                          <input type="date"  class="form-control @error('DateEntries') is-invalid @enderror" value="{{$data->date}}" id="DateEntries" name="DateEntries" placeholder=" ">
                          @error('DateEntries')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">      {{ trans('Account.from') }}  :</label>
                          {{-- <input type="text"  class="form-control @error('NameAccountBank') is-invalid @enderror" id="NameAccountBank" name="NameAccountBank" placeholder="اسم حساب البنك "> --}}
                          <select class="form-control @error('FromEntries') is-invalid @enderror" id="FromEntries"  onkeypress="return ValidateKey();" name="FromEntries" placeholder="حساب الاب ">
                            <option value="false" style="display:none"></option>
                            @foreach ($from as $item)
                              @if ($item->AccountName==$data->JournalChild[0]->nameAccount)
                                <option selected value="{{$item->AccountID}}::{{ $item->AccountName}}">{{ $item->AccountName}}</option>
                            @else
                                <option value="{{$item->AccountID}}::{{ $item->AccountName}}">{{ $item->AccountName}}</option>
                            @endif

                            @endforeach
                          </select>

                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Account.to') }}:</label>
                          <select class="form-control @error('ToEntries') is-invalid @enderror" id="ToEntries"  onkeypress="return ValidateKey();" name="ToEntries" placeholder="حساب الاب ">
                            <option value="false" style="display:none"></option>

                            @foreach ($To as $item)
                              @if ($item->AccountName==$data->JournalChild[1]->nameAccount)
                                <option selected value="{{$item->AccountID}}::{{ $item->AccountName}}">{{ $item->AccountName}}</option>
                            @else
                                <option value="{{$item->AccountID}}::{{ $item->AccountName}}">{{ $item->AccountName}}</option>
                            @endif

                            @endforeach
                         </select>
                        </div>
                      </div>




                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">    {{ trans('Account.thevalue') }}:</label>
                          <input type="number"  class="form-control @error('amount') is-invalid @enderror" id="amount"  value="{{$data->Total}}" name="amount" placeholder="    {{ trans('Account.thevalue') }}">
                           <input type="hidden"  name="Oldamount" value="{{$data->Total}}">
                          @error('amount')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">     {{ trans('Account.thedescription') }}  :</label>
                          <textarea  class="form-control @error('desc') is-invalid @enderror" id="amount" name="desc"   placeholder=" {{ trans('Account.thedescription') }} " rows="3" cols="3">{{$data->dec}}</textarea>
                          @error('desc')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>


                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <input type="submit" class="btn btn-primary" value=" {{ trans('Account.save') }}" style="width: 100%">
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
