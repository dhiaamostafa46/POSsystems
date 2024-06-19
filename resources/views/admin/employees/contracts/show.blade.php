@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <style>
        .textprograf {
            color: #478f8c;
            text-align: justify;
            font-size: 20px;
            margin-right: 30px;

        }

        .headtext {
            color: #5dddc5;
            font-size: 25px;
            font-weight: bold;
            margin-top: 50px;

        }

        .head2textone {
            color: #478f8c;
            text-align: justify;
            font-size: 22px;
            font-weight: bold;
            margin-right: 30px;
            font-family: "Tajawal", sans-serif;
        }

        @media print {
            .print-only {
                display: block !important;
                width: 100% !important;
            }
        }
    </style>

    <section class="wrapper ">
        <div class="row ">

            <div class="col-12 " >
                <div class="card " id="content" style="margin: 20px">
                    <div class="card-header no-print">
                        <button class="btn btn-info" onclick="window.print()" > download pdf </button>
                        <a class="btn btn-success" href="{{route('savecontractElronpdf',$contracts->id)}}"> download pdf All </a>


                    </div>
                    <div class="card-body print-only" style=" @media print {  width: 100%  !important;}">

                        <h1 class="text-center " style="color: #478f8c">
                            العقد الوظيفي
                            <br>
                            EMPLOYMENT CONTRACT
                        </h1>
                        <br>


                        <h3 class="headtext"> رقم العقد: {{ $contracts->contractNo }} </h3>


                        <p class="lh-lg textprograf ">
                            أُبرم هذا العقد الكترونياً تحت

                            {{ auth()->user()->organization->nameAr ?? '' }} ,
                            المملكة العربية السعودية في يوم الموافق

                            {{ date('Y-m-d') }}
                            م



                        </p>








                        <h3 class="headtext"> الطرف الأول: </h3>


                        <div>
                            <p class="lh-lg textprograf "><strong>شركة/مؤسسة :</strong>
                                {{ auth()->user()->organization->nameAr ?? '' }} </p>
                            <p class="lh-lg textprograf "><strong> الرقم الوطني الموحد: </strong>
                                {{ auth()->user()->organization->Ntionladdress ?? '' }} </p>
                            <p class="lh-lg textprograf "><strong>رقم المنشأة: </strong>
                                {{ auth()->user()->organization->Nofacility ?? '' }} </p>
                            <p class="lh-lg textprograf "><strong> السجل التجاري: </strong>
                                {{ auth()->user()->organization->CR ?? '' }} </p>
                            <p class="lh-lg textprograf "><strong>العنوان :</strong>
                                {{ auth()->user()->organization->branches[0]->addressAr ?? '' }} </p>
                            <p class="lh-lg textprograf "><strong>مكان العمل :</strong>
                                {{ auth()->user()->organization->branches[0]->city ?? '' }}</p>
                            <p class="lh-lg textprograf "><strong> البريد الإلكتروني:</strong>
                                {{ auth()->user()->organization->User->email ?? '' }}</p>
                            <p class="lh-lg textprograf "><strong> ويمثلها بالتوقيع: </strong>
                                {{ auth()->user()->organization->User->name ?? '' }}
                                بصفته المدير العام
                                ويشار إليه فيما بعد ب (الطرف الأول)، </p>
                        </div>






                        <h3 class="headtext"> الطرف الثاني: </h3>

                        <div class="lh-lg textprograf ">
                            <p><strong>الاسم:</strong> {{ $emp->nameAr }}</p>
                            <p><strong>المهنة:</strong> {{ $emp->job->nameAr ?? '' }} </p>
                            <p><strong> الرقم الوظيفي: </strong>{{ $count }}
                            </p>
                            <p><strong>الجنسية :</strong> {{ $emp->nationality }} </p>
                            <p><strong>تاريخ الميلاد:</strong> </p>
                            <p><strong> رقم الهوية :</strong> {{ $emp->idNo }} </p>
                            <p><strong>نوع الهوية: </strong>
                                @if ($emp->typeiqama == 1)
                                    {{ trans('HR.Identity') }}
                                @elseif($emp->typeiqama == 0)
                                    {{ trans('HR.iqama') }}
                                @endif
                            </p>
                            <p><strong>الجنس:</strong>
                                @if ($emp->Gender == 0)
                                    {{ trans('HR.male') }}
                                @elseif($emp->Gender == 1)
                                    {{ trans('HR.Female') }}
                                @endif
                            </p>
                            <p><strong>الديانة:</strong>{{ $emp->Religion }} </p>
                            <p><strong>تاريخ الإنتهاء :</strong> {{ $emp->idEndDate }} </p>
                            <p><strong>الحالة الاجتماعية :</strong>
                                @if ($emp->marriedStatus == 1)
                                    {{ trans('HR.single') }}
                                @elseif($emp->marriedStatus == 2)
                                    {{ trans('HR.Married') }}
                                @elseif($emp->marriedStatus == 3)
                                    {{ trans('HR.separate') }}
                                @endif

                            </p>
                            <p><strong>المؤهل العلمي:</strong> {{ $emp->jobClass }} </p>
                            <p><strong>التخصص :</strong> {{ $emp->Special }} </p>
                            <p><strong>رقم الآيبان :</strong> {{ $emp->IBN }}</p>
                            {{-- <p><strong> اسم البنك: </strong> </p> --}}
                            <p><strong>البريد الإلكتروني :</strong> {{ $emp->email }} </p>
                            <p><strong>رقم الجوال :</strong> {{ $emp->phone }} </p>
                            <p>ويشار إليه فيما بعد ب (الطرف الثاني), </p>
                        </div>
                        <div class="lh-lg textprograf ">
                            <p>
                                اتفق الطرفان على أن يعمل الطرف الثاني لدى الطرف الأول
                                تحت ادارته و اشرافه بوظيفة <strong> {{ $emp->jobClass }}</strong> ومباشرة الأعمال التي يكلف
                                بها بما يتناسب مع قدراته العملية والعلمية والفنية وفقاً
                                لاحتياجات العمل وبما لا يتعارض مع الضوابط المنصوص عليها
                                في المواد (الثامنة والخمسون، التاسعة والخمسون، الستون)
                                من نظام العمل.
                            </p>
                            <p>
                                <span>مدة هذا العقد </span>

                                 <?php $diff =$contracts->created_at_difference($contracts->stDate,  $contracts->enDate); ?>

                                <span> <strong>  <?php echo   $diff->y . " سنة, " . $diff->m . " شهر, " . $diff->d . " يوم"; ?> </strong> </span>
                                <span> يبدأ من تاريخ</span>
                                <span> <strong> {{ $contracts->stDate }} </strong> م</span>
                                <span>وينتهي في </span>
                                <span> <strong> {{ $contracts->enDate }} </strong>م </span>
                                <span>علماً بأن تاريخ مباشرة الطرف الثاني للعمل هو </span>
                                <span> <strong>{{ $contracts->stDate }} </strong>م </span>

                            </p>
                            <p>
                                وتتجدد لمدة أو لمدد مماثلة مالم يشعر أحد الطرفين الأخر خطياً
                                بعدم رغبته في التجديد قبل( <strong> 30 </strong> ) يوماً من تاريخ انتهاء العقد
                            </p>

                            <p>
                                يخضع الطرف الثاني لفترة تجربة مدتها <strong>90</strong> يوماً تبدأ من تاريخ
                                مباشرته للعمل ولا يدخل في حسابها إجازة عيدي الفطر
                                والأضحى والاجازة المرضية ويكون للطرفين الحق في إنهاء
                                العقد خلال هذه الفترة، مالم ينص العقد على أحقية أحدهما في
                                الإنهاء.
                            </p>

                        </div>










                        <h3 class="headtext"> أيام وساعات العمل </h3>
                        <div class="lh-lg textprograf ">
                            <span> تحدد أيام العمل العادية ب </span>
                            <span><strong> 6 إيام</strong></span>
                            <span> في الأسبوع وتحدد ساعات
                                العمل ب </span>
                            <span> <strong> {{ $emp->shift->hours ?? '' }} </strong></span>
                            <span>
                                يومياً ويلتزم الطرف الأول بأن يدفع للطرف الثاني
                                أجراً اضافياً عن ساعات العمل الإضافية يوازي أجر الساعة مضافاً
                                إليه 50 ٪ من أجره الأساسي.
                            </span>

                        </div>







                        <h3 class="headtext"> التزامات الطرف الأول </h3>
                        <div class="lh-lg textprograf">
                            <p>
                                <span> يدفع الطرف الأول للطرف الثاني أجراً أساسي قدره</span>
                                <span> <strong> {{ $emp->Salary->basicSalary ?? '' }}</strong></span>
                                <span>ريال سعودي يستحق نهاية كل </span>
                                <span><strong>شهر </strong></span>
                            </p>


                            @if (count($emp->Empallowan) > 0)
                                <p>كما يلتزم الطرف الأول للطرف الثاني بالآتي: </p>
                                <ol>
                                    @foreach ($emp->Empallowan as $item)
                                        @if ($item->value > 0)
                                            <li>

                                                <span>أن يدفع أجر</span>
                                                <span> <strong>{{ $item->value }} </strong></span>
                                                <span> ريال سعودي,</span>
                                                <span>{{ $item->allow->nameAr ?? '' }} </span>
                                                <span>يستحق نهاية كل </span>
                                                <span> <strong>شهر </strong></span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ol>
                            @endif


                            <p>
                                <span>يستحق الطرف الثاني عن كل عام إجازة سنوية مدتها </span>
                                <span> <strong>{{ $emp->holiday }}</strong></span>
                                <span> يوماً
                                    مدفوعة الأجر ويحدد الطرف الأول تاريخها خلال سنة الاستحقاق
                                    وفقاً لظروف العمل على أن يتم دفع أجر الاجازة مقدماِ عند
                                    استحقاقها وللطرف الأول تأجيل الاجازة بعد نهاية سنة
                                    استحقاقها لمدة لا تزيد عن 90 يوماً كما له بموافقة الطرف
                                    الثاني كتابةً تأجيلها إلى نهاية السنة التالية لسنة الاستحقاق
                                    وذلك حسب مقتضيات ظروف العمل.
                                </span>
                            </p>
                            <p>
                                يلتزم الطرف الأول بتوفير الرعاية الطبية للطرف الثاني بالتأمين
                                الصحي وفقاً لأحكام نظام الضمان الصحي التعاوني
                            </p>
                            <p>
                                يلتزم الطرف الأول بسداد اشتراكات المؤسسة العامة للتأمينات
                                الاجتماعية حسب أنظمتها
                            </p>
                            <p>
                                يتحمل الطرف الأول رسوم استقدام الطرف الثاني / نقل
                                خدماته إليه ورسوم الإقامة ورخصة العمل وتجديدهما وما يترتب
                                على تأخير ذلك من غرامات ورسوم تغيير المهنة والخروج والعودة
                                وتذكرة عودة الطرف الثاني إلى موطنه بالوسيلة التي قدم بها
                                بعد انتهاء العلاقة بين الطرفين
                            </p>
                            <p>
                                يلتزم الطرف الأول بنفقات تجهيز جثمان الطرف الثاني ونقله
                                إلى الجهة التي أبرم فيها العقد أو استقدام الموظف منها ما لم
                                يدفن بموافقة ذويه داخل المملكة أو تلتزم المؤسسة العامة
                                للتأمينات الاجتماعية بذلك.
                            </p>

                        </div>





                        <h3 class="headtext"> التزامات الطرف الثاني </h3>
                        <div class="lh-lg textprograf ">
                            <p>
                                أن ينجز العمل الموكل إليه وفقاً لأصول المهنة ووفق تعليمات
                                الطرف الأول إذا لم يكن في هذه التعليمات ما يخالف العقد أو
                                النظام أو الآداب العامة ولم يكن في تنفيذها ما يعرضه للخطر
                            </p>
                            <p>
                                أن يعتني عناية كافية بالأدوات والمهمات المسندة إليه
                                والخامات المملوكة للطرف الأول الموضوعة تحت تصرفه أو
                                التي تكون في عهدته وأن يعيد إلى الطرف الأول المواد غير
                                المستهلكة
                            </p>
                            <p>
                                أن يقدم كل عون ومساعدة دون أن يشترط لذلك أجراً إضافياً في
                                حالات الأخطار التي تهدد سلامة مكان العمل أو الأشخاص
                                الموظفين فيه
                            </p>
                            <p>
                                أن يخضع وفقاً لطلب الطرف الأول للفحوص الطبية التي يرغب
                                في إجرائها عليه قبل الالتحاق بالعمل أو أثناءه للتحقق من خلوه
                                من الأمراض المهنية أو السارية
                            </p>
                            <p>
                                يلتزم الطرف الثاني بحسن السلوك والأخلاق أثناء العمل وفي
                                جميع الأوقات يلتزم بالأنظمة والأعراف العادات والآداب المرعية
                                في المملكة العربية السعودية وكذلك بالقواعد واللوائح
                                والتعليمات المعمول بها لدى الطرف الأول ويتحمل كافة
                                الغرامات المالية الناتجة عن مخالفته لتلك الأنظمة
                            </p>
                            <p>
                                الموافقة على استقطاع الطرف الأول للنسبة المقررة عليه من
                                الأجر الشهري للاشتراك في المؤسسة العامة للتأمينات
                                الاجتماعية
                            </p>
                        </div>















                        <h3 class="headtext"> انتهاء العقد أو إنهاءه </h3>

                        <div class="lh-lg textprograf ">
                            <p>
                                ينتهي هذا العقد بانتهاء مدته في العقد محدد المدة أو باتفاق
                                الطرفين على انهائه بشرط موافقة الطرف الثاني كتابةً
                            </p>
                            <p>
                                يحق للطرف الأول فسخ العقد دون مكافأة أو إشعار للطرف
                                الثاني أو تعويضه شريطة إتاحة الفرصة للطرف الثاني في إبداء
                                أسباب معارضته للفسخ وذلك طبقاً للحالات الواردة في المادة
                                (الثمانون) من نظام العمل
                            </p>
                            <p>
                                حق للطرف الثاني ترك العمل وإنهاء العقد دون إشعار الطرف
                                الأول مع احتفاظه بحقه في الحصول على كافة مستحقاته طبقاً
                                للحالات الواردة في المادة (الحادية والثمانون) من نظام العمل
                            </p>


                        </div>

















                        <h3 class="headtext">مكافأة نهاية الخدمة </h3>
                        <div class="lh-lg textprograf ">
                            <p>
                                يستحق الطرف الثاني عند إنهاء العلاقة التعاقدية من قبل
                                الطرف الأول أو باتفاق الطرفين أو بانتهاء مدة العقد أو نتيجة
                                لقوة قاهرة مكافأة قدرها أجر خمسة عشر يوماً عن كل سنة من
                                السنوات الخمس الأولى وأجر شهر عن كل سنة من التالية
                                ويستحق الموظف مكافأة عن أجزاء السنة بنسبة ما قضاه منها
                                في العمل وتحسب المكافأة على أساس الأجر الأخير

                            </p>

                        </div>





                        @if (count($contracts->Terms) > 0)
                            <h3 class="headtext"> بنود اضافية </h3>
                            <div class="lh-lg textprograf ">
                                <ul>
                                    @foreach ($contracts->Terms as $item)
                                        <li>
                                            {{ $item->text }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif





                        <h3 class="headtext"> النظام الواجب التطبيق والاختصاص القضائي </h3>
                        <div class="lh-lg textprograf ">
                            <p>
                                يخضع هذا العقد لنظام العمل ولائحته التنفيذية والقرارات
                                الصادرة تنفيذاً له في كل مالم يرد به نص في هذا العقد ويحل
                                هذا العقد محل كافة الاتفاقيات والعقود السابقة الشفهية منها
                                أو الكتابية إن وجدت
                            </p>
                            <p>
                                في حالة نشوء خلاف بين الطرفين حول هذا العقد فإن
                                الاختصاص القضائي ينعقد للجهة المختصة بنظر القضايا
                                العمالية في المملكة العربية السعودية
                            </p>
                            <p>
                                <span> تتم الإخطارات والإشعارات بين الطرفين كتابة عن طريق قنوات
                                    التواصل الإلكترونية في</span>
                                <span> منصة إيفكس </span>
                                <span>
                                    لكل من الطرفين ويلتزم
                                    كل طرف في حال تغييره للعنوان الخاص به أو تغيير البريد
                                    الالكتروني بتعديله من خلال
                                </span>
                                <span> منصة إيفكس </span>
                                <span>
                                    وإلا اعتبر عنوان
                                    العنوان أو البريد الالكتروني المسجل لدى
                                </span>
                                <span> منصة إيفكس </span>
                                <span> هما المعمول بهما نظاماً. </span>
                            </p>
                            <p>
                                <span>
                                    تم تصدير هذا العقد الكترونياً ويتاح الوصول له لكل من الطرفين
                                    عن طريق
                                </span>
                                <span> منصة إيفكس </span>

                            </p>






                        </div>

                        <br>
                        <br>
                        <br>
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="lh-lg textprograf text-center">
                                    <p class="lh-lg textprograf  text-center"><strong> الطرف الأول </strong></p>
                                    <p class="lh-lg textprograf text-center"><strong>شركة/مؤسسة :</strong>
                                        {{ auth()->user()->organization->nameAr ?? '' }} </p>
                                    @if (!empty(auth()->user()->organization->nameAr))
                                        {{-- <img src="{{ asset('dist/img/organizations/Artboardpnjjj_1709482037.png') }}"
                                            width="200px" alt=""> --}}

                                         <img src="{{asset('public/dist/img/organizations/'.auth()->user()->organization->signature)}}" style="width: 100px" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <p class="lh-lg textprograf  text-center"><strong> الطرف الثاني </strong></p>
                                <div class="lh-lg textprograf text-center">
                                    الموظف :
                                    {{ $emp->nameAr }}


                                </div>
                            </div>


                        </div>

                        <br>
                        <br>
                        <br>
                        <br>
                        <br>


                        <div class="lh-lg textprograf ">

                            <p>
                                <span>تم الانشاء بواسطة: </span>
                                <span> {{ auth()->user()->organization->User->name ?? '' }} </span>
                                <span> في </span>
                                <span> {{ $contracts->created_at }} </span>


                            </p>
                        </div>





                    </div>
                </div>
                <div id="editor"></div>

            </div>
            <div class="col-12 no-print">
                <div class="card" style="margin: 20px">
                    <div class="card-body">
                        <div class="divpandsa">
                            <div class="m-2">
                                <input type="hidden" id="contracts" value="{{ $contracts->id }}">
                                <textarea class="form-control" name="AddBand" id="AddBand" cols="30" rows="10"> </textarea>
                            </div>
                            <button class="btn btn-primary" onclick="SaveAddBandNew()"> اضافة بند </button>

                        </div>
                        <br>
                        <br>
                        <div>

                            @if (count($contracts->Terms) > 0)
                                @foreach ($contracts->Terms as $item)
                                    <div class="d-flex justify-content-between ">
                                        <div style="text-wrap: nowrap;  overflow: hidden;     width: 60%;">
                                            {{ $item->text }}</div>
                                        <div>
                                            <a href="{{ route('RemovecontractElron', $item->id) }}"> <i
                                                    class="fa fa-trash"></i> </a>
                                        </div>

                                    </div>
                                @endforeach
                            @endif

                        </div>

                    </div>

                </div>
            </div>

        </div>




    </section>

    {{-- <div id="content">
        <h3>Hello, this is a H3 tag</h3>

        <p>A paragraph</p>
    </div> --}}
    {{-- <div id="editor"></div>
    <button onclick="javascript:createPdf()" id="cmd">generate PDF</button> --}}


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.debug.js"></script>
    <!------------------------------------add saeed -------------------------------------------------->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <script>
        function SaveAddBandNew() {
            contracts = $('#contracts').val();
            AddBand = $('#AddBand').val();

            var formData = new FormData();
            formData.append('contracts', contracts);
            formData.append('AddBand', AddBand);
            $.ajax({
                url: '/savecontractElron',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    $('#AddBand').val('');
                    location.reload();
                    // Handle success response
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error
                }
            });



        }

        function createPdf() {

            var doc = new jsPDF();

            source = $('#content')[0];



            specialElementHandlers = {
                '#editor': function(element, renderer) {
                    return true
                }
            };

            doc.fromHTML(
                source,
                15,
                15, {
                    'width': 170,
                    'elementHandlers': specialElementHandlers
                }
            );
            doc.save('sample-file.pdf')
        }
    </script>
@endsection
