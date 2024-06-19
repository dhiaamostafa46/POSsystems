@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('permissions.permissions') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('permissions.Usersandpermissions') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('permissions.permissions') }} </li>
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
              <h3 class="card-title">  {{ trans('permissions.Permissionsdetails') }}</h3>
            </div>
            <div class="card-body">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">  {{ trans('permissions.ThenameofthepowersisArabic') }} </label>
                        <h6>{{$role->nameAr}}</h6>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">  {{ trans('permissions.ThenameofthepowersisEnglish') }} </label>
                        <h6>{{$role->nameEn}}</h6>
                      </div>
                    </div>
                  </div>
                </div>
                <form class="pl-lg-4" action="{{route('permissions.store',$role->id)}}" method="POST">
                @csrf
                <hr/>
                <h5> {{ trans('permissions.Permissionsdetails') }}</h5>
                <hr/>
                @foreach ($pagecategories as $cat)
                  <div class="card">
                    <div class="card-header bg-secondary">✬ &nbsp; 
                        @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl")
                          <strong>{{$cat->nameAr}}</strong></div>
                        @else
                           <strong>{{$cat->nameEn}}</strong></div>
                        @endif
                    <div class="card-body row">
                      @foreach ($cat->pages as $page)
                        <div class="col-md-3">
                          <input type="checkbox" id="pages[]" name="pages[]" value="{{$page->id}}" @if(count($role->permissions) > 0) @if($role->permissions->contains('pageID', $page->id)) checked @endif @endif>
                          &nbsp;
                          @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl")
                          {{$page->nameAr}}
                            @else
                            {{$page->nameEn}}
                           @endif
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endforeach
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('permissions.save') }}</button>
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
