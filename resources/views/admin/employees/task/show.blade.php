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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> {{ trans('HR.Task') }}</h3>

                        </div>
                        <div class="card-body">
                            <form class="user" enctype = "multipart/form-data">
                                @csrf
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Employee') }} / {{ trans('HR.department') }}:</label>
                                                <br>
                                                @if ($task->flage == 1)
                                                    {{ trans('HR.department') }}/
                                                    {{ $task->Department->nameAr ?? '' }}
                                                @else
                                                    {{ trans('HR.Employee') }}/ {{ $task->employee->nameAr ?? '' }}
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.titketask') }} :</label>
                                                <br>
                                                {{ $task->title }}

                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.statustask') }} :</label>
                                            <br>

                                            @if ($task->status == 0)
                                                <i class="fa fa-circle" aria-hidden="true"
                                                    style="color: rgb(34, 32, 30)"></i> &nbsp;
                                                {{ trans('ticket.Waitingforapproval') }}
                                            @elseif($task->status == 1)
                                                <i class="fa fa-circle" aria-hidden="true"
                                                    style="color: rgb(210, 250, 51)"></i>&nbsp;
                                                {{ trans('ticket.Undertreatment') }}
                                            @elseif($task->status == 2)
                                                <i class="fa fa-circle" aria-hidden="true"
                                                    style="color: rgb(51, 250, 78)"></i>&nbsp;
                                                {{ trans('ticket.Processed') }}
                                            @elseif($task->status == 3)
                                                <i class="fa fa-circle" aria-hidden="true"
                                                    style="color: rgb(250, 51, 51)"></i>&nbsp;
                                                {{ trans('ticket.Closed') }}
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.End') }} :</label>
                                            <br>
                                            <?php echo $task->done; ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.taskmarget') }} :</label>
                                            <br>
                                            <?php echo $task->desc; ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-control-label" for="input-username">
                                                {{ trans('HR.File') }} :</label>
                                            <br>
                                            @if ($task->file !=null)
                                            <a href="{{ asset('public/dist/File/' . $task->file) }}"
                                                target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i>
                                                {{ trans('HR.show') }}</a>
                                            @endif

                                        </div>



                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name"> </label>
                                                <br>

                                                <!-- Button trigger modal -->


                                                <!-- Modal -->

                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                    {{ trans('HR.addcomment') }}
                                                </button>

                                                @if(auth()->user()->empID ==0)
                                                    <button type="button" class="btn btn-info"
                                                        onclick="Changetaskstate({{ $task->id }})">
                                                        {{ trans('HR.chanestata') }}
                                                    </button>
                                                @endif

                                                @if(auth()->user()->empID !=0 && $task->status !=3 )
                                                    <button type="button" class="btn btn-info"
                                                        onclick="Changetaskstate({{ $task->id }})">
                                                        {{ trans('HR.chanestata') }}
                                                    </button>
                                                @endif

                                                <!-- Modal -->




                                            </div>
                                        </div>
                                    </div>

                                </div>
                        </div>
                        <hr class="my-4" />
                        </form>
                    </div>
                    @if (count($task->Taskdetails) > 0)
                        <div class="card">
                            <div class="card-header card-primary">
                                <h3 class="card-title"> {{ trans('HR.comments') }} </h3>

                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 5%"># </th>
                                            <th style="width: 15%" scope="col"> {{ trans('HR.Employee') }}</th>
                                            <th scope="col">{{ trans('HR.comments') }}</th>

                                            <th style="width: 7%" scope="col">{{ trans('HR.File') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($task->Taskdetails as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $item->User->name }}</td>
                                                <td> <?php echo $item->desc; ?></td>
                                                <td>
                                                    @if ($item->file !=null)
                                                        <a href="{{ asset('public/dist/File/' . $item->file) }}"
                                                            target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i>
                                                            {{ trans('HR.show') }}</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    @endif
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('HR.addcomment') }}
                </h5>

            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('Task.update', $task->id) }}"  enctype = "multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="taskid" value="{{ $task->id }}">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label" for="input-username">
                                {{ trans('HR.File') }}</label>
                            <input type="File" id="File" name="File" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">
                            {{ trans('HR.comments') }} </label>
                        <textarea id="summernote" rows="3" name="desc" id="desc">
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
                    <input type="hidden" name="taskidstate" id="taskidstate">
                    <div class="form-group">
                        <select name="statuschnge" id="statuschnge" class="form-control">
                            <option value="0"> {{ trans('ticket.Waitingforapproval') }} </option>
                            <option value="1"> {{ trans('ticket.Undertreatment') }} </option>
                            <option value="2"> {{ trans('ticket.Processed') }} </option>
                            <option value="3"> {{ trans('ticket.Closed') }} </option>
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

<script>
    function showModal(id) {
        console.log(id);
        $('#updatecomment').modal('show');
        $('#taskid').val(id);
    }

    function Changetaskstate(id) {
        $('#Changetaskstate').modal('show');
        $('#taskidstate').val(id);
    }
</script>



<script>
    function showTime() {

        document.getElementById('stTime').style.display = "block";
        document.getElementById('enTime').style.display = "block";


    }

    function hideTime() {

        document.getElementById('stTime').style.display = "none";
        document.getElementById('enTime').style.display = "none";

    }
</script>
