<?php

namespace App\Imports;

use App\Models\Unit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UnitImport implements ToModel, WithStartRow
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
        $unit = new Unit();

        $unit->nameAr = $row[1];
        $unit->nameEn = $row[2];
        $unit->orgID = auth()->user()->orgID;
        $unit->userID = auth()->user()->id;
        $unit->save();



    }
}
