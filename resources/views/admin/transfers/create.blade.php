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
          <div class="row">
       <div class="col-12 card card-primary">
        <div class="card-header">
          <h3 class="card-title">{{ trans('Store.Incomingtransfer') }}    </h3>
        </div>
       </div>
    </div>
        <!-- Small boxes (Stat box) -->
        <div class="row mt-2">
          <div class="col-4">
            <div class="card card-primary" style="height: 110px">
              <div class="card-body">
                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group" style="display: none">

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
            <div class="card card-primary bg-info text-white" style="height: 110px">
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
            <div class="card card-primary bg-info text-white" style="height: 110px">
              <div class="card-body">
                <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <h2 class="text-center text-white" >{{ $store->DepotStoreOne->name ??''}}</h2>
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
                <form class="user" method="POST" action="{{route('Intransfers.store')}}" enctype = "multipart/form-data">
                  @csrf
                  <input type="hidden" name="IdConvert" value="{{$store->id}}">
                <div style="height: 460px">
                  <table id="example5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>

                      <th>{{ trans('Store.ProductName') }}</th>
                      <th>{{ trans('Store.Quantity') }}</th>
                      <th>{{ trans('Store.Unit') }}</th>

                       <th>  {{ trans('Store.Total') }}</th>
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
                      <div class="col-lg-12" style="display: none">
                        <div class="form-group">
                            <input type="text" id="ToStore" name="TOStore" value="{{$store->branchTow}}">

                          {{-- <select class="form-control @error('status') is-invalid @enderror" id="ToStore" required name="TOStore" placeholder="حالة الحساب">
                            @foreach ($DepotStore as $item)
                                @if ($store->branchOne != $item->id)
                                    <option value="{{$item->id}}" > {{$item->name}} </option>
                                @endif
                            @endforeach --}}
                          </select>
                        </div>
                    </div>
                      <div class="col-lg-12" >
                        <div class="form-group">
                          <input type="submit" class="btn btn-primary" value=" {{ trans('Store.save') }}" style="width: 100%">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6"  style="display: none">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">  من المستودع  :</label>
                              <input type="text" id="From" name="From" value="{{$store->branchOne}}">
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">     {{ trans('Store.comment') }}   :</label>
                                <textarea class="form-control"  id="comment" name="comment"  rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group text-left">
                                <h6>  {{ trans('Store.Totalcost') }} </h6>
                                <h6>  {{ trans('Store.Total') }} </h6>
                                <h6>  {{ trans('Store.Averagecost') }}  </h6>
                            </div>
                          </div>
                          <div class="col-lg-2">
                            <div class="form-group text-right">
                              <h6> <input type="number" step='any' name="TotalAlldata" id="TotalAlldata" value="0" readonly /></h6>
                              <h6> <input type="number" step='any' name="viewguenty" id="viewguenty" readonly value="0" /></h6>
                              <h6>  <input type="number" step='any' name="costAll" id="costAll" value="0" readonly /></h6>

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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<!------------------------------------add saeed -------------------------------------------------->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">




<script>
    $( document ).ready(function() {
              data ="";
              count=0;

                    @foreach( $store->StoreConversiondetails as $index => $product )
                        count=count+1;
                        data = data+'<tr id="tr-{{$index+1}}-"> <td>{{$index+1}}</td>  <td>{{$product->product->nameAr??'' }}</td>';
                         data = data+ '<td><input type="number" step="any"  class="form-control text-center" id="quantity{{$index+1}}" max="{{$product->quantity}}" name="quantity{{$index+1}}" value="{{$product->quantity}}"  onchange="calculate({{$index+1}})"></td>';
                        data = data+' <td><select   class="form-control text-center"  onchange="doSomething({{$index+1}});" id="unit{{$index+1}}" required name="unit{{$index+1}}">';
                        data = data+'  <option value="{{$product->uniteid}}::{{$product->indexunit}}::{{$product->indexunit}}::{{$product->nameunitr}}::{{$product->costprodect}}" >{{$product->nameunitr}} </option>  </select></td>';

                        data = data+' <td id="totalitems{{$index+1}}"> {{$product->costprodect *$product->quantity}} </td>';
                        data = data+'   <td class="text-center"><input type="hidden" name="item{{$index+1}}" id="item{{$index+1}}" value="{{$product->productID}}"/>';
                        data = data+'    <input type="hidden" name="index{{$index+1}}" id="index{{$index+1}}" value="{{$product->index}}" />';
                        data = data+'    <input type="hidden" name="CostStore{{$index+1}}" id="CostStore{{$index+1}}" value="{{$product->costprodect}}" />';
                        data = data+'   <input type="hidden" name="discount{{$index+1}}" id="discount{{$index+1}}" value="0" />';
                        data = data+'   <input type="hidden" name="rtotal{{$index+1}}"   id="rtotal{{$index+1}}" value="0" />';
                        data = data+'   <input type="hidden" name="rvat{{$index+1}}"     id="rvat{{$index+1}}" value="0" />';
                        data = data+'   <input type="hidden"  step="any" name="rtotalwvat{{$index+1}}" id="rtotalwvat{{$index+1}}" value="{{$product->costprodect *$product->quantity}}" />';
                        data = data+'  <a href="#" onclick="removeItem({{$index+1}})" class="text-danger text-center"><i class="fa fa-times"></i></a> </td></tr>';
                    @endforeach


                    $('#tbody').append(data);
                    $('#view-total').append("0");
                    $('#view-vat').append("0");
                    $('#view-totalwvat').append("0");
                document.getElementById('count').value = count;
                rows=count;

                calculateTotal();

    });
    </script>



