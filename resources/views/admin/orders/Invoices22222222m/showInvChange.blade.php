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
            <h3 class="card-title">{{ trans('Sale.details') }}</h3>
            <a class="btn btn-info floatmleft" onclick="GetAllTreeTable()"  data-toggle="modal" data-target="#AddRow"  ><i class="fa fa-plus"></i>  {{ trans('Sale.AddColumn') }} </a>
          </div>
          <form class="user" method="POST" action="{{route('OrderInvoices.saveChange')}}" enctype = "multipart/form-data">
            @csrf
            <input type="hidden" name="idorder" value="{{$order->id}}">
            <div class="card-body">
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                            <label class="form-control-label" for="input-username">     {{ trans('Sale.invoicesNumber') }}   </label>
                            <h6 class="text-primary">{{$order->serial }} </h6>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="input-username">      {{ trans('Sale.Datecreated') }}  </label>
                            <h6 class="text-primary">{{$order->created_at}}</h6>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="input-username">        {{ trans('Sale.seller') }}   </label>
                            <h6 class="text-primary">    {{$order->user->name ?? ''}}  </h6>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label class="form-control-label" for="input-username">       {{ trans('Sale.customername') }}  </label>
                        <h6 class="text-primary">  @if ($order->FlageCustumer==-1) {{$order->VirtualCustomer->name ?? ''}} @else  {{$order->Customer->name ?? ''}}  @endif  </h6>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label class="form-control-label" for="input-username">       {{ trans('Sale.Customertaxnumber') }}     </label>
                        <h6 class="text-primary">  @if ($order->FlageCustumer==-1) {{$order->VirtualCustomer->vatNo ?? ''}} @else  {{$order->Customer->vatNo ?? ''}}  @endif </h6>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label class="form-control-label" for="input-username">  {{ trans('Sale.Paymenttype') }}  </label>
                        <h6 class="text-primary">{{$order->type==121?trans('Sale.Cash'):($order->type==122?trans('Sale.Net'):trans('Sale.Paylater') )}} </h6>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label class="form-control-label" for="input-username"> {{ trans('Sale.Invoicetype') }}  </label>
                        <h6 class="text-primary">@if ($order->kind ==1)   {{ trans('Sale.Draft') }} @else  {{ trans('Sale.certified') }} @endif </h6>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                        <label class="form-control-label" for="input-username">   {{ trans('Sale.Value') }}  </label>
                        <h6 class="text-primary">    {{ number_format($order->totalwvat - $order->totalwvat * ($order->ispaied / 100) ,2)}} </h6>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                        <label class="form-control-label" for="input-username">     {{ trans('Sale.Paymentaccount') }}  </label>
                        <h6 class="text-primary">{{$order->NameAcount}}</h6>
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
                                <input type="hidden" value="{{count($order->OrderRow) }}" id="Rowcount" name="Rowcount">
                                <input type="hidden" value="{{count($order->orderdetails) }}" id="count" name="count">
                            <tr id="trnameTableAllRow">

                              @foreach ($order->OrderRow as $index => $item)
                                  @if ( $item->after==1)
                                    <th id="{{$index+1}}" data-info="{{$item->nameAr}}">
                                        @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl")  {{$item->nameAr}} @else {{$item->nameEn}} @endif
                                        <input type="hidden" name="head[][]" id="" value="{{$item->nameAr}}">
                                        <input type="hidden" name="headEn[][]" id="" value="{{$item->nameEn}}">
                                        <input type="hidden" name="valcode[][]" id="" value="{{$item->sort}}">
                                        <input type="hidden" name="rmove[][]" id="" value="{{$item->after}}">
                                    </th>
                                  @else
                                      <th id="{{$index+1}}" data-info="{{$item->nameAr}}">
                                        @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl")  {{$item->nameAr}} @else {{$item->nameEn}} @endif
                                        <button onclick="RemoveColom({{$index+1}})" class="text-danger" type="button"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                                         <input type="hidden" name="head[][]" id="" value="{{$item->nameAr}}">
                                         <input type="hidden" name="headEn[][]" id="" value="{{$item->nameEn}}">
                                         <input type="hidden" name="valcode[][]" id="" value="{{$item->sort}}">
                                         <input type="hidden" name="rmove[][]" id="" value="{{$item->after}}">
                                      </th>
                                  @endif

                              @endforeach

                            <?php $total=0; $vat=0; $alltotal=0;  ?>
                            </tr>
                            </thead>
                            <tbody>


                                {{-- @foreach ($order->OrderRowDetalis as $index => $item)
                                   <td id="1-{{$index+1}}">{{$item->name}} <input type="hidden" name="index[][]" id="" value="{{$item->name}}"> </td>
                                @endforeach --}}
                                <?php $count=0;   $countRow=1;?>
                                @if (count($order->OrderRowDetalis)>0)
                                    @foreach ($order->OrderRowDetalis as $item)
                                        @if ($count ==0)
                                        <tr>
                                        @endif
                                            <td id="{{$count+1}}-{{$countRow}}">{{$item->name}}<input type="hidden" name="{{$order->OrderRow[(int)$count]->sort}}[][]" id="" value="{{$item->name}}"> </td>
                                            <?php $count++; ?>
                                        @if ($count ==count($order->OrderRow))
                                        </tr>
                                        <?php $count=0; $countRow++;?>
                                        @endif
                                    @endforeach
                                @endif


                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row no-print">
                    <div class="col-12">
                      @if (!empty(auth()->user()->organization->vatNo) )
                        <a href="{{route('OrderInvoices.ShowChang',$order->id)}}" class="btn btn-default"><i class="fas fa-print"></i>  {{ trans('Sale.Print') }}</a>
                      @endif

                     <input type="submit" class="btn btn-primary" value=" {{ trans('Sale.saveChange') }} ">
                     <a href="{{route('OrderInvoices.Recovery',$order->id)}}" class="btn btn-danger"><i class="fa fa-cog"></i>  {{ trans('Sale.ٌRemovChange') }}</a>
                    </div>

                </div>
            </div>
          </form>
        </div>
        <!-- /.card -->
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->


  <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="AddRow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">   {{ trans('Sale.Addanewcolumn') }}</h5>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label"> {{ trans('Sale.ColumnnameinArabic') }}</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="nameRow" placeholder="  {{ trans('Sale.ColumnnameinArabic') }}">
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label"> {{ trans('Sale.ColumnnameinEnglish') }}</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nameRowEng" placeholder="  {{ trans('Sale.ColumnnameinEnglish') }}">
                    </div>
                  </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label"> {{ trans('Sale.Afterthecolumn') }}</label>
                  <div class="col-sm-9">
                    <select id="After" class="form-control"> </select>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">  {{ trans('Sale.Columntype') }} </label>
                    <div class="col-sm-9">
                      <select id="type"  class="form-control"> <option value="text">{{ trans('Sale.Text') }}</option>  <option value="number">{{ trans('Sale.Number') }}</option> <option value="date">{{ trans('Sale.Date') }}</option></select>
                    </div>
                  </div>



              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Sale.Close') }}</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="SaveAllChange()">{{ trans('Sale.save') }}</button>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="dir" value="{{LaravelLocalization::getCurrentLocaleDirection()}}">
