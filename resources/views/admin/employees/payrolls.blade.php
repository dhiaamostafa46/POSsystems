@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> {{ trans('HR.payrolls') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb floatmleft">
            <li class="breadcrumb-item"><a href="#">{{ trans('HR.employees') }}</a></li>
            <li class="breadcrumb-item active"> {{ trans('HR.payrolls') }}</li>
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
                <h3 class="card-title">  {{ trans('HR.payrolls') }} </h3>

                <a type="button" onclick="showModal()"  class="btn btn-primary floatmleft"><i class="fa fa-plus"></i>  {{ trans('HR.Issuingpayroll') }}</a>
               <!--route('employees.newPayroll',1)-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <div  class="row">
                <div  class="col-3">
                  <div class="form-group">
                   <input  type="month" class="form-control" id="month" name="month" onchange="enable()" value="{{$month}}">

                  </div>
                </div>
                <div  class="col-4">
                  <div class="form-group">

                   <input type="hidden" class="mt-1 autocomplete form-control" id="monthid" name="monthid">
                   <button  id="monthbtn" class="btn btn-primary" style="width: 25%;display:inline-block" @disabled(true) onclick="getbymonth()"  id="find">{{ trans('HR.review') }}</button>
                   <button  id="monthbtn" class="btn btn-primary" style="width: 25%;display:inline-block"  target="_blank" onclick="print()"  id="print">  {{ trans('HR.print') }}</button>
                  </div>
                </div>
              </div>
              @if(session('PayrollError') != null)<h3 class="alert alert-warning"> {{session('PayrollError')}}</h3>@endif

              {{session()->put('PayrollError',null)}}
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <!--<th> Code ID</th>-->
                    <th>{{ trans('HR.name') }}</th>
                    <th> {{ trans('HR.basicsalary') }}</th>
                    <th > {{ trans('HR.totalsalary') }} </th>


                    @foreach ($allowns as $index => $item)
                    @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl")
                       <th > {{$item->nameAr}} </th>
                    @else
                       <th > {{$item->nameEn}} </th>
                    @endif

                    @endforeach
                    @foreach ($deducts as $index => $itm)
                    @if (LaravelLocalization::getCurrentLocaleDirection() =="rtl")
                       <th > {{$itm->nameAr}} </th>
                    @else
                        <th > {{$itm->nameEn}} </th>
                    @endif
                    @endforeach
                    <th> {{ trans('HR.Penalties') }}</th>
                    <th> {{ trans('HR.Salafis') }}</th>

                    <th >  {{ trans('HR.remainingsalary') }} </th>
                  </tr>

                  </thead>
                  <tbody>
                    <?php $allNetSal=0;  ?>
                    @if (count($payrolls) > 0)
                    @foreach ($payrolls as $index => $salary)
                    <tr>
                      <td>{{$index+1}}</td>
                      <td>{{$salary->employee->nameAr}}</td>
                      <td>{{$salary->salary->basicSalary}}</td>
                      <td>{{$salary->salary->fullSalary}}</td>

                     <?php $all = json_decode($salary->allowns);
                          $allSum = 0;
                     ?>

                     @foreach ($all as $index => $item)
                         <?php $allSum += $item; ?>
                        <td>{{$item}}</td>
                      @endforeach
                      <?php $alld = json_decode($salary->deducts);
                         $allDed = 0;
                      ?>
                      {{-- @dd($alld); --}}
                      @foreach ($alld as $index => $item)
                       <?php $allDed += $item; ?>
                         <td>{{$item}}</td>
                       @endforeach
                        <td>{{$salary->penalties}}</td>
                        <td>{{$salary->advances}}</td>
                      <td>{{$salary->netSalary}}</td>

                      <?php $allNetSal += $salary->netSalary;?>

                    </tr>
                    @endforeach

                  @else
                      <tr>
                        <td colspan="7" class="text-center">  {{ trans('HR.NotFoundData') }} </td>
                      </tr>
                  @endif
                   <tfoot>
                    <?php $allam = count($allowns) + count($deducts);
                    $col = $allam +5;
                  ?>
                  <th colspan="2">  {{ trans('HR.Total') }}</th><th colspan="{{$col}}">{{$allNetSal}}</th>

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

    <div class="modal fade modal" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">    {{ trans('HR.Issuingpayroll') }}    </h5>
           <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>-->
          </div>
          <form class="user" method="POST" action="" enctype = "multipart/form-data">
            @csrf
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-username">  {{ trans('HR.Payrollforthemonth') }}  :</label>
                    <input type="month"  class="form-control @error('nameAr') is-invalid @enderror" id="month" name="month">
                    @error('nameAr')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                </div>


              </div>

                <div class="modal-footer">
                  <button type="button" onclick="createSlaries()" class="btn btn-primary" style="float:right"> {{ trans('HR.Issuing') }}</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right"> {{ trans('HR.retreat') }} </button>
                </div>
              </div>



            </div>
            </div>
            <hr class="my-4" />
          </form>




@endsection
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
  function handleDelete(id){
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
        window.location.href = "/delete-customer/"+id;
      }
    })
  }
  function showModal() {




       $('#CreateModal').modal('show')
    }
    function createSlaries()
  {
    var month = document.getElementById('month').value;
    window.location.href = 'http://localhost:8000/newPayroll/'+month;
  }

    function enable()
  {

    document.getElementById("monthbtn").disabled=false;;


  }

  function print()
  {
    var t =document.getElementById("month").value;

    window.location.href = 'http://localhost:8000/showPage/'+t;

  }
  function getbymonth()
  {

    var t =document.getElementById("month").value;
    var r =new Date(t).getMonth();

    window.location.href = 'http://localhost:8000/payrollsbymonth/'+t;

   // alert(t);

  }
</script>
