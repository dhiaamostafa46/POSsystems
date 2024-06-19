@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"> الدومات</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">الدومات </a></li>
          <li class="breadcrumb-item active">قائمة الدومات</li>
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
                <h6 style="display: inline-block">قائمة الدومات</h6>
                <a href="{{route('attendance.createShift')}}" class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>الدوام</th>
                    <th>نوع الدوام</th>
                    <th>عدد الساعات</th>
                    <th>من الساعه </th>
                    <th>الى الساعه</th>
                    <th>خيارات</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  @if (count($shifts) > 0)
                      @foreach ($shifts as $index => $shift)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$shift->nameAr}}</td>
                      
                        <td>
                          @if($shift->type ==1)
                              ثابت
                          @elseif($shift->type ==2)
                                مرن
                          
                          @endif
                        </td>
                        <td>{{$shift->hours}}</td>
                        {{-- @if($shift->type ==1) --}}
                        <td>{{$shift->stTime}}</td>
                        <td>{{$shift->enTime}}</td>

                        {{-- @endif --}}
                        <td>
                          
                          <a href="{{route('prodcategories.edit',$shift->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> تعديل</a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{ $shift->id }})"><i class="fa fa-trash"></i> حذف</a>
                        </td>
                       
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">لا يوجد دوامات</td>
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
        window.location.href = "/delete-productcategory/"+id;
      }
    })
  }
  
</script>