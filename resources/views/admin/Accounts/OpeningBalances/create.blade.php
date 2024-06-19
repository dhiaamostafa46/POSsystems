@extends('layouts.dashboard')

@section('content')
<style>
    .form-control{
        height: 30px;
    }
</style>
<form class="user" method="POST" action="{{route('OpeningBalances.store')}}"  enctype = "multipart/form-data">
    @csrf
    <section class="content">
        <div class="container-fluid">
            <input type="hidden" name="flagCounter" id="flagCounter" value="0">
            <input type="hidden" name="journalsTotal" id="journalsTotal" >
        <!-- Small boxes (Stat box) -->
        <div class="row mt-2">
            <div class="col-12">
            <div class="card card-primary" style="height: 110px">
                <div class="card-body">

                    <div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                            <label class="form-control-label" for="input-username">      {{ trans('Account.accountname') }}  :</label>
                            <select class="form-control @error('TypeAccount') is-invalid @enderror" onChange="doChangSelect()" id="TypeAccount"   name="TypeAccount" >

                                <option style="display: none">  </option>
                                @foreach ($account as $item)
                                  @if ($item->AccountID[2] ==5)
                                  @else
                                   <option  value="{{$item->id}}">{{ $item->AccountName}}</option>
                                  @endif
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">      {{ trans('Account.date') }}  :</label>
                                <input type="date" class="form-control @error('comment') is-invalid @enderror"  value="<?php echo date('Y-m-d');?>" id="datatime" name="datatime"  >
                            </div>
                        </div>

                        <div class="col-lg-2 " dir="ltr">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">    </label>
                                <input type="submit"   id="submitSave" class="btn btn-primary" value="{{ trans('Account.save') }}" style="width: 100%">
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
            <div class="card card-primary" style="min-height: 350px">

                <div class="card-body">
                <div style="height: 370px;overflow-y: scroll;">
                    <table id="example4" class="table table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 30%;">  {{ trans('Account.accountname') }} </th>
                        <th style="width: 10%;"> {{ trans('Account.thevalue') }} </th>
                        <th style="width: 40%;"> {{ trans('Account.thedescription') }} </th>
                        <th style="width: 5%;"> {{ trans('Account.Options') }} </th>
                    </tr>
                    </thead>

                    <tbody id="OpenItems">

                    </tbody>
                    </table>
                </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card"  >

                <div class="card-body">

                    <table class="table text-center" >
                        <tbody>
                            <tr>
                                <th style="width: 5%;">  </th>
                                <th style="width: 30%;"> {{ trans('Account.Total') }}  </th>
                                <th style="width: 10%;" id="totalDebit">0.00</th>
                                <th style="width: 30%;">   </th>
                                <th style="width: 10%;" id="headtotal"> 0.0</th>
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



































<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>






function doChangSelect()
{

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

data =$("#TypeAccount").val();

$.ajax({
            type: 'post',
            url: "/OpeningBalances.AccountFather/"+data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {'data' : data},
            beforeSend: function(){
                //before sending the request


            },
            success: function(response){
                //the request is success
                // $("#OpenItems").empty();
               i= $('#flagCounter').val();
                      $('#OpenItems').append(

                            '<tr id="trItemsJournal'+i+'"><th>'+i+'</th>'+
                            '<th><input type="text"  class="form-control "  id="NameAccount'+i+'" name="NameAccount[]["NameAccount"]"  value="'+response.count.AccountName+'">'+
                            '<input type="hidden" value="'+response.count.id+'" name="AcountID[]["AcountID"]"><input type="hidden" value="'+response.count.AccountID+'" name="CodeAccount[]["CodeAccount"]"></th>'+
                            '<th> <input type="number"  class="form-control "  onchange="totalJournals()" id="DebitSub'+i+'" name="DebitSub[]["DebitSub"]"  value="0"> </th>'+
                            '<th> <input type="text" value="ss"  class="form-control "   name="decSub[]["decSub"]"  placeholder="ملاحظات " > </th>'+
                            '<th> <a href="#" class="btn btn-danger" onclick="removeItem('+i+')"><i class="fa fa-trash"></i></a></th></tr>'
                    )
                  $('#flagCounter').val(parseInt(i)+1);



            },
            complete: function(response){
                //the request is completed

            }
        });


}

   function removeItem(trnum){
      var myobj = $('#trItemsJournal'+trnum);
       count = $('#flagCounter').val();
      $('#flagCounter').val(parseInt(count)-1);
      myobj.remove();
      totalJournals();
    }


    function totalJournals()
     {
       var sumDebit=0;

       counter=$('#flagCounter').val();


        if(counter > 0){
          for(i=0;i<counter;i++){
          try{
               dataDebitSub=$('#DebitSub'+i).val();
              sumDebit = parseFloat(dataDebitSub)+sumDebit;
          }catch{

          }
        }
        }else{

        }
        $('#totalDebit').text(sumDebit);
        // $('#headtotal').text(sumDebit);

     }


 </script>






</form>

@endsection
