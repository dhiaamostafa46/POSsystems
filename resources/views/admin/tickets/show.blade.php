@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">  {{ trans('ticket.technicalsupport') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">  {{ trans('ticket.thetickets') }} </a></li>
            <li class="breadcrumb-item active">  {{ trans('ticket.technicalsupport') }} </li>
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
            <h3 class="card-title"> {{ trans('ticket.technicalsupport') }}</h3>
          </div>
          <div class="card-body">
            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('ticket.technicalsupport') }}</label>
                      <h6 class="text-primary">{{$ticket->id}}</h6>

                    </div>
                  </div>


                  </div>


                   <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('ticket.title') }}</label>
                      <h6 class="text-primary">{{$ticket->title}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('ticket.by') }}</label>
                      <h6 class="text-primary">{{$ticket->user->name}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('ticket.Datecreated') }}</label>
                      <h6 class="text-primary">{{$ticket->created_at}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('ticket.details') }} </label>
                     <h6 class="text-primary"><?php echo $ticket->details;?></h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('ticket.Thesituation') }} </label>


                      @if($ticket->tickStatus == 1)
                      <h6 class="text-primary">    {{ trans('ticket.Waitingforapproval') }}  </h6>

                          @elseif($ticket->tickStatus ==2)
                          <h6 class="text-primary">  {{ trans('ticket.Undertreatment') }} </h6>

                           @elseif($ticket->tickStatus == 3)
                           <h6 class="text-primary"> {{ trans('ticket.Processed') }} </h6>

                           @elseif($ticket->tickStatus == 4)
                           <h6 class="text-primary">    {{ trans('ticket.Closed') }}</h6>

                           @endif
                    </div>
                  </div>




                </div>
              </div>
            </form>
          </div>
           <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">الردود</h3>
              </div>
              <div class="card-body">

                  <div class="pl-lg-4">

                    <div class="row">
                      <div class="col-lg-12">
                           <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>بواسطة</th>
                    <th>التفاصيل</th>
                     <th>المرفقات</th>
                    <th>التاريخ</th>

                  </tr>
                  </thead>
                  <tbody>

                  @if (count($comments) > 0)
                      @foreach ($comments as $index => $com)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>

                          @if($com->owner == 1)

                           الدعم الفني

                           @else
                               {{$ticket->user->name ?? ''}}
                           @endif
                        </td>

                        <td> {{$com->comment}}</td>



                        <td><a type="button" href="{{$com->image}}" class="btn btn-primary" target="_blank">عرض</a></td>
                         <td> {{$com->created_at}}</td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center">لا يوجد ردود</td>
                      </tr>
                  @endif
                  </tfoot>
                </table>
                      </div>


                    </div>


                  </div>
                  </div>
                  <hr class="my-4" />

              </div>
          <!-- /.card-body -->
        </div>
          <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">المرفقات </h3>
            </div>
            <div class="card-body">
              <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                @csrf

                <div class="pl-lg-4">
                  <div class="row">

                    <div class="col-lg-6">
                      <div class="form-group">

                        <br>
                        <img src="{{$ticket->image}}" height="400px" widht="500px">
                        @error('nameEn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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

           @if($ticket->tickStatus != 4)
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">تحديث الحالة  </h3>
            </div>
            <div class="card-body">
              <form class="user" method="POST" action="{{route('tickets.storeComment')}}" enctype = "multipart/form-data">
                @csrf

                <div class="pl-lg-4">
                  <div class="row">

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">إضافة رد</label>
                        <br>
                        <input type="hidden" name="tickID" value="{{$ticket->id}}">
                         <textarea id="summernote" rows="3"  name="details" id="teamComment" cols="30" rows="10" >
                        </textarea>
                        @error('nameEn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-lg-3">
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
          @endif
        <!-- /.card -->
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
