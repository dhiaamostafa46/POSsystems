
@extends('layouts.dashboard')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">لوحة الموظف</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">الإجازات</a></li>
          <li class="breadcrumb-item active">طلبات الإجازة  </li>
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
                <h3 class="card-title">طلبات الإجازة </h3>
                <a type="button" onclick="showModal()"  class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> طلب جديد</a>
                <br>
                <hr>
                <div class="row">
                <form class="row col-6" method="POST" action="{{route('holydays.ByDate',2)}}">
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
                <div class="col-3"></div>
                <div class="col-3">
                <br>
                  <label for="">الرصيد :</label>
                  <label for="">{{auth()->user()->employee->holiday}} يوم</label>
                </div>

              </div>
            
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
        
                    <th>الأيام المطلوبة</th>
                   
                    <th>من</th>
                    <th>إلى </th>
                    <th>نوع الإجازة</th>
                    <th>حالة الطلب </th>
                    <th>تاريخ الطلب</th>
                    <th>خيارات</th>
                  </tr>
                  </thead>
                  <tbody>
                        
                 
                  @if (count($holidays ) > 0)
                      @foreach ($holidays as $index => $holiday)
                      <tr>
                      
                        <td>{{$index+1}}</td>
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
                        @if($holiday->Status == 1)
                        <td>
                          <a class="btn btn-warning" type="button" onclick="showEditModal('EditModal',{{ $holiday->id }})"><i class="fa fa-edit"></i> تعديل</a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{$holiday->id}})"><i class="fa fa-trash"></i> حذف</a>

                        </td>
                        
                        @endif
                 
                      </tr>
                                                                      <!-- Edit Modal -->
<div class="modal fade modal" id="EditModal{{ $holiday->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">تعديل طلب</h5>
       <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <form class="user" method="POST" action="{{route('holydays.update',$holiday->id)}}" enctype = "multipart/form-data">
        @csrf
        @method('put')
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">نوع الإجازة   :</label>
                <select class="form-control @error('typeID') is-invalid @enderror" id="typeID" name="typeID" required>
                 <option value="1" @if($holiday->typeID == 1) selected @endif>أساسية</option>
                 <option value="2" @if($holiday->typeID == 2) selected @endif>إضطرارية</option>
                </select>
              </div>
              
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">عدد الأيام :</label>
                <input type="number"  class="form-control @error('days') is-invalid @enderror" id="days" name="days" value="{{$holiday->days}}" title="x">
                
                @error('days')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username"> من :</label>
                <input type="date" name="from" class="form-control" value="{{$holiday->from}}">
                @error('from')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label" for="input-username"> إلى :</label>
              <input type="date" name="to" class="form-control" value="{{$holiday->to}}">
              @error('to')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            
          </div>
          <div class="col-lg-11">
            <div class="form-group">
              <label class="form-control-label" for="input-username">تفاصيل  :</label>
              <textarea  class="form-control @error('details') is-invalid @enderror" id="details" name="details" rows="4">{{$holiday->details}}
              </textarea>
              @error('details')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            
          </div>
            
          </div>
            
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="float:right">حفظ</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right">تراجع</button>
            </div>
          </div>
          
          
         
        </div>
        </div>
        <hr class="my-4" />
      </form>
    </div>
  </div>
</div>
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

     <!-- Create Modal -->
<div class="modal fade modal" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel"> تقديم طلب إجازة </h5>
       <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <form class="user" method="POST" action="{{route('holydays.store')}}" enctype = "multipart/form-data">
        @csrf
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">نوع الإجازة : </label>
                <select name="typeID" class="form-control">
                   <option value="1">أساسية</option>
                   <option value="2">إضطرارية</option>
                </select>
                @error('typeID')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-username">عدد الأيام :</label>
                <input type="number"  class="form-control @error('days') is-invalid @enderror" id="days" name="days"  title="x">
                
                @error('days')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              
            </div>
            
            <div class="col-lg-5">
              <div class="form-group">
                <label class="form-control-label" for="input-username">من    :</label>
                <input type="date" name="from" class="form-control">
                
                @error('from')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label class="form-control-label" for="input-username">إلى    :</label>
                <input type="date" name="to" class="form-control">
                
                @error('to')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              
            </div>
            <div class="col-lg-6"></div>
            <div class="col-lg-11">
              <div class="form-group">
                <label class="form-control-label" for="input-username">تفاصيل(إختياري)</label>
                <textarea  class="form-control @error('details') is-invalid @enderror" id="details" name="details" rows="4">
                </textarea>
                @error('details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              
            </div>
           
          </div>
            
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style="float:right">تقديم الطلب</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right">تراجع</button>
            </div>
          </div>
          
          
         
        </div>
        </div>
        <hr class="my-4" />
      </form>
</div>
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
        window.location.href = "/deleteHoliday/"+id;
      }
    })
  }

//   $(document).ready(function(){
   
//        alert('test');
//    if(navigator.geolocation){
//        navigator.geolocation.getCurrentPosition(showLocation);
//    }else{ 
//        $('#location').html('Geolocation is not supported by this browser.');
//    }


// });
function showModal() {
        //console.log('star.', id)
      // var form = document.getElementById('deleteCategoryForm')
      // form.action = '/user/delete/' + id
      // form.action = '/Bills/' + id
       $('#CreateModal').modal('show')
    }
    function showEditModal(...params)
   {
        // alert(modelName);
        var modelName = '#'+params[0]+params[1];
     //alert(modelName);
       $(modelName).modal('show');
   
   }
</script>
