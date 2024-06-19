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
                            <label class="form-control-label" for="input-username">     {{ trans('Account.Registrationnumber') }}   :</label>
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
                            <label class="form-control-label" for="input-username"> {{ trans('Account.Ref') }}   :</label>
                            <input type="text"  class="form-control @error('Refjournals') is-invalid @enderror" value="{{$Journal->Ref}}" id="Ref" name="Refjournals" placeholder=" {{ trans('Account.Ref') }}">
                            @error('Refjournals')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                            <label class="form-control-label" for="input-username">  {{ trans('Account.date') }}  :</label>
                            <input type="date"  value="<?php echo date('Y-m-d'); ?>" class="form-control @error('datejournals') is-invalid @enderror"   value="{{$Journal->Ref}}" id="datejournals" name="datejournals" placeholder=" اسم البنك ">
                            @error('Refjournals')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                            <label class="form-control-label" for="input-username">  {{ trans('Account.description') }}  :</label>
                            <input type="text"  class="form-control @error('dec') is-invalid @enderror" value="{{$Journal->dec}}" value="dec" id="dec" name="dec" placeholder=" {{ trans('Account.description') }} ">
                            @error('dec')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">    </label>
                                <input type="submit"   id="submitSave" class="btn btn-primary" value="{{ trans('Account.save') }}" tyle="width: 100%;">
                                <input type="button" onclick="SaveALlJournals()" id="buttonSave"  style="width: 100%;display: none;" class="btn btn-primary" value="{{ trans('Account.save') }}" style="width: 100%">
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
                <div style="height: 600px;overflow-y: scroll;">
                    <table id="example4" class="table table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 30%;">  {{ trans('Account.accountname') }} </th>
                        <th style="width: 10%;"> {{ trans('Account.debtor') }} </th>
                        <th style="width: 10%;"> {{ trans('Account.Creditor') }} </th>
                        <th style="width: 40%;"> {{ trans('Account.comments') }} </th>
                        <th style="width: 5%;"> {{ trans('Account.Options') }} </th>
                    </tr>
                    </thead>

                    <tbody id="JournalsSub">
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
                                <th style="width: 5%;"> <a href="#" class="btn btn-primary" id="additemsJournals"><i class="fa fa-plus"></i></a> </th>
                                <th style="width: 30%;">{{ trans('Account.total') }} </th>
                                <th style="width: 10%;" id="totalDebit">{{$Journal->Total}}</th>
                                <th style="width: 10%;" id="totalCredit">{{$Journal->Total}}</th>
                                <th style="width: 40%;"></th>
                                <th style="width: 5%;"></th>
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











































<div  style="display: none">
    <h1 id="Thedebitside">  {{ trans('Account.Thedebitside') }} </h1>
    <h1 id="Themainout">  {{ trans('Account.Themainout') }} </h1>
    <h1 id="Theregistrationfilledout">  {{ trans('Account.Theregistrationfilledout') }} </h1>
</div>






