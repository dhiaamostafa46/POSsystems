@extends('layouts.dashboard')
<style>
  @font-face {
  font-family:ARABTYPE;
  src:url("assets/fonts/ARABTYPE.TTF");
  
  }
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
<style>
table {
  page-break-inside: auto;
}
tr {
  page-break-inside: avoid;
  page-break-after: auto;
}
thead {
  display: table-header-group;
}
tfoot {
  display: table-footer-group;
}
.invoice{
  width: 80%;
  margin: auto;
}
</style>
@section('content')
<div class="invoice print">
  <!-- this row will not appear when printing -->
  <div class="row no-print mt-3">
    <div class="col-11" style="margin: auto">
      <a href="#" onclick="printDiv();" class="btn btn-default" style="margin-right: 5px;"><i class="fas fa-print"></i> طباعة</a>
      <button type="button" class="btn btn-primary float-right">
        <i class="fas fa-download"></i> تحميل PDF
      </button>
    </div>
  </div>
  <div class="row" style="margin-top: 0px;">
    <div class="col-3">
      <div style="display: block;margin-top:2px;">
        @if (!empty(auth()->user()->organization->logo) && auth()->user()->organization->logo != "default.png")
        <img src="{{asset('dist/img/organizations/'.auth()->user()->organization->logo)}}" width="150px" height="150px" alt="">
        @endif
      </div>
    </div>
    <div class="col-6">
      <?php $daat = date('Y-m');?>
      <h5 style="text-align: center;margin:5px"><strong>{{auth()->user()->organization->nameAr}}</strong></h5>
      <br>
      <h6 style="text-align: center;margin:5px"><strong>كشف الرواتب لشهر <?php echo $daat; ?></strong></h6>
      
      
      
    </div>
    <div class="col-3"></div>
  </div>
  <hr>
  <div class="row col-12"  style="margin: auto">
    
    
    <table class="col-12 mt-3 border for-print" style="margin:auto;float:none;text-align:center;padding:5px" >
      <thead>
        <tr  style="border: 1px solid #000;">
          <!--<td style="font-size: small">Item Code<br> كود الصنف</td>-->
          <th>#</th>
          <th style="font-size: small;background-color: rgb(202, 199, 199);"> الموظف</th>
          <th style="font-size: small;background-color: rgb(202, 199, 199);"> الراتب الأساسي</th>
          <th style="font-size: small;background-color: rgb(202, 199, 199);">الراتب الإجمالي</th>
          @foreach ($allowns as $index => $item)
          <th style="font-size: small;background-color: rgb(202, 199, 199);">{{$item->nameAr}} </th>
          @endforeach
          <th style="font-size: small;background-color: rgb(202, 199, 199);"> صافي الراتب </th>
        </tr>
       
      </thead>
      <tbody>
        @if(count($payrolls) > 0)
      @foreach ($payrolls as  $index => $salary)
     
      <tr>
        <td>{{$index+1}}</td>
        
        <td style="font-size:small">{{$salary->employee->nameAr}}</td>
        <td style="font-size:small">{{$salary->salary->basicSalary}}</td>
        <td style="font-size:small">{{$salary->salary->fullSalary}}</td>
       
       <?php $all = json_decode($salary->allowns); ?>
       @foreach ($all as $index => $item)
        
          <td style="font-size:small">{{$item}}</td>
        @endforeach
        <?php $alld = json_decode($salary->deducts); ?>
        @foreach ($alld as $index => $item)
         
           <td style="font-size:small">{{$item}}</td>
         @endforeach

        <td style="font-size:small">{{$salary->netSalary}}</td>
        
      </tr>
      @endforeach
      @endif
      <hr>
      <?php
            $size = 66 - count($payrolls)*1.5;
      ?>
      <tr style="height: {{$size}}vh;">
        <td style="font-size:small;">&nbsp;</td>
        <td style="font-size:small"></td>
        <td style="font-size:small"></td>
        <td style="font-size:small"></td>
        <td style="font-size:small"></td>
        <td style="font-size:small"></td>
      </tr>
      </tbody>
      
    </table>
  </div>
</div>
@endsection

<script>
  function printDiv(){
    window.print();
  }
</script>