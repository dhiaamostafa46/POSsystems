
@extends('layouts.dashboard')
<style>
  td ,th {
    vertical-align: middle !important;
    text-align: center !important;
  }
</style>
@section('content')
<!-- /.content-header -->

<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row mt-2">
          <div class="col-4">
            <div class="card card-primary" style="height: 120px">
              <div class="card-body">
                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <input type="text"  class="form-control mb-2 @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="{{ trans('Store.Productcode') }}" autofocus onchange="getBarcode(this.value)">
                           <input type="hidden" class="mt-1 autocomplete form-control @error('prodName') is-invalid @enderror" id="prodName" name="prodName" style="width: 73%;display:inline-block" placeholder="اكتب اسم المنتج">
                            <select class="livesearch form-control" name="sername" id="sername">

                            </select>
                          @error('barcode')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-4">
            <div class="card card-primary bg-info text-white" style="height: 120px">
              <div class="card-body">
                <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <h2 class="text-center text-white" id="pname"></h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <div class="col-4">
            <div class="card card-primary bg-info text-white" style="height: 120px">
              <div class="card-body">
                <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <h2 class="text-center text-white" >{{ $store->name}}</h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>

          <div class="col-12">
            <div class="card card-primary" style="height: 670px">

              <div class="card-body">
                <form class="user" method="POST" action="{{route('Tainted.store')}}" enctype = "multipart/form-data">
                  @csrf
                <div style="height: 460px">
                  <table id="example5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>{{ trans('Store.ProductName') }}</th>
                      <th>{{ trans('Store.Quantity') }}</th>
                      <th>{{ trans('Store.Unit') }}</th>
                      <th>{{ trans('Store.Quantityavailableinstock') }} </th>
                      <th>{{ trans('Store.Options') }}</th>
                    </tr>
                    </thead>

                    <tbody id="tbody">
                    </tbody>
                  </table>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <input type="date" class="form-control @error('comment') is-invalid @enderror" id="datetime" name="datetime" placeholder="اكتب التعليق" value="<?php echo date('Y-m-d');?>" >

                        </div>
                      </div>
                      <input type="hidden" name="total" id="total" value="0" />
                      <input type="hidden" name="vat" id="vat" value="0" />
                      <input type="hidden" name="totalwvat" id="totalwvat" value="0" />
                      <input type="hidden" name="totaldiscount" id="totaldiscount" value="0" />
                      <input type="hidden" name="count" id="count" value="0">
                      <input type="hidden" name="type" id="type" value="1">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <input type="submit" class="btn btn-primary" value="{{ trans('Store.save') }}" style="width: 100%">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-4"  style="display: none">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">  من المستودع  :</label>
                              <input type="text" id="From" name="From" value="{{$store->id}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="mb-4">  {{ trans('Store.Causesofdamage') }} </label>
                                <select class="form-control @error('type') is-invalid @enderror" id="reasonid" name="reasonid">

                                  <option value="0::{{ trans('Store.Damagedduetopoorstorage') }}">   {{ trans('Store.Damagedduetopoorstorage') }}  </option>
                                  @foreach ($User as $item)
                                     <option value="{{$item->id}}:: {{ trans('Store.damagedueto') }}  {{$item->name}}"> {{ trans('Store.damagedueto') }}   {{$item->name}}</option>
                                  @endforeach
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">   {{ trans('Store.comment') }}  :</label>
                                <textarea class="form-control"  id="comment" name="comment"  rows="4"></textarea>
                            </div>
                        </div>

                    </div>
                  </div>
                </div>
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

<div  style="display: none">
    <h1 id="noFoundmesssage">  {{ trans('Store.Theproductisnotinstock') }} </h1>
    <h1 id="namprodectmessage">  {{ trans('Products.ProductName') }} </h1>

</div>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script>
  var count = 0;
  var rows = 0;
  var nameAr = "";
  $('#barcode').change(function(){


    getByBarcode(document.getElementById('barcode').value);

});


