@extends('layouts.dashboard')

@section('content')

<style>
    .select2-container{
        width: 100% !important;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">   {{ trans('Report.Reports') }}   </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb floatmleft">
          <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
          <li class="breadcrumb-item active">   {{ trans('Report.Reports') }} </li>
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
                <h3 class="card-title">   {{ trans('Report.Listofreports') }}   </h3>
              </div>
              <div class="card-body">
                <div class="row rptpg">
                    <div class="col-4">
                        <h2 class="text-muted">{{ trans('Report.sales') }} </h2>
                        <ul>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.Repotcustomers')}}">  {{ trans('Report.Customerdata') }} </a>
                            </li>
                            <li>
                                <a class="view_sale_order" data-toggle="modal" data-target="#Customerbalance" >  {{ trans('Report.Customeraccountstatement') }} </a>
                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.CustomerbalanceRoeport')}}"   >    {{ trans('Report.Customerbalances') }} </a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.Repotcredorders')}}" >  {{ trans('Report.Creditnotes') }} </a>
                            </li>

                            <li>
                                <a class="view_sale_order"  href="{{route('reports.sales')}}" >  {{ trans('Report.salesreport') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.salesfatorah')}}" >    {{ trans('Report.Salesinvoices') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order"   data-toggle="modal" data-target="#MounthOrder"   >   {{ trans('Report.Dailysales') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order"   data-toggle="modal" data-target="#TodayOrder"   >   {{ trans('Report.Monthlysales') }}  </a>
                            </li>

                            <li>
                                <a class="view_sale_order"   data-toggle="modal" data-target="#CashierSales"   >    {{ trans('Report.Cashiersales') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order"   data-toggle="modal" data-target="#NadelSales"   >    {{ trans('Report.Waitersales') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order"   href="{{route('ReportAll.durationsSales')}}"  >     {{ trans('Report.Shiftsales') }}  </a>
                            </li>

                            <li>
                                <a class="view_sale_order" data-toggle="modal" data-target="#ProdectSale"  >   {{ trans('Report.Salesitemreport') }} </a>
                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.MoreSalesProdect')}}" >    {{ trans('Report.Bestsellingitems') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.lessSalesProdect')}}" >     {{ trans('Report.Lesssellingitems') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.Profitability')}}" >    {{ trans('Report.Profitabilityofitems') }}    </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-4">
                        <h2 class="text-muted"> {{ trans('Report.Purchases') }}</h2>
                        <ul>
                            <li>
                                <a class="view_sale_order" data-toggle="modal" data-target="#suppliersbalance"   >   {{ trans('Report.Suppliersaccountstatement') }} </a>
                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.suppliersbalanceRoeport')}}">    {{ trans('Report.Supplierbalances') }} </a>
                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.Repotoutcomes')}}"> {{ trans('Report.Expenseinvoices') }}</a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.Repotsuppliers')}}">  {{ trans('Report.Supplierdata') }}</a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.Repotpurchases')}}">   {{ trans('Report.Purchaseinvoices') }}</a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.Repotdebitorder')}}">   {{ trans('Report.Citynotices') }}</a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('reports.sales')}}"> {{ trans('Report.Purchasingreport') }}</a>
                            </li>
                            <li>
                                <a class="view_sale_order" data-toggle="modal" data-target="#ProdectPuchees"  >   {{ trans('Report.Purchasesitemreport') }}</a>
                            </li>

                        </ul>
                        <h2 class="text-muted">{{ trans('Report.restaurant') }}</h2>
                        <ul>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.PriceProdect')}}" >   {{ trans('Report.Pricesofminoitems') }}</a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.TableReport')}}" > {{ trans('Report.Reporttables') }}   </a>
                            </li>
                            {{-- <li>
                                <a class="view_sale_order" >تقرير الإجازات (بالموظف)</a>
                            </li>
                            <li>
                                <a class="view_sale_order" >تقرير الإجازات (نوع الإجازه)</a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="col-4">
                        <h2 class="text-muted"> {{ trans('Report.Inventory') }}   </h2>
                        <ul>

                            <li>
                                <a class="view_sale_order"   href="{{route('ReportAll.ReportALLproducts')}}" >  {{ trans('Report.Productsreport') }}    </a>
                            </li>
                             <li>
                                <a class="view_sale_order"  data-toggle="modal" data-target="#ProdectMove"    >  {{ trans('Report.Productmovementreport') }}  </a>

                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.prodcategories')}}">     {{ trans('Report.Productsectionsreport') }}  </a>

                            </li>
                            <li>
                                <a class="view_sale_order" data-toggle="modal" data-target="#StoreTainted"  >        {{ trans('Report.Reportdamagedproductsbywarehouse') }}  </a>

                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.Manufactur')}}">     {{ trans('Report.Manufacturingorderreports') }}</a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.Arrangement')}}">   {{ trans('Report.Inventorysettlementreports') }} </a>
                            </li>
                            <li>
                                <a class="view_sale_order" data-toggle="modal" data-target="#OpenStore"  >     {{ trans('Report.Openingbalancesofitems') }}   </a>
                            </li>

                            <li>
                                <a class="view_sale_order" data-toggle="modal" data-target="#StoreConversion"  >     {{ trans('Report.Inventorytransferreports') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order" data-toggle="modal" data-target="#Valuation">    {{ trans('Report.Rateproducts') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order" data-toggle="modal" data-target="#HangeStore" >  {{ trans('Report.Suspenderconversionsreport') }}   </a>
                            </li>
                            {{-- <li>
                                <a class="view_sale_order" href="{{route('ReportAll.OpeningStore')}}"> الرصيد الافتتاحي للمخزون  </a>
                            </li> --}}

                            {{-- <li>
                                <a class="view_sale_order"  href="#">تقرير التحويل المخزني</a>

                            </li>

                           --}}
                             {{-- <li>
                                <a class="view_sale_order" href="#">أسعار المنتجات</a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="#">  تقرير الكميات المتاحة</a>

                            </li>
                            <li>
                                <a class="view_sale_order">المخزون </a>
                            </li> --}}
                            {{-- <li>
                                <a class="view_sale_order"  href="#">حركة المخزن </a>
                            </li>
                            <li>
                                <a class="view_sale_order"href="#"> تقيم المخزون </a>
                            </li>

                            <li>
                              <a class="view_sale_order"  href="#">المشتريات المباعة</a>
                            </li>

                            <li>
                                <a class="view_sale_order"  href="#"> المخزون المتوقع </a>
                            </li> --}}

                        </ul>


                    </div>
                    <div class="col-4">
                        <h2 class="text-muted">{{ trans('Report.accounts') }} </h2>
                        <ul>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.AccountingGuide')}}" >  {{ trans('Report.Accountstree') }}</a>
                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.Repotjournals')}}"> {{ trans('Report.Dailyrestrictions') }}</a>

                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.RepotBalances')}}">{{ trans('Report.Openingbalances') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.RepotBank')}}">  {{ trans('Report.Bankaccounts') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.RepotTreasury')}}">   {{ trans('Report.Fundaccounts') }} </a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.ReportSandatReceive')}}">  {{ trans('Report.receipt') }} </a>
                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.ReportSandatDeliver')}}">  {{ trans('Report.Billsofexchange') }} </a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-4">
                        <h2 class="text-muted">  {{ trans('Report.Taxreturns') }}  </h2>
                        <ul>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.TaxReturns',1)}}">      {{ trans('Report.Thefirstquarteroftheyear') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.TaxReturns',2)}}">    {{ trans('Report.TheSecondquarteroftheyear') }}   </a>
                            </li>
                            <li>
                                <a class="view_sale_order"  href="{{route('ReportAll.TaxReturns',3)}}">      {{ trans('Report.Thethirdquarteroftheyear') }} </a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.TaxReturns',4)}}">     {{ trans('Report.TheFourthquarteroftheyear') }}   </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-4">
                        <h2 class="text-muted">  {{ trans('Report.Accountingactivities') }} </h2>
                        <ul>
                            {{-- <li>
                                <a class="view_sale_order" href="#"> كشف حساب</a>
                            </li> --}}
                            <li>
                                <a href="#" data-toggle="modal" data-target="#AcountGridel" class="view_sale_order" >   {{ trans('Report.accountstatement') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.incomelist')}}">   {{ trans('Report.incomelist') }}  </a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.TrialBalance')}}" >   {{ trans('Report.TrialBalance') }}</a>
                            </li>
                            <li>
                                <a class="view_sale_order" href="{{route('ReportAll.Ledger')}}">    {{ trans('Report.Ledgersummary') }} </a>
                            </li>
                            <li>
                                <a  data-toggle="modal" data-target="#LedgerAccount"  href="#">          {{ trans('Report.Ledgerforacurrentaccount') }}</a>
                            </li>
                            <li>
                                <a class="view_sale_order"href="{{route('ReportAll.Balancesheet')}}" >    {{ trans('Report.Balancesheet') }} </a>
                            </li>
                            {{-- <li>
                                <a class="view_sale_order" >  مركز التكلفة </a>
                            </li> --}}
                        </ul>
                    </div>


                </div>

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

