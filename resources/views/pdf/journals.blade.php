
<table style="width: 100% ;">
    <tbody>
        <tr>
            <td style="width: 70% ;" ><h4>  اسم المنشأة : {{ auth()->user()->organization->nameAr}}</h4></td>
            <td style="width: 30%;"> <small class="float-right">العنوان: {{auth()->user()->branch->area}} - {{auth()->user()->branch->city}} - {{auth()->user()->branch->district}}</small></td>
        </tr>
        <tr >
            <td style="width: 70%;" ><h4> قيد يومي رقم القيد  {{$Journal->id}}</h4> </td>
            <td style="width: 30%;"> <small class="float-right">السجل التجاري: {{auth()->user()->organization->CR}}</small> </td>
        </tr>
        <tr >
            <td style="width: 70%;" ><h4> التاريخ : {{$Journal->date}}</h2> </td>
            <td style="width: 30%;"> <small class="float-right">الرقم الضريبي: {{auth()->user()->organization->vatNo}}</small> </td>
        </tr>

    </tbody>
</table>



<h4>وصف القيد : {{$Journal->dec}} </h4>

<style>
table tbody tr td{
    padding: 10px;
}
</style>

<table border="1" width="100%" style="text-align: center">
    <tbody>
        <tr style="background:#478f8c;">
            <td colspan="2">الحساب</td>
            <td>الوصف</td>
            <td>المدين </td>
            <td>الدائن </td>
        </tr>
        @foreach ($Journal->JournalChild  As $key=>$item)
            <tr>
                <td>{{$item->CodeAccount}}</td>
                <td> {{$item->nameAccount}} </td>
                <td>{{$item->dec}} </td>
                <td>{{$item->Debit}}</td>
                <td>{{$item->Credit	}}</td>
            </tr>

        @endforeach

        <tr style="background:#478f8c;">
            <td colspan="3"> المجموع</td>
            <td>{{$Journal->Total}}</td>
            <td>{{$Journal->Total}}</td>
        </tr>


    </tbody>
</table>



