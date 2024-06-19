@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sandat.Expenseitems') }} </h1>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">  {{ trans('Sandat.Expenseitems') }}</h3>
                <a href="{{route('outcomeCategories.create')}}" class="btn btn-primary btnAddsys" ><i class="fa fa-plus"></i> {{ trans('Sandat.Add') }}</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('Sandat.accountnumber') }} </th>
                    <th> {{ trans('Sandat.Itemtype') }}</th>
                    <th> {{ trans('Sandat.accounttype') }} </th>
                    <th> {{ trans('Sandat.Datecreated') }} </th>
                    <th> {{ trans('Sandat.Options') }}</th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($outcomecategories) > 0)
                      @foreach ($outcomecategories as $index => $outcomecategory)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$outcomecategory->AccountID}}</td>
                        <td>{{$outcomecategory->nameAr}}</td>
                        <td>{{$outcomecategory->TypeAccount}}</td>
                        <td>{{$outcomecategory->created_at}}</td>
                        <td>
                          <a href="{{route('outcomeCategories.show',$outcomecategory->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>  {{ trans('Sandat.Show') }}</a>
                          <a href="{{route('outcomeCategories.edit',$outcomecategory->id)}}" class="btn btn-info"><i class="fa fa-edit"></i>  {{ trans('Sandat.Edite') }}</a>
                          <a href="#" class="btn btn-danger" onclick="handleDelete({{ $outcomecategory->id }})"><i class="fa fa-trash"></i>  {{ trans('Sandat.Delete') }}</a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center">{{ trans('Sandat.NoFound') }} </td>
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
<div  style="display: none">
 
    <h1 id="titalmesssage">  {{ trans('Sandat.Areyousuretodelete') }} </h1>
    <h1 id="confirmButtonText">  {{ trans('Sandat.confirmButtonText') }} </h1>
    <h1 id="cancelButtonText">  {{ trans('Sandat.cancelButtonText') }} </h1>
  
</div>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
  function handleDelete(id){
    ddd= document.getElementById('titalmesssage').innerHTML ;
 dyes= document.getElementById('confirmButtonText').innerHTML ;
 dno = document.getElementById('cancelButtonText').innerHTML ;

    Swal.fire({
      title: ddd,
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: dyes,
      cancelButtonText:dno
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/deleteoutcomecategory/"+id;
      }
    })
  }

</script>
