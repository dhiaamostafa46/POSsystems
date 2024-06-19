@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">سندات الصرف</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">سندات الصرف</a></li>
          <li class="breadcrumb-item active">قائمة سندات الصرف</li>
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
                    <label for="">من تاريخ</label>
                    <input type="date" name="dateFrom" class="form-control" value="{{session('dateFrom')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for="">الى تاريخ</label>
                    <input type="date" name="dateTo" class="form-control" value="{{session('dateTo')}}">
                  </div>
                  <div class="col-lg-4" style="float: none">
                    <label for="">&nbsp;</label>
                    <input type="submit" class="form-control btn btn-primary" value="بحث">
                  </div>
                </form>
                <a href="{{route('invoices.createDeliver')}}"  class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a>
            </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>المبلغ</th>
                    <th>المورد</th>
                    <th>رقم الهاتف</th>
                    <th>تم بواسطة</th>
                    <th>التاريخ</th>
                    <th>خيارات</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($invoices) > 0)
                      @foreach ($invoices as $index => $invoice)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$invoice->total}}</td>
                        <td>{{$invoice->supplier->name ?? ''}}</td>
                        <td>{{$invoice->supplier->phone ?? ''}}</td>
                        <td>{{$invoice->user->name ?? ''}}</td>
                        <td>{{$invoice->created_at}}</td>
                        <td>
                          <a href="{{route('invoices.show',$invoice->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a>
                          <!--<a href="#" class="btn btn-danger" onclick="handleDelete({{ $invoice->id }})"><i class="fa fa-trash"></i> حذف</a>-->
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="8" class="text-center">لا يوجد سندات صرف</td>
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
