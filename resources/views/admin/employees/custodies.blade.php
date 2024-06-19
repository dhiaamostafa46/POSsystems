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
               <div  class="col-6">
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
              </div>

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> الموظف</th>
                    <th>الوصف </th>
                    <th> النوع </th>
                    <th> التاريخ</th>


                  </tr>
                  </thead>
                  <tbody id="salaries">
                    @if (count($custodies) > 0)
                    @foreach ($custodies as $index => $custody)
                    <tr>
                      <td>{{$index+1}}</td>
                      <td>{{$custody->employees->nameAr}}</td>
                      <td>{{$custody->itemAr}}</td>
                      <td>{{$custody->typeID}}</td>
                      <td>{{$custody->created_at}}</td>


                      <td>
                        <a href="{{asset('dist/empDocs/custodies/'.$custody->file)}}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a>
                        <a type="button" class="btn btn-info" onclick="showEditModal('EditModal',{{ $custody->id }})"><i class="fa fa-edit"></i> تعديل</a>

                      </td>
                    </tr>

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




  <!-- Create Modal -->
<div class="modal fade modal" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel"> عهدة جديدة  </h5>
       <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <form class="user" method="POST" action="{{route('castodies.store')}}" enctype = "multipart/form-data">
        @csrf
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">العهدة </label>
                <input type="hidden"  class="form-control @error('empID') is-invalid @enderror" id="empID" name="empID">
                  <select name="" class="form-control">
                    <option value="">سيارة رينولد دوكر</option>
                    <option value="">مركبة</option>
                    <option value="">مستخدمة</option>
                 </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">الكمية </label>
                <input type="number"  class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" placeholder="الكمية">
                @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            {{-- <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">النوع </label>
                <select  class="form-control" name="typeID" id="typeID">
                  <option value="1">لابتوب</option>
                  <option value="2">سيارة</option>
                </select>
                @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div> --}}
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">الملف </label>
                <input type="file"  class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                @error('file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">ملاحظة </label>
                <input type="text"  class="form-control @error('quantity') is-invalid @enderror" id="details" name="details">
                @error('details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>



          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-last-name"> </label>
                <br>
                <button type="submit"class="btn btn-primary" style="width: 50%;display:inline-block" >إضافة </button>
              </div>
            </div>
          </div>

        </div>



        </div>
        </div>
        <hr class="my-4" />
      </form>
    </div>





<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  function showModal() {
        //console.log('star.', id)
      // var form = document.getElementById('deleteCategoryForm')
      // form.action = '/user/delete/' + id
      // form.action = '/Bills/' + id
       $('#CreateModal').modal('show')
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



</script>
@endsection
