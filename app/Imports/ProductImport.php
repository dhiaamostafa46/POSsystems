<?php

namespace App\Imports;

use App\Models\Inv;
use App\Models\Product;
use App\Models\ProdUnit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductImport implements ToModel, WithStartRow
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


          $DepotStore =auth()->user()->organization->DepotStore[0]->id ?? 0;

        $copy = new Product();
        if($row[1]==null){

            $Inv = Inv::where('orgID', auth()->user()->orgID)->first();
            if ($Inv == null) {
                $Inv = new Inv();
                $Inv->Inv = '1';
                $Inv->proud = '1';
                $Inv->orgID = auth()->user()->orgID;
                $Inv->save();
            } else {
                $Inv->proud = $Inv->proud + 1;
                $Inv->save();
            }
            if (strlen($Inv->proud) == 1) {
                $bill_num = '5000' . $Inv->proud;
            }
            if (strlen($Inv->proud) == 2) {
                $bill_num = '500' . $Inv->proud;
            }
            if (strlen($Inv->proud) == 3) {
                $bill_num = '50' . $Inv->proud;
            }
            if (strlen($Inv->proud) == 4) {
                $bill_num = '5' . $Inv->proud;
            }

            $copy->barcode = $bill_num;
        }else{
            $copy->barcode=$row[1];
        }

        $copy->nameAr    = $row[2];
        $copy->nameEn    = $row[3];
        $copy->prodPrice = $row[4];
        $copy->costPrice = $row[5];
        $copy->barcodeType = 2;
        $copy->vat =       $row[6];
        $copy->categoryID =   $row[7];
        $copy->unitID =   $row[8];
        $copy->TypeProdect = $row[9];

        $copy->orgID = auth()->user()->orgID;
        $copy->userID = auth()->user()->id;
        $copy->img = "default.jpg";

        if (auth()->user()->organization->activity == 2) {
            $copy->calories =$row[10];
            $copy->kitchenID =$row[11];
            $copy->isParent =$row[12];
        }
        $copy->save();

        $punit = new ProdUnit();
        $punit->prodID = $copy->id;
        $punit->unitID = $row[8];
        $punit->quantity = 1;
        $punit->price = $row[5];

        $punit->costprodect = $row[5];
        $punit->unitname = "";
        $punit->orgID = auth()->user()->orgID;
        $punit->StoreId =   $DepotStore;
        $punit->save();
    }
}
