
@extends('layouts.dashboard')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">الموظفين</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#"> البلاغات </a></li>
          <li class="breadcrumb-item active">قائمة البلاغات</li>
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
                <h3 class="card-title">كل الموظفين</h3>
                <br>
                <form class="row col-6" method="POST" action="{{route('attendance.ByDate')}}">
                  @csrf
                  <div class="col-lg-4">
                    <label for="">من تاريخ</label>
                    <input type="date" name="dateFrom" class="form-control" value="{{session('dateFrom')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for="">الى تاريخ</label>
                    <input type="date" name="dateTo" class="form-control" value="{{session('dateTo')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for="">&nbsp;</label>
                    <input type="submit" class="form-control btn btn-primary" value="بحث">
                  </div>
                </form>
              {{-- <form class="user" method="POST" action="{{ route('employees.storeSalary') }}" enctype = "multipart/form-data">
                @csrf --}}
                      <input type="hidden" id="lat">
                       <input type="hidden" id="long">

                      
                      
              {{-- </form> --}}
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>الرقم</th>
                    <!--<th> Code ID</th>-->
                    <th>الموظف</th>
                    <th>الفرع</th>
                    <th>تاريخ البلاغ </th>
                    <th>نوع البلاغ</th>
                 
                    <th>خيارات</th>
                  </tr>
                  </thead>
                  <tbody>
                        <td>1</td>
                    <td>سعيد الطيب محمد الحسن</td>
                    <td>الرئيسي</td>
                    <td>{{ date('Y-m-d')}}</td>
                    <td>سرقة</td>
              
                    <td>{{ date('Y-m-d')}}</td>
                    <td>
                      <a href="#" class="btn btn-primary"><i class="fa fa-check"></i> عرض</a>
                      
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

//   $(document).ready(function(){
   
//        alert('test');
//    if(navigator.geolocation){
//        navigator.geolocation.getCurrentPosition(showLocation);
//    }else{ 
//        $('#location').html('Geolocation is not supported by this browser.');
//    }


// });
function getLocation()
{
 //alert('test');
   if(navigator.geolocation){
       navigator.geolocation.getCurrentPosition(showLocation);
   }else{ 
       $('#location').html('Geolocation is not supported by this browser.');
   }
}
function showLocation(position){
var latitude = position.coords.latitude;
var longitude = position.coords.longitude;

 document.getElementById("lat").value= latitude;
 document.getElementById("long").value= longitude;
  //  var test = "/storeAttendance?lat="+String(latitude)+"&long="+String(longitude);
  // alert(longitude);
  location.href = "/storeAttendance/"+String(latitude)+"/"+String(longitude);
  // $.ajax({
  //       url: "/storeAttendance/"+String(latitude)+"/"+String(longitude),
  //       success: data => {
  //         document.getElementById("lat").value = data.quantity;
  //       }

  //     });



}
</script>
