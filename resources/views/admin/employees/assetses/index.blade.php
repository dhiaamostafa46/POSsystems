
@extends('layouts.dashboard')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('HR.assetses') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
            <li class="breadcrumb-item active"> {{ trans('HR.assetses') }}</li>
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
                <h3 class="card-title">{{ trans('HR.assetses') }}</h3>
                <a type="button" href="{{route('assetses.create')}}"  class="btn btn-primary floatmleft" ><i class="fa fa-plus"></i> {{ trans('HR.Add') }}</a>
                <br>


              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>

                     <tr>
                  <tr>
                    <th>#</th>
                    <!--<th> Code ID</th>-->
                    <th> {{ trans('HR.Statement') }}</th>
                    <th>  {{ trans('HR.Assettype') }}</th>
                    <th> {{ trans('HR.Status1') }}</th>


                    <th> {{ trans('HR.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(count($assets) >0 )
                    @foreach($assets as $index => $asset)
                    <tr>
                       <td>{{$index+1}}</td>
                       <td>{{$asset->nameAr}}</td>
                       <td>{{$asset->type->nameAr}}</td>
                       <td>{{$asset->assetStatus}}</td>

                       <td>
                         <a href="{{route('assetses.show',$asset->id)}}" class="btn btn-primary"><i class="fa fa-check"></i>  {{ trans('HR.show') }}</a>

                       </td>
                    </tr>
                    @endforeach

                    @else
                      <tr>
                        <td colspan="7" class="text-center"> {{ trans('HR.Statement') }} </td>
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
