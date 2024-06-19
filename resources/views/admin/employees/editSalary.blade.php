@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('HR.salaries') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
                        <li class="breadcrumb-item active"> {{ trans('HR.salaries') }}</li>
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
                    <form class="user" method="POST" action="{{ route('updatesalaryAll', $empSal->id) }}"
                        enctype = "multipart/form-data">
                        @csrf

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> {{ trans('HR.Salarydata') }} -
                                    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                        {{ $empSal->employee->nameAr }}
                                </h3>
                            @else
                                {{ $empSal->employee->nameEn }}</h3>
                                @endif
                            </div>
                            <div class="card-body">

                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="empID"
                                                    value="{{ $empSal->id }}">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.basicsalary') }} </label>
                                                <input type="number"
                                                    class="form-control @error('basicSalary') is-invalid @enderror"
                                                    id="basicSalary" name="basicSalary" value="{{ $empSal->basicSalary }}"
                                                    onchange="todefault(this)">
                                                @error('basicSalary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">

                                                <input type="hidden"
                                                    class="form-control @error('fullSalary') is-invalid @enderror"
                                                    id="fullSalary" name="fullSalary" value="0">
                                                @error('fullSalary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Allowances') }} </label>
                                                <div class="row">
                                                    @if (count($empSal->Empallowan->where('type','allown') ) > 0)
                                                        <input type="hidden"
                                                            value="{{ count($empSal->Empallowan->where('type','allown') ) }}"id="alowncount">
                                                        @foreach ($empSal->Empallowan->where('type','allown')  as $index => $allowan)
                                                            <div class="col-lg-3 col-md-1 mb-3 text-center">
                                                                <label for="inputAddress2" class="form-label">
                                                                    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                                        <th>{{ $allowan->allow->nameAr }}</th>
                                                                    @else
                                                                        <th>{{ $allowan->allow->nameEn }}</th>
                                                                    @endif
                                                                </label>
                                                                <input type="number"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    value="{{ $allowan->value }}"
                                                                    name="allow{{ $index }}"
                                                                    id="allow{{ $index }}"
                                                                    onchange="todefault(this)">
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        @if (count($allowans) > 0)
                                                            <input type="hidden" value="{{ count($allowans) }}"
                                                                id="alowncount">
                                                            @foreach ($allowans as $index => $allowan)
                                                                <div class="col-lg-3 col-md-1 mb-3 text-center">
                                                                    <label for="inputAddress2"
                                                                        class="form-label">{{ $allowan->nameAr }} </label>
                                                                    <input type="number"
                                                                        class="form-control  text-center @error('name') is-invalid @enderror"
                                                                        value="0" name="allow{{ $index }}"
                                                                        id="allow{{ $index }}"
                                                                        onchange="todefault(this)">
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </div>



                                                {{-- <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>

                                                            <!--<th> Code ID</th>-->
                                                            @if (count($empalown) > 0)
                                                                <input type="hidden" value="{{ count($empalown) }}"
                                                                    id="alowncount">
                                                                @foreach ($empalown as $index => $allowan)
                                                                    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                                        <th>{{ $allowan->allow->nameAr }}</th>
                                                                    @else
                                                                        <th>{{ $allowan->allow->nameEn }}</th>
                                                                    @endif
                                                                @endforeach
                                                            @endif


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>


                                                            @if (count($empalown) > 0)
                                                                @foreach ($empalown as $index => $allowan)
                                                                    <td><input type="number"
                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                            value="{{ $allowan->value }}"
                                                                            name="allow{{ $index }}"
                                                                            id="allow{{ $index }}"
                                                                            onchange="todefault(this)"></td>
                                                                @endforeach
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table> --}}
                                            </div>



                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('HR.Discounts') }} </label>

                                                <div class="row">
                                                    @if (count($empSal->Empallowan->where('type','deducts') ) > 0)
                                                        <input type="hidden" value="{{ count($empSal->Empallowan->where('type','deducts') ) }}"
                                                            id="dedcount">
                                                        @foreach ($empSal->Empallowan->where('type','deducts') as $index => $ded)
                                                            <div class="col-lg-3 col-md-1 mb-3 text-center">
                                                                <label for="inputAddress2" class="form-label">
                                                                    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                                        <th>{{ $ded->allow->nameAr }}</th>
                                                                    @else
                                                                        <th>{{ $ded->allow->nameEn }}</th>
                                                                    @endif
                                                                </label>
                                                                <input type="number"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    name="ded{{ $index }}"
                                                                    id="ded{{ $index }}"
                                                                    value="{{ $ded->value }}" onchange="todefault(this)">
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        @if (count($deducts) > 0)
                                                            <input type="hidden" value="{{ count($allowans) }}"
                                                                id="alowncount">
                                                            @foreach ($deducts as $index => $ded)
                                                                <div class="col-lg-3 col-md-1 mb-3 text-center">
                                                                    <label for="inputAddress2"
                                                                        class="form-label">{{ $allowan->nameAr }} </label>
                                                                    <input type="number"
                                                                        class="form-control text-center @error('name') is-invalid @enderror"
                                                                        name="ded{{ $index }}"
                                                                        id="ded{{ $index }}" value="0"
                                                                        onchange="todefault(this)">
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </div>
                                                {{-- <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>

                                                            <!--<th> Code ID</th>-->
                                                            @if (count($empdeduct) > 0)
                                                                <input type="hidden" value="{{ count($empdeduct) }}"
                                                                    id="dedcount">
                                                                @foreach ($empdeduct as $index => $ded)
                                                                    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                                                                        <th>{{ $ded->allow->nameAr }}</th>
                                                                    @else
                                                                        <th>{{ $ded->allow->nameEn }}</th>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>


                                                            @if (count($empdeduct) > 0)
                                                                @foreach ($empdeduct as $index => $ded)
                                                                    <td><input type="number"
                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                            name="ded{{ $index }}"
                                                                            id="ded{{ $index }}"
                                                                            value="{{ $ded->value }}"
                                                                            onchange="todefault(this)"></td>
                                                                @endforeach
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table> --}}
                                            </div>



                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr class="my-4" />

                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name"> </label>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="{{ trans('HR.Save') }} "
                                        style="width: 100%" onclick="sumSal()">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <script>
        function todefault(type) {


            $sal = Number($('#basicSalary').val());

            @if (count($empSal->Empallowan->where('type','allown') ) > 0)
                @foreach ($empSal->Empallowan->where('type','allown')  as $index => $ded)
                    $sal = $sal + Number($('#allow{{ $index }}').val());
                @endforeach
            @else
                @if (count($allowans) > 0)
                    @foreach ($allowans as $index => $ded)
                        $sal = $sal + Number($('#allow{{ $index }}').val());
                    @endforeach
                @endif
            @endif

            @if (count($empSal->Empallowan->where('type','deducts')) > 0)
                @foreach ($empSal->Empallowan->where('type','deducts') as $index => $ded)
                    $sal = $sal - Number($('#ded{{ $index }}').val());
                @endforeach
            @else
                @if (count($deducts) > 0)
                    @foreach ($deducts as $index => $ded)
                        $sal = $sal - Number($('#ded{{ $index }}').val());
                    @endforeach
                @endif
            @endif



            $('#fullSalary').val($sal);



        }

        function sumSal() {

            let alowns = document.getElementById('alowncount').value;
            let deducts = document.getElementById('dedcount').value;
            let basic = document.getElementById('basicSalary').value;

            let total = Number(basic);
            let totAll = 0;
            let totDed = 0;


            for (let i = 0; i < alowns; i++) {
                let val = document.getElementById('allow' + i).value;
                totAll += Number(val);

            }
            for (let d = 0; d < deducts; d++) {
                let val = document.getElementById('ded' + d).value;
                totDed += Number(val);

            }
            total += totAll - totDed;
            document.getElementById('fullSalary').value = total;


        }

        function sumValue(type) {
            /*

             var basic = document.getElementById('basicSalary').value;
             var old = document.getElementById('fullSalary').value;
             var id = $(type).attr('id'); // English
             //alert(id);
              let val = document.getElementById(id).value;

              let newval= Number(old) + Number(basic) + Number(val) ;
              document.getElementById('fullSalary').value=newval;

              if(result != 0)
              {
                alert("خطأ في كتابة المقاس");
                document.getElementById(id).value ="0.00";
                document.getElementById(id).focus();
              }
              */
        }
    </script>
@endsection
