
@extends('layouts.dashboard')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('HR.advance') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
            <li class="breadcrumb-item active"> {{ trans('HR.advance') }}</li>
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
                <h3 class="card-title"> {{ trans('HR.Requestsforadvances') }} </h3>
                <br>
                <form class="row col-6" method="POST" action="{{route('attendance.ByDate')}}">
                  @csrf
                  <div class="col-lg-4">
                    <label for="">{{ trans('HR.form') }}  </label>
                    <input type="date" name="dateFrom" class="form-control" value="{{session('dateFrom')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for="">  {{ trans('HR.TO') }} </label>
                    <input type="date" name="dateTo" class="form-control" value="{{session('dateTo')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for="">&nbsp;</label>
                    <input type="submit" class="form-control btn btn-primary" value=" {{ trans('HR.Search') }} ">
                  </div>
                </form>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <!--<th> Code ID</th>-->
                    <th>{{ trans('HR.name') }}</th>
                    <th>{{ trans('HR.Branch') }}</th>
                    <th>{{ trans('HR.department') }} </th>
                    <th> {{ trans('HR.amount') }}  </th>
                    <th> {{ trans('HR.duedate') }} </th>
                    <th>{{ trans('HR.date') }} </th>
                    <th>{{ trans('HR.Status1') }} </th>
                    <th>{{ trans('HR.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if (count( $advances)> 0)
                    @foreach ( $advances as $index => $adv)
                    <tr>
                          <td>{{$index+1}}</td>
                      <td>{{$adv->employees->nameAr}}</td>
                      <td>{{$adv->employees->brnanch->nameAr}}</td>
                      <td>{{$adv->employees->depart->nameAr}}</td>
                      <td>{{$adv->amount}}</td>

                      <td>{{$adv->dueDate->format('d-m-Y')}}</td>
                      <td>{{$adv->created_at}}</td>
                      <td>
                        @if($adv->Status == 1)
                        {{ trans('HR.Waitingforapproval') }}
                        @elseif($adv->Status == 2)
                        {{ trans('HR.Hasbeenapproved') }}
                        @elseif($adv->Status == 3)
                        {{ trans('HR.unacceptable') }}
                        @endif
                   </td>
                      <td>
                        @if($adv->Status == 1)
                          <a href="#" class="btn btn-primary" onclick="updateStatus({{$adv->id}},2)"><i class="fa fa-check"></i>  {{ trans('HR.Ok') }}</a>
                          <a href="#" class="btn btn-danger" onclick="updateStatus({{$adv->id}},3)"><i class="fa fa-trash"></i> {{ trans('HR.Cancel') }}</a>

                          @endif
                      </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                          <td colspan="7" class="text-center"> {{ trans('HR.NotFoundData') }} </td>
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
        <h1 id="HRAreyousureApprovaloftheleaverequest"> {{ trans('HR.ApprovaloftheSalafistrequest') }}</h1>
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

     title: document.getElementById('HRAreyousure').innerHTML,
     text: "",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#f8a29e',
     confirmButtonText:  document.getElementById('HRconfirmButtonText').innerHTML,
     cancelButtonText:  document.getElementById('HRcancelButtonText').innerHTML
   }).then((result) => {
     if (result.isConfirmed) {
       window.location.href = "/updateAdvStatus/"+params[0] +"/"+params[1];
     }
   })
 }else
 {

   Swal.fire({

     title:document.getElementById('HRAreyousureApprovaloftheleaverequest').innerHTML,
     text: "",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#f8a29e',
     confirmButtonText: document.getElementById('HRAreyousureconfirmButtonTextsure').innerHTML,
     cancelButtonText:document.getElementById('HRcancelButtonText').innerHTML
   }).then((result) => {
     if (result.isConfirmed) {
       window.location.href = "/updateAdvStatus/"+params[0] +"/"+params[1];
     }
   })
 }
 }



</script>
