<?php

namespace App\Imports;

use App\Models\Kitchen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KitchenImport implements ToModel , WithStartRow
{

    public function startRow(): int
    {
        return 2; // Skip the first row
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $kitchen = new Kitchen();
        $kitchen->nameAr =$row[1];
        $kitchen->nameEn =$row[2];
        $kitchen->orgID = auth()->user()->orgID;
        $kitchen->branchID = auth()->user()->branchID;
        $kitchen->userID = auth()->user()->id;
        $kitchen->save();

        return  $kitchen ;
    }
}
