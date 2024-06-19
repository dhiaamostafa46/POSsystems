@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('HR.Requestsfordeliverycustody') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
            <li class="breadcrumb-item active"> {{ trans('HR.Requestsfordeliverycustody') }}</li>
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
                <h6 style="display: inline-block">  {{ trans('HR.Requestsfordeliverycustody') }}  </h6>
                <!--<a href=""   class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">


                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>

                    <th> {{ trans('HR.From') }}  </th>
                    <th> {{ trans('HR.description') }}  </th>
                    <th> {{ trans('HR.Type') }}  </th>
                    <th>  {{ trans('HR.date') }} </th>
                    <th> {{ trans('HR.Options') }}</th>

                  </tr>
                  </thead>
                  <tbody id="salaries">
                    @if (count($backrequests) > 0)
                    @foreach ($backrequests as $index => $item)
                    <tr>
                      {{-- @if($item->custody->asset->typeID != 0) --}}
                      {{-- @dd($item->empID); --}}
                      <td>{{$index+1}}</td>
                      @if($item->empID == -1)
                        <td> {{ trans('HR.Administration') }}</td>
                      @else
                      <td>{{$item->employees->nameAr}}</td>
                      @endif

                      <td>{{$item->custody->asset->nameAr}}</td>
                      @if($item->custody->asset->typeID != 0)
                      <td>{{$item->custody->asset->type->nameAr}}</td>
                      @else
                       <td>  {{ trans('HR.Mobilecustody') }}</td>
                      @endif

                      <td>{{$item->created_at}}</td>

                      <td>
                        <a href="{{route('castodies.show',$item->custody->id)}}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('HR.show') }} </a>
                          <a type="button" onclick="showModal2()" class="btn btn-primary"><i class="fa fa-user"></i> {{ trans('HR.receiptconfirmation') }}</a>


                      </td>
                      {{-- @endif --}}
                    </tr>

<div class="modal fade modal" id="CastodyReturn" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('HR.Approvalofthecovenant') }} </h5>

      </div>
      <form class="user" method="POST" action="{{route('castodies.acceptRecive')}}" enctype = "multipart/form-data">
        @csrf
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username"> {{ trans('HR.covenant') }}  :</label>
                <input type="text" class="form-control" id="custName" name="custName" value="{{$item->custody->asset->nameAr}}" readonly>
                <input type="hidden" class="form-control" id="custID2" name="custID" value="{{$item->custID}}">
                <input type="hidden" class="form-control" id="reqID" name="reqID" value="{{$item->id}}">
                @if($item->custody->asset->typeID != 0)
                <input type="hidden" class="form-control" id="type" name="ctype" value="1">
                @else
                <input type="hidden" class="form-control" id="type" name="ctype" value="2">
                @endif



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
                <label class="form-control-label" for="input-username"> {{ trans('HR.Conditionofcustodyuponreceipt') }}</label>
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
              <button type="submit" class="btn btn-primary" style="float:right"> {{ trans('HR.Raisetherequest') }}</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right"> {{ trans('HR.retreat') }}</button>
            </div>
          </div>



        </div>
        </div>
        <hr class="my-4" />
      </form>
</div>
                    @endforeach


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


<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  function showModal() {

       $('#CastodyStatus').modal('show')
    }
    function showModal2() {


      //  document.getElementById('custID2').value = params[0];
      //  document.getElementById('custName').value = params[1];
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


  function updateStatus(id){

   Swal.fire({

     title: 'هل انت متأكد من قبول العهدة  ',
     text: "",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#f8a29e',
     confirmButtonText: 'نعم، حذف',
     cancelButtonText: 'لا، الغاء'
   }).then((result) => {
     if (result.isConfirmed) {
       window.location.href = "/acceptReturn/"+id;
     }
   })

 }




</script>

@endsection
