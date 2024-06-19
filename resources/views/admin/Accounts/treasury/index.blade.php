@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('Sandat.Treasury') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('Sandat.Treasurysandbanks') }} </a></li>
            <li class="breadcrumb-item active"> {{ trans('Sandat.Treasury') }} </li>
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
                <h3 class="card-title">  {{ trans('Sandat.Listoffunds') }}   </h3>
                <a href="{{route('Treasury.create')}}" class="btn btn-primary btnAddsys"><i class="fa fa-plus"></i> {{ trans('Sandat.Add') }}</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>#</th>
                    {{-- <th>رقم الحساب</th> --}}
               
                    <th> {{ trans('Sandat.Fundname') }} </th>
                    <th>{{ trans('Sandat.Status') }}  </th>
                    <th>{{ trans('Sandat.Branch') }}  </th>
                    <th> {{ trans('Sandat.description') }} </th>
                    <th> {{ trans('Sandat.Options') }}  </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($Treasury) > 0)
                      @foreach ($Treasury as $index => $row)
                      <tr>
                        <td>{{$index+1}}</td>
                        {{-- <td>{{$row->AccountCode}}</td> --}}
                        <td>{{$row->name}}</td>
                        <td>
                            @if ($row->status ==0)
                            {{ trans('Sandat.Active') }}
                            @else
                            {{ trans('Sandat.NoActive') }}
                            @endif
                        </td>
                        <td>{{$row->branch->nameAr}}</td>
                        <td>{{$row->desc}}</td>
                        <td>
                          {{-- <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i> عرض</a> --}}
                          <a href="{{route('Treasury.edit',$row->id)}}" class="btn btn-info"><i class="fa fa-edit"></i>  {{ trans('Sandat.Edite') }}</a>
                          {{-- <a href="#"  class="btn btn-warning" onclick="handleDelete({{ $row->id }})"><i class="fa fa-stop"></i> ايقاف</a> --}}
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="5" class="text-center"> {{ trans('Sandat.NoFound') }}</td>
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
