@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">المستخدمين</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">المستخدمين</a></li>
          <li class="breadcrumb-item active">اضافة المستخدمين</li>
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
                <h3 class="card-title">اضافة مستخدم</h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('users.storeEmp') }}" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="hidden"   id="empID" name="empID"  value="{{$emp->id}}">
                          <label class="form-control-label" for="input-username">الإسم</label>
                          <input type="text"  class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="اكتب اسم المستخدم" value="{{$emp->nameAr}}" required>
                          @error('nameAr')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="phone">رقم الهاتف</label>
                          <input type="text"  class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="اكتب رقم الهاتف" value="{{$emp->phone}}" required>
                          @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="address">العنوان</label>
                          <input type="text"  class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="اكتب العنوان">
                          @error('address')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الفرع</label>
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
                      
                      {{-- @dd($emprole); --}}

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الصلاحيات</label>
                          <select  class="form-control @error('roleID') is-invalid @enderror" id="roleID" name="roleID" onchange="permission(this);"  required>
                            {{-- <option value="">اختر الصلاحيات</option> --}}
                            {{-- @foreach (auth()->user()->organization->roles as $role) --}}
                            {{-- <option value="{{$role->id}}">{{$role->nameAr}}</option> --}}
                            {{-- @endforeach --}}
                            <option value="{{$emprole->id}}" selected>{{$emprole->nameAr}}</option>
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
                          <label class="form-control-label" for="input-first-name">البريد الإلكتروني</label>
                          <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="test@example.com" value="{{$emp->email}}" required>
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name">كلمة المرور</label>
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="********" required>
                          @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">صورة المستخدم</label>
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
                          <input type="submit" class="btn btn-primary" value="حفظ" style="width: 100%">
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