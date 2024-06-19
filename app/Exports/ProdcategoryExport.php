<?php

namespace App\Exports;

use App\Models\Prodcategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProperties;

class ProdcategoryExport implements FromCollection ,WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Prodcategory::where('status',1)->where('orgID',auth()->user()->orgID)->get();
    }





    public function headings(): array
    {
        return [
            'ID',
            'أسم القسم - عربي',
            'أسم القسم - انجليزي',
            'ترتيب المنتجات في المتجر',
            'نوع القسم  ',
            'الصورة ',
        ];
    }

    public function map($Prodcategory): array
    {
        // Custom logic to modify row 3
        if( $Prodcategory->TypeCatagoury ==1)
        {
            $modifietype="مبيعات";
        }elseif($Prodcategory->TypeCatagoury ==2){
            $modifietype="مشتريات";
        }elseif($Prodcategory->TypeCatagoury ==3){
            $modifietype="تصنيع";
        }
        else{
            $modifietype="";
        }
        $modifiedName = 'https://evix.com.sa/dist/img/productcategories/' . $Prodcategory->img;

        return [
            $Prodcategory->id,
            $Prodcategory->nameAr,
            $Prodcategory->nameEn,
            $Prodcategory->sort,
            $modifietype,
            $modifiedName,
        ];
    }



    public function startCell(): string
    {
        return 'B2';
    }
}
