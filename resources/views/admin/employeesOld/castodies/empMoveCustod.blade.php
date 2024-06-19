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
          <li class="breadcrumb-item active">قائمة العهد المتنقلة</li>
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
                <h6 style="display: inline-block">العهد المتنقلة  </h6>
                <!--<a href=""   class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
           
                    <th>الوصف </th>
             
                    <th> وقت الإستلام</th>
                    <th> خيارات</th>
                    
                  </tr>
                  </thead>
                  <tbody id="salaries">
                   
                    <tr>
                      <td>1</td>
                      <td>سيارة يارس 2020</td>
                      <td>{{ date('Y-m-d h:m')}}</td>
                      
                      <td>

                        <a type="button" onclick="showModal()" class="btn btn-primary"><i class="fa fa-check"></i> تسليم لموظف</a>
                      
                        {{-- <a type="button" onclick="showModal3()" class="btn btn-primary"><i class="fa fa-user"></i> تسليم لموظف</a> --}}
                      </td>
                    </tr>
                     <!-- Create Modal -->
<div class="modal fade modal" id="CastodyStatus" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">تسليم لموظف</h5>
      
      </div>
      <form class="user" method="POST" action="#" enctype = "multipart/form-data">
        @csrf
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username"> الموظف  :</label>

                <select class="livesearch form-control" name="empID" id="sername">
                          
                </select>
               
                
                @error('empID')
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
      <form class="user" method="POST" action="#" enctype = "multipart/form-data">
        @csrf
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username"> العهدة  :</label>

                <label class="form-control-label" for="input-username"></label>
               
                
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<!------------------------------------add saeed -------------------------------------------------->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script>
  function showModal() {
        //console.log('star.', id)
      // var form = document.getElementById('deleteCategoryForm')
      // form.action = '/user/delete/' + id
      // form.action = '/Bills/' + id
       $('#CastodyStatus').modal('show')
    }
    function showModal2() {
        //console.log('star.', id)
      // var form = document.getElementById('deleteCategoryForm')
      // form.action = '/user/delete/' + id
      // form.action = '/Bills/' + id
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
  
 </script>
  <script>
  $('.livesearch').select2({
        placeholder: 'أدخل إسم الموظف ',
        ajax: {
            url: '/emp-autocomplete-search',
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

   


      </script>
 
 
</script>
@endsection