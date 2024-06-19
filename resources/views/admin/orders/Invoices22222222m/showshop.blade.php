@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('Sale.salesbill') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('Sale.sales') }} </a></li>
                        <li class="breadcrumb-item active"> {{ trans('Sale.salesbill') }} </li>
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
                            <h3 class="card-title"> {{ trans('Sale.details') }} </h3>
                        </div>
                        <div class="card-body">
                            <form class="user" method="POST" action="#" enctype = "multipart/form-data">
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Sale.invoicesNumber') }} </label>
                                                <h6 class="text-primary">{{ $order->serial }} </h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Sale.Datecreated') }} </label>
                                                <h6 class="text-primary">{{ $order->created_at }}</h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Sale.seller') }} </label>
                                                <h6 class="text-primary"> {{ $order->user->name ?? '' }} </h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Sale.customername') }} </label>
                                                <h6 class="text-primary">
                                                    @if ($order->FlageCustumer == -1)
                                                        {{ $order->VirtualCustomer->name ?? '' }}
                                                    @else
                                                        {{ $order->Customer->name ?? '' }}
                                                    @endif
                                                </h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Sale.Customertaxnumber') }} </label>
                                                <h6 class="text-primary">
                                                    @if ($order->FlageCustumer == -1)
                                                        {{ $order->VirtualCustomer->vatNo ?? '' }}
                                                    @else
                                                        {{ $order->Customer->vatNo ?? '' }}
                                                    @endif
                                                </h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Sale.Paymenttype') }} </label>
                                                <h6 class="text-primary">
                                                    {{ $order->type == 121 ? trans('Sale.Cash') : ($order->type == 122 ? trans('Sale.Net') : trans('Sale.Paylater')) }}
                                                </h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Sale.Invoicetype') }} </label>
                                                <h6 class="text-primary">
                                                    @if ($order->kind == 1)
                                                        {{ trans('Sale.Draft') }}
                                                    @else
                                                        {{ trans('Sale.certified') }}
                                                    @endif
                                                </h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Sale.Value') }} </label>
                                                <h6 class="text-primary">
                                                    {{ number_format($order->totalwvat - $order->totalwvat * ($order->ispaied / 100) ,2)}}
                                                </h6>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('Sale.Paymentaccount') }} </label>
                                                <h6 class="text-primary">{{ $order->NameAcount }}</h6>
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
                                                        <th> {{ trans('Sale.ProductName') }} </th>
                                                        <th> {{ trans('Sale.Quantity') }} </th>
                                                        <th> {{ trans('Sale.priceofapill') }} </th>
                                                        {{-- <th> {{ trans('Sale.Discount') }} </th>
                                                        <th> {{ trans('Sale.Pricediscount') }} </th> --}}
                                                        <th> {{ trans('Sale.comment') }} </th>
                                                        <th> {{ trans('Sale.Totalbeforetax') }} </th>
                                                        <th> {{ trans('Sale.Valueaddedtax') }} </th>
                                                        <th> {{ trans('Sale.TotalAftertax') }} </th>
                                                        <?php $total = 0;
                                                        $vat = 0;
                                                        $alltotal = 0; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @if (count($order->orderdetails) > 0)
                                                        @foreach ($order->orderdetails as $index => $details)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $details->product->nameAr ?? '' }}</td>
                                                                <td>{{ $details->quantity }}</td>
                                                                <td>{{ $details->price }}</td>
                                                                {{-- <td>{{ $details->discount }}</td>
                                                                <td>{{ $details->price * $details->quantity - $details->total }}
                                                                </td> --}}
                                                                <td>{{ $details->desc }}</td>
                                                                @if ($details->vat == 0)
                                                                    <td style="font-size: large">{{ $details->total }}</td>
                                                                    <td style="font-size: large">{{ $details->vat }}</td>
                                                                    <td style="font-size: large">{{ $details->total }}</td>
                                                                    <?php $total += $details->total;
                                                                    $vat += $details->vat;
                                                                    $alltotal += $details->total; ?>
                                                                @else
                                                                    <td style="font-size: large">
                                                                        {{ number_format($details->total,2)}}</td>
                                                                    <td style="font-size: large">
                                                                        {{ number_format( ($details->total*0.15 ), 2) }}
                                                                    </td>
                                                                    <td style="font-size: large">
                                                                        {{ number_format ($details->total + (($details->total  *0.15)),2) }}
                                                                    </td>

                                                                @endif
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
                                                            {{ $order->totalwvat - $order->totalvat }}
                                                            {{ trans('Sale.Rial') }} </td>
                                                    </tr>
                                                    <tr class="cs-border_left">
                                                        <td class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">
                                                            {{ trans('Sale.Valueaddedtax') }}</td>
                                                        <td
                                                            class="cs-width_2 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                            {{ number_format(( $order->totalvat), 2) }}
                                                            {{ trans('Sale.Rial') }} </td>
                                                    </tr>
  <tr class="cs-border_left">
                                                        <td class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">
                                                            {{ trans('Sale.Discount') }}  {{ number_format(( $order->ispaied), 2) }}</td>
                                                        <td
                                                            class="cs-width_2 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                            {{ number_format(($order->totalwvat *($order->ispaied/100)), 2) }} 
                                                          </td>
                                        </tr>


                                                    <tr class="cs-border_left">
                                                        <td
                                                            class="cs-width_2 cs-border_top_0 cs-bold cs-f16 cs-primary_color">
                                                            {{ trans('Sale.Totalincludingtax') }} </td>
                                                        <td
                                                            class="cs-width_2 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">
                                                            {{ number_format($order->totalwvat - ($order->totalwvat *($order->ispaied/100)), 2) }}
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

                                    @if (!empty(auth()->user()->organization->vatNo) )
                                      <a href="{{ route('OrderInvoices.showInv', $order->id) }}" class="btn btn-default"><i
                                        class="fas fa-print"></i> {{ trans('Sale.Print') }}</a>
                                    @endif

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
