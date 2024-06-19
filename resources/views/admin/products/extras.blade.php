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
                            <input type="text"  class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="{{ trans('purchases.Productcode') }}" autofocus onchange="getBarcode(this.value)">
                            <input type="hidden" class="mt-1 autocomplete form-control @error('prodName') is-invalid @enderror" id="prodName" name="prodName" style="width: 73%;display:inline-block" placeholder="اكتب اسم المنتج">
                            <select class="livesearch form-control" name="sername" id="sername">

                            </select>

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
                          <h2 class="text-center text-white" ></h2>
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
                          <h2 class="text-center text-white" ></h2>
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
                <form class="user" method="POST" action="{{route('extras.store')}}" enctype = "multipart/form-data">
                  @csrf
                <div style="height: 460px">
                  <table id="example5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th  style="width: 10%">#</th>
                      <th>{{ trans('Products.ProductName') }}</th>
                      <th>{{ trans('Products.price') }}</th>
                      <th style="width: 30%">{{ trans('Products.Unit') }} </th>
                      <th style="width: 10%">{{ trans('Products.Options') }}</th>
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
                            <input type="hidden" name="count" id="count" value="0">
                            <input type="hidden" name="idpeodect" id="idpeodect" value="{{$Products->id}}">
                          <input type="submit" class="btn btn-primary" value="{{ trans('Products.save') }}" style="width: 100%">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
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


      <div  style="display: none">
        <h1 id="noFoundmesssage">  {{ trans('purchases.Theproductisnotinstock') }} </h1>
        <h1 id="namprodectmessage">  {{ trans('Products.ProductName') }} </h1>

    </div>
</section>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

<script>

    $( document ).ready(function() {

              data ="";
              count=0;
              try{


                    @foreach( $Products->extras as $index => $product )
                    count=count+1;
                        data = data+'<tr id="tr-{{$index+1}}-"> <td>{{$index+1}} </td>  <td>{{$product->nameAr}}<input  class="form-control text-center"  type="hidden" name="nameitems{{$index+1}}" id="nameitems{{$index+1}}" value="{{$product->nameAr}}" /></td>';
                        data = data+'<td><input type="number"  step="any"  class="form-control text-center" id="price{{$index+1}}"  name="price{{$index+1}}"  value="{{$product->price}}" ></td>';
                        data = data+'<td><input type="text"   class="form-control text-center" id="unit{{$index+1}}"  name="unit{{$index+1}}" value="{{$product->nameUnit}}" ></td>';
                        data = data+' <td class="text-center"> <input type="hidden" name="item{{$index+1}}" id="item{{$index+1}}" value="{{$product->id}}" />';
                        data = data+'  <input type="hidden" name="idunit{{$index+1}}" id="idunit{{$index+1}}" value="{{$product->idUnit}}"  />';
                        data = data+' <a href="#" onclick="removeItem({{$index+1}})" class="text-danger text-center"><i class="fa fa-times"></i></a> </td> </tr>';
                    @endforeach
              }catch  (error){

                Swal.fire({
                    title: " حدث خطا في المنتجات",
                    icon: "warning"
                });
              }

                $('#tbody').append(data);
            document.getElementById('count').value = count;

    });
</script>













<script>
  var count = 0;
  var rows = 0;
  var nameAr = "";
  $('#barcode').change(function(){


    getByBarcode( document.getElementById('barcode').value);



});





$('.livesearch').select2({
        placeholder: document.getElementById('namprodectmessage').innerHTML,
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





function  getByBarcode(varcode)
{
    $.ajax({
        url: `/extras.StockSum/${varcode}`,
        data:{id:varcode},
        success: data => {

            if(data.flage ==0)
            {
                document.getElementById('barcode').value = "";
                document.getElementById("barcode").focus();
                Swal.fire({
                    title: " ليس المنتج من اصناف المقادير",
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
                        <td><input type="number"  step="any"  class="form-control text-center" id="price${count}"  name="price${count}"  value="${item.prodPrice}" ></td>
                        <td><input type="text"   class="form-control text-center" id="unit${count}"  name="unit${count}" value="${data.unit}" ></td>
                        <td class="text-center">
                        <input type="hidden" name="item${count}" id="item${count}" value="${item.id}" />
                        <input type="hidden" name="idunit${count}" id="idunit${count}" value="${data.idunit} " />
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

 function removeItem(trnum){
      var count = document.getElementById('count').value;
        var myobj = document.getElementById("tr-"+trnum+"-");
        myobj.remove();
        count=  parseInt(count)-1;
        document.getElementById('count').value =count;
        calculateTotal();
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
