
@extends('layouts.dashboard')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">الموظفين</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">الموظفين</a></li>
          <li class="breadcrumb-item active">قائمة الموظفين</li>
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
                <h3 class="card-title">كل الموظفين</h3>
                <a href="{{route('employees.create')}}" class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>الرقم</th>
                    <!--<th> Code ID</th>-->
                    <th>الاسم</th>
                    <th>الجوال</th>
                    <th>الجنسية </th>
                    <th> إنتهاء الهوية</th>
                    <th>تاريخ التعيين</th>
                    <th>خيارات</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($employees) > 0)
                      @foreach ($employees as $index => $employee)
                      <tr>
                      
                        <td>{{$employee->id}}</td>
                        
                        <!--<td>{{$employee->AccountID}}</td>-->
                        <td>{{$employee->nameAr}}</td>
                        <td>{{$employee->phone}}</td>
                        <td>{{$employee->nationality}}</td>
                        <td style="text-align:center" @if($employee->created_at_difference($employee->idEndDate) <  30) class="alert alert-secondary" @endif>
                          {{$employee->idEndDate}}</td>
                        <!--<td></td>-->
                        <td style="text-align:center">{{$employee->hireDate}}</td>
                        <td>
                          <a href="{{route('employees.show',$employee->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a>
                          <a href="{{route('employees.custodiesByID',$employee->id)}}" class="btn btn-info"><i class="fa fa-bookmark"></i> العهد</a>
                          <a href="{{route('employees.documentsByID',$employee->id)}}" class="btn btn-danger"><i class="fa fa-file"></i> المستندات</a>
                          @if(auth()->user()->employee != null)
                           
                          <a href="{{route('Users.createEmpUser',$employee->id)}}" class="btn btn-danger"><i class="fa fa-file"></i> إسم مستخدم </a>
                            @endif
                          
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center">لا يوجد موظفين</td>
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
        window.location.href = "/delete-customer/"+id;
      }
    })
  }

</script>
