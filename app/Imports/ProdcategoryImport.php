<?php

namespace App\Imports;

use App\Models\Prodcategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProdcategoryImport implements ToModel , WithStartRow
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




        $productcategory = new Prodcategory();
        $productcategory->nameAr = $row[1];
        $productcategory->nameEn = $row[2];

        $productcategory->orgID = auth()->user()->orgID;
        $productcategory->sort = $row[3];
        $productcategory->userID = auth()->user()->id;
        $productcategory->TypeCatagoury = $row[4];
        $productcategory->save();
        return $productcategory ;




    }


    private function uploadImage($imageData)
    {
        // Implement your file upload logic here
        // For example:
        // Generate a unique file name
        $fileName = uniqid() . '_' . time() . '.' . pathinfo($imageData, PATHINFO_EXTENSION);
        // Move the file to the desired directory
        // Example:
        // move_uploaded_file($imageData, public_path('images/' . $fileName));
        // For demonstration purposes, let's assume the file is directly stored in the public directory
        // In a real-world scenario, you should handle file storage securely
        copy(public_path('example_images/' . $imageData), public_path('images/' . $fileName));

        return $fileName;
    }
}
