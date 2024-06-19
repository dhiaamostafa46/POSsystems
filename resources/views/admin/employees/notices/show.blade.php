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
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"> {{ trans('HR.details') }}</h3>
          </div>
          <div class="card-body">
            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('HR.noticesnumber') }}</label>
                      <h6 class="text-primary">{{$notic->id}}</h6>

                    </div>
                  </div>


                  </div>



                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('HR.Addemployees') }} </label>
                      <h6 class="text-primary">{{$notic->employees->nameAr ?? ''}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('HR.Dateadded') }}</label>
                      <h6 class="text-primary">{{$notic->created_at}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">{{ trans('HR.noticesdate') }}  </label>
                      <h6 class="text-primary">{{$notic->noticDate}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('HR.noticesdetails') }} </label>
                      <h6 class="text-primary">{{$notic->details}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('HR.noticesstatus') }}  </label>


                      @if($notic->Status == 1)
                      <h6 class="text-primary">{{ trans('HR.New') }} </h6>

                          @elseif($notic->Status ==2)
                          <h6 class="text-primary">  {{ trans('HR.Underreview') }}  </h6>

                           @elseif($notic->Status == 3)
                           <h6 class="text-primary"> {{ trans('HR.Reviewed') }} </h6>


                           @endif
                    </div>
                  </div>




                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{ trans('HR.Attachments') }}</h3>
            </div>
            <div class="card-body">
              <div class="row">
                {{-- @dd(url()->previous()) --}}
                @foreach($files as $file)
                  <div class="col-4">
                    @if($file->type == "img")
                     <img src="{{asset('Notics/'.$file->fileURL)}}" height="350px" width="500px" style="margin-left:10px;">
                    @else
                    <a href="{{asset('Notics/'.$file->fileURL)}}" target="_blank"><img src="{{asset('Notics/default.png')}}" height="100px" width="100px" style="margin-left:10px;" style="margin-left:10px;"></a>
                    @endif
                  </div>
                @endforeach
             </div>
            </div>
            <!-- /.card-body -->
          </div>



      </div>

      {{-- @if(url()->previous() =="") --}}


      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