<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>

    var rows = 0;
    var nameAr = "";
    var existRow=0;

    $( document ).ready(function() {

        var count = 0;
        debt=0;
         credit=0;
        desc="";



         @foreach($Journal->JournalChild as $index=>$product )
                debt=parseInt({{$product->Debit}});
                credit=parseInt({{$product->Credit}});
                desc =String({{$product->dec}});
            data ="";
            @foreach($AccountingGuide as   $produ )
                data = data+'<option value="{{$produ->id}}::{{$produ->AccountID}}::{{ $produ->AccountName}}"  @if ($produ->AccountID ==$product->CodeAccount) selected @endif>{{$produ->AccountName }}</option>';
            @endforeach


            $("#JournalsSub").append(

                '<tr id="trItemsJournal{{$index}}"><th>{{$index}}</th>'+
                '<th><select onChange="doChangSelect({{$index}})" class="form-control"  name="selectAcount[]["selectAcount"]">'+
                        '<option value="false" style="display:none"></option>'+data+'</select>'+
                '</th>'+
                '<th> <input type="number"  class="form-control "  onchange="calcuateItem()" id="DebitSub{{$index}}" name="DebitSub[]["DebitSub"]"  value="'+debt+'"> </th>'+
                '<th> <input type="number"  class="form-control "  onchange="calcuateItem()"  id="CreditSub{{$index}}" name="CreditSub[]["CreditSub"]" value="'+credit+'">  </th>'+
                '<th> <input type="text"  class="form-control " value="'+desc+'"   name="decSub[]["decSub"]"  placeholder="ملاحظات " > </th>'+
                '<th> <a href="#" class="btn btn-danger" onclick="removeItem({{$index}})"><i class="fa fa-trash"></i></a></th></tr>'
                );

         @endforeach

         totalJournals();


    });


    $('#additemsJournals').click(function(){

        counter=$('#flagCounter').val();
         getByitemsJournals(parseInt(counter));
         $('#flagCounter').val(parseInt(counter)+1);
    });



    function SaveALlJournals(){
        data=ChackTotal();
        console.log(data);
        if(parseInt(data)==1)
        {
            ddd= document.getElementById('Theregistrationfilledout').innerHTML ;
            Swal.fire({
             
                    title: ddd,
                    icon: "warning"
                });


        }
        else if(parseInt(data)==2)
        {
            ddd= document.getElementById('Themainout').innerHTML ;
            Swal.fire({
               
                title: ddd,
                    icon: "warning"
                });

        }
        else if(parseInt(data)==3)
        {
            ddd= document.getElementById('Thedebitside').innerHTML ;
              Swal.fire({
              
                title: ddd,
                    icon: "warning"
                });

        }


}


    function ChackTotal()
{


        flagechange=0;
        totalDebit =   $('#totalDebit').text();
        sumCredit  =   $('#totalCredit').text();
        if(!$.trim($('#dec').val()).length || !$.trim($('#Ref').val()).length) {

            return 1;

        }
        else if(totalDebit =="0" ||sumCredit=="0")
        {
            return 2;
        }else if(totalDebit ==sumCredit){

            $("#submitSave").show();
            $("#buttonSave").hide();
                return 0;

        } else{

            $("#buttonSave").show();
            $("#submitSave").hide();
            return 3;
        }

}






    function getByitemsJournals(counter)
    {

           data ="";
            @foreach($AccountingGuide as $product )
                data = data+'<option value="{{$product->id}}::{{$product->AccountID}}::{{ $product->AccountName}}" >{{$product->AccountName }}</option>';
            @endforeach
        $("#JournalsSub").append(

         '<tr id="trItemsJournal'+counter+'"><th>'+counter+'</th>'+
            '<th><select onChange="doChangSelect('+counter+')" class="form-control"  name="selectAcount[]["selectAcount"]">'+
                    '<option value="false" style="display:none"></option>'+data+'</select>'+
            '</th>'+
            '<th> <input type="number"  class="form-control " readonly onchange="calcuateItem()" id="DebitSub'+counter+'" name="DebitSub[]["DebitSub"]"  value="0"> </th>'+
            '<th> <input type="number"  class="form-control "readonly  onchange="calcuateItem()"  id="CreditSub'+counter+'" name="CreditSub[]["CreditSub"]" value="0">  </th>'+
            '<th> <input type="text"  class="form-control "   name="decSub[]["decSub"]"  placeholder="ملاحظات " > </th>'+
            '<th> <a href="#" class="btn btn-danger" onclick="removeItem('+counter+')"><i class="fa fa-trash"></i></a></th></tr>'
        );

    }



    function doChangSelect(id)
    {
        $('#DebitSub'+id).attr("readonly", false);
        $('#CreditSub'+id).attr("readonly", false);

        totalDebit= $('#totalDebit').text();
        sumCredit = $('#totalCredit').text();

       if(parseFloat(totalDebit)>parseFloat(sumCredit))
       {


       $('#CreditSub'+id).val(parseFloat(totalDebit)-parseFloat(sumCredit));
       }else{
        $('#DebitSub'+id).val(parseFloat(sumCredit)-parseFloat(totalDebit));

       }
      totalJournals();

    }

    function removeItem(trnum){
      var myobj = $('#trItemsJournal'+trnum);
      myobj.remove();
      totalJournals();
    }
    function calcuateItem(){

      totalJournals();
    }

     function totalJournals()
     {
       var sumDebit=0;
       var sumCredit=0;
        co=$('#flagCounter').val();
        counter =parseInt(co);
        if(counter > 0){
          for(i=0;i<counter;i++){
          try{


              dataDebitSub=$('#DebitSub'+i).val();
              sumDebit = parseFloat(dataDebitSub)+sumDebit;
              dataDebitSub=$('#CreditSub'+i).val();
              sumCredit = parseFloat(dataDebitSub)+sumCredit;
          }catch{

          }
        }
        }else{

        }


        $('#totalDebit').text(sumDebit);
        $('#totalCredit').text(sumCredit);
        ChackTotal();
        $('#journalsTotal').val(sumDebit);

     }





  </script>
</form>

@endsection