<!-- Button trigger modal -->


<div class="modal fade modal" id="ProdectSale" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('Report.Products') }}     </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="POST" action="{{ route('ReportAll.ProdectSale') }}" enctype = "multipart/form-data">
              @csrf
              <div class="row mb-3">
                <h5 class="modal-title text-center" id="exampleModalLabel">   {{ trans('Report.Entertheproductname') }}  </h5>
                <div class="col-sm-8">
                    <select class="livesearch form-control" name="nameProdectSale" id="nameProdectSale" required>
                    </select>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label"> {{ trans('Report.from') }} </label>
                <div class="col-sm-10">
                  <input type="date"  name="from"   value="<?php echo date("Y-m-d", strtotime("-1 month", strtotime(date("Y/m/d"))));  ?>"     class="form-control" >
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"> {{ trans('Report.to') }} </label>
                  <div class="col-sm-10">
                    <input type="date"  name="to" value="<?php echo date('Y-m-d'); ?>" class="form-control" >
                  </div>
              </div>
              <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary"> {{ trans('Report.search') }} </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade modal" id="AcountGridel" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">    {{ trans('Report.ChooseAccount') }}    </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="POST" action="{{ route('ReportAll.Accountsummary') }}" enctype = "multipart/form-data">
              @csrf
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">   {{ trans('Report.account') }} </label>
                <div class="col-sm-10">
                    <select class="livesearchAccount form-control" name="AccountSelect" id="AccountSelect" >
                    </select>
                  {{-- <select name="AccountSelect" id="AccountSelect"   class="form-control">
                      @foreach ($account as $item)
                        <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif </option>
                      @endforeach
                  </select> --}}
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label"> {{ trans('Report.from') }}  </label>
                <div class="col-sm-10">
                  <input type="date"  name="from"   value="<?php echo date("Y-m-d", strtotime("-1 month", strtotime(date("Y/m/d"))));  ?>"     class="form-control" >
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">{{ trans('Report.to') }}  </label>
                  <div class="col-sm-10">
                    <input type="date"  name="to" value="<?php echo date('Y-m-d'); ?>" class="form-control" >
                  </div>
              </div>
              <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary">{{ trans('Report.search') }}   </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

