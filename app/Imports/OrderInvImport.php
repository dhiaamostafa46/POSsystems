<?php

namespace App\Imports;

use App\Models\OrderInv;
use Maatwebsite\Excel\Concerns\ToModel;

class OrderInvImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new OrderInv([
            //
        ]);
    }
}
