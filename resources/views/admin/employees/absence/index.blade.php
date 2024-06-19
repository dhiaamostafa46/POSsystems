
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
                <h3 class="card-title"> {{ trans('HR.employeeslist') }}</h3>
                <br>
                <form class="row col-6" method="POST" action="{{route('absences.ByDate',1)}}">
                  @csrf
                  <div class="col-lg-4">
                    <label for="">  {{ trans('HR.dateFrom') }}</label>
                    <input type="date" name="dateFrom" class="form-control" value="{{session('dateFrom')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for="">  {{ trans('HR.dateTo') }}</label>
                    <input type="date" name="dateTo" class="form-control" value="{{session('dateTo')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for="">&nbsp;</label>
                    <input type="submit" class="form-control btn btn-primary" value=" {{ trans('HR.Sreach') }}">
                  </div>
                </form>
              {{-- <form class="user" method="POST" action="{{ route('employees.storeSalary') }}" enctype = "multipart/form-data">
                @csrf --}}

              {{-- </form> --}}
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>{{ trans('HR.number') }}</th>
                    <!--<th> Code ID</th>-->
                    <th>{{ trans('HR.name') }}</th>
                    <th>{{ trans('HR.Branch') }}</th>
                    <th>{{ trans('HR.department') }} </th>
                    <th> {{ trans('HR.Requiredhours') }} </th>
                    <th>{{ trans('HR.form') }}  </th>
                    <th>{{ trans('HR.TO') }} </th>
                    <th>{{ trans('HR.date') }} </th>
                    <th>{{ trans('HR.Status1') }} </th>
                    <th>{{ trans('HR.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($absences)> 0)
                  @foreach ($absences as $index => $abs)
                  <tr>
                        <td>{{$index+1}}</td>
                    <td>{{$abs->employees->nameAr}}</td>
                    <td>{{$abs->employees->brnanch->nameAr}}</td>
                    <td>{{$abs->employees->depart->nameAr}}</td>
                    <td>{{$abs->hours}}</td>
                    <td>{{$abs->from}}</td>
                    <td>{{$abs->to}}</td>
                    <td>{{$abs->absDate->format('d-m-Y')}}</td>
                    <td>
                      @if($abs->Status == 1)
                      {{ trans('HR.Waitingforapproval') }}
                      @elseif($abs->Status == 2)
                      {{ trans('HR.Hasbeenapproved') }}
                      @elseif($abs->Status == 3)
                      {{ trans('HR.unacceptable') }}
                      @endif
                 </td>
                    <td>
                      @if($abs->Status == 1)
                        <a href="#" class="btn btn-primary" onclick="updateStatus({{$abs->id}},2)"><i class="fa fa-check"></i>   {{ trans('HR.Ok') }}</a>
                        <a href="#" class="btn btn-danger" onclick="updateStatus({{$abs->id}},3)"><i class="fa fa-trash"></i> {{ trans('HR.Cancel') }}</a>

                        @endif
                    </td>
                  </tr>
                  @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center"> {{ trans('HR.NotFoundData') }}   </td>
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

    <div style="display: none">
        <h1 id="HRAreyousure"> {{ trans('HR.Areyousuretherequestwillberejected') }}</h1>
        <h1 id="HRAreyousureApprovaloftheleaverequest"> {{ trans('HR.Approvalofthepermissionrequest') }}</h1>
        <h1 id="HRAreyousureconfirmButtonTextsure"> {{ trans('HR.confirmButtonTextsure') }}</h1>
        <h1 id="HRconfirmButtonText"> {{ trans('HR.confirmButtonText') }}</h1>
        <h1 id="HRcancelButtonText"> {{ trans('HR.cancelButtonText') }}</h1>
        {{-- document.getElementById('HRAreyousure').innerHTML --}}
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


  function updateStatus(...params){

   if( params[1] == 3)
   {

   Swal.fire({

     title:document.getElementById('HRAreyousure').innerHTML ,
     text: "",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#f8a29e',
     confirmButtonText: document.getElementById('HRconfirmButtonText').innerHTML ,
     cancelButtonText:document.getElementById('HRcancelButtonText').innerHTML
   }).then((result) => {
     if (result.isConfirmed) {
       window.location.href = "/updateAbsStatus/"+params[0] +"/"+params[1];
     }
   })
 }else
 {

   Swal.fire({

     title: document.getElementById('HRAreyousureApprovaloftheleaverequest').innerHTML ,
     text: "",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#f8a29e',
     confirmButtonText:document.getElementById('HRAreyousureconfirmButtonTextsure').innerHTML ,
     cancelButtonText: document.getElementById('HRcancelButtonText').innerHTML
   }).then((result) => {
     if (result.isConfirmed) {
       window.location.href = "/updateAbsStatus/"+params[0] +"/"+params[1];
     }
   })
 }
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
