
@extends('layouts.dashboard')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">المركبات</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#"> المركبات </a></li>
          <li class="breadcrumb-item active">قائمة المركبات</li>
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
                <h3 class="card-title">كل المركبات</h3>

                <a type="button" onclick="showModal()"  class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> إضافة </a>
                <br>
                
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>الرقم</th>
                    <!--<th> Code ID</th>-->
                    <th>المركبة</th>
                    <th>الموديل</th>
                    <th>رقم الهيكل</th>
                    <th>إنتهاء رخصة السير </th>
                    
                    <th>خيارات</th>
                  </tr>
                  </thead>
                  <tbody>
                        <td>1</td>
                    <td>لاندكروزر برادو</td>
                    <td>2020</td>
                    <td>VC17FDB00012030203</td>
                    <td>15-9-2024</td>
                   
                    <td>
                      <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a>
                      <a href="#" class="btn btn-warning"><i class="fa fa-check"></i> تسليم لموظف</a>
                      
                    </td>
                   
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
        <h5 class="modal-title text-center" id="exampleModalLabel">مركبة جديدة</h5>
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
                <label class="form-control-label" for="input-username">  إسم المركبة:</label>
                <input type="text" name="nameAr" class="form-control">
              </div>
              
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">  الموديل :</label>
                <input type="text" name="nameAr" class="form-control">
              </div>
              
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">  رقم الهيكل :</label>
                <input type="text" name="nameAr" class="form-control">
              </div>
              
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">  رقم اللوحة :</label>
                <input type="text" name="nameAr" class="form-control">
              </div>
              
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">  رخصة السير  :</label>
                <input type="file" class="form-control" name="licenceImage">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">  التأمين:</label>
                <input type="file" class="form-control" name="insuranceImage">
              </div>
            </div>
           
           
          </div>
            
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="float:right">إضافة</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right">تراجع</button>
            </div>
          </div>
          
          
         
        </div>
        </div>
        <hr class="my-4" />
      </form>
</div>
@endsection
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
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
        window.location.href = "/delete-customer/"+id;
      }
    })
  }

  function showModal() {
        //console.log('star.', id)
      // var form = document.getElementById('deleteCategoryForm')
      // form.action = '/user/delete/' + id
      // form.action = '/Bills/' + id
       $('#CreateModal').modal('show')
    }

//   $(document).ready(function(){
   
//        alert('test');
//    if(navigator.geolocation){
//        navigator.geolocation.getCurrentPosition(showLocation);
//    }else{ 
//        $('#location').html('Geolocation is not supported by this browser.');
//    }


// });

</script>
