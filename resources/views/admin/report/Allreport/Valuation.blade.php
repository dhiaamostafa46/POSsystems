@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">   {{ trans('Report.Rateproducts') }}   </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">   {{ trans('Report.Listofreports') }}</a></li>
            <li class="breadcrumb-item active">   {{ trans('Report.Rateproducts') }} </li>
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
          <div class="card-header bg-white row">
            {{-- <form class="row col-6 no-print" method="POST" action="{{route('setPeriod')}}">
              @csrf
              <div class="col-lg-4">
                <input type="date" name="dateFrom" class="form-control" value="{{session('dateFrom')}}">
              </div>
              <div class="col-lg-4" style="float: none">
                <input type="date" name="dateTo" class="form-control" value="{{session('dateTo')}}">
              </div>
              <div class="col-lg-4" style="float: none">
                <input type="submit" class="form-control btn btn-primary" value="بحث">
              </div>
            </form> --}}
            <div class="col-6">
              {{-- <a href="{{route('stocks.print',$product->id)}}" class="btn btn-danger" style="float:left"><i class="fa fa-print"></i> طباعة</a> --}}
            </div>
          </div>
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover text-center">
              <thead>
                <tr>
                    <th>#</th>
                    {{-- <th>الباركود</th> --}}
                    <th>{{ trans('Report.ProductName') }}</th>
                    <th> {{ trans('Report.lonliness') }}</th>
                    <th> {{ trans('Report.Assess') }} </th>
                    <th>  {{ trans('Report.Weightedaverage') }} </th>
                    <th> {{ trans('Report.firstperiod') }} </th>
                    <th> {{ trans('Report.buyer') }}</th>
                    <th>   {{ trans('Report.Transferredto') }}</th>
                    <th>   {{ trans('Report.Transferredfrom') }}</th>
                    <th>  {{ trans('Report.Soldout') }}</th>
                    <th> {{ trans('Report.Damaged') }} </th>
                    {{-- <th>المعالق</th> --}}
                    <th>  {{ trans('Report.lastperiod') }}  </th>
                    <th>  {{ trans('Report.Assess') }} </th>

                </tr>
              </thead>
              <tbody>
                <?php $sum=0; ?>
                   <!--get product transaction on stock-->
              @if (count($unit) > 0)
                  @foreach ($unit as $index => $product)
                  <tr>
                    <td>{{$index+1}}</td>
                    {{-- <td>{{$product->product->barcode ?? ''}}</td> --}}
                    <td>{{$product->product->nameAr ?? ''}}</td>
                    <td>{{$product->product->category->nameAr ?? ''}}</td>
                    <td>{{$product->unitname}}</td>
                    <td>{{$product->costprodect}}</td>
                    <td>{{$product->start}}</td>
                    <td>{{$product->count}}</td>
                    <td>{{$product->comeIn}}</td>
                    <td>{{$product->ComeOut}}</td>
                    <td>{{$product->saller}}</td>
                    <td>{{$product->Tainted}}</td>
                    {{-- <td>{{$product->hang}}</td> --}}
                    <td>{{($product->start +$product->count +$product->comeIn )- ($product->saller+$product->Tainted+$product->ComeOut + $product->hang) }}</td>
                    <?php $sum= $sum+((($product->start +$product->count +$product->comeIn )- ($product->saller+$product->Tainted+$product->ComeOut + $product->hang))* $product->costprodect); ?>
                    <td>{{ (($product->start +$product->count +$product->comeIn )- ($product->saller+$product->Tainted+$product->ComeOut + $product->hang))* $product->costprodect}}</td>
                  </tr>
                  @endforeach

              @else
                  <tr>
                    <td colspan="6" class="text-center"> {{ trans('Report.NotFounddata') }} </td>
                  </tr>
              @endif
              </tbody>
             <tfoot>
                <tr style="background: ">
                    <th>#</th>
                    {{-- <th>الباركود</th> --}}
                    <th></th>
                    <th> </th>
                    <th></th>
                    <th> </th>
                    <th> </th>
                    <th> </th>
                    <th>  </th>
                    <th>  </th>
                    <th></th>

                    <th colspan="2">   {{ trans('Report.Total') }} </th>

                    <th colspan="2">  <?php echo $sum;?> </th>

                </tr>
             </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
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
