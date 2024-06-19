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
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> {{ trans('permissions.AddUsers') }} </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('users.store') }}" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('permissions.Name') }} </label>
                          <input type="text"  class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="  {{ trans('permissions.Name') }}">
                          @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="phone">{{ trans('permissions.cellphone') }} </label>
                          <input type="text"  class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="  {{ trans('permissions.cellphone') }}">
                          @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="address">{{ trans('permissions.theaddress') }}</label>
                          <input type="text"  class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder=" {{ trans('permissions.theaddress') }}">
                          @error('address')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('permissions.Branch') }} </label>
                          <select  class="form-control @error('branchID') is-invalid @enderror" id="branchID" name="branchID" required>
                            <option value="">اختر الفرع</option>
                            @foreach(auth()->user()->organization->branches as $branch)
                            <option value="{{$branch->id}}">{{$branch->nameAr}}</option>
                            @endforeach
                          </select>
                          @error('branchID')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('permissions.Accesstobranchesispermitted') }}</label>
                          <select  class="form-control @error('isManager') is-invalid @enderror" id="isManager" name="isManager" required>
                            <option value="0">لا</option>
                            <option value="1">نعم</option>
                          </select>
                          @error('isManager')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('permissions.permissions') }}</label>
                          <select  class="form-control @error('roleID') is-invalid @enderror" id="roleID" name="roleID" onchange="permission(this);" required>
                            <option value="">اختر الصلاحيات</option>
                            @foreach (auth()->user()->organization->roles as $role)
                            <option value="{{$role->id}}">{{$role->nameAr}}</option>
                            @endforeach
                            <option value="-1">اضافة صلاحية جديدة</option>
                          </select>
                          @error('roleID')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">{{ trans('permissions.Email') }} </label>
                          <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="test@example.com">
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name">{{ trans('permissions.password') }} </label>
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="********">
                          @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">{{ trans('permissions.Userphoto') }} </label>
                          <input type="file" class="form-control" name="img" id="img">
                          @error('img')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <input type="submit" class="btn btn-primary" value="{{ trans('permissions.save') }}" style="width: 100%">
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <hr class="my-4" />
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
@endsection
<script>
   function permission(obj){
    if(obj.value == -1)
    {
      window.location.href = "/roles/create"
    };
  }
</script>