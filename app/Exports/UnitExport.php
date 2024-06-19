<?php

namespace App\Exports;

use App\Models\Unit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UnitExport implements FromCollection ,WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  Unit::where('status',1)->where('orgID',auth()->user()->orgID)->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'الاسم (عربي)',
            'الاسم (انجليزي)',
        ];
    }


    public function map($Unit): array
    {
        // Custom logic to modify row 3

        return [
            $Unit->id,
            $Unit->nameAr,
            $Unit->nameEn,
        ];
    }
}
