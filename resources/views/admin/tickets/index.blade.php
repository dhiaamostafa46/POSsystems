@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">  {{ trans('ticket.technicalsupport') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">  {{ trans('ticket.thetickets') }} </a></li>
            <li class="breadcrumb-item active">  {{ trans('ticket.technicalsupport') }} </li>
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
                <h3 class="card-title"> {{ trans('ticket.Alltickets') }} </h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> {{ trans('ticket.orgniztion') }}</th>
                    <th> {{ trans('ticket.by') }}</th>
                    <th> {{ trans('ticket.title') }}</th>
                    <th> {{ trans('ticket.Thesituation') }}</th>
                    <!--<th>الصورة</th>-->
                    <th>  {{ trans('ticket.Datecreated') }}</th>
                    <th> {{ trans('ticket.Options') }} </th>
                  </tr>
                  </thead>
                  <tbody>

                  @if (count($tickets) > 0)
                      @foreach ($tickets as $index => $ticket)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$ticket->organization->nameAr}}</td>
                        <td>{{$ticket->user->name}}</td>
                        <td>{{$ticket->title}}</td>

                        <td>

                          @if($ticket->tickStatus == 1)

                          {{ trans('ticket.Waitingforapproval') }}
                          @elseif($ticket->tickStatus ==2)

                          {{ trans('ticket.Undertreatment') }}
                           @elseif($ticket->tickStatus == 3)

                           {{ trans('ticket.Processed') }}
                           @elseif($ticket->tickStatus == 4)

                           {{ trans('ticket.Closed') }}
                           @endif
                        </td>

                        <td>{{$ticket->created_at}}</td>
                        <td>
                          <a href="{{route('tickets.show',$ticket->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> {{ trans('ticket.show') }}</a>

                          <a href="#" class="btn btn-danger" onclick="handleDelete({{ $ticket->id }})"><i class="fa fa-trash"></i> {{ trans('ticket.delete') }}</a>
                        </td>
                      </tr>
                      @endforeach
                  @else
                      <tr>
                        <td colspan="7" class="text-center"> {{ trans('ticket.NotfoundData') }} </td>
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

    <div  style="display: none">
        <h1 id="wwwwwwwwwwwwwwopen">  {{ trans('ticket.Areyousuretodelete') }} </h1>
        <h1 id="Markrvvvvvvvvvvvvvvvvv">  {{ trans('ticket.confirmButtonText') }} </h1>
        <h1 id="Bororoeeowpppppp">  {{ trans('ticket.cancelButtonText') }} </h1>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
      function handleDelete(id){

        ddd= document.getElementById('wwwwwwwwwwwwwwopen').innerHTML ;
     dyes= document.getElementById('Markrvvvvvvvvvvvvvvvvv').innerHTML ;
     dno = document.getElementById('Bororoeeowpppppp').innerHTML ;
        Swal.fire({
          title: ddd,
          text: "",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#f8a29e',
          confirmButtonText: dyes,
          cancelButtonText: dno
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "/delete-productcategory/"+id;
          }
        })
      }

    </script>

@endsection

