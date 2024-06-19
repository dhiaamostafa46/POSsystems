@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">السندات</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">قائمة السندات</a></li>
          <li class="breadcrumb-item active">اضافة سند صرف</li>
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
            <div class="card card-primary">
              <div class="card-header bg-danger">
                <h3 class="card-title">اضافة سند صرف جديد</h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('invoices.store') }}" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">العميل</label>

                          {{-- <input type="text" class="form-control @error('supplierName') is-invalid @enderror" id="supplierName" name="supplierName" value="{{$purchase->supplier->name  ?? ''}}" readonly> --}}

                          <select class="form-control @error('supplierID') is-invalid @enderror" id="supplierID" name="supplierId">
                            <option value="">اختر المورد</option>
                            @foreach (auth()->user()->organization->suppliers as $supplier)
                                <option value="{{$supplier->id}}" >{{$supplier->name}}</option>
                            @endforeach
                          </select>
                          <input type="hidden" name="purchaseID" value="{{$purchase->id ?? ''}}">

                          @error('supplierName')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الاجمالي</label>
                          <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" onchange="getRest();" placeholder="اكتب اجمالي المبلغ">
                          @error('total')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">المتبقي</label>
                          <input type="number" class="form-control @error('rest') is-invalid @enderror" id="rest" name="rest" value="" readonly>
                          <input type="hidden" name="restOld" id="restOld" value="">
                          @error('rest')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>


                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">تعليق</label>
                          <input type="text" class="form-control text-right @error('comment') is-invalid @enderror" id="comment" name="comment" placeholder="اضافة تعليق">
                          @error('comment')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <input type="hidden" name="type" value="3">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">طريقة الدفع</label>
                          <select class="form-control @error('paymentType') is-invalid @enderror" id="paymentType" name="paymentType">
                            <option value="1">نقداً</option>
                            <option value="2">تحويل/شبكة</option>
                          </select>
                          @error('type')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name">اضافة مرفق</label>
                          <input type="file" class="form-control" name="img" id="img">
                          @error('img')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <input type="submit" class="btn btn-danger" value="حفظ" style="width: 100%">
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <hr class="my-4" />
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
</section>

@endsection
<script>
  function getRest(){
    document.getElementById('rest').value = document.getElementById('restOld').value - document.getElementById('total').value;
  }
</script>