{{-- <div class="modal fade modal" id="ProdectSale" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">  المنتجات  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">

              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">  اختار المنتج </label>
                <div class="col-sm-8">
                    <select class="livesearch form-control" name="nameProdectSale" id="nameProdectSale" required>

                    </select>
                </div>
                <input type="button"  onclick="ProdectSale()" id="buttonSereachStore" class="btn col-sm-2  btn-primary" value="عرض">
              </div>


          </div>
        </div>
      </div>
    </div>
</div> --}}


<div class="modal fade modal" id="ProdectPuchees" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog   modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">    {{ trans('Report.Products') }}  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form action="{{route('ReportAll.Purchproduct')}}"  method="POST">
                @csrf
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">    {{ trans('Report.Entertheproductname') }}  </label>
                <div class="col-sm-10">
                    <select class="livesearch form-control" name="sername" id="sername">

                    </select>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label"> {{ trans('Report.from') }}  </label>
                <div class="col-sm-10">
                  <input type="date"  name="from"   value="<?php echo date("Y-m-d", strtotime("-1 month", strtotime(date("Y/m/d"))));  ?>"     class="form-control" >
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"> {{ trans('Report.to') }}  </label>
                  <div class="col-sm-10">
                    <input type="date"  name="to" value="<?php echo date('Y-m-d'); ?>" class="form-control" >
                  </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label"> </label>
                <div class="col-sm-10">
                    <input type="submit"  id="buttonSereachStore" class="btn col-sm-2  btn-primary" value=" {{ trans('Report.search') }} ">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade modal" id="ProdectMove" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog  " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">    {{ trans('Report.Productmovement') }}   </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label"> {{ trans('Report.warehouse') }}</label>
                <div class="col-sm-10">
                  <select name="warehouse" id="warehouse"   class="form-control">
                    <option value="-1::-1::-1"> {{ trans('Report.All') }} </option>
                      @foreach ($account as $item)
                        @if ($item->SourceID==125)
                            <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif </option>
                        @endif
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label"> {{ trans('Report.product') }} </label>
                <div class="col-sm-10">
                    <select class="livesearch form-control" name="nameProdect" id="nameProdect">

                    </select>
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"> </label>
                  <div class="col-sm-10">
                    <input type="button"  onclick="ProdectMove()" id="buttonSereachStore" class="btn col-sm-2  btn-primary" value=" {{ trans('Report.search') }}">
                  </div>
              </div>

        </div>

      </div>
    </div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"><script>




