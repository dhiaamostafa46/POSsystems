@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">الصفحات</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">الصفحات</a></li>
          <li class="breadcrumb-item active">قائمة الصفحات</li>
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
                <h3 class="card-title">كل الصفحات</h3>
                <a href="{{route('pages.create')}}" class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>الاسم عربي</th>
                    <th>الاسم انجليزي</th>
                    <th>الكود</th>
                    <th>التصنيف</th>
                    <th>تاريخ الانشاء</th>
                    <th>خيارات</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  @if (count($pages) > 0)
                      @foreach ($pages as $index => $page)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$page->nameAr}}</td>
                        <td>{{$page->nameEn}}</td>
                        <td>{{$page->code}}</td>
                        <td>{{$page->category->nameAr}}</td>
                        <td>{{$page->created_at}}</td>
                        <td>
                          <a href="{{route('pages.show',$page->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a>
                          <a href="{{route('pages.edit',$page->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> تعديل</a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{ $page->id }})"><i class="fa fa-trash"></i> حذف</a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">لا يوجد صفحات</td>
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
        window.location.href = "/delete-page/"+id;
      }
    })
  }
  
</script>