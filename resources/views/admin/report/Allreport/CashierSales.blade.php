@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Report.Registercashierbills') }}  </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Report.Reports') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Report.Registercashierbills') }} </li>
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
              <div class="row mt-2 col-12">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>  {{count($orders) }} </h3>
                      <p>   {{ trans('Report.Numberofrequests') }}  </p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>

                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>{{count($orders->where('kind',2))}}</h3>
                      <p>  {{ trans('Report.Thepaymentwasmade') }} </p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>

                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>{{count($orders->where('kind',1))}}</h3>
                      <p>  {{ trans('Report.unpaid') }}</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>

                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>{{count($orders->where('kind',3))}}</h3>
                      <p>  {{ trans('Report.Ordercanceled') }} </p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>

                  </div>
                </div>
                <!-- ./col -->
              </div>
            </div>
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="salesfatorahReport" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>  {{ trans('Sale.invoicesNumber') }}</th>
                      <th> {{ trans('Sale.customername') }}</th>
                      <th> {{ trans('Sale.value') }}</th>
                      <th> {{ trans('Sale.Tax') }}</th>
                      <th>{{ trans('Sale.Type') }}</th>
                      <th>{{ trans('Sale.user') }}</th>
                      <th> {{ trans('Sale.Datecreated') }}</th>
                      <th>{{ trans('Sale.Options') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if (count($orders) > 0)
                        @foreach ($orders as $index => $order)
                        <tr>
                          <td>{{$index+1}}</td>
                          <td>{{$order->serial}}</td>
                          <td>{{$order->Customer->name ?? ""}}</td>
                          <td>{{$order->totalwvat}}</td>
                          <td>{{$order->totalvat}}</td>
                          <td>{{$order->type==121?trans('Sale.Cash'):($order->type==122?trans('Sale.Net'):trans('Sale.Paylater'))}}</td>
                          <td>{{$order->user->name}}</td>
                          <td>{{$order->created_at}}</td>
                          <td>
                            <a href="{{route('ReportAll.ShowInvoices',$order->serial)}}" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('Sale.Show') }}</a>
                          </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center"> {{ trans('Sale.NoFound') }}</td>
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
     function handleDelete(id){


    Swal.fire({
      title: ' تاكيد إلغاء الطلب ',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: 'نعم',
      cancelButtonText: 'لا، الغاء'
    }).then((result) => {
      if (result.isConfirmed) {

        window.location.href = `/Nadal.delete/${id}`;

      }
    })
  }
</script>




