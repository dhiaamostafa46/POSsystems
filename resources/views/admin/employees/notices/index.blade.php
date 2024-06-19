
@extends('layouts.dashboard')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('HR.notices') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
            <li class="breadcrumb-item active"> {{ trans('HR.notices') }}</li>
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
                <h3 class="card-title">  {{ trans('HR.noticesAll') }}</h3>
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
                    <input type="submit" class="form-control btn btn-primary" value="{{ trans('HR.Search') }}">
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
                    <th> {{ trans('HR.noticesnumber') }}</th>
                    <!--<th> Code ID</th>-->
                    <th>{{ trans('HR.Employee') }}</th>
                    <th>{{ trans('HR.Branch') }}</th>
                    <th> {{ trans('HR.noticesdate') }}  </th>
                    <th>  {{ trans('HR.noticestype') }}  </th>

                    <th>{{ trans('HR.Options') }} </th>
                  </tr>
                  </thead>
                  <tbody>
                    @if (count($notics) > 0)
                    @foreach ($notics as $index => $notic)
                    <tr>
                      <td>{{$notic->id}}</td>
                      <td>{{$notic->employees->nameAr ?? ''}}</td>
                      <td>{{$notic->type->nameAr ?? ''}}</td>
                      <td>{{$notic->noticDate->format('d-m-Y')}}</td>
                      <td>
                        @if($notic->Status == 1)
                        {{ trans('HR.New') }}
                        @elseif($notic->Status == 2)

                         {{ trans('HR.Underreview') }}

                         @elseif($notic->Status == 3)
                         {{ trans('HR.Reviewed') }}
                         @endif
                        </td>

                        <td>
                          <a href="{{route('notices.show',$notic->id)}}" target="_blank" class="btn btn-primary"><i class="fa fa-eye">{{ trans('HR.show') }}</i></a>
                          @if($notic->Status != 3)
                          <a href="{{route('notics.updateStatus',['id'=>$notic->id,'status'=>3])}}" class="btn btn-primary"><i class="fa fa-check">{{ trans('HR.Done') }} </i></a>
                          @endif
                        </td>


                    </tr>
                    @endforeach
                    @else
                        <tr>
                          <td colspan="7" class="text-center"> {{ trans('HR.NotFoundData') }}</td>
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
<script>
  function handleDelete(id)
  {
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

</script>
