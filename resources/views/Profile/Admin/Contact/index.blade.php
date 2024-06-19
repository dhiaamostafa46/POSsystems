@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Packages.ContactInformation') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Packages.Visualidentity') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Packages.ContactInformation') }} </li>
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
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">  {{ trans('Packages.ContactInformation') }} </h3>
            <div class="btnAddsys">
              @if ( $prof ==null)
                 <a href="{{route('ProfileInfCompany.ContactEdit',-1)}}" class="btn btn-secondary"><i class="fa fa-edit"></i>  {{ trans('Packages.Adddata') }} </a>
              @else
                 <a href="{{route('ProfileInfCompany.ContactEdit',$prof->id)}}" class="btn btn-secondary"><i class="fa fa-edit"></i> {{ trans('Packages.Modifydata') }}  </a>
              @endif

            </div>
          </div>
          <div class="card-body">
            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
              <div class="pl-lg-4">
                <div class="row"> 
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="input-username">  {{ trans('Packages.address') }} </label>
                        <h6 class="text-primary">
                           {{$prof->Address ?? ''}}
                        </h6>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="input-username"> {{ trans('Packages.Email') }}   </label>
                        <h6 class="text-primary">
                            {{$prof->email ?? ''}}
                         </h6>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="input-username"> {{ trans('Packages.phone') }}  </label>
                        <h6 class="text-primary">
                            {{$prof->Phone ?? ''}}
                        </h6>
                        </div>
                    </div>

                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- /.card -->
      </div>
      <!-- /.col -->

    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>


















<!-- link Modal -->
<div class="modal fade modal" id="linkModel" tabindex="-1" role="dialog" aria-labelledby="linkModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">رابط المطبخ</h5>
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
                    <input type="text"  class="form-control @error('link') is-invalid @enderror" id="link" name="link" placeholder="الرابط" >
                    @error('link')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="button" onclick="copyFunction()" data-dismiss="modal" class="btn btn-primary" value="نسخ" style="width: 100%">
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
        window.location.href = "/delete-user/"+id;
      }
    })
  }

  function getLink(id) {
    document.getElementById('link').value = window.location.protocol + '//' + window.location.host+'/restaurant/'+{{auth()->user()->orgID}};
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
