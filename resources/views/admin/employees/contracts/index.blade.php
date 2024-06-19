@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('HR.Employmentcontracts') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('HR.Employmentcontracts') }}</li>
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
                            <h6 style="display: inline-block"> {{ trans('HR.Employmentcontracts') }} </h6>
                            <!--<a href=""   class="btn btn-primary" style="float:left"><i class="fa fa-plus"></i> اضافة</a>-->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text"
                                        class="mt-1 autocomplete form-control @error('empName') is-invalid @enderror"
                                        id="empName" name="empName" style="width: 73%;display:inline-block"
                                        placeholder="ادخل إسم الموظف">

                                    <a type="button" class="btn btn-primary" style="width: 25%;display:inline-block"
                                        id="find"> {{ trans('HR.Search') }} </a>

                                    <label class="form-control-label" for="input-username"> {{ trans('HR.name') }}</label>
                                    <input type="text" class="form-control" id="ename" name="ename" disabled>
                                    <label class="form-control-label" for="input-username"> {{ trans('HR.IDNumber') }}
                                    </label>
                                    <input type="text" class="form-control" id="idno" name="idno" disabled>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name"> </label>
                                                <br>
                                                <div class="row">
                                                    {{-- <div class="col-6">
                                                        <button class="btn btn-primary"
                                                            style="width: 100%;display:inline-block" onclick="UrLcontractsAlictrony()" id="addbtnEmploymentcontracts"
                                                            disabled> إضافة عقد الالكتروني </button>
                                                    </div> --}}
                                                    <div class="col-6">
                                                        <button class="btn btn-primary"
                                                            style="width: 100%;display:inline-block" id="addbtn"
                                                            onclick="showModal()" disabled>
                                                            {{ trans('HR.Addcontracts') }}</button>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> {{ trans('HR.Employee') }} </th>
                                        <th> {{ trans('HR.contractnumber') }} </th>
                                        <th> {{ trans('HR.Start') }} </th>
                                        <th> {{ trans('HR.End') }}</th>
                                        <th> {{ trans('HR.Contractstatus') }}</th>
                                        <th> {{ trans('HR.Options') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="salaries">
                                    @if (count($contracts) > 0)
                                        @foreach ($contracts as $index => $contract)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $contract->employees->nameAr }}</td>
                                                <td>{{ $contract->contractNo }}</td>
                                                <td>{{ $contract->stDate }}</td>
                                                <td>{{ $contract->enDate }}</td>
                                                @if ($contract->contractStatus == 1)
                                                    <td>{{ trans('HR.valid') }}</td>
                                                @else
                                                    <td>{{ trans('HR.Finished') }}</td>
                                                @endif

                                                <td>
                                                    <a href="{{ asset('public/dist/empDocs/contracts/' . $contract->file) }}"
                                                        target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i>
                                                        {{ trans('HR.download') }}</a>

                                                    <a href="{{ route('electroniccontracts', $contract->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-eye"></i>
                                                        عقد الالكتروني
                                                    </a>

                                                    <a type="button" class="btn btn-info"
                                                        onclick="showEditModal({{ $contract->id }})"><i
                                                            class="fa fa-edit"></i> {{ trans('HR.Edit') }}</a>

                                                    <a type="button" class="btn btn-danger"
                                                        onclick="handleDelete({{ $contract->id }})"><i
                                                            class="fa fa-trash"></i> {{ trans('HR.Edit') }}</a>

                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade modal" id="EditModal{{ $contract->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center" id="exampleModalLabel">
                                                                {{ trans('HR.Editemploymentcontractdata') }} </h5>

                                                        </div>
                                                        <form class="user" method="POST"
                                                            action="{{ route('employees.updateInfo', ['id' => $contract->id, 'type' => 'contract']) }}"
                                                            enctype = "multipart/form-data">
                                                            @csrf
                                                            @method('put')
                                                            <div class="pl-lg-4">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label"
                                                                                for="input-username">
                                                                                {{ trans('HR.Thecontractnumberisqua') }}
                                                                            </label>

                                                                            <input type="text"
                                                                                class="form-control @error('contractNo') is-invalid @enderror"
                                                                                id="contractNo" name="contractNo"
                                                                                value="{{ $contract->contractNo }}">
                                                                            </select>
                                                                            @error('nameAr')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label"
                                                                                for="input-username">
                                                                                {{ trans('HR.Start') }} </label>
                                                                            <input type="date"
                                                                                class="form-control @error('sdate') is-invalid @enderror"
                                                                                id="stDate" name="stDate"
                                                                                value="{{ $contract->stDate }}">
                                                                            @error('stDate')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label"
                                                                                for="input-username">
                                                                                {{ trans('HR.End') }} </label>
                                                                            <input type="date"
                                                                                class="form-control @error('enDate') is-invalid @enderror"
                                                                                id="enDate" name="enDate"
                                                                                value="{{ $contract->enDate }}">
                                                                            @error('enDate')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label"
                                                                                for="input-username">
                                                                                {{ trans('HR.Contractcopy') }} </label>
                                                                            <input type="file"
                                                                                class="form-control @error('nameEn') is-invalid @enderror"
                                                                                id="file" name="file">
                                                                            @error('file')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary"
                                                                        style="float:right"> {{ trans('HR.Save') }}
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal" style="float:right">
                                                                        {{ trans('HR.retreat') }} </button>
                                                                </div>
                                                            </div>



                                                    </div>
                                                </div>
                                                <hr class="my-4" />
                                                </form>
                                            </div>
                                            <!-- End Edit Modal -->
                                        @endforeach
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




    <!-- Create Modal -->
    <div class="modal fade modal" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('HR.newContract') }} </h5>
                    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>-->
                </div>
                <form class="user" method="POST" action="{{ route('employees.storeContract') }}"
                    enctype = "multipart/form-data">
                    @csrf
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">
                                        {{ trans('HR.Thecontractnumberisqua') }} </label>
                                    <input type="hidden" class="form-control @error('empID') is-invalid @enderror"
                                        id="empID" name="empID">
                                    <input type="text" class="form-control @error('contractNo') is-invalid @enderror"
                                        id="contractNo" name="contractNo">
                                    @error('contractNo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username"> {{ trans('HR.Start') }}
                                    </label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                        id="stDate" name="stDate">
                                    @error('stDate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username"> {{ trans('HR.End') }}
                                    </label>
                                    <input type="date" class="form-control @error('enDate') is-invalid @enderror"
                                        id="enDate" name="enDate">
                                    @error('enDate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">
                                        {{ trans('HR.Contractcopy') }} </label>
                                    <input type="file" class="form-control @error('nameEn') is-invalid @enderror"
                                        id="file" name="file">
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" style="float:right">
                                {{ trans('HR.Save') }}</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                style="float:right">{{ trans('HR.retreat') }}</button>
                        </div>
                    </div>



            </div>
        </div>
        <hr class="my-4" />
        </form>
    </div>





    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        function showEditModal(id) {
            $('#EditModal' + id).modal('show');
        }

        function showModal() {
            //console.log('star.', id)
            // var form = document.getElementById('deleteCategoryForm')
            // form.action = '/user/delete/' + id
            // form.action = '/Bills/' + id
            $('#CreateModal').modal('show')
        }

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
                    window.location.href = "/contractsdelete/" + id;
                }
            })
        }

        $('#empName').change(function() {

            nameAr = document.getElementById("empName").value;
            arr_index = items.map((el) => el.nameAr).indexOf(nameAr);
            empid = items[arr_index].id;
            ino = items[arr_index].idNo;


            document.getElementById("empID").value = empid;
            document.getElementById("idno").value = ino;
            document.getElementById("ename").value = nameAr;
            document.getElementById("addbtn").disabled = false;

        });
        var availableTags = <?php echo json_encode($employees); ?>;
        var items = <?php echo json_encode($employees_all); ?>;
        $(".autocomplete").autocomplete({
            source: availableTags
        });


        function UrLcontractsAlictrony() {

            id = document.getElementById("empID").value;
            window.location.href = 'contractElron/' + id;
        }

        function addSalary(id) {

            window.location.href = 'createSalary/' + id;
        }
    </script>
@endsection
