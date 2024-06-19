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
                            <label class="form-control-label" for="input-username">    رقم القيد :</label>
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
                            <label class="form-control-label" for="input-username"> المرجع   :</label>
                            <input type="text"  class="form-control @error('Refjournals') is-invalid @enderror" value="{{$Journal->Ref}}" id="Ref" name="Refjournals" placeholder=" المرجع">
                            @error('Refjournals')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                            <label class="form-control-label" for="input-username">  التاريخ  :</label>
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
                            <label class="form-control-label" for="input-username">  الوصف  :</label>
                            <input type="text"  class="form-control @error('dec') is-invalid @enderror" value="{{$Journal->dec}}" value="dec" id="dec" name="dec" placeholder=" وصف ">
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
                                <input type="submit"   id="submitSave" class="btn btn-primary" value="حفظ" tyle="width: 100%;">
                                <input type="button" onclick="SaveALlJournals()" id="buttonSave"  style="width: 100%;display: none;" class="btn btn-primary" value="حفظ" style="width: 100%">
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
                        <th style="width: 30%;">اسم الحساب</th>
                        <th style="width: 10%;">مدين</th>
                        <th style="width: 10%;">الدين</th>
                        <th style="width: 40%;">الملاحظات</th>
                        <th style="width: 5%;">خيارات</th>
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
                                <th style="width: 30%;">الاجمالي </th>
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
        debt=[];
         credit=[];
        //  String[] desc;



         @foreach($Journal->JournalChild as $product )
                debt[count]=parseInt({{$product->Debit}});
                credit[count]=parseInt({{$product->Credit}});
                //  desc[count]=toString({{$product->dec}});
          ++count;
         @endforeach

        for (let i = 0; i <{{$Journal->Items}}; i++) {

            data ="";
            @foreach($AccountingGuide as $product )
                data = data+'<option>{{$product->AccountName }}</option>';
            @endforeach


            $("#JournalsSub").append(

                '<tr id="trItemsJournal'+i+'"><th>'+i+'</th>'+
                '<th><select onChange="doChangSelect('+i+')" class="form-control"  name="selectAcount[]["selectAcount"]">'+
                        '<option value="false" style="display:none"></option>'+data+'</select>'+
                '</th>'+
                '<th> <input type="number"  class="form-control "  onchange="calcuateItem()" id="DebitSub'+i+'" name="DebitSub[]["DebitSub"]"  value="'+debt[i]+'"> </th>'+
                '<th> <input type="number"  class="form-control "  onchange="calcuateItem()"  id="CreditSub'+i+'" name="CreditSub[]["CreditSub"]" value="'+credit[i]+'">  </th>'+
                '<th> <input type="text"  class="form-control " value="ssas"   name="decSub[]["decSub"]"  placeholder="ملاحظات " > </th>'+
                '<th> <a href="#" class="btn btn-danger" onclick="removeItem('+i+')"><i class="fa fa-trash"></i></a></th></tr>'
                );
            }


    });


    $('#additemsJournals').click(function(){

        counter=$('#flagCounter').val();
         getByitemsJournals(parseInt(counter)+1);
         $('#flagCounter').val(parseInt(counter)+1);
    });


    
    function SaveALlJournals(){
        data=ChackTotal();
        console.log(data);
        if(parseInt(data)==1)
        {
            Swal.fire({
                title: "يجب تعبة الحقول الرئيسية للقيد (الوصف او المرجع)",
                //
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#f8a29e',
                confirmButtonText: 'نعم',
                cancelButtonText: ' الغاء'
            })

        }
        else if(parseInt(data)==2)
        {
                Swal.fire({
                    title: "يجب تعبة الحقول الرئيسية للقيد الفرعية)",
                    //
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#f8a29e',
                    confirmButtonText: 'نعم',
                    cancelButtonText: ' الغاء'
                })
        }
        else if(parseInt(data)==3)
        {

            Swal.fire({
                title: "يجب ان يتساوي الجانب المدين مع الجانب الدائن",
                //
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#f8a29e',
                confirmButtonText: 'نعم',
                cancelButtonText: ' الغاء'
            })
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
                data = data+'<option>{{$product->AccountName }}</option>';
            @endforeach




        $("#JournalsSub").append(

         '<tr id="trItemsJournal'+counter+'"><th>'+counter+'</th>'+
            '<th><select onChange="doChangSelect('+counter+')" class="form-control"  name="selectAcount[]["selectAcount"]">'+
                    '<option value="false" style="display:none"></option>'+data+'</select>'+
            '</th>'+
            '<th> <input type="number"  class="form-control " readonly onchange="calcuateItem()" id="DebitSub'+counter+'" name="DebitSub[]["DebitSub"]"  value=""> </th>'+
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
          for(i=1;i<=counter;i++){
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










    // function getByitemsJournals(barcode){
    //   $.ajax({
    //       url: `/getBarcode/${barcode}`,
    //       success: data => {
    //         qntNew = data.quantity;

    //         var exist = 0;
    //         document.getElementById('barcode').value = "";
    //         document.getElementById('prodName').value = "";
    //         document.getElementById("barcode").focus();

    //         document.getElementById('pname').innerHTML = "";
    //         //$('#prodName').empty()
    //         data.items.forEach(item =>
    //           {
    //             if(rows > 0){//to check if this first row in order or not
    //                 for(i=1;i<=count;i++){
    //                 try{
    //                   if(document.getElementById(`item${i}`).value == item.id) {
    //                     exist = 1;
    //                     existRow =i;
    //                   }
    //                 }catch{

    //                 }
    //               }
    //             }


    //             document.getElementById('pname').innerHTML = item.nameAr;
    //             if(exist == 0){
    //               count++;
    //               rows++;
    //               $('#tbody').append(`
    //               <tr id="tr-${count}-">
    //                 <td>${item.id}</td>
    //                 <td>${item.nameAr}</td>
    //                 <td><input type="number" min="0.00" step=".01" id="price${count}" name="price${count}" value="${item.prodPrice}" onchange="calculate(${count})" readonly></td>>
    //                 <td><input type="number" min="0.00" step=".01"  id="quantity${count}" name="quantity${count}" value="${data.quantity}" onchange="calculate(${count})"></td>
    //                 <td id="itotal${count}">${item.prodPrice*data.quantity}</td>
    //                 <td class="text-center">
    //                   <input type="hidden" name="item${count}" id="item${count}" value="${item.id}" />
    //                   <input type="hidden" name="cprice${count}" id="cprice${count}" value="${item.costPrice}" />
    //                   <input type="hidden" name="itemName${count}" id="itemName${count}" value="${item.nameAr}" />
    //                   <input type="hidden" name="discount${count}" id="discount${count}" value="0" />
    //                   <input type="hidden" name="rtotal${count}" id="rtotal${count}" value="0" />
    //                   <input type="hidden" name="rvat${count}" id="rvat${count}" value="0" />
    //                   <input type="hidden" name="vatValue${count}" id="vatValue${count}" value="${item.vat}" />
    //                   <input type="hidden" name="rtotalwvat${count}" id="rtotalwvat${count}" value="${item.prodPrice*data.quantity}" />
    //                   <a href="#" onclick="removeItem(${count})" class="text-danger text-center"><i class="fa fa-times"></i></a>
    //                 </td>
    //               </tr>
    //               `)
    //             }else{
    //               qntyUpdate(existRow,qntNew)
    //             }


    //           }

    //         )
    //         document.getElementById('count').value = count;
    //         calculate(count);
    //         calculateTotal();
    //       }
    //     });
    // }



    //   function calculate(id){
    //     var price = document.getElementById('price'+id).value;
    //     var quantity = document.getElementById('quantity'+id).value;
    //     var discount = document.getElementById('discount'+id).value;
    //     var vatValue = document.getElementById('vatValue'+id).value;
    //                                 //price without vat
    //     var rtotal = +parseFloat(price/(1+(vatValue/100)) * quantity - discount/(1+(vatValue/100))).toFixed(2);//total without vat
    //     var rvat = +parseFloat(rtotal * (vatValue/100)).toFixed(2);
    //     var rtotalwvat = +parseFloat(price*quantity-discount).toFixed(2);

    //     document.getElementById('rtotal'+id).value = rtotal;
    //     document.getElementById('rvat'+id).value = rvat;
    //     document.getElementById('rtotalwvat'+id).value = rtotalwvat;
    //     $( "#itotal"+id ).empty().append(rtotalwvat);

    //     calculateTotal();
    // }

    // function calculateTotal(){
    //   totalwvat = 0;
    //   total = 0;
    //   vat = 0;

    //   totaldiscount = 0;
    //     if(rows > 0){
    //       for(i=1;i<=count;i++){
    //       try{
    //       var rtotalwvat = document.getElementById("rtotalwvat"+i+"").value;
    //       var rtotal = document.getElementById("rtotal"+i+"").value;
    //       var rvat = document.getElementById("rvat"+i+"").value;
    //       var discount = document.getElementById("discount"+i+"").value;

    //       totalwvat += Number(rtotalwvat);
    //       total += Number(rtotal);
    //       vat += Number(rvat);
    //       totaldiscount += parseFloat(discount);


    //       document.getElementById("total").value = +parseFloat(total).toFixed(2);
    //       document.getElementById("vat").value = +parseFloat(vat).toFixed(2);
    //       document.getElementById("totalwvat").value = +parseFloat(totalwvat).toFixed(2);
    //       document.getElementById("totaldiscount").value = +parseFloat(totaldiscount).toFixed(2);
    //       $( "#view-total" ).empty().append(document.getElementById('total').value);
    //       $( "#view-vat" ).empty().append(document.getElementById('vat').value);
    //       $( "#view-totalwvat" ).empty().append(document.getElementById('totalwvat').value);
    //       $( "#bigtotal" ).empty().append(document.getElementById('totalwvat').value);
    //       //$( "#view-totaldiscount" ).empty().append(document.getElementById('totaldiscount').value);
    //       }catch{

    //       }
    //     }
    //     }else{
    //       document.getElementById("total").value = 0;
    //       document.getElementById("vat").value = 0;
    //       document.getElementById("totalwvat").value = 0;
    //       document.getElementById("totaldiscount").value = 0;
    //       $( "#view-total" ).empty().append(document.getElementById('total').value);
    //       $( "#view-vat" ).empty().append(document.getElementById('vat').value);
    //       $( "#view-totalwvat" ).empty().append(document.getElementById('totalwvat').value);
    //       $( "#bigtotal" ).empty().append(document.getElementById('totalwvat').value);
    //       document.getElementById('pname').innerHTML = "";
    //     }

    // }

    // function qntyUpdate(qntID,qntNew){
    //   var qnt = document.getElementById(`quantity${qntID}`).value;
    //   qnt=Number(qnt)+Number(qntNew);
    //   //alert(qnt);
    //   document.getElementById(`quantity${qntID}`).value = qnt;
    //   document.getElementById(`rtotalwvat${qntID}`).value = Number(document.getElementById(`price${qntID}`).value) * Number(qnt);
    //   calculate(qntID);
    //   calculateTotal();
    // }

    // function addCustomer(obj){

    //     //$('#customersModel').modal('show')

    //     if(obj.value == -1)
    //     {
    //       document.getElementById(`newcustomer`).style.display = "flex";
    //     }else{
    //       document.getElementById(`newcustomer`).style.display = "none";
    //     }

    // }

    // function showCashCard(obj){
    //   if(obj.value == 4)
    //   {
    //     document.getElementById(`cashcard`).style.display = "flex";
    //   }else{
    //     document.getElementById(`cashcard`).style.display = "none";
    //   }
    // }

    // function storeCustomer() {
    //     try{
    //      var form = document.querySelector('form');
    //       var formData = new FormData(form);
    //       formData.append("name", "فوزي");
    //       formData.append("area", "area");
    //       formData.append("city", "city");
    //       formData.append("district", "district");
    //       formData.append("address", "address");
    //       formData.append("vatNo", "vatNo");
    //       formData.append("phone", "phone");
    //       formData.append("email", "email");

    //       fetch("/../customers-add",{
    //           method: "post",
    //           body: formData
    //       })
    //       .then((response)=>{

    //       })
    //     }catch{

    //     }
    //  }

    //    $("form").bind("keypress", function (e) {
    //   if (e.keyCode == 13) {
    //       $("#barcode").focus()
    //       //add more buttons here
    //       return false;
    //   }
    //   });
    //   function startDuration(){
    //       Swal.fire({
    //       title: 'ادخل الرصيد الافتتاحي للصندوق',
    //       input: 'text',
    //       inputAttributes: {
    //         autocapitalize: 'off'
    //       },
    //       showCancelButton: true,
    //       confirmButtonText: 'تأكيد',
    //       cancelButtonText: 'الغاء',
    //       showLoaderOnConfirm: true,
    //       preConfirm: (amount) => {
    //         window.location.href = `/createDuration/${amount}`;
    //       },
    //       allowOutsideClick: () => !Swal.isLoading()
    //     })
    //     }
  </script>
  {{-- <script>
    $('#prodName').change(function(){
      nameAr = document.getElementById("prodName").value;
      arr_index = items.map((el) => el.nameAr).indexOf(nameAr);
      barcode = items[arr_index].barcode;
      getByBarcode(barcode);
    });
    var availableTags = <?php echo json_encode($items); ?>;
    var items = <?php echo json_encode($items_all); ?>;
      $( ".autocomplete" ).autocomplete({
      source: availableTags
    });
  </script> --}}
</form>

@endsection
