
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
          <li class="breadcrumb-item"><a href="#">الحضور والإنصراف</a></li>
          <li class="breadcrumb-item active">قائمة الحضور والإنصراف</li>
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
                <a type="button" onclick="getLocation()"  class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> تسجيل الحضور</a>
              </div>
              {{-- <form class="user" method="POST" action="{{ route('employees.storeSalary') }}" enctype = "multipart/form-data">
                @csrf --}}
                      <input type="hidden" id="lat">
                       <input type="hidden" id="long">

                       @if(session('atstatus') == 1)
                       <p class="alert alert-success">تم تسجيل الحضور </p>
                    @elseif(session('atstatus') == 5)
                     <p class="alert alert-danger">تعذر تسجيل الحضور لعدم وصولك لموقع العمل</p>
                    @elseif(session('atstatus') == 11)
                    <p class="alert alert-success">تم تسجيل الإنصراف </p>
                    @elseif(session('atstatus') == 33)
                    <p class="alert alert-danger">يرجى تسسجيل الحضور اولا</p>
                    @elseif(session('atstatus') == 2)
                    <p class="alert alert-danger">عفوا لقد تم التسجيل  مسبقا لهذا اليوم</p>
                    @endif
              {{-- </form> --}}
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    
                    <!--<th> Code ID</th>-->
                  
                    <th>وقت الحضور </th>
             
                    <th>التاريخ</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($attendances as $index =>  $item)
                    <tr>
                       <td>{{$item->checkTime}}</td> 
                       <td>{{$item->created_at->format('d-m-Y')}}</td> 
                       
                  </tr>
                    @endforeach
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
  location.href = "/storeHourAttendance/"+String(latitude)+"/"+String(longitude);
  // $.ajax({
  //       url: "/storeAttendance/"+String(latitude)+"/"+String(longitude),
  //       success: data => {
  //         document.getElementById("lat").value = data.quantity;
  //       }

  //     });



}
</script>
