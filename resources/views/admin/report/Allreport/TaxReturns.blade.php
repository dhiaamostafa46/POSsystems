@extends('layouts.dashboard')
<style>
  @media print
  {

    body{
      background-color: #fff !important;
      margin-right: 25px !important;
      margin-left: 25px !important;
    }
    .content-wrapper{
      background-color: #fff !important;
    }
    .invoice{
      width: 100% !important;
      margin: auto;
    }
    .print:last-child {
     page-break-after: auto;
    }
  .no-print, .no-print *
    {
        display: none !important;
    }
  .for-print{
    -webkit-print-color-adjust:exact;
  }
  table td { border:1px solid #000; }
  tr    { page-break-inside:avoid; page-break-after:auto }
  thead { display:table-header-group }
  tfoot { display:table-footer-group }
  .main{
    background-color: #fff !important;
   font-family: Arial, Helvetica, sans-serif !important;
  }
  .col-xs-7{
    width: 100% !important;
  }
}
@page { size: auto;  margin: 0mm; }
</style>
@section('content')
<div class="invoice p-3 mb-3">
  <!-- title row -->
  <div class="row">
    <div class="col-8">
      <h4>
        <img src="{{asset('dist/img/organizations/'.auth()->user()->organization->logo)}}" style="width: 70px;" alt="">
         <br>{{auth()->user()->organization->nameAr}}
      </h4>

    </div>
    <div class="col-4">
      <h4>
        <br><br>
        <small class="floatmleft"> {{ trans('Report.theaddress') }}: {{auth()->user()->branch->area}} - {{auth()->user()->branch->city}} - {{auth()->user()->branch->district}}</small><br>
        <small class="floatmleft">  {{ trans('Report.commercialregister') }}: {{auth()->user()->organization->CR}}</small><br>
        <small class="floatmleft">  {{ trans('Report.TaxNumber') }} : {{auth()->user()->organization->vatNo}}</small><br>
      </h4>
    </div>
    <!-- /.col -->
  </div>
  <hr>
  <h5>   {{ trans('Report.TaxreturnsReport') }}</h5>
  <hr>
  <!-- Table row -->
  <?php $years = range(strftime("%Y", time()) ,1900); ?>
  <input type="hidden" id="idTax" value="{{$id}}">
  <form class="row col-6 no-print" method="POST" action="{{route('setPeriod')}}">
    @csrf

    <div class="col-lg-6" style="float: none">
        <label for="">   {{ trans('Report.ChooseYears') }} </label>

        <select class="form-control" id="SelectYear" onchange="ConvertYears()">

            <?php foreach($years as $year) : ?>
              <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
  </form>




  {{-- - $credorders->sum('totalwvat') }}           - $credorders->sum('totalwvat') }}  --}}

  <div class="row">
        <div class="col-6">
            <div class="card text-center">
              <div class="card-header">
                {{ trans('Report.Facilitysales') }}
              </div>
              <div class="card-body">
                <table class="table text-center">
                    <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">   {{ trans('Report.Taxableamount') }}</th>
                        <th scope="col"> {{ trans('Report.Tax') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>   {{ trans('Report.sales') }}</td>
                        <td id="saleTotal">{{$sales->sum('totaldis') }}</td>
                        <td id="saleTax">{{$sales->sum('totalvat') }}</td>
                      </tr>
                      <tr>
                        <td>   {{ trans('Report.Creditnotes') }}</td>
                        <td id="Creditnotes">{{$credorders->sum('totaldis') }}</td>
                        <td id="CreditnotesTex">{{$credorders->sum('totalvat') }}</td>
                      </tr>
                      <tr>
                        <td>   {{ trans('Report.Purchases') }}</td>
                        <td id="purcheseTotal">{{ $Purchase->sum('totaldis') }}</td>
                        <td id="purcheseTax">{{ $Purchase->sum('totalvat') }}</td>
                      </tr>
                      <tr>
                        <td>   {{ trans('Report.Citynotices') }}</td>
                        <td id="Citynotices">{{$depiteOrder->sum('totaldis') }}</td>
                        <td id="Citynoticestax">{{$depiteOrder->sum('totalvat') }}</td>
                      </tr>
                      <tr>
                        <td>   {{ trans('Report.Expenses') }}</td>
                        <td id="Expenses">{{$Expenses->sum('total') }}</td>
                        <td id="Expensestax">{{$Expenses->sum('vat') }}</td>
                      </tr>
                      <tr>
                        <td>   {{ trans('Report.Total') }}</td>
                        <td id="Allsales">{{( $Expenses->sum('total') + $Purchase->sum('totaldis') - $depiteOrder->sum('totaldis') ) - ($sales->sum('totaldis') - $credorders->sum('totaldis') ) }} </td>
                        <td id="Allpurches">{{ ($Expenses->sum('vat') + $Purchase->sum('totalvat') - $depiteOrder->sum('totalvat'))  -( $sales->sum('totalvat') - $credorders->sum('totalvat'))   }}</td>
                      </tr>

                    </tbody>
                  </table>

              </div>
            </div>
        </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <hr>


  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-12">
      <a href="#" onclick="printDiv();" class="btn btn-default"><i class="fas fa-print"></i> {{ trans('Report.Print') }} </a>
    </div>
  </div>
</div>
<!-- /.invoice -->
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
  function printDiv(){
    window.print();
  }

function ConvertYears()
{

    var Select = document.getElementById('SelectYear').value;
    var idTax  = document.getElementById('idTax').value;

    $.ajax({
            type: 'post',
            url: "/ReportAll.TaxReturnsAjax",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{'select' :Select ,'id' :idTax },
            beforeSend: function(){
                //before sending the request
                //  console.log("sdsdsdfff");

            },
            success: function(response){
                //the request is success
                 console.log((response.expentotal.toFixed(2) + (response.Purchaseval.toFixed(2) - response.depittotal.toFixed(2)))   );
                 $('#saleTotal').text( response.salesval.toFixed(2));
                 $('#saleTax').text(response.salestax.toFixed(2));
                 $('#Creditnotes').text( response.credtotal.toFixed(2));
                 $('#CreditnotesTex').text(response.credordtax.toFixed(2));

                 $('#purcheseTotal').text( response.Purchaseval.toFixed(2));
                 $('#purcheseTax').text(  response.Purchasetax.toFixed(2));
                 $('#Citynotices').text( response.depittotal.toFixed(2));
                 $('#Citynoticestax').text(response.depittax.toFixed(2));

                 $('#Expenses').text( response.expentotal.toFixed(2));
                 $('#Expensestax').text(response.expentax.toFixed(2));


                 $('#Allsales').text(Number( (parseFloat(response.expentotal)+ (parseFloat(response.Purchaseval) - parseFloat(response.depittotal))) - (parseFloat(response.salesval) - parseFloat(response.credtotal) )).toFixed(2) );
                 $('#Allpurches').text(Number( (parseFloat(response.expentax)+ (parseFloat(response.Purchasetax) - parseFloat(response.depittax))) - (parseFloat(response.salestax) - parseFloat(response.credordtax) )).toFixed(2) );

        

              },
            complete: function(response){

        }
    });


    console.log(idTax);
}
</script>
