@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Store.Manufacturingorder') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Store.Inventory') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Store.Manufacturingorder') }} </li>
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
            <h3 class="card-title">   {{ trans('Store.editmanufacturingorder') }}</h3>
          </div>
          <div class="card-body">
            <form class="user" method="POST" action="{{route('Manufactur.update' ,$vom->id)}}" enctype = "multipart/form-data">
                @csrf

            <input type="hidden" name="Count" id="Count" value="{{count( $vom->Manufacturdetials)}}">
             <input type="hidden"  name="totalcost" id="totalcost" value="{{$vom->totalcost}}">
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">    {{ trans('Store.ProductName') }} </label>
                      <input type="text"  class="form-control" name="prodectname" value="{{$vom->nameprodect}}" readonly id="prodectname">

                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">  {{ trans('Store.Quantity') }}  </label>
                      <input type="number"  class="form-control" name="Quantity" value="{{$vom->Quantity}}" onchange="calculation()" id="Quantity">
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">    {{ trans('Store.description') }}  </label>
                      <textarea   class="form-control" name="desc" id=""  rows="3">{{$vom->desc }}</textarea>

                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('Store.Datecreated') }} </label>
                      <input type="date"  class="form-control" name="date" value="{{$vom->date }}" >
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username"> {{ trans('Store.Unit') }}</label>
                      <select   class="form-control" name="Unit"  id="Unit">
                        <option value="{{ $vom->product->compUnit->id ??'' }}"> {{  $vom->product->compUnit->nameAr ??'' }}</option>
                     </select>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">


                      <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username">   {{ trans('Store.Entrytype') }}</label>
                                <select   class="form-control" name="kind"  id="kind">
                                    <option value="1"> {{ trans('Store.Draft') }}</option>
                                    <option value="2"> {{ trans('Store.certified') }}</option>
                                 </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-username"> &nbsp&nbsp&nbsp</label>
                                <input type="submit" class="btn btn-primary" value=" {{ trans('Store.save') }}"  style="width: 100%">
                            </div>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="col-lg-12">
                    <table class="table text-center table-bordered table-hover">
                        <thead>
                        <tr>
                          <th>#</th>
                          <th>  {{ trans('Store.ProductName') }} </th>
                          <th>   {{ trans('Store.Unit') }}</th>
                          <th>  {{ trans('Store.Quantity') }}</th>
                          <th> {{ trans('Store.Weightedaverage') }}  </th>
                          <th>  {{ trans('Store.Total') }} </th>
                          <?php $rt=0; ?>
                        </tr>
                        </thead>
                        <tbody>

                              @if (count( $vom->Manufacturdetials) > 0)
                              <?php $cc=0;?>
                                  @foreach ( $vom->Manufacturdetials as $index => $details)
                                  <tr>
                                      <td>{{$index+1}}</td>
                                      <td>{{$details->product->nameAr ??''}}</td>
                                       <?php $cc +=$details->Quantity; ?>
                                      <input type="hidden" name="prod{{$index+1}}" value="{{$details->ProdectId}}">
                                      <td> <select  class="form-control" type="text" name="nuit{{$index+1}}" id="nuit{{$index+1}}">  <option value="{{$details->product->compUnit->id ??''}}"> {{$details->product->compUnit->nameAr ??'' }}</option></select></td>
                                      <td><input  class="form-control" type="text" name="Qty{{$index+1}}" id="Qty{{$index+1}}" onchange="calPrdect({{$index+1}})" value="{{$details->Quantity}}"></td>
                                      <td><input  class="form-control" type="text" readonly name="costprod{{$index+1}}" id="costprod{{$index+1}}" value="{{$details->product->unitprodectcomment[0]->costprodect}}"></td>
                                      <td>  <input  class="form-control" class="form-control" type="text" id="total{{$index+1}}" name="total{{$index+1}}" value="{{ $details->QuantityTotal}}" readonly> </td>
                                  </tr>
                                  @endforeach
                              @endif

                              <tr>
                                <th>#</th>
                                <th>  </th>
                                <th >  </th>
                                <th id="countingitemsall"> <?php echo $cc ;?> </th>
                                <th>  </th>
                                <th id="texttotal"> {{$vom->totalcost}} </th>
                            </tr>


                        </tbody>
                      </table>
                  </div>

                </div>
              </div>

            </form>
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

    function calculation()
    {

      Qty=  document.getElementById('Quantity').value ;
      Count=  document.getElementById('Count').value ;

      let  costtotal=0;
      let=counting=0;

        for(i=1;i<=parseInt(Count);i++){
            QtyPrd   =  document.getElementById('Qty'+i).value ;
            costval   =  document.getElementById('costprod'+i).value ;
            costtotal += parseFloat((Qty/QtyPrd)*QtyPrd*costval);
            counting+=QtyPrd;
            document.getElementById('total'+i).value = parseFloat((Qty/QtyPrd)*QtyPrd*costval).toFixed(4);
        }
        document.getElementById('totalcost').value  =parseFloat(costtotal).toFixed(4);
        document.getElementById('texttotal').innerHTML =parseFloat(costtotal).toFixed(4);
        document.getElementById('countingitemsall').innerHTML =parseFloat(counting);

    }



    function calPrdect(i)
    {

        Qty=  document.getElementById('Quantity').value ;
        QtyPrd   =  document.getElementById('Qty'+i).value ;
        costval   =  document.getElementById('costprod'+i).value ;
        document.getElementById('total'+i).value = parseFloat((Qty/QtyPrd)*QtyPrd*costval).toFixed(4);

        calculation();
    }

</script>
@endsection
