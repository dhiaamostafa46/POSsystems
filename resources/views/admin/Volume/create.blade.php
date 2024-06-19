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
            <div class="card card-primary" style="height: 110px">
              <div class="card-body">
                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text"  class="form-control mb-2  @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="{{ trans('Products.Productcode') }} " autofocus onchange="getBarcode(this.value)">
                            <input type="hidden" class="mt-1 autocomplete form-control @error('prodName') is-invalid @enderror" id="prodName" name="prodName" style="width: 73%;display:inline-block" placeholder="{{ trans('Products.ProductName') }}">
                            <select class="livesearch form-control" name="sername" id="sername" placeholder="{{ trans('Products.ProductName') }}">

                            </select>

                            <!--<a href="#" class="btn btn-primary" style="width: 25%;display:inline-block">بحث</a>-->

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
                          <h2 class="text-center text-white" >{{ $store->nameAr}}</h2>
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
                          <h2 class="text-center text-white" >{{ $store->unit->nameAr ?? ''}} </h2>
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
                <form class="user" method="POST" action="{{route('Volume.store')}}" enctype = "multipart/form-data">
                  @csrf

                  <input type="hidden" name="Flage" id="Flage"  value="{{$Flage}}">
                  @if ($Flage==1)
                    <input type="hidden" name="idVome"  value="{{$Volume->id}}">
                  @else
                      <input type="hidden" name="idVome"  value="0">
                  @endif
                <div style="height: 460px">
                  <table id="example5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>{{ trans('Products.ProductName') }} </th>
                      <th>{{ trans('Products.Unit') }} </th>
                      <th>{{ trans('Products.Quantity') }}</th>
                      <th> {{ trans('Products.Averagecost') }}</th>
                      <th> {{ trans('Products.Total') }} </th>
                      <th>{{ trans('Products.Options') }}</th>
                    </tr>
                    </thead>

                    <tbody id="tbody">
                    </tbody>
                  </table>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <input type="text" class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" placeholder="{{ trans('Products.comment') }}" >
                          @error('comment')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <input type="hidden" name="total" id="total" value="0" />
                      <input type="hidden" name="vat" id="vat" value="0" />
                      <input type="hidden" name="totalwvat" id="totalwvat" value="0" />

                      <input type="hidden" name="totaldiscount" id="totaldiscount" value="0" />
                      <input type="hidden" name="CostProdect" id="CostProdect" value="0">
                      <input type="hidden" name="count" id="count" value="0">
                      <input type="hidden" name="type" id="type" value="1">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <input type="submit" class="btn btn-primary" value="{{ trans('Products.save') }}" style="width: 100%">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <h6>  {{ trans('Products.Totalcost') }} </h6>
                                <h6>  {{ trans('Products.Total') }} </h6>
                                <h6>  {{ trans('Products.Averagecost') }} </h6>
                            </div>
                            <div class="col-6">
                                <h6> <input type="number" step='any' name="TotalAlldata" id="TotalAlldata" value="0" readonly />  </h6>
                                <h6> <input type="number" step='any' name="viewguenty" id="viewguenty" onchange="CostallFunction()" value="0" /> </h6>
                                <h6> <input type="number" step='any' name="costAll" id="costAll" value="0" readonly />  </h6>
                            </div>
                        </div>
                    </div>
                  </div>



                  <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6"  style="display: none">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">  من المستودع  :</label>
                              <input type="text" id="From" name="From" value="{{$store->id}}">
                              <input type="text" id="From" name="FromName" value="{{$store->nameAr}}">
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
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">-->
<!--<script src="//code.jquery.com/jquery-1.12.4.js"></script>-->
<!--<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<div  style="display: none">
    <h1 id="noFoundmesssage">  {{ trans('Products.IngredientsNotfound') }} </h1>
    <h1 id="namprodectmessage">  {{ trans('Products.ProductName') }} </h1>

</div>




<script>
  var count = 0;
  var rows = 0;
  var nameAr = "";
  $('#barcode').change(function(){


    getByBarcode( document.getElementById('barcode').value);



});


function  getByBarcode(varcode)
{
    $.ajax({
        url: `/Volume.StockSum/${varcode}`,
        data:{id:varcode},
        success: data => {

            if(data.flage ==0)
            {
                document.getElementById('barcode').value = "";
                document.getElementById("barcode").focus();
                dd=document.getElementById('noFoundmesssage').innerHTML;
                Swal.fire({
                    title:dd,
                    icon: "warning"
                });

            }else{

                count++;
                rows++;
                document.getElementById('barcode').value = "";
                document.getElementById("barcode").focus();
                // count=  document.getElementById('count').value ;
                //   document.getElementById('pname').innerHTML = "";


                //$('#prodName').empty()
                data.items.forEach(item =>
                    {

                    $('#tbody').append(`
                    <tr id="tr-${count}-">
                        <td>${count}</td>
                        <td>${item.nameAr}  <input  class="form-control text-center"  type="hidden" name="nameitems${count}" id="nameitems${count}" value="${item.nameAr}" /></td>
                        <td><input type="text"   class="form-control text-center" id="unit${count}"  name="unit${count}" value="${data.unit}" ></td>
                        <td><input type="number"  class="form-control text-center" step="any" min="0.00"  id="quantity${count}"  name="quantity${count}" value="1" onchange="calculate(${count})"></td>
                        <td>${data.CostStore} </td>
                        <td id='totalitems${count}'>${data.CostStore  *1} </td>
                        <td class="text-center">
                        <input type="hidden" name="item${count}" id="item${count}" value="${item.id}" />
                        <input type="hidden" name="unitid${count}" id="unitid${count}" value="${data.unitcostid}" />
                        <input type="hidden" name="CostStore${count}" id="CostStore${count}" value="${data.CostStore}" />
                        <input type="hidden" name="discount${count}" id="discount${count}" value="0" />
                        <input type="hidden" name="rtotal${count}" id="rtotal${count}" value="0" />
                        <input type="hidden" name="rvat${count}" id="rvat${count}" value="0" />
                        <input type="hidden"  step='any' name="rtotalwvat${count}" id="rtotalwvat${count}" value="0" />
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

 function removeItem(trnum){
      var count = document.getElementById('count').value;
        var myobj = document.getElementById("tr-"+trnum+"-");
        myobj.remove();
        count=  parseInt(count)-1;
        document.getElementById('count').value =count;
        calculateTotal();
      }


    function calculate(id){
        calculateTotal();
  }



  function CostallFunction()
  {
    TotalAlldata=   document.getElementById('TotalAlldata').value;
    quantity = document.getElementById('viewguenty').value;
    document.getElementById('costAll').value =(TotalAlldata/quantity).toFixed(4);
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
</script>


  <script>

    $('.livesearch').select2({

        placeholder: document.getElementById('namprodectmessage').innerHTML,
        ajax: {
            url: '/comp-autocomplete-search',
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
@endsection
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<!------------------------------------add saeed -------------------------------------------------->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
