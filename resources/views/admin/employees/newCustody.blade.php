@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"> عهده</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">قائمة العهد</a></li>
          <li class="breadcrumb-item active">اضافة عهد</li>
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
            <form class="user" method="POST" action="{{ route('employees.store') }}" enctype = "multipart/form-data">
              @csrf
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">نفاصيل العهده   </h3>
              </div>
              <div class="card-body">
               
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الوصف </label>
                          <input type="text"  class="form-control @error('itemAr') is-invalid @enderror" id="itemAr" name="itemAr" placeholder="وصف العهده  ">
                          @error('itemAr')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الكمية </label>
                          <input type="number"  class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" placeholder="الكمية">
                          @error('quantity')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">النوع </label>
                          <select  class="form-control" name="type" id="type">
                            <option value="1">سيارة</option>
                          </select>
                          @error('type')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الملف </label>
                          <input type="file"  class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                          @error('file')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">ملاحظة </label>
                          <input type="text"  class="form-control @error('quantity') is-invalid @enderror" id="details" name="details">
                          @error('details')
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
               
              </div>

  
                 <!----------------------------------------------------------------------------------------------------------------------------------------------->

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-last-name"> </label>
                      <br>
                      <input type="submit" class="btn btn-primary" value="حفظ" style="width: 100%">
                    </div>
                  </div>
                </div>
              <!-- /.card-body -->
            </form>
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
</section>
<script>
  function availableT() {
    if(document.getElementById('availableTime').checked == true){
      document.getElementById('sfrom').style.display = "block";
      document.getElementById('sto').style.display = "block";
    }else{
      document.getElementById('sfrom').style.display = "none";
      document.getElementById('sto').style.display = "none";
    }
  }
</script>
@endsection
