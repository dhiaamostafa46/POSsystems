@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">العهد  </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">العهد </a></li>
          <li class="breadcrumb-item active">قائمة العهد</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h6 style="display: inline-block">العهد  </h6>
                <!--<a href=""   class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               {{-- <div  class="col-6">
                <div class="form-group">

                 <input type="text" class="mt-1 autocomplete form-control @error('empName') is-invalid @enderror" id="empName" name="empName" style="width: 73%;display:inline-block" placeholder="ادخل إسم الموظف">

                 <a type="button"  class="btn btn-primary" style="width: 25%;display:inline-block" id="find">بحث</a>

                 <label class="form-control-label" for="input-username">الإسم</label>
                 <input type="text" class="form-control" id="ename" name="ename" disabled>

                  <label class="form-control-label" for="input-username">رقم الهوية  </label>
                  <input type="text" class="form-control" id="idno" name="idno" disabled>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name"> </label>
                        <br>
                        <button class="btn btn-primary" style="width: 50%;display:inline-block" id="addbtn" onclick="showModal()" disabled>إضافة عهدة</button>
                      </div>
                    </div>
                  </div>

                </div>
              </div> --}}

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>

                    <th>الوصف </th>
                    <th> النوع </th>
                    <th> التاريخ</th>

                      <th>الحالة</th>

                    <th> خيارات</th>

                  </tr>
                  </thead>
                  <tbody id="salaries">
                    @if (count($custodies) > 0)
                    @foreach ($custodies as $index => $custody)
                    <tr>
                      @if($custody->asset->typeID != 0)
                      <td>{{$index+1}}</td>

                      <td>{{$custody->asset->nameAr}}</td>

                      <td>{{$custody->asset->type->nameAr}}</td>

                      <td>{{$custody->created_at}}</td>
                      @if($custody->Status == 6)
                      <td>في إنتظار قبول التسليم</td>
                      @else
                        قيد الإستخدام
                      @endif

                      <td>

                        @if(($custody->Status != -2)&&($custody->Status != 6))
                        <a href="{{route('castodies.show',$custody->id)}}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a>
                        {{-- <a type="button" onclick="showModal()" class="btn btn-warning"><i class="fa fa-list"></i> إشعار بحالة عهدة</a> --}}

                        <a type="button" onclick="showModal2({{$custody->id}},'{{$custody->asset->nameAr}}')" class="btn btn-primary"><i class="fa fa-check"></i> تسليم العهدة</a>
                        @elseif($custody->Status == -2)
                        <a type="button" onclick="updateStatus({{$custody->id}},1)" class="btn btn-primary"><i class="fa fa-user"></i>تأكيد الإستلام</a>
                        @endif
                        {{-- <a type="button" onclick="showModal3()" class="btn btn-primary"><i class="fa fa-user"></i> تسليم لموظف</a> --}}
                      </td>
                      @endif
                    </tr>
                     <!-- Create Modal -->
<div class="modal fade modal" id="CastodyStatus" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">إشعار حالة عهدة</h5>
       <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <form class="user" method="POST" action="#" enctype = "multipart/form-data">
        @csrf
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username"> العهدة  :</label>

                <label class="form-control-label" for="input-username"> {{$custody->itemAr}}</label>


                @error('days')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>
            <div class="col-lg-6"></div>
            <div class="col-lg-11">
              <div class="form-group">
                <label class="form-control-label" for="input-username">حالة العهدة</label>
                <textarea  class="form-control @error('details') is-invalid @enderror" id="details" name="details" rows="4">
                </textarea>
                @error('details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>

          </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="float:right">رفع الإشعار</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right">تراجع</button>
            </div>
          </div>



        </div>
        </div>
        <hr class="my-4" />
      </form>
</div>
<div class="modal fade modal" id="CastodyReturn" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">   طلب تسليم العهدة</h5>
       <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <form class="user" method="POST" action="{{route('castodies.return')}}" enctype = "multipart/form-data">
        @csrf
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username"> العهدة  :</label>
                <input type="text" class="form-control" id="custName" name="custName" readonly>
                <input type="hidden" class="form-control" id="custID2" name="custID">


                @error('days')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>
            <div class="col-lg-6"></div>
            <div class="col-lg-11">
              <div class="form-group">
                <label class="form-control-label" for="input-username">حالة العهدة عند التسليم</label>
                <textarea  class="form-control @error('details') is-invalid @enderror" id="details" name="details" rows="4">
                </textarea>
                @error('details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>

          </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="float:right">رفع الطلب</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right">تراجع</button>
            </div>
          </div>



        </div>
        </div>
        <hr class="my-4" />
      </form>
</div>
                    @endforeach


                @endif

                  </tfoot>
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


<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  function showModal() {

       $('#CastodyStatus').modal('show')
    }
    function showModal2(...params) {


       document.getElementById('custID2').value = params[0];
       document.getElementById('custName').value = params[1];
        $('#CastodyReturn').modal('show')
     }
  function handleDelete(id){
    Swal.fire({
      title: 'هل انت متأكد من الحذف؟',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: 'نعم، حذف',
      cancelButtonText: 'لا، الغاء'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/delete-productcategory/"+id;
      }
    })
  }

  $('#empName').change(function(){

    nameAr = document.getElementById("empName").value;
    arr_index = items.map((el) => el.nameAr).indexOf(nameAr);
    empid = items[arr_index].id;
    ino =items[arr_index].idNo;


    document.getElementById("empID").value = empid;
    document.getElementById("idno").value =ino;
    document.getElementById("ename").value =nameAr;
    document.getElementById("addbtn").disabled=false;
  });
  var availableTags = <?php echo json_encode($employees); ?>;
  var items = <?php echo json_encode($employees_all); ?>;
    $( ".autocomplete" ).autocomplete({
    source: availableTags
  });

  function updateStatus(...params){

   Swal.fire({

     title: 'هل انت متأكد من قبول العهدة  ',
     text: "",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#f8a29e',
     confirmButtonText: 'نعم، حذف',
     cancelButtonText: 'لا، الغاء'
   }).then((result) => {
     if (result.isConfirmed) {
       window.location.href = "/updateCustodStatus/"+params[0] +"/"+params[1];
     }
   })

 }




</script>

@endsection
