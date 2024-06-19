
@extends('layouts.dashboard')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">الإجازات</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">الإجازات</a></li>
          <li class="breadcrumb-item active">طلبات الإجازات </li>
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
                <h3 class="card-title">كل الطلبات</h3>
                <br>
                <form class="row col-6" method="POST" action="{{route('holydays.ByDate',1)}}">
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
             
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>الرقم</th>
                    <!--<th> Code ID</th>-->
                    <th>الاسم</th>
                    <th>الفرع</th>
                    <th>القسم </th>
                    <th>الأيام المطلوبة </th>
                    <th>من</th>
                    <th>إلى</th>
                    <th>نوع الإجازة</th>
                    <th>الحالة</th>
                    <th>التاريخ</th>
                    <th>خيارات</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if (count($holidays ) > 0)
                    @foreach ($holidays as $index => $holiday)
                    <tr>
                    
                      <td>{{$index+1}}</td>
                      <td>{{$holiday->employees->nameAr}}</td>
                      <td>{{$holiday->employees->brnanch->nameAr}}</td>
                      <td>{{$holiday->employees->depart->nameAr}}</td>
                      <td>{{$holiday->days}}</td>
                      <td>{{$holiday->from}}</td>
                      <td>{{$holiday->to}}</td>
                      <td>
                        @if($holiday->typeID == 1)
                            أساسية
                        @else 
                            إضطرارية
                        @endif
                      </td>
                      <td>
                        @if($holiday->Status == 1)
                        في إنتظار الموافقة
                        @elseif($holiday->Status == 2) 
                        تمت الموافقة
                        @else
                         مرفوض
                        @endif
                      </td>
                      <td>{{$holiday->created_at->format('d-m-Y')}}</td>
                      
                      <td>
                        @if($holiday->Status == 1)
                        <a href="#" class="btn btn-primary" onclick="updateStatus({{$holiday->id}},2)"><i class="fa fa-check"></i> موافقة</a>
                        <a href="#" class="btn btn-danger" onclick="updateStatus({{$holiday->id}},3)"><i class="fa fa-trash"></i> رفض</a>
                       
                        @endif
                      </td>
                      
                     
               
                    </tr>
                    @endforeach
                    @else
                        <tr>
                          <td colspan="7" class="text-center">لا توجد طلبات إجازة  </td>
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
 
  

  function updateStatus(...params){
   
    if( params[1] == 3)
    {
      
    Swal.fire({
      
      title: 'هل انت متأكد من رفض الإجازة؟',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: 'نعم، حذف',
      cancelButtonText: 'لا، الغاء'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/updateHoliStatus/"+params[0] +"/"+params[1];
      }
    })
  }else
  {
    
    Swal.fire({
      
      title: 'الموافقة على طلب الإجازة',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: 'نعم',
      cancelButtonText: 'إلغاء '
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/updateHoliStatus/"+params[0] +"/"+params[1];
      }
    })
  }
  }

</script>
