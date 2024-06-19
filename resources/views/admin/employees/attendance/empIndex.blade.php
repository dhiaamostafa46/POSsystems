
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
                <h3 class="card-title">  {{ trans('HR.AttendanceandDeparture') }}  </h3>

                <a type="button" onclick="getLocation(1)"  class="btn btn-primary floatmleft"><i class="fa fa-sign-in" aria-hidden="true"></i>   {{ trans('HR.Recordattendance') }}  </a>
                <a type="button" onclick="getLocation(2)"  class="btn btn-danger floatmleft" style="margin:0px 10px"><i class="fa fa-sign-out"></i>   {{ trans('HR.Disbursementregistration') }} </a>

                <a type="button" href="{{route('attendance.empHourAttendance')}}"  class="btn btn-primary floatmleft" style="margin-left:10px"><i class="fa fa-clock"></i>  {{ trans('HR.Attendancethehour') }}  </a>

              </div>
              {{-- <form class="user" method="POST" action="{{ route('employees.storeSalary') }}" enctype = "multipart/form-data">
                @csrf --}}
                      <input type="hidden" id="lat" value="24.711668300417863">
                       <input type="hidden" id="long"  value="46.67555999755859">

                       <input type="hidden" id="type">
                         {{-- @dd(session('atstatus')); --}}

                         @if(session('atstatus') == 1)
                            <p class="alert alert-success">  {{ trans('HR.Attendancehasbeenrecorded') }}  </p>
                         @elseif(session('atstatus') == 5)
                          <p class="alert alert-danger">{{ trans('HR.Unableregistersite') }}</p>
                         @elseif(session('atstatus') == 11)
                         <p class="alert alert-success">{{ trans('HR.Disbursementrecorded') }} </p>
                         @elseif(session('atstatus') == 33)
                         <p class="alert alert-danger">{{ trans('HR.Pleaseattendfirst') }}</p>
                         @elseif(session('atstatus') == 2)
                         <p class="alert alert-danger">{{ trans('HR.Sorryyouhavetoday') }}</p>
                         @endif

              {{-- </form> --}}
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover ">
                  <thead>
                  <tr>
                    <th>{{ trans('HR.number') }}</th>
                    <!--<th> Code ID</th>-->
                    <th>{{ trans('HR.date') }}</th>
                    <th>{{ trans('HR.Branch') }}</th>
                    <th>{{ trans('HR.department') }} </th>

                    <th> {{ trans('HR.timeattendance') }} </th>
                    <th>{{ trans('HR.Check-outtime') }}  </th>
                    <th>{{ trans('HR.Delay') }}</th>
                    <th>{{ trans('HR.extratime') }}</th>
                    <th> {{ trans('HR.workhours') }}</th>
                    <th>{{ trans('HR.Statusdattendance') }} </th>
                    <th> {{ trans('HR.comments') }}</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($attendances) > 0)

                      <?php $v=1;?>
                      <?php $ch = "vv";?>
                      @for($x=0;$x<count($dates);$x++)

                        <?php $atten= $attendances->where('created_at',$dates[$x]); ?>

                              @if(count($atten)>0)
                                @foreach ($atten as $index => $att)
                                <tr>

                                  <td style="text-align:center;">{{$v++}}</td>


                                  <td style="text-align:center;">{{$att->created_at->format('D  d/m/Y')}}</td>

                                  <td style="text-align:center;">{{$att->employees->brnanch->nameAr}}</td>
                                  <td style="text-align:center;">{{$att->employees->depart->nameAr}}</td>


                                  {{-- <td style="text-align:center" @if($att->created_at_difference($att->idEndDate) <  30) class="alert alert-secondary" @endif>
                                    {{$att->idEndDate}}</td> --}}

                                    <td style="text-align:center">{{$att->checkTime}}</td>
                                    <td style="text-align:center">{{$att->checkoutTime}}</td>
                                    @if($att->employees->shift->type == 1)
                                    <?php
                                      $workHoures = $att->created_at_difference($att->checkTime,$att->checkoutTime);
                                       $diffSt = $att->created_at_difference($att->checkTime,$att->employees->shift->stTime);
                                       $diffEn = $att->created_at_difference($att->checkoutTime,$att->employees->shift->enTime);

                                       $r1 = $att->toHours($diffSt) + $att->toHours($diffEn);
                                       ?>

                                      <td style="text-align:center;color:red">{{$diffSt}}</td>
                                      <td style="text-align:center;color:green">{{$diffEn}}</td>
                                    @endif
                                    <td>{{$workHoures}}</td>
                                    <td>{{ trans('HR.Presence') }}</td>


                                </tr>
                                @endforeach
                                @else
                                <tr>
                                  <td style="text-align:center;background-color:rgba(188, 184, 184, 0.91)">{{$v++}}</td>
                                  <td style="text-align:center;background-color:rgba(188, 184, 184, 0.91)">{{date('D  d/m/y',strtotime($dates[$x]))}}</td>
                                   @for($i=0;$i<7;$i++)
                                    <td style="text-align:center;background-color:rgba(188, 184, 184, 0.91)"></td>
                                   @endfor
                                   @if(date('D',strtotime($dates[$x])) == 'Fri')
                                    <td style="text-align:center;background-color:rgba(188, 184, 184, 0.91)">---</td>
                                    <td>

                                        {{ trans('HR.weekend') }}

                                    </td>
                                    @else
                                    <td style="text-align:center;background-color:rgba(188, 184, 184, 0.91)">{{ trans('HR.absence') }}</td><td></td>
                                    @endif
                                  </tr>
                                @endif
                      @endfor

                  @else
                      <tr>
                        <td colspan="7" class="text-center">  {{ trans('HR.NotFoundData') }}</td>
                      </tr>
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
@endsection
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript"
    src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyAJDNGhvRiWXMvI7VjALT363E3QMOqp6j8'></script>
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
function getLocation(type)
{
 document.getElementById("type").value =type;
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
 var atype =document.getElementById("type").value;
  //  var test = "/storeAttendance?lat="+String(latitude)+"&long="+String(longitude);
  // alert(longitude);
  location.href = "/storeAttendance/"+String(latitude)+"/"+String(longitude)+"/"+atype;
  // $.ajax({
  //       url: "/storeAttendance/"+String(latitude)+"/"+String(longitude),
  //       success: data => {
  //         document.getElementById("lat").value = data.quantity;
  //       }

  //     });



}
</script>
