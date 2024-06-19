@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ trans('sitting.Sitting') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb floatmleft">
                        <li class="breadcrumb-item"><a href="#">{{ trans('sitting.generalSitting') }} </a></li>
                        <li class="breadcrumb-item active"> {{ trans('sitting.Sitting') }} </li>
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
                            <h3 class="card-title"> {{ trans('sitting.generalSitting') }} </h3>
                        </div>
                        <div class="card-body">
                            <form class="user" method="POST" action="{{ route('Sitting.update', $inv->id) }}"
                                enctype = "multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('sitting.Billcounter') }} </label>
                                                <input type="number" class="form-control" name="Bill"
                                                    value="{{ $inv->Inv }}"
                                                    placeholder="{{ trans('sitting.Billcounter') }} " required>
                                                @error('nameAr')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">
                                                    {{ trans('sitting.Numberproducts') }} </label>
                                                <input type="number" class="form-control " id="nameEn"
                                                    value="{{ $inv->proud }}" name="product"
                                                    placeholder=" {{ trans('sitting.Numberproducts') }}" required>
                                                @error('nameEn')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name"> </label>
                                                <br>
                                                <input type="submit" class="btn btn-primary"
                                                    value="{{ trans('permissions.save') }}" style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <hr class="my-4" />
                        </form>
                    </div>
                    @if ( auth()->user()->organization->PackageList->where('end', '>', date('Y-m-d') )->contains('code' ,$package->where('nameEn','Online')->first()->nameEn)  )
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> إعدادات المتجر الإلكتروني </h3>
                            </div>
                            <div class="card-body">
                                <form class="user" method="POST" action="{{ route('setting.storeUpdate') }}"
                                    enctype = "multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="pl-lg-4">
                                        <div class="row">

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username"> اللون الأساسي
                                                    </label>
                                                    <input type="color" class="form-control " id="color"
                                                        @if ($storsetting == null) value="#35d5b6" @else value="{{ $storsetting->storecolor }}" @endif
                                                        name="color" required>
                                                    {{-- <input type="text"  class="form-control " id="color"    name="color"  placeholder="أدخل كود اللون مثال : a0f1e4#" required> --}}
                                                    @error('color')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username"> لون الخط الأساسي
                                                    </label>
                                                    <input type="color" class="form-control " id="color"
                                                        @if ($storsetting == null) value="#fff" @else value="{{ $storsetting->fontcolor }}" @endif
                                                        name="fontcolor" required>
                                                    {{-- <input type="text"  class="form-control " id="color"    name="color"  placeholder="أدخل كود اللون مثال : a0f1e4#" required> --}}
                                                    @error('color')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username"> لون خط سعر المنتج
                                                    </label>
                                                    <input type="color" class="form-control " id="color"
                                                        @if ($storsetting == null) value="#000000" @else value="{{ $storsetting->pricecolor }}" @endif
                                                        name="pricecolor" required>
                                                    {{-- <input type="text"  class="form-control " id="color"    name="color"  placeholder="أدخل كود اللون مثال : a0f1e4#" required> --}}
                                                    @error('color')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username"> لون خط عناوين
                                                        الأقسام </label>
                                                    <input type="color" class="form-control " id="color"
                                                        @if ($storsetting == null) value="#000000" @else value="{{ $storsetting->catcolor }}" @endif
                                                        name="catcolor" required>
                                                    {{-- <input type="text"  class="form-control " id="color"    name="color"  placeholder="أدخل كود اللون مثال : a0f1e4#" required> --}}
                                                    @error('color')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                             <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username"> QrCodeصورة الخلفية للصفحة ال  
                                                        الأقسام </label>
                                                    <input type="file" class="form-control " id="color" name="backPhoto" >
                                                
                                                    @error('backPhoto')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-last-name"> </label>
                                                    <br>
                                                    <input type="submit" class="btn btn-primary"
                                                        value="{{ trans('permissions.save') }}" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <hr class="my-4" />
                            </form>
                        </div>
                        <!-- /.card-body -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> إعدادات روابط التواصل </h3>
                            </div>
                            <div class="card-body">
                                <form class="user" method="POST" action="{{ route('storeSettingUpdatelink') }}"
                                    enctype = "multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <input type="hidden" name="id" id=""  value="{{ $storsetting->id}}" >

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Facebook </label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                                        </div>
                                                        </div>
                                                        <input type="url" name="Facebook"  value="{{ $storsetting->Facebook}}" class="form-control" id="inlineFormInputGroup" placeholder="Facebook">
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Twitter </label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                                        </div>
                                                        </div>
                                                        <input type="url" name="Twitter"   value="{{ $storsetting->Twitter}}" class="form-control" id="inlineFormInputGroup" placeholder="Twitter">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Instagram </label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-instagram" aria-hidden="true"></i>
                                                        </div>
                                                        </div>
                                                        <input type="url" name="Instagram"  value="{{ $storsetting->Instagram}}" class="form-control" id="inlineFormInputGroup" placeholder="Instagram">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Snapchat </label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-snapchat" aria-hidden="true"></i>
                                                        </div>
                                                        </div>
                                                        <input type="url" name="Snapchat" value="{{ $storsetting->Snapchat}}" class="form-control" id="inlineFormInputGroup" placeholder="Snapchat">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">LinkedIn </label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                                                        </div>
                                                        </div>
                                                        <input type="url" name="LinkedIn" value="{{ $storsetting->LinkedIn}}"  class="form-control" id="inlineFormInputGroup" placeholder="LinkedIn">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">YouTube </label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-youtube" aria-hidden="true"></i>
                                                        </div>
                                                        </div>
                                                        <input type="url" name="YouTube"  value="{{ $storsetting->YouTube}}" class="form-control" id="inlineFormInputGroup" placeholder="YouTube">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">TikTok </label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-tiktok" aria-hidden="true"></i>
                                                        </div>
                                                        </div>
                                                        <input type="url" name="TikTok" value="{{ $storsetting->TikTok}}"  class="form-control" id="inlineFormInputGroup" placeholder="TikTok">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">WhatsApp </label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                                        </div>
                                                        </div>
                                                        <input type="url" name="WhatsApp"  value="{{ $storsetting->WhatsApp}}"  class="form-control" id="inlineFormInputGroup" placeholder="WhatsApp">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Pinterest </label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                                                        </div>
                                                        </div>
                                                        <input type="url" name="Pinterest"   value="{{ $storsetting->Pinterest}}"  class="form-control" id="inlineFormInputGroup" placeholder="Pinterest">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Messenger </label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-messenger" aria-hidden="true"></i>
                                                        </div>
                                                        </div>
                                                        <input type="url" name="Messenger" value="{{ $storsetting->Messenger}}"  class="form-control" id="inlineFormInputGroup" placeholder="Messenger">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Google </label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-google" aria-hidden="true"></i>
                                                        </div>
                                                        </div>
                                                        <input type="url" name="Google"value="{{ $storsetting->Google}}"   class="form-control" id="inlineFormInputGroup" placeholder="Google">
                                                    </div>

                                                </div>
                                            </div>




                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-last-name"> </label>
                                                    <br>
                                                    <input type="submit" class="btn btn-primary"
                                                        value="{{ trans('permissions.save') }}" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <hr class="my-4" />
                            </form>
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
