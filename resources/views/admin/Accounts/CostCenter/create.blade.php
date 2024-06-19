@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Account.Costcenter') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Account.accounts') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Account.Costcenter') }} </li>
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
              <div class="card-header">
                <h3 class="card-title">     {{ trans('Account.Addacostcenter') }}   </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('costcenters.store') }}" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('Account.Code') }}: <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span> </label>
                          <input type="number"  class="form-control @error('CostCodeID') is-invalid @enderror" id="CostCodeID" readonly name="CostCodeID" placeholder="  {{ trans('Account.Code') }}    ">
                          @error('CostCodeID')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('Account.Costname') }}    : <span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span> </label>
                          <input type="text"  class="form-control @error('CostName') is-invalid @enderror" id="CostName" name="CostName" placeholder=" {{ trans('Account.Costname') }}    ">
                          @error('CostName')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('Account.CostnameinEnglish') }}   :</label>
                          <input type="text"  class="form-control @error('CostNameEN') is-invalid @enderror" id="CostNameEN" name="CostNameEN" placeholder="    {{ trans('Account.CostnameinEnglish') }}    ">
                          @error('CostNameEN')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Account.Mainaccount') }}  :<span style="color: rgba(255, 0, 0, 0.544);font-size:25px ;    margin: 0px 10px;position: absolute;">*</span> </label>
                          <select class="form-control @error('nameFather') is-invalid @enderror" id="nameFather"  onkeypress="return ValidateKey();" name="nameFather" placeholder=" {{ trans('Account.Mainaccount') }} ">
                            @foreach (auth()->user()->organization->CostCenter as $item)
                              <option value="{{$item->CostCodeID}}::{{ $item->id}}::{{ $item->CostName}}">{{ $item->CostName}}</option>
                            @endforeach
                        </select>
                        </div>
                      </div>



                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <input type="submit" class="btn btn-primary" value="{{ trans('Account.save') }}" style="width: 100%">
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



<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>

 $( document ).ready(function() {



    var optionSelected = $(this).find("option:selected");
     var valueSelected  = optionSelected.val();
     var data=valueSelected.split("::");



     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });





    $.ajax({
            type: 'post',
            url: "/costcenters.AccountFather/"+data[0],
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(){
                //before sending the request
                //  console.log("sdsdsdfff");

            },
            success: function(response){
                //the request is success
                 console.log(response.count);
                 if(data[0].length<3)
                 {
                    $('#CostCodeID').val(data[0]+response.count);
                 }else
                 {
                    $('#CostCodeID').val(data[0]+"00"+response.count);
                 }

            },
            complete: function(response){
                //the request is completed
            //  console.log("fff");
            }
        });





    });
    </script>













<script  type="text/javascript">



      $('#nameFather').change(function (event) {
        event.preventDefault();

     var optionSelected = $(this).find("option:selected");
     var valueSelected  = optionSelected.val();
     var data=valueSelected.split("::");



     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });





    $.ajax({
            type: 'post',
            url: "/costcenters.AccountFather/"+data[0],
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(){
                //before sending the request
                //  console.log("sdsdsdfff");

            },
            success: function(response){
                //the request is success
                 console.log(response.count);
                 if(data[0].length<3)
                 {
                    $('#CostCodeID').val(data[0]+response.count);
                 }else
                 {
                    $('#CostCodeID').val(data[0]+"00"+response.count);
                 }

            },
            complete: function(response){
                //the request is completed
            //  console.log("fff");
            }
        });



 });
</script>






@endsection
