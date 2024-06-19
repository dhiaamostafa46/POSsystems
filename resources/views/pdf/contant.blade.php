<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
    .textprograf {
        color: #478f8c;
        text-align: justify;
        font-size: 20px;
        margin-right: 30px;
        font-family: "Tajawal", sans-serif;
    }

    .headtext {
        color: #5dddc5;
        font-size: 25px;
        font-weight: bold;
        margin-top: 50px;
        font-family: "Tajawal", sans-serif;
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
</head>
<body>
    <div class="card " id="content" style="margin: 20px">

        <div class="card-body">

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
                <p><strong>رقم الآيبان :</strong> SA2380000445608016205760 </p>
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

                    <span> <strong> 5 سنوات</strong> </span>
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
                            <li>

                                <span>أن يدفع أجر</span>
                                <span> <strong>{{ $item->value }} </strong></span>
                                <span> ريال سعودي,</span>
                                <span>{{ $item->allow->nameAr ?? '' }} </span>
                                <span>يستحق نهاية كل </span>
                                <span> <strong>شهر </strong></span>
                            </li>
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
                        {{-- @if (!empty(auth()->user()->organization->nameAr))


                            <img src="{{asset('public/dist/img/organizations/'.auth()->user()->organization->signature)}}" style="width: 100px" alt="">
                        @endif --}}
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
</body>
</html>
