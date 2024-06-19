@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">مرتجع المشتريات </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">المشتريات</a></li>
          <li class="breadcrumb-item active"> مرتجع مشتريات</li>
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
                <a href="{{route('Purchasereturns.create')}}" class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>المورد</th>
                    <th>القيمة</th>
                    <th>الضريبة</th>
                    <th>النوع</th>
                    <th>بواسطة</th>
                    <th>تاريخ الانشاء</th>
                    <th>خيارات</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($purchases) > 0)
                      @foreach ($purchases as $index => $purchase)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{!empty($purchase->supplierID)?$purchase->supplier->name:"لا يوجد"}}</td>
                        <td>{{$purchase->totalwvat}}</td>
                        <td>{{$purchase->totalvat}}</td>
                        <td>{{$purchase->type==121?"نقداً":($purchase->type==122?"شبكة":"آجل")}}</td>
                        <td>{{$purchase->user->name}}</td>
                        <td>{{$purchase->created_at}}</td>
                        <td>
                          <a href="{{route('Purchasereturns.show',$purchase->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> </a>
                          <a href="{{route('purchases.edit',$purchase->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{ $purchase->id }})"><i class="fa fa-trash"></i> </a>

                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="8" class="text-center">لا يوجد فواتير</td>
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
          window.location.href = "/purchases-delete/"+id;
        }
      })
  }
  </script>
