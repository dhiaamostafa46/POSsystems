@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">التقارير</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">الدوام</a></li>
          <li class="breadcrumb-item active">قائمة الدوام</li>
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
                <form class="row col-6 no-print" method="POST" action="{{route('setPeriod')}}">
                  @csrf
                  <div class="col-lg-4">
                    <input type="date" name="dateFrom" class="form-control" value="{{session('dateFrom')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <input type="date" name="dateTo" class="form-control" value="{{session('dateTo')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <input type="submit" class="form-control btn btn-primary" value="بحث">
                  </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>رقم الدوام</th>
                    <th>تاريخ البدء</th>
                    <th>تاريخ الإنهاء</th>
                    <th>بواسطة</th>
                    <th>خيارات</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  @if (count($durations) > 0)
                      @foreach ($durations as $index => $duration)
                      <tr>
                        <td>{{$duration->durationNo}}</td>
                        <td>{{$duration->created_at}}</td>
                        <td>{{$duration->endAt}}</td>
                        <td>{{$duration->user->name}}</td>
                        <td>
                          <a href="{{route('durations.show',$duration->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a>
                          <!--<a href="#" class="btn btn-danger" onclick="handleDelete({{ $duration->id }})"><i class="fa fa-trash"></i> حذف</a>-->
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">لا يوجد دوام</td>
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
@endsection
