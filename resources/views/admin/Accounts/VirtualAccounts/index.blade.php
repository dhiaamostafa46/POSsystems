@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Account.Defaultuseraccounts') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Account.accounts') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Account.Defaultuseraccounts') }} </li>
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
                <h3 class="card-title">    {{ trans('Account.Virtualaccounts') }}  </h3>
              </div>
              <div class="card-body">

                <form class="user" method="POST" action="{{ route('VirtualAccounts.store') }}" enctype = "multipart/form-data">
                  @csrf
                  <input type="hidden" value="{{$Virtual->id}}" name="RoutID">
                  <div class="pl-lg-4">
                    <div class="row">


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">     {{ trans('Account.bank') }}  :</label>
                                <select class="form-control @error('Bank') is-invalid @enderror" id="Bank" name="Bank" >
                                <option value="false" style="display:none"></option>
                                    @if ($Virtual->bank ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $Virtual->bank)
                                           <option selected value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @else
                                         <option  value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">     {{ trans('Account.Treasury') }}  :</label>
                                <select class="form-control @error('treasury') is-invalid @enderror" id="treasury" name="treasury" >
                                <option value="false" style="display:none"></option>
                                    @if ($Virtual->treasury ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $Virtual->treasury)
                                           <option selected value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @else
                                         <option  value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">      {{ trans('Account.sales') }}   :</label>
                                <select class="form-control @error('sales') is-invalid @enderror" id="sales" name="sales" >
                                <option value="false" style="display:none"></option>
                                    @if ($Virtual->sale ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $Virtual->sale)
                                           <option selected value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @else
                                         <option  value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">      {{ trans('Account.Salesreturns') }}  :</label>
                                <select class="form-control @error('Salesreturns') is-invalid @enderror" id="Salesreturns" name="Salesreturns" >
                                <option value="false" style="display:none"></option>
                                    @if ($Virtual->returnsale ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $Virtual->returnsale)
                                           <option selected value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @else
                                         <option  value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">     {{ trans('Account.Purchases') }} :</label>
                                <select class="form-control @error('purchases') is-invalid @enderror" id="purchases" name="purchases" >
                                <option value="false" style="display:none"></option>
                                    @if ($Virtual->purch ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $Virtual->purch)
                                           <option selected value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @else
                                         <option  value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">      {{ trans('Account.Purchasereturns') }}  :</label>
                                <select class="form-control @error('Purchreturns') is-invalid @enderror" id="Purchreturns" name="Purchreturns" >
                                <option value="false" style="display:none"></option>
                                    @if ($Virtual->returnpuch ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $Virtual->returnpuch)
                                           <option selected value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @else
                                         <option  value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">      {{ trans('Account.Costcenter') }}  :</label>
                                <select class="form-control @error('Profitloss') is-invalid @enderror" id="CostCenter" name="CostCenter" >
                                <option value="false" style="display:none"></option>
                                    @foreach ($cost as $key =>  $item)
                                       @if ($item->CostCodeID == $Virtual->costcenter)
                                           <option selected value="{{$item->CostCodeID}}" >  {{$item->CostName}}</option>
                                       @else
                                         <option  value="{{$item->CostCodeID}}" >  {{$item->CostName}}</option>
                                       @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>



                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <input type="submit" class="btn btn-primary" value="  {{ trans('Account.save') }}" style="width: 100%">
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
