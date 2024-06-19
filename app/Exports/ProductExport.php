<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::where('status', '!=', 5)
            ->where('orgID', auth()->user()->orgID)
            ->Orderby('id', 'DESC')
            ->get();
    }

    public function headings(): array
    {
        if (auth()->user()->organization->activity == 2) {
            return ['ID', ' الباركود ', 'اسم المنتج عربي ', 'اسم المنتج انجليزي', ' السعر ', 'التكلفة ', 'الضريبة ', 'رقم القسم ', 'رقم الوحدة ', ' نوع المنتج ', '  السعرات الحرارية ', '   رقم المطبخ ', '    هل المنتج قابل للبيع  ', '  صورة المنتج '];
        } else {
            return ['ID', ' الباركود ', 'اسم المنتج عربي ', 'اسم المنتج انجليزي', ' السعر ', 'التكلفة ', 'الضريبة ', 'رقم القسم ', 'رقم الوحدة ', ' نوع المنتج ', '  صورة المنتج '];
        }
    }

    public function map($Prodcategory): array
    {
        // Custom logic to modify row 3
        if ($Prodcategory->TypeProdect == 1) {
            $modifietype = 'مبيعات';
        } elseif ($Prodcategory->TypeProdect == 2) {
            $modifietype = 'مشتريات';
        } elseif ($Prodcategory->TypeProdect == 3) {
            $modifietype = 'تصنيع';
        } else {
            $modifietype = '';
        }
        $modifiedName = 'https://evix.com.sa/public/dist/img/products/' . $Prodcategory->img;
        if (auth()->user()->organization->activity == 2) {
            return [
                $Prodcategory->id,
                $Prodcategory->barcode,
                $Prodcategory->nameAr,
                $Prodcategory->nameEn,
                $Prodcategory->prodPrice,
                $Prodcategory->costPrice,
                $Prodcategory->vat,
                $Prodcategory->category->nameAr ?? '',
                $Prodcategory->unit->nameAr ?? '',
                $modifietype,
                $Prodcategory->calories,
                $Prodcategory->kitchenID,
                $Prodcategory->isParent,
                // $modifiedName,
                '=HYPERLINK("' . $modifiedName . '", "' . $modifiedName . '")',
            ];
        } else {
            return [
                $Prodcategory->id,
                $Prodcategory->barcode,
                $Prodcategory->nameAr,
                $Prodcategory->nameEn,
                $Prodcategory->prodPrice,
                $Prodcategory->costPrice,
                $Prodcategory->vat,
                $Prodcategory->category->nameAr ?? '',
                $Prodcategory->unit->nameAr ?? '',
                $modifietype,
              
                // $modifiedName,
                '=HYPERLINK("' . $modifiedName . '", "' . $modifiedName . '")',
            ];
        }
    }
}
