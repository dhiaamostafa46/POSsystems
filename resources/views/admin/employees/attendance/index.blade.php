
@extends('layouts.dashboard')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('HR.AttendanceandDeparture') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
            <li class="breadcrumb-item active"> {{ trans('HR.AttendanceandDeparture') }}</li>
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
                <h3 class="card-title"> {{ trans('HR.AttendanceandDeparture') }}</h3>
                <br>
                <form class="row col-6" method="POST" action="{{route('attendance.ByDate')}}">
                  @csrf
                  <div class="col-lg-4">
                    <label for=""> {{ trans('HR.dateFrom') }}</label>
                    <input type="date" name="dateFrom" class="form-control" value="{{session('dateFrom')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for="">  {{ trans('HR.dateTo') }}</label>
                    <input type="date" name="dateTo" class="form-control" value="{{session('dateTo')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for="">&nbsp;</label>
                    <input type="submit" class="form-control btn btn-primary" value=" {{ trans('HR.Search') }}">
                  </div>
                </form>
              {{-- <form class="user" method="POST" action="{{ route('employees.storeSalary') }}" enctype = "multipart/form-data">
                @csrf --}}
                      <input type="hidden" id="lat">
                       <input type="hidden" id="long">

                       @if($status != -1)
                         @if($status == 1)
                            <p class="alert alert-success">  {{ trans('HR.Attendancehasbeenrecorded') }} </p>
                         @elseif($status == 0)
                          <p class="alert alert-danger">{{ trans('HR.Unabletheworksite') }}</p>
                         @else
                         <p class="alert alert-danger">{{ trans('HR.Sorryattendancetoday') }}</p>
                         @endif
                      @endif
              {{-- </form> --}}
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <!--<th> Code ID</th>-->
                    <th> {{ trans('HR.name') }}</th>
                    <th> {{ trans('HR.Branch') }}</th>
                    <th> {{ trans('HR.department') }} </th>
                    <th>  {{ trans('HR.Daysattendance') }} </th>
                    <th> {{ trans('HR.Daysabsence') }}  </th>

                    <th>  {{ trans('HR.extratime') }}  </th>

                    <th> {{ trans('HR.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>

                  {{-- @if (count($attendances) > 0)
                      @foreach ($attendances as $index => $atten)
                      <tr>

                        <td>{{$atten->id}}</td>


                        <td>{{$atten->employees->nameAr}}</td>
                        <td>{{$atten->employees->brnanch->nameAr}}</td>
                        <td>{{$atten->employees->depart->nameAr}}</td>
                        <td>حضور</td>


                        <td style="text-align:center">{{$atten->checkTime}}</td>
                        <td style="text-align:center">{{$atten->checkoutTime}}</td>

                        <td>{{$atten->created_at}}</td>
                        <td>
                          <a href="{{route('employees.show',$atten->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a>
                          <a href="{{route('employees.custodiesByID',$atten->id)}}" class="btn btn-info"><i class="fa fa-bookmark"></i> العهد</a>
                          <a href="{{route('employees.documentsByID',$atten->id)}}" class="btn btn-danger"><i class="fa fa-file"></i> المستندات</a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center">لا يوجد سجل حضور</td>
                      </tr>
                  @endif --}}
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
