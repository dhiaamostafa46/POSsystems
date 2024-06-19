@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Account.Defaultuseraccounts') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Account.accounts') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Account.Defaultuseraccounts') }} </li>
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
                <h3 class="card-title">  {{ trans('Account.Defaultuseraccounts') }} </h3>
                <a href="{{route('users.create')}}" class="btn btn-primary btnAddsys"><i class="fa fa-plus"></i> {{ trans('Account.Add') }} </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Account.name') }} </th>
                    <th> {{ trans('Account.Email') }} </th>
                    <th> {{ trans('Account.cellphone') }} </th>
                    <th> {{ trans('Account.Powers') }} </th>
                    <th> {{ trans('Account.Branch') }} </th>
                    <th> {{ trans('Account.Options') }} </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($users) > 0)
                      @foreach ($users as $index => $user)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->role->nameAr}}</td>
                        <td>{{$user->branch->nameAr}}</td>
                        <td>
                          <a href="{{route('VirtualAccounts.show',$user->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>   {{ trans('Account.Virtualaccounts') }}</a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center"> {{ trans('Account.NoFound') }}</td>
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

   
    <div  style="display: none">
        <h1 id="titalmesssage">  {{ trans('Account.Areyousuretodelete') }} </h1>
        <h1 id="confirmButtonText">  {{ trans('Account.confirmButtonText') }} </h1>
        <h1 id="cancelButtonText">  {{ trans('Account.cancelButtonText') }} </h1>
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
      cancelButtonText: dno
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/delete-user/"+id;
      }
    })
  }

</script>
