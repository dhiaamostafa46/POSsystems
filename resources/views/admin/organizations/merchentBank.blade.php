@extends('layouts.dashboard')
<style>
/* Style all input fields */
input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
}

/* Style the container for inputs */
.container {
  background-color: #f1f1f1;
  padding: 20px;
}

/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 2px;
}

#message p {
  padding: 5px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  right: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  right: -35px;
  content: "✖";
}
</style>
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">بيانات المنشأة</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">ربط بوابة الدفع</a></li>
          <li class="breadcrumb-item active">بيانات المنشأة</li>
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
                <h3 class="card-title">بيانات البنك</h3>
              </div>
              <div class="card-body">
                <form class="user" method="POST" action="{{route('payment.storeBank')}}" enctype = "multipart/form-data">
                  @method('POST')
                  @csrf
                  <div class="pl-lg-4">
                    <div class="row">
                      
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="bankName">اختيار البنك</label>
                          <select type="text" class="form-control @error('bankName') is-invalid @enderror" id="bankName" name="bankName" required>
                            <option value="">اختر البنك</option>
                            @foreach (session('banks') as $bank)
                            <option value="{{$bank['bankName']}}" @if(session('bankName') == $bank['bankName']) selected @endif>{{$bank['bankNameAr']}}</option>
                            @endforeach
                          </select>
                          @error('bankName')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="iban">الآيبان IBAN</label>
                          
                          <div class="input-group-append">
                            <input type="text" style="direction: ltr" oninvalid="this.setCustomValidity('يجب ان يتكون من 22 رقم')"
                            oninput="this.setCustomValidity('')" pattern="[0-9]" minlength="22"  class="form-control @error('iban') is-invalid @enderror" id="iban" name="iban" placeholder="ادخل الآيبان" value="{{session('iban')}}" required>
                            <div class="input-group-text">
                              <span>SA</span>
                            </div>
                          </div>
                          @error('iban')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="salesVolume">الدخل الشهري بالريال</label>
                          <select class="form-control @error('salesVolume') is-invalid @enderror" id="salesVolume" name="salesVolume" required>
                            <option value="">اختر الدخل الشهري</option>
                              @foreach (session('monthlySalesVolumes') as $value)
                              <option value="{{$value['salesVolumeValue']}}" @if(session('salesVolume') == $value['salesVolumeValue']) selected @endif>{{$value['salesVolumeNameAr']}}</option>
                              @endforeach   
                          </select>
                          @error('salesVolume')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="licenseName">اسم المنشأة</label>
                          <input type="text" class="form-control @error('licenseName') is-invalid @enderror" id="licenseName" name="licenseName"  value="{{session('licenseName')}}" readonly>
                          @error('licenseName')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="sellingScope">نطاق العمل</label>
                          <select type="text" class="form-control @error('sellingScope') is-invalid @enderror" id="sellingScope" name="sellingScope" required>
                              <option value="domestic" @if(session('sellingScope') == "domestic") selected @endif>داخل السعودية</option>
                              <option value="global" @if(session('sellingScope') == "global") selected @endif>داخل وخارج السعودية</option>
                          </select>
                          @error('sellingScope')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="categoryDescription">وصف نشاط المنشأة <span style="font-size: small;color:firebrick">(لا يقل عن 100 حرف)</label>
                          <textarea class="form-control @error('categoryDescription') is-invalid @enderror" oninvalid="this.setCustomValidity('يجب ان لا يقل عن 100 حرف')"
                          oninput="this.setCustomValidity('')" minlength="100" id="categoryDescription" name="categoryDescription" placeholder="اكتب ما لا يقل عن 100 حرف" required>{{session('categoryDescription')}}</textarea>
                          @error('categoryDescription')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="nationalId">رقم الهوية</label>
                          <select class="form-control @error('nationalId') is-invalid @enderror" id="nationalId" name="nationalId" required>
                              @foreach (session('nationalIds') as $value)
                              <option value="{{$value}}" @if(session('nationalId') == $value) selected @endif>{{$value}}</option>
                              @endforeach   
                          </select>
                          @error('nationalId')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="Email">البريد الالكتروني</label>
                          <input type="email" class="form-control @error('Email') is-invalid @enderror" id="Email" name="Email" placeholder="ادخل الايميل" value="{{session('email')}}" required>
                          @error('Email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">الاسم الأول والأخير</label>
                          <div class="row">
                            <div class="col-6">
                              <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName" name="firstName" value="{{session('firstName')}}" placeholder="الاسم الأول" required>
                            </div>
                            <div class="col-6">
                              <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" name="lastName" value="{{session('lastName')}}" placeholder="الاسم الأخير" required>
                            </div>
                          </div>
                          @error('firstName')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="password">كلمة المرور</label>
                          <input type="text" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="يجب ان يتكون من حرف كبير وحرف صغير ورمز ورقم ولا يقل عن 8 خانات" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="ادخل كلمة المرور" required>
                          @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div id="message" style="direction: rtl;text-align:right">
                          <h3>كلمة المرور يجب ان تحتوي على:</h3>
                          <p id="letter" class="invalid" style="margin-top: 2px;margin-bottom:2px;padding-top:2px;padding-bottom:2px">حرف صغير</p>
                          <p id="capital" class="invalid" style="margin-top: 2px;margin-bottom:2px;padding-top:2px;padding-bottom:2px">حرف كبير</p>
                          <p id="number" class="invalid" style="margin-top: 2px;margin-bottom:2px;padding-top:2px;padding-bottom:2px">رقم</b></p>
                          <p id="length" class="invalid" style="margin-top: 2px;margin-bottom:2px;padding-top:2px;padding-bottom:2px">اقل شي 8 خانات</p>
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-last-name"> </label>
                          <br>
                          <input type="submit" class="btn btn-primary" value="التالي" style="width: 100%">
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <hr class="my-4" />
                </form>
                
              </div>
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
			
<script>
  var myInput = document.getElementById("password");
  var letter = document.getElementById("letter");
  var capital = document.getElementById("capital");
  var number = document.getElementById("number");
  var length = document.getElementById("length");
  
  // When the user clicks on the password field, show the message box
  myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
  }
  
  // When the user clicks outside of the password field, hide the message box
  myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
  }
  
  // When the user starts to type something inside the password field
  myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) {  
      letter.classList.remove("invalid");
      letter.classList.add("valid");
    } else {
      letter.classList.remove("valid");
      letter.classList.add("invalid");
    }
    
    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {  
      capital.classList.remove("invalid");
      capital.classList.add("valid");
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
    }
  
    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {  
      number.classList.remove("invalid");
      number.classList.add("valid");
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
    }
    
    // Validate length
    if(myInput.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }
  }
  </script>
@endsection
