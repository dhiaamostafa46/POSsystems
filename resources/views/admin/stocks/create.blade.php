@extends('layouts.dashboard')
<style>
  td ,th {
    padding: 0px !important;
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
          <h3 class="card-title">المخزن </h3>
        </div>
       </div>
    </div>
        <!-- Small boxes (Stat box) -->
        <div class="row mt-2">
          <div class="col-4">
            <div class="card card-primary" style="height: 70px">
              <div class="card-body">
                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <input type="text"  class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="كود المنتج" autofocus onchange="getBarcode(this.value)">
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
          <div class="col-8">
            <div class="card card-primary bg-info text-white" style="height: 70px">
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
          <div class="col-12">
            <div class="card card-primary" style="height: 670px">
              
              <div class="card-body">
                <form class="user" method="POST" action="{{route('stocks.store')}}" enctype = "multipart/form-data">
                  @csrf
                <div style="height: 460px">
                  <table id="example5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>المنتج</th>
                      <th>الكمية</th>
                      <th>خيارات</th>
                    </tr>
                    </thead>
                    
                    <tbody id="tbody">
                    </tbody>
                  </table>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <input type="text" class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" placeholder="اكتب التعليق" required>
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
                      <input type="hidden" name="count" id="count" value="0">
                      <input type="hidden" name="type" id="type" value="1">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <input type="submit" class="btn btn-primary" value="حفظ" style="width: 100%">
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
<script>
  var count = 0;
  var rows = 0;
  var nameAr = "";
  $('#barcode').change(function(){
    
      $.ajax({
        url: `/getBarcode/${document.getElementById('barcode').value}`,
        success: data => {
          count++;
          rows++;
          document.getElementById('barcode').value = "";
          document.getElementById("barcode").focus();
          
          document.getElementById('pname').innerHTML = "";
          //$('#prodName').empty()
          data.items.forEach(item =>
            {
              document.getElementById('pname').innerHTML = item.nameAr;
              $('#tbody').append(`
              <tr id="tr-${count}-">
                <td>${item.id}</td>
                <td>${item.nameAr}</td>
                <td><input type="number" id="quantity${count}" name="quantity${count}" value="1" onchange="calculate(${count})"></td>
                <td class="text-center">
                  <input type="hidden" name="item${count}" id="item${count}" value="${item.id}" />
                  <input type="hidden" name="discount${count}" id="discount${count}" value="0" />
                  <input type="hidden" name="rtotal${count}" id="rtotal${count}" value="0" />
                  <input type="hidden" name="rvat${count}" id="rvat${count}" value="0" />
                  <input type="hidden" name="rtotalwvat${count}" id="rtotalwvat${count}" value="${item.prodPrice}" />
                  <a href="#" onclick="removeItem(${count})" class="text-danger text-center"><i class="fa fa-times"></i></a>
                </td>
              </tr>
              `)
              
            }
            
          )
          document.getElementById('count').value = count;
          calculateTotal();
        }
      });
      
      
      });

      function removeItem(trnum){
        var myobj = document.getElementById("tr-"+trnum+"-");
        myobj.remove();
        rows--;
        calculateTotal();
      }

    function calculate(id){
    var price = document.getElementById('price'+id).value;
    var quantity = document.getElementById('quantity'+id).value;
    var discount = document.getElementById('discount'+id).value;

    var rtotal = +parseFloat(price/1.15 * quantity - discount/1.15).toFixed(2);
    var rvat = +parseFloat(rtotal * 0.15).toFixed(2);
    var rtotalwvat = +parseFloat(rtotal+rvat).toFixed(2);

    document.getElementById('rtotal'+id).value = rtotal;
    document.getElementById('rvat'+id).value = rvat;
    document.getElementById('rtotalwvat'+id).value = rtotalwvat;
    $( "#itotal" ).empty().append(rtotalwvat);

    calculateTotal();
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
</script>
@endsection
