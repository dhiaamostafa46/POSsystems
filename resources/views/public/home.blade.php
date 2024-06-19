@extends('layouts.websitedashboard')

@section('content')


<section class="wrapper bg-dark angled lower-start">
  <div class="swiper-container swiper-hero dots-over" data-margin="0" data-autoplay="true" data-autoplaytime="5000" data-nav="true" data-dots="true" data-items="1">
    <div class="swiper" id="slideshow">
      <div class="swiper-wrapper">
        <div class="swiper-slide h-100 bg-overlay bg-overlay-400 bg-dark" style="background-image:url(./assets/img/website/headerFull.png);">
          <div class="container h-100">
            <div class="row h-100">
              <div class="col-md-10 offset-md-1 col-lg-7 offset-lg-0 col-xl-6 col-xxl-5 text-center text-lg-start justify-content-center align-self-center align-items-start">
                <h2 class="lead fs-23 lh-sm mb-7 text-white animate__animated animate__slideInRight animate__delay-1s tajawal-bold"style="direction:rtl">{{trans('website.header1')}}</h2>
                <h2 class="display-1 fs-56 mb-4 text-white animate__animated animate__slideInDown animate__delay-2s tajawal-bold">{{trans('website.header1-2')}}</h2>

                <div class="animate__animated animate__slideInUp animate__delay-3s"><a href="{{route('register')}}" class="btn btn-lg btn-white rounded-pill tajawal-bold">{{trans('website.readmore')}}</a></div>
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          </div>
          <!--/.container -->
        </div>
        <!--/.swiper-slide -->
        {{-- <div class="swiper-slide h-100 bg-overlay bg-overlay-400 bg-dark" style="background-image:url(./assets/img/photos/bg8.jpg);">
          <div class="container h-100">
            <div class="row h-100">
              <div class="col-md-11 col-lg-8 col-xl-7 col-xxl-6 mx-auto text-center justify-content-center align-self-center">
                <h2 class="display-1 fs-56 mb-4 text-white animate__animated animate__slideInDown animate__delay-1s">We are trusted by over a million customers.</h2>
                <p class="lead fs-23 lh-sm mb-7 text-white animate__animated animate__slideInRight animate__delay-2s">Here a few reasons why our customers choose us.</p>
                <div class="animate__animated animate__slideInUp animate__delay-3s"><a href="./assets/media/movie.mp4" class="btn btn-circle btn-white btn-play ripple mx-auto mb-5" data-glightbox><i class="icn-caret-right"></i></a></div>
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          </div>
          <!--/.container -->
        </div>
        <!--/.swiper-slide -->
        <div class="swiper-slide h-100 bg-overlay bg-overlay-400 bg-dark" style="background-image:url(./assets/img/photos/bg9.jpg);">
          <div class="container h-100">
            <div class="row h-100">
              <div class="col-md-10 offset-md-1 col-lg-7 offset-lg-5 col-xl-6 offset-xl-6 col-xxl-5 offset-xxl-6 text-center text-lg-start justify-content-center align-self-center align-items-start">
                <h2 class="display-1 fs-56 mb-4 text-white animate__animated animate__slideInDown animate__delay-1s">Just sit and relax.</h2>
                <p class="lead fs-23 lh-sm mb-7 text-white animate__animated animate__slideInRight animate__delay-2s">We make sure your spending is stress free so that you can have the perfect control.</p>
                <div class="animate__animated animate__slideInUp animate__delay-3s"><a href="#" class="btn btn-lg btn-outline-white rounded-pill">Contact Us</a></div>
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          </div>
          <!--/.container -->
        </div> --}}
        <!--/.swiper-slide -->
      </div>
      <!--/.swiper-wrapper -->
    </div>
    <!-- /.swiper -->
  </div>
  <!-- /.swiper-container -->
    <!-- /.container -->
  </section>
  <!-- /section -->

    <section class="wrapper bg-light">
      <br /><br /><br />
      <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
          <div class="col-md-8 col-lg-6 col-xl-5 order-lg-2 position-relative">
            <div class="shape bg-soft-primary rounded-circle rellax w-20 h-20" data-rellax-speed="1" style="top: -2rem; right: -1.9rem;"></div>
            <figure class="rounded">
              {{-- <img src="./assets/img/photos/aboutPic550.jpg" srcset="./assets/img/website/aboutPic.png 2x" alt=""> --}}
              <img class="rounded" src="./assets/img/website/aboutPic.png" srcset="./assets/img/website/aboutPic.png 2x" alt="">
            </figure>
           {{-- <img class="rounded" src="./assets/img/website/about7.jpg" srcset="./assets/img/website/aboutPic.png 2x" alt=""> --}}
          </div>
          <!--/column -->
          <div class="col-lg-6">
            <h2 class="display-4 mb-3">{{trans('website.AboutEvix')}}</h2>
            <p class="lead fs-lg" style="text-align: justify;">

                {{trans('website.AboutDet')}}
            </p>
            {{-- <p class="mb-6">Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p> --}}
            <div class="row gx-xl-10 gy-6">
              <div class="col-md-6">
                <div class="d-flex flex-row">
                  <div>
                    <img src="./assets/img/icons/lineal/target.svg" class="svg-inject icon-svg icon-svg-sm me-4" alt="" />
                  </div>
                  <div>
                    <h4 class="mb-1 tajawal-bold">{{trans('website.Objective')}}</h4>
                    <p class="mb-0">{{trans('website.ObjDet')}} </p>
                  </div>
                </div>
              </div>
              <!--/column -->
              <div class="col-md-6">
                <div class="d-flex flex-row">
                  <div>
                    <img src="./assets/img/icons/lineal/award-2.svg" class="svg-inject icon-svg icon-svg-sm me-4" alt="" />
                  </div>
                  <div>
                    <h4 class="mb-1 tajawal-bold"> {{trans('website.Values')}}</h4>
                    <p class="mb-0"> {{trans('website.ValDet')}}</p>
                  </div>
                </div>
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!------------------------------------------------------------------------------------------------------------------------------------------------------>
      <div class="container py-14 py-md-17">
        <div class="row text-center">
          <div class="col-md-10 offset-md-1 col-lg-9 mx-auto offset-lg-2">
            <h2 class="fs-25 text-uppercase text-primary mb-3 tajawal-bold"> {{trans('website.whyEvix')}}  </h2>
            <h3 class="display-4 mb-10 px-xl-10 tajawal-bold">{{trans('website.whyEvixDet')}}</h3>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="position-relative mb-14 mb-md-17">
          <div class="shape rounded-circle bg-soft-primary rellax w-16 h-16" data-rellax-speed="1" style="bottom: -0.5rem; right: -2.5rem; z-index: 0;"></div>
          <div class="shape bg-dot primary rellax w-16 h-17" data-rellax-speed="1" style="top: -0.5rem; left: -2.5rem; z-index: 0;"></div>
          <div class="row gx-md-5 gy-5 text-center">
            <div class="col-md-6 col-xl-3">
              <div class="card" style="height: 350px">
                <div class="card-body">
                  <div class="icon  btn-lg btn-primary pe-none mb-3">
                    <img src="{{asset('assets/img/website/whyIcon3.png')}}">
                    </div>

                  <h4 class="tajawal-bold">{{trans('website.24support')}}</h4>
                  <p class="mb-2" style="height:120px;text-align: justify;">
                         {{trans('website.24supportDet')}}
                  </p>

                </div>
                <!--/.card-body -->
              </div>
              <!--/.card -->
            </div>
            <!--/column -->
            <div class="col-md-6 col-xl-3">
              <div class="card" style="height: 350px">
                <div class="card-body">
                  {{-- <div class="icon btn btn-circle btn-lg btn-primary pe-none mb-3">
                    <i class="uil uil-shield-exclamation"></i>
                  </div> --}}
                  <div class="icon  btn-lg btn-primary pe-none mb-3">
                    <img src="{{asset('assets/img/website/whyIcon1.png')}}">
                  </div>
                  <h4 class="tajawal-bold">{{trans('website.vat')}}  </h4>
                  <p class="mb-2" style="height:120px;text-align: justify;">
                   {{trans('website.vatDet')}}
                  </p>

                </div>
                <!--/.card-body -->
              </div>
              <!--/.card -->
            </div>
            <!--/column -->
            <div class="col-md-6 col-xl-3">
              <div class="card" style="height: 350px">
                <div class="card-body">
                  {{-- <div class="icon btn btn-circle btn-lg btn-primary pe-none mb-3">
                    <i class="uil uil-laptop-cloud"></i>
                  </div> --}}
                  <div class="icon  btn-lg btn-primary pe-none mb-3">
                    <img src="{{asset('assets/img/website/whyIcon2.png')}}">
                    </div>
                  <h4 class="tajawal-bold">{{trans('website.fullSys')}} </h4>
                  <p class="mb-2" style="height:120px;text-align: justify;">
                  {{trans('website.fullSysDet')}}
                  </p>

                </div>
                <!--/.card-body -->
              </div>
              <!--/.card -->
            </div>
            <!--/column -->
            <div class="col-md-6 col-xl-3">
              <div class="card" style="height: 350px">
                <div class="card-body">
                  {{-- <div class="icon btn btn-circle btn-lg btn-primary pe-none mb-3">
                    <i class="uil uil-chart-line"></i>
                   </div> --}}
                   <div class="icon  btn-lg btn-primary pe-none mb-3">
                    <img src="{{asset('assets/img/website/whyIcon4.png')}}">
                    </div>
                  <h4 class="tajawal-bold">{{trans('website.pack')}}</h4>
                  <p class="mb-2" style="height:120px;text-align: justify;">
                     {{trans('website.packDet')}}
                  </p>

                </div>
                <!--/.card-body -->
              </div>
              <!--/.card -->
            </div>
            <!--/column -->
          </div>
          <!--/.row -->
        </div>
        <!-- /.position-relative -->
        {{-- <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center mb-14 mb-md-17">
          <div class="col-lg-7">
            <figure><img class="w-auto" src="{{asset('assets/img/illustrations/i11.png')}}" srcset="{{asset('assets/img/illustrations/i11@2x.png 2x')}}" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col-lg-5">
            <h2 class="fs-15 text-uppercase text-primary mb-3">{{trans('website.EvixSolution')}}</h2>
            <h3 class="display-4 mb-7">{{trans('website.pack')}}</h3>
            <div class="accordion accordion-wrapper" id="accordionExample">
              <div class="card plain accordion-item">
                <div class="card-header" id="headingOne">
                  <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> فواتير ضريبية معتمدة </button>
                </div>
                <!--/.card-header -->
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="card-body">
                    <p style="text-align: justify;">
                        نظام إيفكس معتمد من هبئة الذكاة والدخل, مما يمكنك من إصدار فواتير ضريبية صحيحة ومعتمدة.
                    </p>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.accordion-collapse -->
              </div>
              <!--/.accordion-item -->
              <div class="card plain accordion-item">
                <div class="card-header" id="headingTwo">
                  <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> التخزين السحابي </button>
                </div>
                <!--/.card-header -->
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="card-body">
                    <p style="text-align: justify;">
                      مع ميزة التخزين السحابي تمتع بمساحة غير محدوده لحفظ بيانات منشأتك (المنتجات - تقارير المبيعات المشتريات ...إلخ)  مع إمكانية الوصول لها في اي وقت ومن اي مكان  عن طريق الجوال او اللابتوب.
                    </p>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.accordion-collapse -->
              </div>
              <!--/.accordion-item -->
              <div class="card plain accordion-item">
                <div class="card-header" id="headingThree">
                  <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Header and Slider Options </button>
                </div>
                <!--/.card-header -->
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="card-body">
                    <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel.</p>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.accordion-collapse -->
              </div>
              <!--/.accordion-item -->
            </div>
            <!--/.accordion -->
          </div>
          <!--/column -->
        </div> --}}
        <!--/.row -->

        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-gray">
        <div class="container py-14 pt-md-0 pb-md-16">
          <div class="row mt-md-n50p mb-14 mb-md-7">
            <div class="col-xl-10 mx-auto">
              {{-- <div class="card image-wrapper bg-full bg-image bg-overlay bg-overlay-400" data-image-src="{{asset('assets/img/photos/bg2.jpg')}}">
                <div class="card-body p-9 p-xl-11">
                  <div class="row align-items-center counter-wrapper gy-8 text-center text-white">
                    <div class="col-6 col-lg-3">
                      <h3 class="counter counter-lg text-white">7518</h3>
                      <p>Completed Projects</p>
                    </div>
                    <!--/column -->
                    <div class="col-6 col-lg-3">
                      <h3 class="counter counter-lg text-white">3472</h3>
                      <p>Happy Customers</p>
                    </div>
                    <!--/column -->
                    <div class="col-6 col-lg-3">
                      <h3 class="counter counter-lg text-white">2184</h3>
                      <p>Expert Employees</p>
                    </div>
                    <!--/column -->
                    <div class="col-6 col-lg-3">
                      <h3 class="counter counter-lg text-white">4523</h3>
                      <p>Awards Won</p>
                    </div>
                    <!--/column -->
                  </div>
                  <!--/.row -->
                </div>
                <!--/.card-body -->
              </div> --}}
              <!--/.card -->
            </div>
            <!-- /column -->
          </div>
          <!-- /.row -->
          <div class="row text-center">
            <div class="col-lg-9 col-xl-8 col-xxl-7 mx-auto">
              <h2 class="text-uppercase text-primary mb-3">{{trans('website.EvixSolution')}}</h2>
              <h3 class="display-4 mb-10 px-xl-10 tajawal-bold">{{trans('website.EvixSolutionDet')}} </h3>
            </div>
            <!-- /column -->
          </div>
          <!-- /.row -->
          <div class="position-relative">
            <div class="shape bg-dot primary rellax w-17 h-20" data-rellax-speed="1" style="top: 0; left: -1.7rem;"></div>
            <div class="swiper-container dots-closer blog grid-view mb-6" data-margin="0" data-dots="true" data-items-xl="3" data-items-md="2" data-items-xs="1">
              <div class="swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide"  id="rest">
                    <div class="item-inner">
                      <article>
                        <div class="card" style="height: 500px">
                          <figure class="card-img-top overlay overlay-1 hover-scale"><a href="#"> <img src="{{asset('assets/img/website/services/resturant.png')}}" alt="" /></a>
                            <figcaption>
                              <h5 class="from-top mb-0">{{trans('website.readmore')}}</h5>
                            </figcaption>
                          </figure>
                          <div class="card-body">
                            <div class="post-header">
                              <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="#">{{trans('website.resturant')}}</a></h2>
                            </div>
                            <!-- /.post-header -->
                            <div class="post-content">

                               <p style="text-align: justify;">
                                  {{trans('website.restDet')}}
                              </p>
                            </div>
                            <!-- /.post-content -->
                          </div>
                          <!--/.card-body -->


                        </div>
                        <!-- /.card -->
                      </article>
                      <!-- /article -->
                    </div>
                    <!-- /.item-inner -->
                  </div>
                  <!--/.swiper-slide -->
                  <div class="swiper-slide" id="acc">
                    <div class="item-inner">
                      <article>
                        <div class="card" style="height: 500px">
                          <figure class="card-img-top overlay overlay-1 hover-scale"><a href="#"> <img src="{{asset('assets/img/website/services/accounting.png')}}" alt="" /></a>
                            <figcaption>
                              <h5 class="from-top mb-0">{{trans('website.readmore')}}</h5>
                            </figcaption>
                          </figure>
                          <div class="card-body">
                            <div class="post-header">
                              <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="#"> {{trans('website.accounting')}}   </a></h2>
                            </div>
                            <!-- /.post-header -->
                            <div class="post-content">

                               <p style="text-align: justify;">
                                  {{trans('website.accDet')}}
                              </p>
                            </div>
                            <!-- /.post-content -->
                          </div>
                          <!--/.card-body -->

                          <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                      </article>
                      <!-- /article -->
                    </div>
                    <!-- /.item-inner -->
                  </div>
                  <!--/.swiper-slide -->
                  <div class="swiper-slide"  id="pos">
                    <div class="item-inner">
                      <article>
                        <div class="card" style="height: 500px">
                          <figure class="card-img-top overlay overlay-1 hover-scale"><a href="#"> <img src="{{asset('assets/img/website/services/pos.png')}}" alt="" /></a>
                            <figcaption>
                              <h5 class="from-top mb-0">{{trans('website.readmore')}}</h5>
                            </figcaption>
                          </figure>
                          <div class="card-body">
                            <div class="post-header">
                              <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="#"> {{trans('website.pos')}}  </a></h2>
                            </div>
                            <!-- /.post-header -->
                            <div class="post-content">

                               <p  style="text-align: justify;">
                                  {{trans('website.posDet')}}
                              </p>
                            </div>
                            <!-- /.post-content -->
                          </div>
                          <!--/.card-body -->

                          <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                      </article>
                      <!-- /article -->
                    </div>
                    <!-- /.item-inner -->
                  </div>
                  <!--/.swiper-slide -->
                  <div class="swiper-slide"  id="hr">
                    <div class="item-inner">
                      <article>
                        <div class="card">
                          <figure class="card-img-top overlay overlay-1 hover-scale"><a href="#"> <img src="{{asset('assets/img/website/services/HR.png')}}" alt="" /></a>
                            <figcaption>
                              <h5 class="from-top mb-0">{{trans('website.readmore')}}</h5>
                            </figcaption>
                          </figure>
                          <div class="card-body">
                            <div class="post-header">
                              <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href=""> {{trans('website.hr')}}</a></h2>
                            </div>
                            <!-- /.post-header -->
                            <div class="post-content">

                               <p style="text-align: justify;">
                                  {{trans('website.hrDet')}}
                              </p>

                            </div>
                            <!-- /.post-content -->
                          </div>
                          <!--/.card-body -->
                          {{-- <div class="card-footer">
                            <ul class="post-meta d-flex mb-0">
                              <li class="post-date"><i class="uil uil-calendar-alt"></i><span>7 Jan 2022</span></li>
                              <li class="post-comments"><a href="#"><i class="uil uil-file-alt fs-15"></i>Business Tips</a></li>
                            </ul>
                            <!-- /.post-meta -->
                          </div> --}}
                          <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                      </article>
                      <!-- /article -->
                    </div>
                    <!-- /.item-inner -->
                  </div>
                  <div class="swiper-slide"  id="stock">
                    <div class="item-inner">
                      <article>
                        <div class="card">
                          <figure class="card-img-top overlay overlay-1 hover-scale"><a href="#"> <img src="{{asset('assets/img/website/services/stock.png')}}" alt="" /></a>
                            <figcaption>
                              <h5 class="from-top mb-0">{{trans('website.readmore')}}</h5>
                            </figcaption>
                          </figure>
                          <div class="card-body">
                            <div class="post-header">
                              <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="#">{{trans('website.stock')}} </a></h2>
                            </div>
                            <!-- /.post-header -->
                            <div class="post-content">

                              <p style="text-align: justify;">
                                  {{trans('website.stockDet')}}
                              </p>

                            </div>
                            <!-- /.post-content -->
                          </div>
                          <!--/.card-body -->


                        </div>
                        <!-- /.card -->
                      </article>
                      <!-- /article -->
                    </div>
                    <!-- /.item-inner -->
                  </div>
                  <!--/.swiper-slide -->
                </div>
                <!--/.swiper-wrapper -->
              </div>
              <!--/.swiper -->
            </div>
            <!-- /.swiper-container -->
          </div>
          <!-- /.position-relative -->
        </div>
        <!-- /.container -->
      </section>
      <!-- /section -->

      <!-- /section -->
      <section class="wrapper bg-gray">
        <div class="container py-14 pt-md-0 pb-md-17" id="prices">

          <!-- /.row -->
          <div class="row text-center">
            <div class="col-lg-9 col-xl-8 col-xxl-7 mx-auto">
              <h2 class="text-uppercase text-primary mb-3"> {{trans('website.package')}}</h2>
              <h3 class="display-4 mb-10 px-xl-10 tajawal-bold">{{trans('website.packageDet')}} </h3>
            </div>
            <!-- /column -->
          </div>
          <!-- /.row -->
          <div class="row">

            <div class="table-responsive">
      <table class="table table-borderless table-striped ">
        <thead>
          <tr>
            <th class="w-25"></th>
            <th>
              <div class="h4 mb-1 tajawal-bold">{{trans('website.Basic')}}</div>
              <div class="fs-15 fw-normal text-secondary"  style='font-family: "Tajawal", sans-serif;'>220 &nbsp;{{trans('website.RyalMonth')}} </div>
            </th>
            <th>
              <div class="h4 mb-1 tajawal-bold">{{trans('website.Profisional')}}</div>
              <div class="fs-15 fw-normal text-secondary" style='font-family: "Tajawal", sans-serif;'>260 &nbsp;{{trans('website.RyalMonth')}}</div>
            </th>
            <th>
              <div class="h4 mb-1 tajawal-bold">{{trans('website.Advance')}}</div>
              <div class="fs-15 fw-normal text-secondary"  style='font-family: "Tajawal", sans-serif;'>310 &nbsp;{{trans('website.RyalMonth')}}</div>
            </th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="option  tajawal-bold " >{{trans('website.SealsPoints')}}</td></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>

          </tr>
          <tr>
            <td class="option  tajawal-bold ">{{trans('website.InventoryManagement')}}</td>
            <td> <i class="uil uil-times bg-pale-red rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>

          </tr>
          <tr>
            <td class="option  tajawal-bold ">{{trans('website.Recipe')}}</td>
            <td><i class="uil uil-times bg-pale-red rounded-circle p-1"></i></td>
            <td><i class="uil uil-times bg-pale-red rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>

          </tr>
          <tr>
            <td class="option  tajawal-bold ">{{trans('website.GeneralAccounts')}}</td>

            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>
          </tr>
          <tr>
            <td class="option  tajawal-bold ">{{trans('website.HR')}}</td>
            <td><i class="uil uil-times bg-pale-red rounded-circle p-1"></i></td>
            <td  style='font-family: "Tajawal", sans-serif;'>10 {{trans('website.Free')}}</td>
            <td  style='font-family: "Tajawal", sans-serif;'>25 {{trans('website.Free')}}</td>

          </tr>

          <tr>
            <td class="option  tajawal-bold "> {{trans('website.OnlineStore')}} </td>
            <td> <i class="uil uil-times bg-pale-red rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>
          </tr>
          <tr>
            <td class="option  tajawal-bold ">{{trans('website.QRcode')}}</td>
            <td> <i class="uil uil-times bg-pale-red rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>
          </tr>
          <tr>
            <td class="option  tajawal-bold ">{{trans('website.booktable')}}</td>
            <td> <i class="uil uil-times bg-pale-red rounded-circle p-1"></i></td>
            <td> <i class="uil uil-times bg-pale-red rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>
          </tr>
          <tr>
            <td class="option  tajawal-bold ">{{trans('website.BranchNo')}} </td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
          </tr>
          <tr>
            <td class="option  tajawal-bold ">{{trans('website.UserNo')}}</td>
            <td>1</td>
            <td>4</td>
            <td>10</td>
          </tr>
          <tr>
            <td class="option  tajawal-bold ">{{trans('website.Saleswindow')}} </td>
            <td>1</td>
            <td>2</td>
            <td>4</td>
          </tr>
          <tr>
            <td class="option  tajawal-bold ">{{trans('website.WarehousesNo')}} </td>
            <td>1</td>
            <td>2</td>
            <td>4</td>
          </tr>
          <tr>
            <td class="option  tajawal-bold ">{{trans('website.Roles')}}  </td>
            <td><i class="uil uil-times bg-pale-red rounded-circle p-1"></i></td>
            <td><i class="uil uil-times bg-pale-red rounded-circle p-1"></i></td>
            <td><i class="uil uil-check bg-pale-primary text-primary rounded-circle p-1"></i></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <th class="w-25"></th>
            <th><a href="{{route('register')}}" class="btn btn-soft-primary rounded-pill mt-1 tajawal-bold">{{trans('website.Choose')}}</a></th>
            <th><a href="{{route('register')}}" class="btn btn-soft-primary rounded-pill mt-1 tajawal-bold">{{trans('website.Choose')}}</a></th>
            <th><a href="{{route('register')}}" class="btn btn-soft-primary rounded-pill mt-1 tajawal-bold"> {{trans('website.Choose')}} </a></th>

          </tr>
        </tfoot>
      </table>
    </div>
            <!-- /column -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
      </section>
      <!-- /section -->
      <section class="wrapper bg-light" >
        <div class="container py-14 py-md-16" id="contacts">
          <div class="row gx-md-8 gx-xl-12 gy-10 align-items-center">
            <div class="col-md-8 col-lg-6 offset-lg-0 col-xl-5 offset-xl-1 position-relative">
              <div class="shape bg-dot primary rellax w-17 h-21" data-rellax-speed="1" style="top: -2rem; left: -1.4rem;"></div>
              <figure class="rounded"><img src="./assets/img/website/ser3.jpg" srcset="./assets/img/website/about4@2x.jpg 2x" alt=""></figure>
            </div>
            <!--/column -->
            <div class="col-lg-6">
              <img src="./assets/img/icons/lineal/telemarketer.svg" class="svg-inject icon-svg icon-svg-md mb-4" alt="" />
              <h2 class="display-4 mb-8">{{trans('website.ContactusTitle')}}</h2>
              <div class="d-flex flex-row">
                <div>
                  <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-location-pin-alt"></i> </div>
                </div>
                <div>
                  <h5 class="mb-1">{{trans('website.Address')}}</h5>
                  <address class="tajawal-bold">{{trans('website.AddressDet')}}</address>
                </div>
              </div>
              <div class="d-flex flex-row">
                <div>
                  <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-phone-volume"></i> </div>
                </div>
                <div>
                  <h5 class="mb-1 tajawal-bold">{{trans('website.Phone')}}</h5>
                  <p> 538444938 966+</p>
                </div>
              </div>
           <div class="d-flex flex-row">
                <div>
                  <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-whatsapp"></i> </div>
                </div>
                <div>
                  <h5 class="mb-1">{{trans('whatsapp')}}</h5>
                  <p class="tajawal-bold">  <a href="https://wa.me/+966583490100"> <p> 583490100 966+</p> </a></p>
                </div>
            </div>
              <div class="d-flex flex-row">
                <div>
                  <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-envelope"></i> </div>
                </div>
                <div>
                  <h5 class="mb-1">{{trans('website.Email')}}</h5>
                  <p class="mb-0" tajawal-bold><a href="mailto:sandbox@email.com" class="link-body">info@evix.com.sa</a></p>
                </div>
              </div>
            </div>
            <!--/column -->
          </div>
          <!--/.row -->
        </div>
        <!-- /.container -->
      </section>
      <!-- /section -->

@endsection
