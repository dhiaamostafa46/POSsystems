<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\OrderInv;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OrderInv::all();
    }
}
