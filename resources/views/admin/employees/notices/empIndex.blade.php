
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
                <h3 class="card-title"> {{ trans('HR.noticesAll') }}</h3>
                <a type="button" onclick="showModal()"  class="btn btn-primary floatmleft" ><i class="fa fa-plus"></i> {{ trans('HR.Add') }}</a>
                <br>
                <hr>
                <div class="row">
                <form class="row col-6" method="POST" action="{{route('notics.ByDate')}}">
                  @csrf
                  <div class="col-lg-4">
                    <label for=""> {{ trans('HR.dateFrom') }}</label>
                    <input type="date" name="dateFrom" class="form-control" value="{{session('dateFrom')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for=""> {{ trans('HR.dateTo') }}</label>
                    <input type="date" name="dateTo" class="form-control" value="{{session('dateTo')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for="">&nbsp;</label>
                    <input type="submit" class="form-control btn btn-primary" value="{{ trans('HR.Search') }}">
                  </div>
                </form>

              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <!--<th> Code ID</th>-->
                      <th> {{ trans('HR.noticestype') }}</th>
                      <th>{{ trans('HR.noticesdate') }}</th>
                      <th>{{ trans('HR.noticesstatus') }}</th>

                      <th>{{ trans('HR.Options') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($notics) > 0)
                    @foreach ($notics as $index => $notic)
                    <tr>
                      <td>{{$index+1}}</td>
                      <td>{{$notic->type->nameAr}}</td>
                      <td>{{$notic->noticDate->format('d/m/Y')}}</td>
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
                          <a href="{{route('notices.show',$notic->id)}}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i>  {{ trans('HR.show') }}</a>
                           @if($notic->Status == 1)
                          <a type="button" class="btn btn-info" onclick="showEditModal('EditModal',{{ $notic->id }})"><i class="fa fa-edit"></i>  {{ trans('HR.Edit') }}</a>
                          <a type="button" class="btn btn-danger" onclick=""><i class="fa fa-trash"></i> {{ trans('HR.Delete') }}</a>
                          @endif
                        </td>


                    </tr>

                                                 <!-- Edit Modal -->
<div class="modal fade modal" id="EditModal{{ $notic->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('HR.noticesEdit') }} </h5>
       <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <form class="user" method="POST" action="{{route('notices.update',$notic->id)}}" enctype = "multipart/form-data">
        @csrf
        @method('put')
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username"> {{ trans('HR.noticestype') }}   :</label>
                <select class="form-control @error('typeID') is-invalid @enderror" id="typeID" name="typeID" required>
                  @if(count(auth()->user()->organization->NoticsType) > 0 )
                  @foreach(auth()->user()->organization->NoticsType as $index => $type)
                  <option value="{{$type->id}}">{{$type->nameAr}}</option>
                  @endforeach
                  @endif

                </select>
              </div>

            </div>
            <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label" for="input-username">  {{ trans('HR.DateofEvent') }}    :</label>
              <input type="date" name="noticDate" class="form-control" value="{{$notic->noticDate}}">
              @error('noticDate')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          </div>
          <div class="col-lg-11">
            <div class="form-group">
              <label class="form-control-label" for="input-username">  {{ trans('HR.noticesdetails') }}  :</label>
              <textarea  class="form-control @error('details') is-invalid @enderror" id="details" name="details" rows="4">{{$notic->details}}
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
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right">{{ trans('HR.retreat') }} </button>
            </div>
          </div>



        </div>
        </div>
        <hr class="my-4" />
      </form>
    </div>
  </div>
</div>
                    @endforeach
                    @else
                        <tr>
                          <td colspan="7" class="text-center">  {{ trans('HR.NotFoundData') }} </td>
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
        <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('HR.Fileanewreport ') }}</h5>
       <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <form class="user" method="POST" action="{{route('notices.store')}}" enctype = "multipart/form-data">
        @csrf
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">  {{ trans('HR.noticesstatus') }}   :</label>
                <select class="form-control @error('typeID') is-invalid @enderror" id="typeID" name="typeID" required>
                  @if(count(auth()->user()->organization->NoticsType) > 0 )
                  @foreach(auth()->user()->organization->NoticsType as $index => $type)
                  <option value="{{$type->id}}">{{$type->nameAr}}</option>
                  @endforeach
                  @endif

                </select>
                @error('typeID')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">  {{ trans('HR.noticesdate') }}   :</label>
                <input type="date" name="noticDate" class="form-control">
                @error('noticDate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">  {{ trans('HR.Attachments') }}   :</label>
                <input type="file" class="form-control" name="images[]" multiple="multiple">
              </div>
            </div>
            <div class="col-lg-6"></div>

            <div class="col-lg-11">
              <div class="form-group">
                <label class="form-control-label" for="input-username">  {{ trans('HR.noticesdetails') }}  :</label>
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
              <button type="submit" class="btn btn-primary" style="float:right"> {{ trans('HR.Save') }}</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right"> {{ trans('HR.retreat') }}</button>
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
   function showEditModal(...params)
   {
        // alert(modelName);
        var modelName = '#'+params[0]+params[1];
     //alert(modelName);
       $(modelName).modal('show');

   }
</script>
