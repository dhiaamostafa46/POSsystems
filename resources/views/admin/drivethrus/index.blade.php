@extends('layouts.dashboard')
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Products.Branchwindows') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Products.Branchwindows') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Products.Allwindows') }} </li>
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
                <h3 class="card-title">  {{ trans('Products.Allwindows') }}  </h3>
                <div class="btnAddsys">
                  <a href="#" onclick="handleTbls();" class="btn btn-primary"><i class="fa fa-plus"></i>  {{ trans('Products.Addawindow') }}  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Products.windowName') }}  </th>
                    <th> {{ trans('Products.branch') }} </th>
                    <th>  {{ trans('Products.Datecreated') }} </th>
                    <th> {{ trans('Products.Options') }}  </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($drivethrus) > 0)
                      @foreach ($drivethrus as $index => $drivethru)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$drivethru->qrNo}}</td>
                        @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl")
                          <td>{{$drivethru->branch->nameAr}}</td>
                        @else
                          <td>{{$drivethru->branch->nameEn}}</td>
                        @endif
                        <td>{{$drivethru->created_at}}</td>
                        <td>
                          <a href="{{route('drivethrus.show',$drivethru->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('Products.Show') }}</a>
                          <a href="#" onclick="handleTblsEdit({{ $drivethru->id }})" class="btn btn-info"><i class="fa fa-edit"></i> {{ trans('Products.Edite') }}</a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{ $drivethru->id }})"><i class="fa fa-trash"></i> {{ trans('Products.Delete') }}</a>
                          <a href="#" class="btn btn-primary" onclick="handleLink({{ $drivethru->id }})"><i class="fa fa-link"></i> {{ trans('Products.link') }}</a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center"> {{ trans('Products.NoFound') }}  </td>
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
    @foreach ($drivethrus as $index => $drivethru)
    <!-- Extras Modal -->
    <div class="modal fade modal" id="drivethrusModel{{$drivethru->id}}" tabindex="-1" role="dialog" aria-labelledby="drivethrusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('Products.Ediawindow') }}  </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="col-12 row mt-3">
              <div class="col-12">
                <form class="user" id="drivethrusForm" method="POST"  action="{{ route('drivethrus.update',$drivethru->id) }}" enctype = "multipart/form-data"  >
                  @method('PUT')
                  @csrf
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">  {{ trans('Products.windowName') }}  </label>
                    <div class="col-sm-9">
                      <input type="texr" class="form-control" id="windowName" name="windowName"  value="{{$drivethru->qrNo}}"  placeholder="{{ trans('Products.windowName') }} ">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">  {{ trans('Products.branch') }} </label>
                    <div class="col-sm-9">
                      <select  class="form-control @error('branchID') is-invalid @enderror" id="branchID" name="branchID" required>

                          @foreach(auth()->user()->organization->branches as $branch)
                          <option value="{{$branch->id}}" @if ($branch->id ==$drivethru->branchID) @selected(true) @endif>@if (LaravelLocalization::getCurrentLocaleDirection() =="rtl")
                               {{$branch->nameAr}} @else{{$branch->nameEn}}  @endif</option>
                          @endforeach
                       </select>
                    </div>
                  </div>
                  <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-10 col-form-label"></label>
                      <div class="col-sm-2">
                          <button type="submit" class="btn btn-primary">  {{ trans('Products.save') }} </button>
                      </div>
                  </div>
              </form>
              </div>
            </div>


          </div>
        </div>
        </div>
    <!-- Extras Modal -->
    @endforeach
    <!-- Tbl Modal -->
    <div class="modal fade modal" id="drivethrusModel" tabindex="-1" role="dialog" aria-labelledby="drivethrusModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">  {{ trans('Products.Addawindow') }} </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="user" id="drivethrusForm" method="POST" action="{{ route('drivethrus.store') }}" >
                @csrf
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">  {{ trans('Products.windowName') }}  </label>
                  <div class="col-sm-9">
                    <input type="texr" class="form-control" id="windowName" name="windowName" placeholder="{{ trans('Products.windowName') }} ">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label">  {{ trans('Products.branch') }} </label>
                  <div class="col-sm-9">
                    <select  class="form-control @error('branchID') is-invalid @enderror" id="branchID" name="branchID" required>

                        @foreach(auth()->user()->organization->branches as $branch)
                        <option value="{{$branch->id}}">@if (LaravelLocalization::getCurrentLocaleDirection() =="rtl") {{$branch->nameAr}} @else{{$branch->nameEn}}  @endif</option>
                        @endforeach
                     </select>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-10 col-form-label"></label>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">  {{ trans('Products.save') }} </button>
                    </div>
                </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    <!-- Tbl Modal -->

    <!-- link Modal -->
    <div class="modal fade modal" id="linkModel" tabindex="-1" role="dialog" aria-labelledby="linkModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('Products.Linkawindow') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="col-12 row mt-3">
            <div class="col-12">
              <form class="user" id="linkForm" method="POST" action="#" enctype = "multipart/form-data">
                @csrf
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="form-group">
                        <input type="text"  class="form-control @error('link') is-invalid @enderror" id="link" name="link"  >
                        @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-lg-4">
                      <div class="form-group">
                        <input type="button" onclick="copyFunction()" data-dismiss="modal" class="btn btn-primary" value="{{ trans('Products.Copy') }}" style="width: 100%">
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                <hr class="my-4" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- link Modal -->

    <div  style="display: none">
        <h1 id="titalmesssage">  {{ trans('Products.Areyousuretodelete') }} </h1>
        <h1 id="confirmButtonText">  {{ trans('Products.confirmButtonText') }} </h1>
        <h1 id="cancelButtonText">  {{ trans('Products.cancelButtonText') }} </h1>
    </div>

@endsection
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
  function handleDelete(id){
    ddd= document.getElementById('titalmesssage').innerHTML ;
 dyes= document.getElementById('confirmButtonText').innerHTML ;
 dno = document.getElementById('cancelButtonText').innerHTML ;

     Swal.fire({
      title: ddd,
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: dyes,
      cancelButtonText:  dno
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "/delete-drivethru/"+id;
        }
      })
  }

  function handleTbls() {
      $('#drivethrusModel').modal('show')
    }

  function handleTblsGroup() {
    $('#drivethrusGroupModel').modal('show')
  }

  function handleTblsEdit(id) {
      $('#drivethrusModel'+id).modal('show')
    }

 function handleLink(id) {
    document.getElementById('link').value = window.location.protocol + '//' + window.location.host+'/driver/'+{{auth()->user()->branchID}}+'/'+id;
    $('#linkModel').modal('show')
  }

  function copyFunction() {
    // Get the text field
    var copyText = document.getElementById("link");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);

    // Alert the copied text
    alert("تم نسخ: " + copyText.value);
  }
</script>
