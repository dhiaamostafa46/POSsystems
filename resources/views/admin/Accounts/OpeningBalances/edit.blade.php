@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Account.Openingbalance') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Account.accounts') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Account.Openingbalance') }} </li>
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
                <h3 class="card-title">  {{ trans('Account.Openingbalance') }}  </h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{ route('OpeningBalances.update' ,$data->id) }}" enctype = "multipart/form-data">
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  {{ trans('Account.accountname') }}    :</label>
                          <input type="text"  class="form-control @error('nameAccount') is-invalid @enderror" readonly value="{{$data->nameAccount}}" id="nameAccount" name="nameAccount" placeholder=" {{ trans('Account.accountname') }}   ">
                          @error('nameAccount')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">     {{ trans('Account.date') }} :</label>
                          <input type="date"  class="form-control @error('date') is-invalid @enderror" value="{{$data->date}}" id="date" name="date">
                          @error('date')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      {{-- <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">  الدائن:</label>
                          <input type="text"  class="form-control @error('Credit') is-invalid @enderror" onkeypress="doChangSelect()"  value="{{$data->Credit}}" id="Credit" name="Credit" placeholder="   Credit ">
                          <div class="prodect_list">

                          </div>
                          @error('Credit')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div> --}}
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">     {{ trans('Account.thevalue') }} :</label>
                          <input type="number"  class="form-control @error('Debit') is-invalid @enderror" value="{{$data->Debit}}" id="Debit" name="Debit">
                          @error('Debit')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">   {{ trans('Account.thedescription') }} :</label>
                          <textarea  class="form-control @error('desc') is-invalid @enderror" id="amount" name="desc" placeholder="    {{ trans('Account.thedescription') }}   " rows="3" cols="3">{{$data->desc}}</textarea>
                          @error('desc')
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
                          <input type="submit" class="btn btn-primary" value="  {{ trans('Account.save') }} " style="width: 100%">
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

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

function doChangSelect()
{

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
$.ajax({
            type: 'post',
            url: "/OpeningBalances.serach",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // data : {'data' : data},
            beforeSend: function(){



            },
            success: function(response){
                //the request is success

                  $('.prodect_list').append(response);
                   console.log(response);

            },
            complete: function(response){
                //the request is completed

            }
        });


}

$(document).on('click', '.list-group-item', function(){
        var value = $(this).text();

        var idlink=$(this).attr('data-id');
        var div =$(this).parent().parent();
        var input=div.prev();

        input.attr('data-store',idlink);
        input.val(value);
        div.html("");

     });
</script>