<script>
  var count = 0;
  var rows = 0;
  var nameAr = "";
  $('#barcode').change(function(){




      getByBarcode(document.getElementById('barcode').value);

    });



  function getByBarcode( Xcode)
  {

    $.ajax({
        url: `/StoreConversion.StockSum/${Xcode}`,
        data:{id:document.getElementById('From').value},
        success: data => {



            if(data.flage ==0)
            {
                document.getElementById('barcode').value = "";
                document.getElementById("barcode").focus();
                Swal.fire({
                    title: " المنتج ليس موجودا  ",
                    icon: "warning"
                });

            }  else if (data.flage ==2) {
                document.getElementById('barcode').value = "";
                document.getElementById("barcode").focus();
                Swal.fire({
                    title: "  المنتج ليس موجودا في المستودع ",
                    icon: "warning"
                });


            }else{
                            count++;
                            rows++;
                            document.getElementById('barcode').value = "";
                            document.getElementById("barcode").focus();

                            dataaa="";
                            cost=0;
                            costprodect=0;
                            data.unit.forEach((item ,index)=>{
                                if(index ==0){cost=parseInt((item.count +item.start)- (item.saller +item.Tainted)); costprodect=item.costprodect; }
                                dataaa=dataaa+ `<option value="${item.id}::${index}::${parseInt((item.count + item.start)-(item.saller +item.Tainted))}::${item.unitname}::${item.costprodect}" >${item.unitname} </option> `;
                            })
                            data.items.forEach(item =>
                                {

                                    $('#tbody').append(`
                                    <tr id="tr-${count}-">
                                        <td>${item.id}</td>
                                        <td>${item.nameAr}</td>
                                        <td><input type="number" step="any"  class="form-control text-center" id="quantity${count}" name="quantity${count}" value="1"  onchange="calculate(${count})"></td>
                                        <td><select   class="form-control text-center"  onchange="doSomething(${count});" id="unit${count}" required name="unit${count}"> ${dataaa} </select></td>

                                        <td id="totalitems${count}"> ${costprodect*1} </td>
                                        <td class="text-center">
                                        <input type="hidden" name="CostStore${count}" id="CostStore${count}" value="${costprodect}" />
                                        <input type="hidden" name="item${count}" id="item${count}" value="${item.id}" />
                                        <input type="hidden" name="discount${count}" id="discount${count}" value="0" />
                                        <input type="hidden" name="rtotal${count}" id="rtotal${count}" value="0" />
                                        <input type="hidden" name="rvat${count}" id="rvat${count}" value="0" />
                                        <input type="hidden" name="rtotalwvat${count}" id="rtotalwvat${count}" value="${costprodect}" />
                                        <a href="#" onclick="removeItem(${count})" class="text-danger text-center"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    `)
                                }
                            )
                            document.getElementById('count').value = count;
                            calculateTotal();
            }

        }
      });

  }

    // -------------------------------------------------------------------------------------


    function doSomething(id)
    {
        let text =document.getElementById('unit'+id).value;
        let quantity =document.getElementById('quantity'+id).value;
        data=   text.split('::')
        document.getElementById('CostStore'+id).value =data[4];

        document.getElementById('rtotalwvat'+id).value =parseFloat(data[4]*quantity) ;
        document.getElementById('totalitems'+id).innerHTML=parseFloat(data[4]*quantity) ;
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

        let text =document.getElementById('unit'+id).value;
        let quantity =document.getElementById('quantity'+id).value;
        data=   text.split('::')
        document.getElementById('CostStore'+id).value =data[4];

        document.getElementById('rtotalwvat'+id).value =parseFloat(data[4]*quantity) ;
        document.getElementById('totalitems'+id).innerHTML=parseFloat(data[4]*quantity) ;
        calculateTotal();
  }




  function calculateTotal(){

    count =document.getElementById('count').value ;
    totaldiscount = 0;
    totalquantity = 0;
    for(i=1;i<=parseInt(count);i++){

        var rtotalwvat = document.getElementById("rtotalwvat"+i+"").value;
        var CostStore = document.getElementById("CostStore"+i+"").value;
        var quantity = document.getElementById("quantity"+i+"").value;

        document.getElementById("totalitems"+i+"").innerHTML =(quantity*CostStore).toFixed(4);
        document.getElementById("rtotalwvat"+i+"").value =(quantity*CostStore).toFixed(4);
        totaldiscount  =totaldiscount +parseFloat(CostStore)*parseFloat(quantity);
        totalquantity =parseFloat(totalquantity)+parseFloat(quantity);
    }
        document.getElementById('TotalAlldata').value =totaldiscount.toFixed(4);
        document.getElementById('viewguenty').value =totalquantity;
        document.getElementById('costAll').value =(totaldiscount/totalquantity).toFixed(2);
}

  $("form").bind("keypress", function (e) {
    if (e.keyCode == 13) {
        $("#barcode").focus()
        //add more buttons here
        return false;
    }
});

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

