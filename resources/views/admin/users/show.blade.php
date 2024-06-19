@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('permissions.Users') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('permissions.Usersandpermissions') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('permissions.Users') }} </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="{{asset('dist/img/users/'.$user->img)}}"
                   alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{$user->name}}</h3>

            <p class="text-muted text-center">{{$user->branch->nameAr}}</p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">  {{ trans('permissions.Userdetails') }} </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i>  {{ trans('permissions.Email') }} </strong>
            <p class="text-muted">
              {{$user->email}}
            </p>
            <hr>
            <strong><i class="fas fa-phone mr-1"></i>   {{ trans('permissions.cellphone') }} </strong>
            <p class="text-muted">{{$user->phone}}</p>
            <hr>
            <strong><i class="fas fa-calendar-alt mr-1"></i>   {{ trans('permissions.Dateadded') }} </strong>
            <p class="text-muted">{{$user->created_at}}</p>
            <hr>
            <strong><i class="fas fa-map-marker-alt mr-1"></i>  {{ trans('permissions.thecondition') }}  </strong>
            <p class="text-muted">{{$user->status==1? trans('permissions.active') : trans('permissions.Inactive') }}</p>
            <hr>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">  {{ trans('permissions.Employeeperformance') }}</a></li>
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">  {{ trans('permissions.Updatingdata') }} </a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="active tab-pane" id="timeline">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-copy bg-warning"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header border-0"><span class="badge badge-warning" style="font-size: medium">  {{ trans('permissions.Numberofinvoicesextracted') }}</span> <strong class="badge badge-danger" style="font-size: medium">{{$order->sum('id')}} فاتورة</strong>
                      </h3>
                    </div>
                  </div>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <div>
                    <i class="fa fa-credit-card bg-warning"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header border-0"><span class="badge badge-warning" style="font-size: medium">{{ trans('permissions.Thevalueoftheinvoicesextracted') }}  </span> <strong class="badge badge-danger" style="font-size: medium">{{$order->sum('totalwvat')}}  ريال</strong>
                      </h3>
                    </div>
                  </div>
                  <!-- END timeline item -->

                  <div>
                    <i class="far fa-clock bg-gray"></i>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="{{route('users.update',$user->id)}}" method="POST"  enctype = "multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label"> {{ trans('permissions.Name') }}</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">{{ trans('permissions.Email') }}</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" name="email" placeholder="اكتب الايميل هنا" value="{{$user->email}}" >
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label" for="input-username">{{ trans('permissions.permissions') }}</label>
                      <div class="col-sm-10">
                      <select  class="form-control @error('roleID') is-invalid @enderror" id="roleID" name="roleID" required>
                        <option value="">اختر الصلاحيات</option>
                        @foreach (auth()->user()->organization->roles as $role)
                        <option value="{{$role->id}}" @if($role->id == auth()->user()->roleID) @selected(true) @endif>{{$role->nameAr}}</option>
                        @endforeach
                      </select>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-username">{{ trans('permissions.Accesstobranchesispermitted') }}</label>
                    <div class="col-sm-10">
                    <select  class="form-control @error('branchID') is-invalid @enderror" id="branchID" name="branchID" required>
                      <option value="">اختر الفرع</option>
                      @foreach (auth()->user()->organization->branches as $branch)
                      <option value="{{$branch->id}}" @if($branch->id == $user->branchID) selected @endif>{{$branch->nameAr}}</option>
                      @endforeach
                    </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-username">  {{ trans('permissions.Updatingdata') }}</label>
                    <div class="col-sm-10">
                    <select  class="form-control @error('isManager') is-invalid @enderror" id="isManager" name="isManager" required>
                      <option value="0" @if($user->ismanager == 0) selected @endif>لا</option>
                      <option value="1" @if($user->ismanager == 1) selected @endif>نعم</option>
                    </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label"> {{ trans('permissions.password') }} </label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password"  name="password" placeholder="اكتب كلمة المرور الجديدة او اترك الحقل فارغ">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="img" class="col-sm-2 col-form-label">  {{ trans('permissions.Updatetheimage') }}  </label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="img" id="img">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="signature" class="col-sm-2 col-form-label">  {{ trans('permissions.Signatureupdate') }} </label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="signature" id="signature">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger"> {{ trans('permissions.amendment') }}</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
