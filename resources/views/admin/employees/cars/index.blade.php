@extends('layouts.dashboard')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('HR.vehicle') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('HR.vehicle') }}</li>
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
                            <h3 class="card-title"> {{ trans('HR.vehicle') }}</h3>

                            <a type="button" onclick="showModal()" class="btn btn-primary floatmleft"><i
                                    class="fa fa-plus"></i> {{ trans('HR.Add') }} </a>
                            <br>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> {{ trans('HR.number') }}</th>
                                        <!--<th> Code ID</th>-->
                                        <th>{{ trans('HR.vehicle') }}</th>
                                        <th>{{ trans('HR.Model') }}</th>
                                        <th> {{ trans('HR.StructureNo') }} </th>
                                        <th> {{ trans('HR.Expiryofdrivinglicense') }} </th>
                                        {{-- <th>{{ trans('HR.Status1') }}</th> --}}
                                        <th>{{ trans('HR.Options') }} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($assets) > 0)
                                        @foreach ($assets as $index => $asset)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $asset->nameAr }}</td>
                                                <td>{{ $asset->car->modelNo }}</td>
                                                <td>{{ $asset->car->bodyNo }}</td>
                                                <td>{{ $asset->car->licenceExpDate }}</td>


                                                <td>
                                                    <a href="{{ route('assetses.show', $asset->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-eye"></i>
                                                        {{ trans('HR.show') }} </a>
                                                    @if ($asset->isTaked == 0)
                                                        <a href="#" class="btn btn-warning"
                                                            onclick="ToEmpModal({{ $asset->id }},'{{ $asset->nameAr }}')"><i
                                                                class="fa fa-check"></i>
                                                            {{ trans('HR.Handingovertoanemployee') }} </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center"> {{ trans('HR.NotFoundData') }}
                                            </td>
                                        </tr>
                                    @endif
                                    </tfoot>
                            </table>
                            <br>

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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('HR.Newvehicle') }} </h5>
                </div>
                <div class="modal-body">
                    <form class="user" method="POST" action="{{ route('assetses.storeCar') }}"
                        enctype = "multipart/form-data">
                        @csrf
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">
                                            {{ trans('HR.Vehiclename') }}:</label>
                                        <input type="text" name="nameAr" class="form-control" required>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username"> {{ trans('HR.Model') }}
                                            :</label>
                                        <input type="text" name="modelNo" class="form-control" required>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">
                                            {{ trans('HR.StructureNo') }}
                                            :</label>
                                        <input type="text" name="bodyNo" class="form-control" required>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">
                                            {{ trans('HR.PlateNumber') }}
                                            :</label>
                                        <input type="text" name="blatNo" class="form-control" required>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">
                                            {{ trans('HR.Trafficlicence') }} :</label>
                                        <input type="file" class="form-control" name="licence">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">
                                            {{ trans('HR.Insurance') }}:</label>
                                        <input type="file" class="form-control" name="insurance">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">
                                            {{ trans('HR.Expiryofdrivinglicense') }}:</label>
                                        <input type="date" class="form-control" name="licenceExpDate">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">
                                            {{ trans('HR.Insuranceexpiry') }} :</label>
                                        <input type="date" class="form-control" name="insuranceExpDate">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                            for="input-username">{{ trans('HR.Branch') }}</label>
                                        <select class="form-control @error('branchID') is-invalid @enderror"
                                            id="branchID" name="branchID" required>
                                            <option value=""> {{ trans('HR.Selectthebranch') }}</option>
                                            @foreach (auth()->user()->organization->branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->nameAr }}</option>
                                            @endforeach
                                        </select>
                                        @error('branchID')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username"> {{ trans('HR.Status1') }}
                                            :
                                        </label>
                                        <div class="form-check">
                                            <input id="TypeProdect" name="assetStatus" value=" {{ trans('HR.New') }}"
                                                type="radio" class="form-check-input">
                                            <label class="form-check-label" for="credit"> {{ trans('HR.New') }}</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="TypeProdect" name="assetStatus" value=" {{ trans('HR.User') }}"
                                                type="radio" class="form-check-input" checked>
                                            <label class="form-check-label" for="credit"> {{ trans('HR.User') }}
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">
                                            {{ trans('HR.Additionaldetails') }} : </label>
                                        <br>
                                        <textarea name="details" class="form-control" id="" cols="60" rows="10"></textarea>
                                    </div>
                                </div>


                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"
                                    style="float:right">{{ trans('HR.Save') }}</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    style="float:right">{{ trans('HR.retreat') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




















    <!-- Create Modal -->
    <div class="modal fade modal" id="ToEmpModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('HR.Handingovertoanemployee') }}
                    </h5>

                </div>
                <div class="modal-body">
                    <form class="user" method="POST" action="{{ route('castodies.AssetToEmp') }}"
                        enctype = "multipart/form-data">
                        @csrf
                        <div class="pl-lg-4">
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">
                                            {{ trans('HR.Employee') }}
                                            :</label>

                                        <select class="livesearchemp form-control" name="empID" id="sername">

                                        </select>

                                        @error('empID')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username"> {{ trans('HR.custody') }}
                                        </label>
                                        <input type="text" class="form-control " id="assetName" name="castName"
                                            readonly>
                                        <input type="hidden" class="form-control" id="assetID" name="assetID">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">{{ trans('HR.File') }}
                                        </label>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                                            id="file" name="file">
                                        @error('file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">{{ trans('HR.comments') }}
                                        </label>
                                        <input type="text" class="form-control @error('quantity') is-invalid @enderror"
                                            id="details" name="details">
                                        @error('details')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>



                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"
                                    style="float:right">{{ trans('HR.Save') }}</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    style="float:right">{{ trans('HR.retreat') }}</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {{--
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"> --}}

    <!------------------------------------add saeed -------------------------------------------------->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

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

        function showModal() {

            $('#CreateModal').modal('show');
        }

        function ToEmpModal(...params) {

            document.getElementById("assetID").value = params[0];
            document.getElementById("assetName").value = params[1];
            $('#ToEmpModal').modal('show');

        }
        $('#empName').change(function() {

            nameAr = document.getElementById("empName").value;
            arr_index = items.map((el) => el.nameAr).indexOf(nameAr);

            empid = items[arr_index].id;
            ino = items[arr_index].idNo;

            document.getElementById("empID").value = empid;

            document.getElementById("idno").value = ino;
            document.getElementById("ename").value = empid;
            document.getElementById("addbtn").disabled = false;
        });
        var availableTags = <?php echo json_encode($employees); ?>;
        var items = <?php echo json_encode($employees_all); ?>;
        $(".autocomplete").autocomplete({
            source: availableTags
        });

        $('.livesearchemp').select2({
            placeholder: 'أدخل إسم الموظف ',
            ajax: {
                url: '/emp-autocomplete-search',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nameAr,
                                id: item.id + "-" + item.barcode

                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>


@endsection
