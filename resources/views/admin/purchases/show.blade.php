@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('purchases.Purchaserecord') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('purchases.Purchase') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('purchases.Purchaserecord') }} </li>
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
            <h3 class="card-title"> {{ trans('purchases.details') }}</h3>
          </div>
          <div class="card-body">
            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
              <div class="pl-lg-4">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label class="form-control-label" for="input-username">    {{ trans('purchases.invoicenumber') }}   </label>
                        <h6 class="text-primary">{{$purchase->invoicesID}} </h6>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                    </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">     {{ trans('purchases.Datecreated') }}  </label>
                        <h6 class="text-primary">{{$purchase->created_at}}</h6>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">     {{ trans('purchases.Bookinvoicenumber') }}    </label>
                        <h6 class="text-primary">{{$purchase->serial}}</h6>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">     {{ trans('purchases.supplier') }} </label>
                      <h6 class="text-primary">{{$purchase->supplier->name ?? 'لايوجد '}} </h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('purchases.Paymenttype') }} </label>
                      <h6 class="text-primary">{{$purchase->type==121?"نقداً":($purchase->type==122?"شبكة":"آجل")}} </h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('purchases.Invoicetype') }} </label>
                      <h6 class="text-primary">@if ($purchase->kind ==1)  مسودة @else معتمده @endif </h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">   {{ trans('purchases.value') }} </label>
                      <h6 class="text-primary">{{$purchase->totalwvat}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('purchases.Tax') }} </label>
                      <h6 class="text-primary">{{$purchase->totalvat}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">     {{ trans('purchases.Paymentaccount') }}  </label>
                      <h6 class="text-primary">{{$purchase->NameAcount}}</h6>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>


                  <div class="col-lg-12">
                    <table class="table text-center table-bordered table-hover">
                        <thead>
                        <tr>
                          <th>#</th>
                          <th> {{ trans('purchases.ProductName') }}  </th>
                          <th>   {{ trans('purchases.Quantity') }}</th>
                          <th>   {{ trans('purchases.Unit') }}</th>
                          <th>  {{ trans('purchases.priceofapill') }} </th>
                          <th>    {{ trans('purchases.Totalbeforetax') }} </th>
                          <th>    {{ trans('purchases.Tax') }} </th>
                          <th>   {{ trans('purchases.Totalincludingtax') }}  </th>
                          <?php $rt=0; ?>
                        </tr>
                        </thead>
                        <tbody>

                              @if (count( $purchase->purchasedetails) > 0)
                                  @foreach ( $purchase->purchasedetails as $index => $details)
                                  <tr>
                                      <td>{{$index+1}}</td>
                                      <td>{{$details->product->nameAr ?? ''}}</td>
                                      <td>{{$details->quantity}}</td>
                                      <td>{{$details->ProdUnit->unitname ?? ''}}</td>
                                      <td>{{$details->price}}</td>
                                      <td>{{number_format(($details->price/1.15) * $details->quantity,2) }}</td>
                                      <td>{{number_format(($details->price*0.15/1.15) * $details->quantity,2)}}</td>
                                      <td>{{number_format($details->price * $details->quantity,2)}}</td>
                                  </tr>
                                  @endforeach
                              @endif

                        
                        </tbody>
                      </table>
                  </div>
                  <div class="col-lg-6">

                  </div>
                  <div class="col-lg-6">
                      <table class="table table-bordered text-center">
                          <tbody>
                              <tr class="cs-border_left">
                                  <td class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">
                                      {{ trans('Sale.total') }} </td>
                                  <td
                                      class="cs-width_2 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                      {{ $purchase->totalwvat - $purchase->totalvat }}
                                      {{ trans('Sale.Rial') }} </td>
                              </tr>
                              <tr class="cs-border_left">
                                  <td class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">
                                      {{ trans('Sale.Valueaddedtax') }}</td>
                                  <td
                                      class="cs-width_2 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                      {{ number_format($purchase->totalvat, 2) }}
                                      {{ trans('Sale.Rial') }} </td>
                              </tr>
                              @if ($purchase->discount != 0 || $purchase->discount != null)
                                  <tr class="cs-border_left">
                                      <td
                                          class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">
                                          {{ trans('Sale.Discount') }}
                                          {{ number_format($purchase->discount, 2) }} </td>
                                      <td
                                          class="cs-width_2 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                          {{ number_format($purchase->totalwvat * ($purchase->discount / 100), 2) }}
                                          {{ trans('Sale.Rial') }}
                                      </td>
                                  </tr>
                              @endif

                              <tr class="cs-border_left">
                                  <td
                                      class="cs-width_2 cs-border_top_0 cs-bold cs-f16 cs-primary_color">
                                      {{ trans('Sale.Totalincludingtax') }} </td>
                                  <td
                                      class="cs-width_2 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">
                                      {{ number_format($purchase->totalwvat - $purchase->totalwvat * ($purchase->discount / 100), 2) }}
                                      {{ trans('Sale.Rial') }} </td>
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
                  <a href="{{route('purchases.show',$purchase->id)}}" class="btn btn-default"><i class="fas fa-print"></i> {{ trans('purchases.Print') }}</a>
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