function ProdectSale(){

Store=document.getElementById('nameProdectSale').value;
console.log(Store);
var name = $('#nameProdectSale :selected').val(); // English
const myArray = name.split("-", 2);
window.location.href = "/ReportAll.ProdectSale/"+myArray[1];
}

function ProdectMove(){

Store=document.getElementById('nameProdect').value;
warehouse=document.getElementById('warehouse').value;
var name = $('#nameProdect :selected').val(); // English
const myArray = name.split("-", 2);
window.location.href = "/ReportAll.Reportproducts/"+myArray[1]+"/"+warehouse;
}




  function SereachStore(){

    Store=document.getElementById('sername').value;
    console.log(Store);
    var name = $('#sername :selected').val(); // English
    const myArray = name.split("-", 2);
    window.location.href = "/ReportAll.Purchproduct/"+myArray[1];
}





        $('.livesearch').select2({
            placeholder: 'أدخل إسم المنتج ',
            ajax: {
                url: '/pur-autocomplete-search',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.nameAr,
                                id: item.id+"-"+item.barcode

                            }
                        })
                    };
                },
                cache: true
            }
        });



        $('.livesearchAccount').select2({
            placeholder: 'أدخل إسم الحساب ',
            ajax: {
                url: '/Account-autocomplete-search',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.AccountName,
                                id: item.id+"::"+item.AccountID+'::'+item.AccountName

                            }
                        })
                    };
                },
                cache: true
            }
        });




        $('#sername').change(function(){

            var name = $('#sername :selected').val(); // English

            const myArray = name.split("-", 2);
            //alert(myArray[1])
            console.log(myArray[1]);

        });

   </script>

