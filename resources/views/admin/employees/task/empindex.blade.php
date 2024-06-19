@extends('layouts.dashboard')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('HR.Task') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('HR.Task') }}</li>
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
                    <div class="card ">
                        <div class="card-header  card-primary">
                            <h3 class="card-title">{{ trans('HR.Task') }}</h3>
                            {{-- <a type="button" href="{{ route('Task.create') }}" class="btn btn-primary floatmleft"><i
                                    class="fa fa-plus"></i> {{ trans('HR.Add') }}</a> --}}

                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table  table-bordered table-hover">
                                <thead>

                                    <tr>
                                    <tr>
                                        <th>#</th>
                                        <!--<th> Code ID</th>-->
                                        <th> {{ trans('HR.Employee') }} / {{ trans('HR.department') }}</th>
                                        <th> {{ trans('HR.titketask') }}</th>
                                        <th> {{ trans('HR.createdat') }}</th>

                                        <th> {{ trans('HR.End') }}</th>
                                        <th> {{ trans('HR.statustask') }}</th>
                                        <th> {{ trans('HR.Options') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($task) > 0)
                                        @foreach ($task as $index => $asset)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if ($asset->flage == 1)
                                                        {{ trans('HR.department') }}/
                                                        {{ $asset->Department->nameAr ?? '' }}
                                                    @else
                                                        {{ trans('HR.Employee') }}/ {{ $asset->employee->nameAr ?? '' }}
                                                    @endif
                                                </td>
                                                <td>{{ $asset->title }}</td>
                                                <td>{{ $asset->created_at }}</td>
                                                <td>{{ $asset->done }}</td>
                                                <td>
                                                    @if ($asset->status == 0)
                                                        <i class="fa fa-circle" aria-hidden="true"
                                                            style="color: rgb(34, 32, 30)"></i> &nbsp;
                                                        {{ trans('ticket.Waitingforapproval') }}
                                                    @elseif($asset->status == 1)
                                                        <i class="fa fa-circle" aria-hidden="true"
                                                            style="color: rgb(210, 250, 51)"></i>&nbsp;
                                                        {{ trans('ticket.Undertreatment') }}
                                                    @elseif($asset->status == 2)
                                                        <i class="fa fa-circle" aria-hidden="true"
                                                            style="color: rgb(51, 250, 78)"></i>&nbsp;
                                                        {{ trans('ticket.Processed') }}
                                                    @elseif($asset->status == 3)
                                                        <i class="fa fa-circle" aria-hidden="true"
                                                            style="color: rgb(250, 51, 51)"></i>&nbsp;
                                                        {{ trans('ticket.Closed') }}
                                                    @endif
                                                </td>


                                                <td>
                                                    <a href="{{ route('Task.show', $asset->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-check"></i>
                                                        {{ trans('HR.show') }}</a>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="showModal({{ $asset->id }})">
                                                        {{ trans('HR.addcomment') }}
                                                    </button>
                                                    @if ($asset->status != 3)
                                                        <button type="button" class="btn btn-info" onclick="Changetaskstate({{$asset->id}})">
                                                            {{ trans('HR.chanestata') }}
                                                        </button>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center"> {{ trans('HR.Statement') }} </td>
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

<div class="modal fade" id="updatecomment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('HR.addcomment') }}
                </h5>

            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('Task.update', 1) }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="taskid" id="taskid">
                    <div class="form-group">
                        <label for="exampleInputEmail1">
                            {{ trans('HR.comments') }} </label>
                        <textarea id="summernotecomments" rows="3" name="desc" id="desc">
                        </textarea>

                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('HR.close') }}</button>

                    <button type="submit" class="btn btn-primary">
                        {{ trans('HR.Save') }}</button>
                </form>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="Changetaskstate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('HR.statustask') }}
                </h5>

            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('changetask', 1) }}">
                    @csrf
                    <input type="hidden" name="taskidstate" id="taskidstate" >
                    <div class="form-group">
                        <select name="statuschnge" id="statuschnge" class="form-control" >
                            <option value="0">   {{ trans('ticket.Waitingforapproval') }} </option>
                            <option value="1">   {{ trans('ticket.Undertreatment') }} </option>
                            <option value="2">   {{ trans('ticket.Processed') }} </option>
                            <option value="3">   {{ trans('ticket.Closed') }} </option>
                        </select>


                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('HR.close') }}</button>

                    <button type="submit" class="btn btn-primary">
                        {{ trans('HR.Save') }}</button>
                </form>

            </div>

        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
    function showModal(id)
    {
        console.log(id);
        $('#updatecomment').modal('show');
        $('#taskid').val(id);
    }

    function Changetaskstate(id)
    {
        $('#Changetaskstate').modal('show');
        $('#taskidstate').val(id);
    }
</script>





<script>
    function funtypetask() {

        if ($('#typetask').val() == 0) {
            $('#groupempcreate').show();
            $('#groupdepartments').hide();
        } else {
            $('#groupdepartments').show();
            $('#groupempcreate').hide();

        }
    }
</script>
<script>
    function handleDelete(id) {
        Swal.fire({
            title: 'هل انت متأكد من الحذف؟',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#f8a29e',
            confirmButtonText: 'نعم، حذف',
            cancelButtonText: 'لا، الغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/delete-customer/" + id;
            }
        })
    }

    //   $(document).ready(function(){

    //        alert('test');
    //    if(navigator.geolocation){
    //        navigator.geolocation.getCurrentPosition(showLocation);
    //    }else{
    //        $('#location').html('Geolocation is not supported by this browser.');
    //    }


    // });
    function getLocation() {
        //alert('test');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showLocation);
        } else {
            $('#location').html('Geolocation is not supported by this browser.');
        }
    }

    function showLocation(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        document.getElementById("lat").value = latitude;
        document.getElementById("long").value = longitude;
        //  var test = "/storeAttendance?lat="+String(latitude)+"&long="+String(longitude);
        // alert(longitude);
        location.href = "/storeAttendance/" + String(latitude) + "/" + String(longitude);
        // $.ajax({
        //       url: "/storeAttendance/"+String(latitude)+"/"+String(longitude),
        //       success: data => {
        //         document.getElementById("lat").value = data.quantity;
        //       }

        //     });



    }
</script>
