@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">الأصول  </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">الأصول</a></li>
          <li class="breadcrumb-item active">أنواع الأصول </li>
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
                <h6 style="display: inline-block">أنواع الأصول</h6>
                <a type="button" onclick="showModal()"  class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> إضافة </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> الإسم (عربي)</th>
                    <th> الإسم (إنجليزي)</th>
                    <th>حيارات</th>
                    
                    
                  </tr>
                  </thead>
                  <tbody id="salaries">
                     <tr>
                      <td>1</td>
                        <td>جهاز إتصال</td>
                        <td>Call Device</td>
                        <td>
                          <a href="#" class="btn btn-warning"><i class="fa fa-edit"></i> تعديل</a>
                          <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> حذف </a>
                          
                        </td>
                     </tr>
                     <tr>
                      <td>2</td>
                      <td>لابتوب</td>
                      <td>Laptop</td>
                      <td>
                        <a href="#" class="btn btn-warning"><i class="fa fa-edit"></i> تعديل</a>
                        <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> حذف </a>
                        
                      </td>
                      
                     </tr>

                     <tr>
                      <td>3</td>
                      <td>جوال</td>
                      <td>phone</td>
                      <td>
                        <a href="#" class="btn btn-warning"><i class="fa fa-edit"></i> تعديل</a>
                        <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> حذف </a>
                        
                      </td>
                     </tr>
                      

                     
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
        <h5 class="modal-title text-center" id="exampleModalLabel"> نوع جديد   </h5>
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
                <label class="form-control-label" for="input-username">الإسم (عربي) </label>
                <input type="text"  class="form-control @error('empID') is-invalid @enderror" id="empID" name="empID">
                 
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">الإسم (إنجليزي) </label>
                <input type="text"  class="form-control @error('empID') is-invalid @enderror" id="empID" name="empID">
                @error('quantity')
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
  
  
 
</script>
@endsection