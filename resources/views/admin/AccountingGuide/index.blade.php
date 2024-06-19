@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{asset('tree/src/css/filetree.css')}}" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="{{asset('tree/src/js/filetree.js')}}"></script>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Account.Accountproofrecord') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Account.accounts') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Account.Accountproofrecord') }} </li>
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
              <div class="card-header">
                <h3 class="card-title">   {{ trans('Account.Accountproofrecord') }}   </h3>
                <a href="{{route('AccountingGuide.create')}}" class="btn btn-primary btnAddsys"><i class="fa fa-plus"></i> {{ trans('Account.Add') }} </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="filetree">
                            @if (count($Guide) > 0)

                                    @foreach($Guide as $category)
                                        <ul class="main-tree">
                                            <li class="tree-title" onclick="FunClickAccount({{$category->AccountID}})">  @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl"){{ $category->AccountName }}  @else {{ $category->AccountNameEn }} @endif </li>
                                            @if(count($category->AccountingGuide)>0)
                                            {{-- <ul class="tree"> --}}
                                                @include('manageChild',['childs' => $category->AccountingGuide])
                                            {{-- </ul> --}}
                                            @endif
                                        </ul>
                                    @endforeach



                            @else
                                <tr>
                                <td colspan="5" class="text-center">    {{ trans('Account.NoFound') }}  </td>
                                </tr>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8" id="BorderleftAccount">
                        <table  class="table table-bordered table-hover text-center">
                            <thead>
                            <tr>

                              <th>{{ trans('Account.Code') }} </th>
                              <th>{{ trans('Account.Directoryname') }}   </th>




                              <th> {{ trans('Account.Options') }}  </th>
                            </tr>
                            </thead>
                            <tbody id="tbody">


                            </tfoot>
                          </table>

                    </div>
                </div>

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
 <input type="hidden" id="lang" value="{{LaravelLocalization::getCurrentLocaleDirection()}}">

<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
 function   FunClickAccount(id){

    console.log(id);
    $.ajax({
        url: `/AccountingGuide.Account/${id}`,
        data:{id:id},
        success: data => {
            console.log(data);
            $('#tbody').empty();
            $data="";
            data.data.forEach(item => {
                edit="";
                if(item.Account_status ==0)
                {
                    edit= `<a href="AccountingGuide.edit/${item.id}" class="btn btn-info"><i class="fa fa-edit"></i></a>`;
                }else{

                }
                if( document.getElementById('lang').value =="rtl")
                {

                    $data+=`<tr> <td>${item.AccountID}</td> <td>${item.AccountName}</td> <td>${edit}
                         </td> </tr> `;
                }
                else
                {
                    $data+=`<tr> <td>${item.AccountID}</td> <td>${item.AccountNameEn}</td>  <td>${edit}
                     </td> </tr> `;
                }




                                })

             $('#tbody').append(  $data);
        }
     });

    }
</script>


@endsection

{{-- $('#tbody').append(`<tr> <td>${item.AccountID}</td> <td>${item.AccountName}</td><td>${item.type}</td> <td> </td> </tr> `) --}}
