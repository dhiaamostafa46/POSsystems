@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('HR.MobileCovenant') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
            <li class="breadcrumb-item active"> {{ trans('HR.MobileCovenant') }}</li>
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
                <h6 style="display: inline-block">  {{ trans('HR.MobileCovenant') }}  </h6>
                <!--<a href=""   class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">


                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>

                    <th> {{ trans('HR.description') }} </th>
                    <th>{{ trans('HR.Model') }}  </th>
                    <th> {{ trans('HR.PlateNumber') }}   </th>

                    <th>  {{ trans('HR.Timeofreceipt') }}</th>
                    <th>   {{ trans('HR.Statusdattendance') }} </th>
                    <th>  {{ trans('HR.Options') }} </th>

                  </tr>
                  </thead>

                  <tbody id="salaries">
                    @if(count($custodies) >0 )
                    @foreach($custodies as $index => $cust)
                    @if($cust->asset->typeID == 0 )
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$cust->asset->nameAr}}</td>
                        <td>{{$cust->asset->car->modelNo}}</td>
                        <td>{{$cust->asset->car->blatNo}}</td>
                        <td>{{$cust->toEmpDate}}</td>

                        @if($cust->Status == 6)
                        <td>{{ trans('HR.Waitingtoacceptdelivery') }} </td>
                        @else
                        <td>  {{ trans('HR.Inuse') }}  </td>
                        @endif


                      <td>
                        @if(($cust->Status != -2)&&($cust->Status != 6))
                        <a type="button" onclick="showModal({{$cust->id}},'{{$cust->asset->nameAr}}')" class="btn btn-primary"><i class="fa fa-check"></i>  {{ trans('HR.Handingovertoanemployee') }}  </a>

                        <a type="button" onclick="showModal2({{$cust->id}},'{{$cust->asset->nameAr}}')" class="btn btn-warning"><i class="fa fa-user"></i>  {{ trans('HR.retreat') }} </a>

                        {{-- @elseif($cust->Status == -2)
                        <a type="button" onclick="updateStatus({{$cust->id}},1)" class="btn btn-primary"><i class="fa fa-user"></i>تأكيد الإستلام</a> --}}
                        @endif
                      </td>
                    </tr>
                    @endif
                    @endforeach
                    @else
                    <tr>
                      <td colspan="7" class="text-center">{{ trans('HR.NotFoundData') }}</td>
                    </tr>
                @endif
                     <!-- Create Modal -->
<div class="modal fade modal" id="CastodyStatus" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('HR.Handingovertoanemployee') }} </h5>

      </div>
      <form class="user" method="POST" action="{{route('castodies.ToEmp')}}" enctype = "multipart/form-data">
        @csrf
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-10">
              <div class="form-group">
                <label class="form-control-label" for="input-username">  {{ trans('HR.Employee') }}  :</label>

                <select class="livesearch form-control" name="empID" id="sername">

                </select>

                @error('empID')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>

            <div class="col-lg-6"></div>

            <div class="col-lg-11">
              <div class="form-group">
                <label class="form-control-label" for="input-username"> {{ trans('HR.Custodystatus') }}</label>
                <input type="text" class="form-control" id="custName3" name="custName" readonly>
                <input type="hidden" class="form-control" id="custID3" name="custID">
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
              <button type="submit" class="btn btn-primary" style="float:right">{{ trans('HR.delivery') }}  </button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right">{{ trans('HR.retreat') }} </button>
            </div>

          </div>

        </div>
        </div>
        <hr class="my-4" />
      </form>
</div>
<div class="modal fade modal" id="CastodyReturn" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('HR.Requesttohandovercustody') }} </h5>

      </div>
      <form class="user" method="POST" action="{{route('castodies.return')}}" enctype = "multipart/form-data">
        @csrf
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username"> {{ trans('HR.custody') }}   :</label>

                <label class="form-control-label" for="input-username"></label>
                <input type="text" class="form-control" id="custName" name="custName" readonly>
                <input type="hidden" class="form-control" id="custID2" name="custID">

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
                <label class="form-control-label" for="input-username">{{ trans('HR.Conditionofcustodyuponreceipt') }} </label>
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<!------------------------------------add saeed -------------------------------------------------->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script>
  function showModal(...params)
  {

    document.getElementById('custID3').value = params[0];
      document.getElementById('custName3').value = params[1];
       $('#CastodyStatus').modal('show')
  }

    function showModal2(...params) {

      document.getElementById('custID2').value = params[0];
      document.getElementById('custName').value = params[1];
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

 </script>
  <script>
  $('.livesearch').select2({
        placeholder: 'أدخل إسم الموظف ',
        ajax: {
            url: '/emp-autocomplete-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nameAr,
                            id: item.id+"-"+item.barcode

                        }
                    })
                };
            },
            cache: true
        }
    });

    function updateStatus(...params){

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
       window.location.href = "/updateCustodStatus/"+params[0] +"/"+params[1];
     }
   })

 }


      </script>


</script>
@endsection