</section>
<!-- /.content -->
@endsection

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

 function   GetAllTreeTable(){

    $('#After').empty();
        jQuery('#trnameTableAllRow th').each( function( cmp ) {
        $('#After').append('<option value="'+this.id+'">'+ jQuery(this).children('input').val()+'</option>')
    } );

    $('#nameRow').val("");
    $('#After').val("");

 }


 function SaveAllChange()
{
    var nameRow=  $('#nameRow').val();
    var nameRowEng=  $('#nameRowEng').val()
    var after=$('#After').val();
    var count=$('#count').val();

    var Rowcount=$('#Rowcount').val();
    var type=$('#type').val();
    Rowcount=parseInt(Rowcount)+1;
    $('#'+after).after('<th id="'+Rowcount+'">  <input type="text" class="form-control text-center" name="head[][]" id="" value="'+nameRow+'">   <input type="hidden" name="headEn[][]" id="" value="'+nameRowEng+'"> <input type="hidden" name="valcode[][]" id="" value="Row'+Rowcount+'"> <input type="hidden" name="rmove[][]" id="" value="0"></th>');

    for(i=1;i<=count;i++){
        $('#'+after+"-"+i).after('<th id="'+Rowcount+'-'+i+'">   <input type="'+type+'" class="form-control" id="www" name="Row'+Rowcount+'[][]"></th>');
    }
    $('#Rowcount').val(Rowcount);
    // console.log( );

}



function RemoveColom(id)
{

    console.log(  );
    var count=$('#count').val();
    var Rowcount=$('#Rowcount').val();

    for(i=1;i<=count;i++){
        $('#'+id+"-"+i).remove();
    }
    $('#'+id).remove();
    $('#Rowcount').val(parseInt(Rowcount)-1);
}
</script>