function getByBarcode(xcode){


    $.ajax({
        url: `/StoreConversion.StockSum/${xcode}`,
        data:{id:document.getElementById('From').value},
        success: data => {



            if(data.flage ==0)
            {
                document.getElementById('barcode').value = "";
                document.getElementById("barcode").focus();
                Swal.fire({
                    title:document.getElementById('noFoundmesssage').innerHTML,
                    icon: "warning"
                });

            }  else if (data.flage ==2) {
                document.getElementById('barcode').value = "";
                document.getElementById("barcode").focus();
                Swal.fire({
                    title:document.getElementById('noFoundmesssage').innerHTML,
                    icon: "warning"
                });


            }else{
                            count++;
                            rows++;
                            document.getElementById('barcode').value = "";
                            document.getElementById("barcode").focus();

                            dataaa="";
                            cost=0;
                             data.unit.forEach((item ,index)=>{
                                if(index ==0){cost=parseInt((item.count +item.start +item.comeIn )- (item.saller +item.Tainted +item.ComeOut+item.hang) + item.Arrang); costprodect=item.costprodect; }
                                dataaa=dataaa+ `<option value="${item.id}::${index}::${parseInt((item.count +item.start +item.comeIn )- (item.saller +item.Tainted +item.ComeOut+item.hang) + item.Arrang)}::${item.unitname}::${item.costprodect}" >${item.unitname} </option> `;
                            })
                            data.items.forEach(item =>
                                {

                                    $('#tbody').append(`
                                    <tr id="tr-${count}-">
                                        <td>${count}</td>
                                        <td>${item.nameAr}</td>
                                        <td><input type="number" step="any"  class="form-control text-center" id="quantity${count}" name="quantity${count}" value="1"></td>
                                        <td><select   class="form-control text-center"  onchange="doSomething(${count});" id="unit${count}" required name="unit${count}"> ${dataaa} </select></td>
                                        <td><input type="text"  readonly class="form-control text-center" id="Countitems${count}" name="Countitems${count}" value="${cost }"></td>
                                        <td class="text-center">
                                        <input type="hidden" name="item${count}" id="item${count}" value="${item.id}" />
                                        <input type="hidden" name="discount${count}" id="discount${count}" value="0" />
                                        <input type="hidden" name="rtotal${count}" id="rtotal${count}" value="0" />
                                        <input type="hidden" name="rvat${count}" id="rvat${count}" value="0" />
                                        <input type="hidden" name="rtotalwvat${count}" id="rtotalwvat${count}" value="${item.costPrice}" />
                                        <a href="#" onclick="removeItem(${count})" class="text-danger text-center"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    `)
                                }
                            )
                            document.getElementById('count').value = count;
            }

        }
      });

}

    // -------------------------------------------------------------------------------------


    function doSomething(id)
    {
        let text =document.getElementById('unit'+id).value;
        data=   text.split('::')
        document.getElementById('Countitems'+id).value =data[2];
        calculateTotal();
    }


    // ---------------------------------------------------------------------------------
      function removeItem(trnum){
        var myobj = document.getElementById("tr-"+trnum+"-");
        myobj.remove();
        rows--;
        calculateTotal();
      }

    // -----------------------------------------------------------------------------
    function calculate(id){

        quantity= document.getElementById('quantity'+id).value;
        Countitems =document.getElementById('Countitems'+id).value;

    // if(quantity>Countitems)
    // {
    //         Swal.fire({
    //             title: " الكمية اكبر من المتوفر في المستودع",
    //             //
    //             icon: 'warning',
    //             showCancelButton: true,
    //             confirmButtonColor: '#d33',
    //             cancelButtonColor: '#f8a29e',
    //             confirmButtonText: 'نعم',
    //             cancelButtonText: ' الغاء'
    //         })

    //         document.getElementById('quantity'+id).value=Countitems;
    // }


  }

  function calculateTotal(){
    totalwvat = 0;
    total = 0;
    vat = 0;

    totaldiscount = 0;
      if(rows > 0){
        for(i=1;i<=count;i++){
        try{
        var rtotalwvat = document.getElementById("rtotalwvat"+i+"").value;
        var discount = document.getElementById("discount"+i+"").value;

        totalwvat += parseFloat(rtotalwvat);
        total = +parseFloat(totalwvat/1.15).toFixed(2);
        vat = +parseFloat(totalwvat - total).toFixed(2);
        totaldiscount += parseFloat(discount);

        document.getElementById("total").value = +parseFloat(total).toFixed(2);
        document.getElementById("vat").value = +parseFloat(vat).toFixed(2);
        document.getElementById("totalwvat").value = +parseFloat(totalwvat).toFixed(2);
        document.getElementById("totaldiscount").value = +parseFloat(totaldiscount).toFixed(2);
        $( "#view-total" ).empty().append(document.getElementById('total').value);
        $( "#view-vat" ).empty().append(document.getElementById('vat').value);
        $( "#view-totalwvat" ).empty().append(document.getElementById('totalwvat').value);
        $( "#bigtotal" ).empty().append(document.getElementById('totalwvat').value);
        //$( "#view-totaldiscount" ).empty().append(document.getElementById('totaldiscount').value);
        }catch{

        }
      }
      }else{
        document.getElementById("total").value = 0;
        document.getElementById("vat").value = 0;
        document.getElementById("totalwvat").value = 0;
        document.getElementById("totaldiscount").value = 0;
        $( "#view-total" ).empty().append(document.getElementById('total').value);
        $( "#view-vat" ).empty().append(document.getElementById('vat').value);
        $( "#view-totalwvat" ).empty().append(document.getElementById('totalwvat').value);
        $( "#bigtotal" ).empty().append(document.getElementById('totalwvat').value);
        document.getElementById('pname').innerHTML = "";
      }

  }

  $("form").bind("keypress", function (e) {
    if (e.keyCode == 13) {
        $("#barcode").focus()
        //add more buttons here
        return false;
    }
});
$('.livesearch').select2({
        placeholder:  document.getElementById('namprodectmessage').innerHTML,
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

    $('#sername').change(function(){

          var name = $('#sername :selected').val(); // English

          const myArray = name.split("-", 2);
          //alert(myArray[1])
          getByBarcode(myArray[1]);
       });

</script>




<script>
    $('#prodName').change(function(){
      nameAr = document.getElementById("prodName").value;
      arr_index = items.map((el) => el.nameAr).indexOf(nameAr);
      barcode = items[arr_index].barcode;
      getByBarcode(barcode);
       document.getElementById("prodName").value ="";
    });
    var availableTags = <?php echo json_encode($items); ?>;
    var items = <?php echo json_encode($items_all); ?>;
      $( ".autocomplete" ).autocomplete({
      source: availableTags
    });

</script>


@endsection

