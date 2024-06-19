@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Account.Accountingredirection') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Account.accounts') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Account.Accountingredirection') }} </li>
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
                <h3 class="card-title">     {{ trans('Account.AmendingtheAccountingManualDirective') }}  </h3>
              </div>
              <div class="card-body">

                <form class="user" method="POST" action="{{ route('RoutAccount.store') }}" enctype = "multipart/form-data">
                  @csrf
                  <input type="hidden" value="{{$RoutAccount->id}}" name="RoutID">
                  <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-username">      {{ trans('Account.Customers') }}   :</label>
                            <select class="form-control @error('Customers') is-invalid @enderror" id="Customers" name="Customers" >
                            <option value="false" style="display:none"></option>
                                @if ($RoutAccount->Customers ==0)
                                  <option selected value="0" > الميزانية العمومية</option>
                                @endif
                                @foreach ($Account as $key =>  $item)
                                   @if ($item->AccountID == $RoutAccount->Customers)
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
                                <label class="form-control-label" for="input-username">     {{ trans('Account.Suppliers') }}   :</label>
                                <select class="form-control @error('Suppliers') is-invalid @enderror" id="Suppliers" name="Suppliers" >
                                <option value="false" style="display:none"></option>
                                    @if ($RoutAccount->Suppliers ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $RoutAccount->Suppliers)
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
                                <label class="form-control-label" for="input-username">     {{ trans('Account.Inventory') }}   :</label>
                                <select class="form-control @error('Store') is-invalid @enderror" id="Store" name="Store" >
                                <option value="false" style="display:none"></option>
                                    @if ($RoutAccount->Store ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $RoutAccount->Store)
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
                                <label class="form-control-label" for="input-username">     {{ trans('Account.bank') }}  :</label>
                                <select class="form-control @error('Bank') is-invalid @enderror" id="Bank" name="Bank" >
                                <option value="false" style="display:none"></option>
                                    @if ($RoutAccount->Bank ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $RoutAccount->Bank)
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
                                    @if ($RoutAccount->treasury ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $RoutAccount->treasury)
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
                                <label class="form-control-label" for="input-username">     {{ trans('Account.sales') }}  :</label>
                                <select class="form-control @error('sales') is-invalid @enderror" id="sales" name="sales" >
                                <option value="false" style="display:none"></option>
                                    @if ($RoutAccount->sales ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $RoutAccount->sales)
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
                                <label class="form-control-label" for="input-username">      {{ trans('Account.Purchases') }} :</label>
                                <select class="form-control @error('purchases') is-invalid @enderror" id="purchases" name="purchases" >
                                <option value="false" style="display:none"></option>
                                    @if ($RoutAccount->purchases ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $RoutAccount->purchases)
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
                                <label class="form-control-label" for="input-username">       {{ trans('Account.Lossandprofits') }} :</label>
                                <select class="form-control @error('Profitloss') is-invalid @enderror" id="Profitloss" name="Profitloss" >
                                <option value="false" style="display:none"></option>
                                    @if ($RoutAccount->Profitloss ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $RoutAccount->Profitloss)
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
                                <label class="form-control-label" for="input-username">        {{ trans('Account.Salesreturns') }} :</label>
                                <select class="form-control @error('Salesreturns') is-invalid @enderror" id="Salesreturns" name="Salesreturns" >
                                <option value="false" style="display:none"></option>
                                    @if ($RoutAccount->Salesreturns ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $RoutAccount->Salesreturns)
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
                                <label class="form-control-label" for="input-username">      {{ trans('Account.Purchasereturns') }} :</label>
                                <select class="form-control @error('Purchreturns') is-invalid @enderror" id="Purchreturns" name="Purchreturns" >
                                <option value="false" style="display:none"></option>
                                    @if ($RoutAccount->Purchreturns ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $RoutAccount->Purchreturns)
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
                                <label class="form-control-label" for="input-username">     {{ trans('Account.Discountearned') }}   :</label>
                                <select class="form-control @error('Discountearned') is-invalid @enderror" id="Discountearned" name="Discountearned" >
                                <option value="false" style="display:none"></option>
                                    @if ($RoutAccount->Discountearned ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $RoutAccount->Discountearned)
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
                                <label class="form-control-label" for="input-username">       {{ trans('Account.Discountallowed') }}  :</label>
                                <select class="form-control @error('Discountpermitted') is-invalid @enderror" id="Discountpermitted" name="Discountpermitted" >
                                <option value="false" style="display:none"></option>
                                    @if ($RoutAccount->Discountpermitted ==0)
                                      <option selected value="0" > الميزانية العمومية</option>
                                    @endif
                                    @foreach ($Account as $key =>  $item)
                                       @if ($item->AccountID == $RoutAccount->Discountpermitted)
                                           <option selected value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
                                       @else
                                         <option  value="{{$item->AccountID}}" >  {{$item->AccountName}}</option>
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
                          <input type="submit" class="btn btn-primary" value="   {{ trans('Account.save') }} " style="width: 100%">
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
