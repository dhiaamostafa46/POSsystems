
@extends('layouts.dashboard')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('HR.Permissionrequests') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
            <li class="breadcrumb-item active"> {{ trans('HR.Permissionrequests') }}</li>
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
                <h3 class="card-title">  {{ trans('HR.Permissionrequests') }} </h3>
                <a type="button" onclick="showModal()"  class="btn btn-primary floatmleft"><i class="fa fa-plus"></i>   {{ trans('HR.NewOrder') }}</a>
                <br>
                <hr>
                <div class="row">
                <form class="row col-6" method="POST" action="{{route('absences.ByDate',2)}}">
                  @csrf
                  <div class="col-lg-4">
                    <label for=""> {{ trans('HR.dateFrom') }} </label>
                    <input type="date" name="dateFrom" class="form-control" value="{{session('dateFrom')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for=""> {{ trans('HR.dateTo') }} </label>
                    <input type="date" name="dateTo" class="form-control" value="{{session('dateTo')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for="">&nbsp;</label>
                    <input type="submit" class="form-control btn btn-primary" value=" {{ trans('HR.Search') }}">
                  </div>
                </form>
                <div class="col-3"></div>
                <div class="col-3">
                <br>

                </div>

              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <!--<th> Code ID</th>-->
                    <th> {{ trans('HR.Requiredhours') }} </th>
                    <th> {{ trans('HR.date') }} </th>
                    <th> {{ trans('HR.form') }} </th>
                    <th> {{ trans('HR.TO') }} </th>
                    <th>  {{ trans('HR.Orderstatus') }}  </th>

                  </tr>
                  </thead>
                  <tbody>


                  @if (count($absences)> 0)
                      @foreach ($absences as $index => $abs)
                      <tr>
                        <td>{{$index}}</td>
                        <td>{{$abs->hours}}</td>
                        <td>{{$abs->absDate->format('d-m-Y')}}</td>
                        <td>{{$abs->from}}</td>
                        <td>{{$abs->to}}</td>
                        <td>
                             @if($abs->Status == 1)
                             {{ trans('HR.Waitingforapproval') }}
                             @elseif($abs->Status == 2)
                             {{ trans('HR.Hasbeenapproved') }}
                             @elseif($abs->Status == 3)
                             {{ trans('HR.unacceptable') }}
                             @endif
                        </td>


                        {{-- <td>
                          <a href="{{route('employees.show',$atten->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a>
                          <a href="{{route('employees.custodiesByID',$atten->id)}}" class="btn btn-info"><i class="fa fa-bookmark"></i> العهد</a>
                          <a href="{{route('employees.documentsByID',$atten->id)}}" class="btn btn-danger"><i class="fa fa-file"></i> المستندات</a>
                        </td> --}}
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center"> {{ trans('HR.NotFoundData') }}    </td>
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

     <!-- Create Modal -->
<div class="modal fade modal" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('HR.Submitarequestforpermission') }}  </h5>
       <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <form class="user" method="POST" action="{{route('absences.storeAbsence')}}" enctype = "multipart/form-data">
        @csrf
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-5">
              <div class="form-group">
                <label class="form-control-label" for="input-username">    {{ trans('HR.Requiredhours') }}</label>
                <input type="number" name="hours" class="form-control">

                @error('hours')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label class="form-control-label" for="input-username"> {{ trans('HR.form') }}   :</label>
                <input type="time" name="timeFrom" class="form-control">

                @error('hours')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label class="form-control-label" for="input-username">{{ trans('HR.TO') }}    :</label>
                <input type="time" name="timeTo" class="form-control">

                @error('hours')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label class="form-control-label" for="input-username">{{ trans('HR.date') }}  :</label>
                <input type="date" name="reqdate" class="form-control">

                @error('reqdate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-lg-6"></div>
            <div class="col-lg-11">
              <div class="form-group">
                <label class="form-control-label" for="input-username">{{ trans('HR.reason') }}  </label>
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
              <button type="submit" class="btn btn-primary" style="float:right">{{ trans('HR.Save') }} </button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right">{{ trans('HR.retreat') }}</button>
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

//   $(document).ready(function(){

//        alert('test');
//    if(navigator.geolocation){
//        navigator.geolocation.getCurrentPosition(showLocation);
//    }else{
//        $('#location').html('Geolocation is not supported by this browser.');
//    }


// });
function showModal() {
        //console.log('star.', id)
      // var form = document.getElementById('deleteCategoryForm')
      // form.action = '/user/delete/' + id
      // form.action = '/Bills/' + id
       $('#CreateModal').modal('show')
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
