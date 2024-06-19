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
                <h6 style="display: inline-block">العقود الوظيفية </h6>
                <!--<a href=""   class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <div  class="col-6">
                <div class="form-group">
                 
                            
                 <label class="form-control-label" for="input-username">الموظف : {{$employee->nameAr}}</label>
                  <br>
                  <label class="form-control-label" for="input-username">القسم :   {{$employee->depart->nameAr}} </label>
                  
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name"> </label>
                        <br>
                        <!--<button class="btn btn-primary" style="width: 50%;display:inline-block" id="addbtn" onclick="newRow()" >إضافة </button>-->
                      </div>
                    </div>
                  </div>
                 
                </div>
              </div>

                <table  class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  
                    <th> الوصف</th>
                    <th>النوع </th>
                    <th> الكمية </th>
                    <th> تفاصيل</th>
                   
                    
                  </tr>
                  </thead>
                  <tbody id="items">
                    <tr>
                  
                        <td><input type="text" id="title" name="titleAr[]"></td>
                        <td><input type="text" id="type" name="type[]"></td>
                        <td><input type="number" id="quantity" name="quantity[]" ></td>
                        <td><input type="text" id="details" name="details[]" ></td>
                        
                        <td><a type="button" class="btn btn-info" onclick="newRow()"><i class="fa fa-plus"></i></a></td>
                        
                        
                      </tr>
                  </tfoot>
                </table>
                <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name"> </label>
                        <br>
                        <button class="btn btn-primary" style="width: 50%;display:inline-block" id="addbtn"  >إضافة </button>
                      </div>
                    </div>
                  </div>
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
  
  function newRow(){
    
    $('#items').append(`
                <tr>
                  
                  <td><input type="text" id="title" name="titleAr[]" onchange="calculate"></td>
                  <td><input type="text" id="type" name="type[]" onchange="calculate"></td>
                  <td><input type="text" id="quantity" name="quantity[]" onchange="calculate"></td>
                  <td><input type="text" id="details" name="details[]" onchange="calculate"></td>
                 
                  
                  
                </tr>
                `)
  }
 
</script>
@endsection