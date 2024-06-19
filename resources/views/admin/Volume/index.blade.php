@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        @if (auth()->user()->organization->activity == 2)
                            {{ trans('Products.Ingredients') }}
                        @else
                            {{ trans('admin.Productcomponents') }}
                        @endif
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">
                                @if (auth()->user()->organization->activity == 2)
                                    {{ trans('Products.Ingredients') }}
                                @else
                                    {{ trans('admin.Productcomponents') }}
                                @endif
                            </a></li>
                        <li class="breadcrumb-item active">
                            @if (auth()->user()->organization->activity == 2)
                                {{ trans('Products.listIngredients') }}
                            @else
                                {{ trans('admin.Productcomponentslist') }}
                            @endif
                        </li>
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
                            <h3 class="card-title">
                                @if (auth()->user()->organization->activity == 2)
                                    {{ trans('Products.listIngredients') }}
                                @else
                                    {{ trans('admin.Productcomponentslist') }}
                                @endif
                            </h3>
                            <a href="#" data-toggle="modal" data-target="#AcountGridel"
                                class="btn btn-primary btnAddsys"><i class="fa fa-plus"></i> {{ trans('Products.Add') }}
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> {{ trans('Products.productname') }} </th>
                                        <th> {{ trans('Products.Numberofcomponents') }} </th>
                                        <th> {{ trans('Products.Totalcostoftheproduct') }} </th>
                                        <th> {{ trans('Products.Averagecost') }} </th>
                                        <th> {{ trans('Products.Options') }} </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($Volume) > 0)
                                        @foreach ($Volume as $index => $row)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $row->nameprodect }}</td>
                                                <td>{{ $row->countVol }}</td>
                                                <td>{{ $row->totalcost }}</td>
                                                <!--<td>{{ $row->totalguenty }}</td>-->
                                                <td>{{ $row->costvol }}</td>
                                                <td>
                                                    <a href="{{ route('Volume.show', $row->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-eye"></i>
                                                        {{ trans('Products.Show') }} </a>
                                                    <a href="{{ route('Volume.edit', $row->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-edit"></i>
                                                        {{ trans('Products.Edite') }} </a>
                                                    <a href="{{ route('Volume.delete', $row->id) }}"
                                                        class="btn btn-danger"><i class="fa fa-trash"></i>
                                                        {{ trans('Products.Delete') }} </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center"> {{ trans('Products.NoFound') }}</td>
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


<div class="modal fade modal" id="AcountGridel" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"> {{ trans('Products.ListProducts') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-12 row mt-3">
                <div class="col-12">
                    <form class="user" id="passwordForm" method="get" action="{{ route('Volume.create') }}"
                        enctype = "multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ trans('Products.Products') }}
                            </label>
                            <div class="col-sm-10">
                                <select name="Prodect" id="Prodect" class="form-control">
                                    @if (count($Product) > 0)
                                        @foreach ($Product as $item)
                                            <?php $falage = 0; ?>
                                            @if (count($Volume) > 0)
                                                @foreach ($Volume as $index => $row)
                                                    @if ($item->id == $row->ProdectID)
                                                        <?php $falage = 1; ?>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if ($falage == 0)
                                                <option value="{{ $item->id }}">{{ $item->nameAr }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <button type="submit " style="margin: 0px 81px;"
                            class="btn btn-primary">{{ trans('Products.Search') }} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
