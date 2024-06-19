@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sandat.Expenses') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sandat.Treasurysandbanks') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sandat.Expenses') }} </li>
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
                <h3 class="card-title"> {{ trans('Sandat.Editanewexpense') }}</h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('outcomes.update',$outcome->id) }}" enctype = "multipart/form-data">
                @csrf
                @method('PUT')
                   <input type="hidden"   name="Oldpayment"  value="{{$outcome->outAccount}}" >
                   <input type="hidden"   name="oldCat"  value="{{$outcome->categoryID}}">
                  <div class="pl-lg-4">
                    <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username"> {{ trans('Sandat.Expenseitem') }}</label>
                              <select class="form-control @error('categoryID') is-invalid @enderror" id="categoryID" name="categoryID">
                                <option value=""> {{ trans('Sandat.Selectitem') }}</option>
                                @foreach (auth()->user()->organization->outcomecategories as $cat)
                                  <option value="{{$cat->id}}" @if($outcome->categoryID == $cat->id) selected @endif>{{$cat->nameAr}}</option>
                                @endforeach
                              </select>
                              @error('categoryID')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">{{ trans('Sandat.Total') }}</label>
                              <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" placeholder="{{ trans('Sandat.Total') }}" value="{{$outcome->total}}">
                              <input type="hidden"  name="Oldtotal"  value="{{$outcome->total}}">
                              @error('total')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>

                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">{{ trans('Sandat.comment') }}</label>
                              <input type="text" class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" placeholder="{{ trans('Sandat.comment') }}" value="{{$outcome->comment}}">
                              @error('comment')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>



                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username"> {{ trans('Sandat.Paymenttype') }} </label>
                          <select class="form-control @error('type') is-invalid @enderror" id="type" onchange="showCashCard(this)" name="type">
                            <option style="display: none">  {{ trans('Sandat.Choosethepaymenttype') }}  </option>
                            <option  @if ($outcome->type=='121')  selected @endif value="121">{{ trans('Sandat.Cash') }}</option>
                            <option  @if ($outcome->type=='122')  selected @endif value="122">{{ trans('Sandat.Net') }}</option>
                        </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        ه
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">{{ trans('Sandat.accounttype') }} </label>

                          <select class="form-control @error('paymentTypeitems') is-invalid @enderror" id="paymentTypeitems" name="paymentTypeitems" >
                            <option value="{{$outcome->outAccount}}::{{$outcome->nameAccount}}">{{$outcome->nameAccount}}</option>

                           </select>
                        </div>
                      </div>



                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-first-name"> {{ trans('Sandat.Imageoftheexpense') }}</label>
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
                          <input type="submit" class="btn btn-primary" value="{{ trans('Sandat.save') }}" style="width: 100%">
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
  function route(obj){
    if(obj.value == -1)
    {
      window.location.href = "/outcomeCategories/create"
    };
  }





  function showCashCard(obj){

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        type =obj.value;
        $('#paymentTypeitems').empty();

        if (obj.value ==121) {

            $.ajax({
                type: 'post',
                url: "/purchases.SearchAccount/"+type,
                data: {id : type},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(){ },
                success: function(response){
                    //the request is success
                    console.log(response.data[0].AccountName);
                    for (let i = 0; i <response.count; i++){
                        $('#paymentTypeitems').append('<option value="'+response.data[i].AccountID+'::'+response.data[i].AccountName+'">'+response.data[i].AccountName+'</option>');
                    }
                },
                complete: function(response){ }
            });
            document.getElementById(`paymentType`).style.display = "flex";

        } else if (obj.value ==122) {
            $.ajax({
                type: 'post',
                url: "/purchases.SearchAccount/"+type,
                data: {id : type},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(){ },
                success: function(response){
                    //the request is success
                    console.log(response.data[0].AccountName);
                    for (let i = 0; i <response.count; i++){
                        $('#paymentTypeitems').append('<option value="'+response.data[i].AccountID+'::'+response.data[i].AccountName+'">'+response.data[i].AccountName+'</option>');
                    }
                },
                complete: function(response){ }
            });
            document.getElementById(`paymentType`).style.display = "flex";

        }

}
</script>
