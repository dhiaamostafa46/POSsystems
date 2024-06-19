<?php

namespace App\Exports;

use App\Models\OrderInv;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderInvExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OrderInv::all();
    }
}
