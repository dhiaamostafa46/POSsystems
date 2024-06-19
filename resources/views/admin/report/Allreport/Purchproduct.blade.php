@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">   صنف مشتريات   </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">   صنف مشتريات  </a></li>
          <li class="breadcrumb-item active">   صنف مشتريات    </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">التفاصيل  </h3>
          </div>
          <div class="card-body">

              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-12">
                    <table class="table text-center table-bordered table-hover">
                        <thead>
                        <tr>

                          <th> رقم الصنف </th>
                          <th>اسم المنتج </th>
                          <th>  الكمية</th>
                          <th>  الوحدة</th>
                          <th>  المتوسط المرجح</th>
                          <th>  الاجمالي </th>

                          <?php $rt=0; ?>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$items->barcode}}</td>
                                <td>{{$items->nameAr}}</td>
                                <td>{{  $items->unitprodect[0]->count ?? '' }}</td>
                                <td>{{  $items->unitprodect[0]->unitname ?? '' }}</td>
                                <td>{{  $items->unitprodect[0]->costprodect ?? '' }}</td>
                                <td>{{  ($items->unitprodect[0]->costprodect * $items->unitprodect[0]->count )?? '' }}</td>

                            </tr>
                        </tbody>
                      </table>
                  </div>

                </div>
              </div>

            </form>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <div class="row no-print">
                <div class="col-12">
                  {{-- <a href="{{route('purchases.show',$purchase->id)}}" class="btn btn-default"><i class="fas fa-print"></i> طباعة</a> --}}
                </div>
              </div>
          </div>
        </div>
        <!-- /.card -->
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
