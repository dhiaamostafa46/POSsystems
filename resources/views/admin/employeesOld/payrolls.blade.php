@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">الرواتب</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">الرواتب</a></li>
          <li class="breadcrumb-item active">كشوفات الرواتب </li>
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
                <h3 class="card-title">كشوفات الرواتب </h3>
                
                <a href ="{{route('employees.newPayroll',1)}}"  class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> إصدار كشف الرواتب</a>
               <!--route('employees.newPayroll',1)-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <div  class="row">
                <div  class="col-3">
                  <div class="form-group">
                   <input  type="month" class="form-control" id="month" name="month" onchange="enable()" value="{{$month}}">
                  
                  </div>
                </div>
                <div  class="col-4">
                  <div class="form-group">
                   
                   <input type="hidden" class="mt-1 autocomplete form-control" id="monthid" name="monthid">
                   <button  id="monthbtn" class="btn btn-primary" style="width: 25%;display:inline-block" @disabled(true) onclick="getbymonth()"  id="find">إستعراض</button>
                   <button  id="monthbtn" class="btn btn-primary" style="width: 25%;display:inline-block"  target="_blank" onclick="print()"  id="print">طباعه</button>  
                  </div>
                </div>
              </div>
              @if(session('PayrollError') != null)<h3 class="alert alert-warning"> {{session('PayrollError')}}</h3>@endif

              {{session()->put('PayrollError',null)}}
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <!--<th> Code ID</th>-->
                    <th>الاسم</th>
                    <th>الراتب الأساسي</th>          
                    <th >الراتب الإجمالي </th>
                    <th >بدل السكن</th>
                    <th >بدل النقل</th>
                    <th >التأمين الإجتماعي</th>
                    <th >الجزاءات </th>
                    <th >صافي الراتب </th>
                  
                 
                  </tr>
                  <tr>
                   <td>1</td><td>سعيد الطيب محمد</td> <td>4000</td><td>6000</td><td>1000</td><td>1000</td><td>150</td><td>300</td><td>5650</td>
                  </tr>
{{--                     
                    @foreach ($allowns as $index => $item)
                    <th > {{$item->nameAr}} </th>
                    @endforeach
                    
                  
                    <th >صافي الراتب</th>
                  </tr>
                  
                  </thead>
                  <tbody>
                  
                    @if (count($payrolls) > 0)
                    @foreach ($payrolls as $index => $salary)
                    <tr>
                      <td>{{$index+1}}</td>
                      
                      <td>{{$salary->employee->nameAr}}</td>
                      <td>{{$salary->salary->basicSalary}}</td>
                      <td>{{$salary->salary->fullSalary}}</td>
                     
                     <?php //$all = json_decode($salary->allowns); ?>
                     @foreach ($all as $index => $item)
                      
                        <td>{{$item}}</td>
                      @endforeach
                      <?php //$alld = json_decode($salary->deducts); ?>
                      @foreach ($alld as $index => $item)
                       
                         <td>{{$item}}</td>
                       @endforeach

                      <td>{{$salary->netSalary}}</td>
                      
                    </tr>
                    @endforeach
                   
                  @else
                      <tr>
                        <td colspan="7" class="text-center">لا كشوفات لهذا الشهر </td>
                      </tr>
                  @endif --}}
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

    <div class="modal fade modal" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel"> وظيفة جديدة  </h5>
           <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>-->
          </div>
          <form class="user" method="POST" action="{{route('employees.storeJob')}}" enctype = "multipart/form-data">
            @csrf
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-username">الوظيفة(عربي)</label>
                    <input type="text"  class="form-control @error('nameAr') is-invalid @enderror" id="nameAr" name="nameAr">
                    @error('nameAr')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-username">الوظيفة(إنجليزي)</label>
                    <input type="text"  class="form-control @error('nameEn') is-invalid @enderror" id="nameEn" name="nameEn">
                    @error('nameEn')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  
                </div>
                
              </div>
                
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" style="float:right">إضافة</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right">تراجع</button>
                </div>
              </div>
              
              
             
            </div>
            </div>
            <hr class="my-4" />
          </form>
          
            
          
    
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
  function showModal() {
        //console.log('star.', id)
      // var form = document.getElementById('deleteCategoryForm')
      // form.action = '/user/delete/' + id
      // form.action = '/Bills/' + id
       $('#CreateModal').modal('show')
    }
    
    function enable()
  {
    
    document.getElementById("monthbtn").disabled=false;;


  }
  
  function print()
  {
    
    
    window.location.href = '/showPage';

  }
  function getbymonth()
  {
    
    var t =document.getElementById("month").value;
    var r =new Date(t).getMonth();
    window.location.href = 'payrollsbymonth/'+t;

   // alert(t);

  }
</script>
