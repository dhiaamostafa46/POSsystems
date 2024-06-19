@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Account.Dailyrestrictions') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Account.accounts') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Account.Dailyrestrictions') }} </li>
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
                <h3 class="card-title">   {{ trans('Account.Recorddailyentries') }}    </h3>
                <a href="{{route('journals.create')}}" class="btn btn-primary btnAddsys" ><i class="fa fa-plus"></i>   {{ trans('Account.Add') }}</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>  {{ trans('Account.Registrationnumber') }}  </th>
                    <th> {{ trans('Account.date') }}  </th>
                    <th> {{ trans('Account.user') }}    </th>
                    <th> {{ trans('Account.Ref') }}    </th>
                    <th>  {{ trans('Account.total') }}   </th>
                    <th>   {{ trans('Account.description') }}    </th>
                    <th>  {{ trans('Account.Options') }}    </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($Journal) > 0)
                      @foreach ($Journal as $index => $row)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$row->id}}</td>
                        <td>{{$row->date}}</td>
                        <td>{{$row->user->name}}</td>
                        <td>{{$row->Ref}}</td>
                        <td>{{$row->Total}}</td>
                        <td>{{$row->dec}}</td>
                         <td>
                          <a href="{{route('journals.show',$row->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i>  {{ trans('Account.Show') }} </a>
                          <a href="{{route('journals.edit',$row->id)}}" class="btn btn-info"><i class="fa fa-edit"></i>  {{ trans('Account.Edite') }} </a>
                          {{-- <a href="#"  class="btn btn-warning" onclick="handleDelete({{ $row->id }})"><i class="fa fa-stop"></i> ايقاف</a> --}}
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center"> {{ trans('Account.NoFound') }} </td>
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
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>

  function handleDelete(id ,flag){

    console.log(flag);
    if(flag == 0)
    var title ='هل انت متأكد من ايقاف الدليل؟'
    else
    var title ='هل انت متأكد من فتح الدليل'

    Swal.fire({
      title: title,
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#f8a29e',
      confirmButtonText: 'نعم',
      cancelButtonText: ' الغاء'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "/AccountingGuide.delete/"+id;
      }
    })
  }

</script>