@endsection






























  <div class="modal fade modal" id="Customerbalance" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">   {{ trans('Report.Choosetheclient') }}   </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="POST" action="{{ route('ReportAll.Accountsummary') }}" enctype = "multipart/form-data">
              @csrf
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">  {{ trans('Report.Client') }}  </label>
                <div class="col-sm-10">
                  <select name="AccountSelect" id="AccountSelect"   class="form-control">
                      @foreach ($account as $item)
                        @if ($item->SourceID==124)
                            <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif</option>
                        @endif
                        {{-- <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">{{$item->AccountName}}</option> --}}
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label"> {{ trans('Report.from') }} </label>
                <div class="col-sm-10">
                  <input type="date"  name="from"   value="<?php echo date("Y-m-d", strtotime("-1 month", strtotime(date("Y/m/d"))));  ?>"     class="form-control" >
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"> {{ trans('Report.to') }} </label>
                  <div class="col-sm-10">
                    <input type="date"  name="to" value="<?php echo date('Y-m-d'); ?>" class="form-control" >
                  </div>
              </div>
              <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary"> {{ trans('Report.search') }} </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modal" id="suppliersbalance" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('Report.Choosethesupplier') }}    </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="POST" action="{{ route('ReportAll.Accountsummary') }}" enctype = "multipart/form-data">
              @csrf
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label"> {{ trans('Report.supplier') }}   </label>
                <div class="col-sm-10">
                  <select name="AccountSelect" id="AccountSelect"   class="form-control">
                      @foreach ($account as $item)
                        @if ($item->SourceID==221)
                            <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif </option>
                        @endif
                        {{-- <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">{{$item->AccountName}}</option> --}}
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">{{ trans('Report.from') }}  </label>
                <div class="col-sm-10">
                  <input type="date"  name="from"   value="<?php echo date("Y-m-d", strtotime("-1 month", strtotime(date("Y/m/d"))));  ?>"     class="form-control" >
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">{{ trans('Report.to') }}  </label>
                  <div class="col-sm-10">
                    <input type="date"  name="to" value="<?php echo date('Y-m-d'); ?>" class="form-control" >
                  </div>
              </div>
              <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary">{{ trans('Report.search') }}  </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade modal" id="StoreTainted" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">    {{ trans('Report.Selectthewarehouse') }}  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="POST" action="{{ route('ReportAll.Damagedproducts') }}" enctype = "multipart/form-data">
              @csrf
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ trans('Report.warehouse') }}</label>
                <div class="col-sm-10">
                  <select name="AccountSelect" id="AccountSelect"   class="form-control">
                     <option value="-1::-1::-1"> {{ trans('Report.All') }} </option>
                      @foreach ($account as $item)
                        @if ($item->SourceID==125)
                            <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif </option>
                        @endif
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">{{ trans('Report.from') }}  </label>
                <div class="col-sm-10">
                  <input type="date"  name="from"   value="<?php echo date("Y-m-d", strtotime("-1 month", strtotime(date("Y/m/d"))));  ?>"   class="form-control" >
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">{{ trans('Report.to') }} </label>
                  <div class="col-sm-10">
                    <input type="date"  name="to" value="<?php echo date('Y-m-d'); ?>"  class="form-control" >
                  </div>
              </div>
              <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary">{{ trans('Report.search') }}  </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade modal" id="OpenStore" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">     {{ trans('Report.Selectthewarehouse') }}  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="POST" action="{{ route('ReportAll.OpenStoreRoeport') }}" enctype = "multipart/form-data">
              @csrf
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label"> {{ trans('Report.warehouse') }}</label>
                <div class="col-sm-10">
                  <select name="AccountSelect" id="AccountSelect"   class="form-control">
                    <option value="-1::-1::-1"> {{ trans('Report.All') }} </option>
                      @foreach ($account as $item)
                        @if ($item->SourceID==125)
                            <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif </option>
                        @endif
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label"> {{ trans('Report.from') }}  </label>
                <div class="col-sm-10">
                  <input type="date"  name="from" value="<?php echo date("Y-m-d", strtotime("-1 month", strtotime(date("Y/m/d"))));  ?>"   class="form-control" >
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"> {{ trans('Report.to') }}  </label>
                  <div class="col-sm-10">
                    <input type="date"  name="to"  value="<?php echo date('Y-m-d'); ?>"  class="form-control" >
                  </div>
              </div>
              <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary"> {{ trans('Report.search') }}  </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade modal" id="StoreConversion" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">    {{ trans('Report.Inventorytransfers') }}   </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="POST" action="{{ route('ReportAll.StoreConversionRoeport') }}" enctype = "multipart/form-data">
              @csrf
              {{-- <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">الحساب</label>
                <div class="col-sm-10">
                  <select name="AccountSelect" id="AccountSelect"   class="form-control">
                      @foreach ($account as $item)
                        @if ($item->SourceID==125)
                            <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">{{$item->AccountName}}</option>
                        @endif
                      @endforeach
                  </select>
                </div>
              </div> --}}
              <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> {{ trans('Report.Transferredfrom') }}  </label>
                <div class="col-sm-9">
                    <select name="from" id="from"   class="form-control">
                        @foreach ($account as $item)
                          @if ($item->SourceID==125)
                              <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif</option>
                          @endif
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-3 col-form-label"> {{ trans('Report.Transferredto') }}  </label>
                  <div class="col-sm-9">
                    <select name="to" id="to"   class="form-control">
                        @foreach ($account as $item)
                          @if ($item->SourceID==125)
                              <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif </option>
                          @endif
                        @endforeach
                    </select>
                  </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> {{ trans('Report.from') }} </label>
                <div class="col-sm-9">
                  <input type="date"  name="datafrom" value="<?php echo date("Y-m-d", strtotime("-1 month", strtotime(date("Y/m/d"))));  ?>"  class="form-control" >
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-3 col-form-label"> {{ trans('Report.to') }} </label>
                  <div class="col-sm-9">
                    <input type="date"  name="datato"  value="<?php echo date('Y-m-d'); ?>"  class="form-control" >
                  </div>
              </div>
              <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary"> {{ trans('Report.search') }} </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modal" id="HangeStore" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">      {{ trans('Report.Pendingtransfers') }}  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="POST" action="{{ route('ReportAll.HangeStore') }}" enctype = "multipart/form-data">
              @csrf

              <div class="row mb-3">
                <label class="col-sm-3 col-form-label">  {{ trans('Report.Transferredfrom') }} </label>
                <div class="col-sm-9">
                    <select name="from" id="from"   class="form-control">
                        @foreach ($account as $item)
                          @if ($item->SourceID==125)
                              <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif </option>
                          @endif
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">  {{ trans('Report.Transferredto') }}  </label>
                  <div class="col-sm-9">
                    <select name="to" id="to"   class="form-control">
                        @foreach ($account as $item)
                          @if ($item->SourceID==125)
                              <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">   @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif </option>
                          @endif
                        @endforeach
                    </select>
                  </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> {{ trans('Report.from') }} </label>
                <div class="col-sm-9">
                  <input type="date"  name="datafrom" value="<?php echo date("Y-m-d", strtotime("-1 month", strtotime(date("Y/m/d"))));  ?>"  class="form-control" >
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-3 col-form-label"> {{ trans('Report.to') }} </label>
                  <div class="col-sm-9">
                    <input type="date"  name="datato"  value="<?php echo date('Y-m-d'); ?>"  class="form-control" >
                  </div>
              </div>

              <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary"> {{ trans('Report.search') }} </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>





  <div class="modal fade modal" id="LedgerAccount" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('Report.ChooseAccount') }}  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form method="POST" action="{{ route('ReportAll.LedgerAccount') }}" enctype = "multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">{{ trans('Report.account') }}</label>
                  <div class="col-sm-10">
                    <select name="AccountSelect" id="AccountSelect"   class="form-control">
                        @foreach ($account as $item)
                          <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif </option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">{{ trans('Report.from') }} </label>
                  <div class="col-sm-10">
                    <input type="date"  name="from" value="<?php echo date("Y-m-d", strtotime("-1 month", strtotime(date("Y/m/d"))));  ?>"  class="form-control" >
                  </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">{{ trans('Report.to') }} </label>
                    <div class="col-sm-10">
                      <input type="date"  name="to"  value="<?php echo date('Y-m-d'); ?>"  class="form-control" >
                    </div>
                </div>

                <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary"> {{ trans('Report.search') }} </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade modal" id="CashierSales" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('Report.choosethecashier') }}  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form method="get" action="{{ route('ReportAll.CashierSales') }}" enctype = "multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">{{ trans('Report.cashier') }}</label>
                  <div class="col-sm-10">
                    <select name="AccountSelect" id="AccountSelect"   class="form-control">
                        @foreach ($User as $item)
                           @if ($item->role->permissions->contains('pageID', $pages->where('code','Saleswindow')->first()->id ))
                              <option value="{{$item->id}}">{{$item->name}}</option>
                           @endif
                        @endforeach
                    </select>
                  </div>
                </div>
                <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary">{{ trans('Report.search') }} </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade modal" id="NadelSales" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('Report.choosetheWaiter') }}   </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form method="get" action="{{ route('ReportAll.NadelSales') }}" enctype = "multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">{{ trans('Report.Waiter') }} </label>
                  <div class="col-sm-10">
                    <select name="AccountSelect" id="AccountSelect"   class="form-control">
                        @foreach ($User as $item)
                           @if ($item->role->permissions->contains('pageID', $pages->where('code','WaiterPOS')->first()->id ))
                              <option value="{{$item->id}}">{{$item->name}}</option>
                           @endif
                        @endforeach
                    </select>
                  </div>
                </div>
                <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary">{{ trans('Report.search') }}  </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade modal" id="MounthOrder" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">  مبيعات يومية  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form method="POST" action="{{ route('ReportAll.TodayOrder') }}" enctype = "multipart/form-data">
                @csrf

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">يوم  </label>
                  <div class="col-sm-10">
                    <input type="date"  name="from" value="<?php echo date("Y-m-d");  ?>"  class="form-control" >
                  </div>
                </div>
                <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary">بحث </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade modal" id="TodayOrder" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">   {{ trans('Report.Monthlysales') }}  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form method="POST" action="{{ route('ReportAll.MonthOrder') }}" enctype = "multipart/form-data">
                @csrf

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">{{ trans('Report.Month') }}  </label>
                  <div class="col-sm-10">
                    <input type="month"  name="from" value="<?php echo date("F", strtotime(date("Y-m-d"))) ;  ?>"  class="form-control" >
                  </div>
                </div>
                <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary">{{ trans('Report.search') }} </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>









  <div class="modal fade modal" id="Valuation" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('Report.Selectthewarehouse') }}     </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="col-12 row mt-3">
          <div class="col-12">
            <form class="user" id="passwordForm" method="POST" action="{{ route('ReportAll.Valuation') }}" enctype = "multipart/form-data">
              @csrf
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ trans('Report.warehouse') }} </label>
                <div class="col-sm-10">
                  <select name="AccountSelect" id="AccountSelect"   class="form-control">
                      @foreach ($account as $item)
                        @if ($item->SourceID==125)
                            <option value="{{$item->id}}::{{$item->AccountID}}::{{$item->AccountName}}">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{$item->AccountName}} @else{{$item->AccountNameEn}}@endif </option>
                        @endif
                      @endforeach
                  </select>
                </div>
              </div>
              <button type="submit " style="margin: 0px 81px;"  class="btn btn-primary">{{ trans('Report.search') }}  </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
