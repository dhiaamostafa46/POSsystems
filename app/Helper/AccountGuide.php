<?php

use App\Models\ProdUnit;

function UiteAllAdd($index, $prodect, $price1, $quantity1, $dept)
{
    $price = (float) $price1;
    $quantity = (float) $quantity1;
    $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();

    if (count($unit) <= 0) {
        $unituu = ProdUnit::where('prodID', $prodect)->get();
        foreach ($unituu as $item) {
            $punit = new ProdUnit();
            $punit->prodID = $item->prodID;
            $punit->unitID = $item->unitID;
            $punit->unitname = $item->unitname;
            $punit->quantity = $item->quantity;
            $punit->price = $item->price;
            $punit->sales = $item->sales;
            $punit->purchase = $item->purchase;
            $punit->report = $item->report;
            $punit->compon = $item->compon;
            $punit->count = 0;
            $punit->costprodect = 0;
            $punit->saller = 0;
            $punit->countSaller = 0;
            $punit->orgID = auth()->user()->orgID;
            $punit->StoreId = $dept;
            $punit->start = 0;
            $punit->Tainted = 0;

            $punit->save();
        }
    }

    if ($index == 0) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    $items->countSaller = (float) $items->countSaller + ($price / $unit[0]->quantity) * $quantity;
                    if ($index == 2) {
                        $items->count = $items->count + $items->quantity * $quantity * $unit[1]->quantity;
                    } else {
                        $items->count = $items->count + $items->quantity * $quantity;
                    }
                    if($items->count + $items->start !=0){

                        $items->costprodect = $items->countSaller / ($items->count + $items->start);

                    }else{
                        $items->costprodect =$unit[$index]->price;
                    }

                    $items->save();
                }
            }
        }
    } elseif ($index == 1) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    $items->countSaller = $items->countSaller + ($price / $unit[0]->quantity) * $quantity;

                    if ($index == 0) {
                        if (count($unit) > 1) {
                            $items->count = $items->count + ($items->quantity * $quantity) / $unit[1]->quantity;
                        } else {
                            $items->count = $items->count + $items->quantity * $quantity;
                        }
                    } elseif ($index == 2) {
                        if (count($unit) > 1) {
                            $items->count = $items->count + $items->quantity * $quantity;
                        } else {
                            $items->count = $items->count + $items->quantity * $quantity;
                        }
                    } else {
                        $items->count = $items->count + $quantity;
                    }

                    $items->costprodect = $items->countSaller / ($items->count + $items->start);
                    if($items->count + $items->start !=0){

                        $items->costprodect = $items->countSaller / ($items->count + $items->start);

                    }else{
                        $items->costprodect =$unit[$index]->price;
                    }
                    $items->save();
                }
            }
        }
    } else {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    $items->countSaller = $items->countSaller + ($price / $unit[0]->quantity) * $quantity;
                    if ($index == 0) {
                        if (count($unit) > 2) {
                            $items->count = $items->count + $quantity / ($unit[1]->quantity * $unit[2]->quantity);
                        } elseif (count($unit) > 1) {
                            $items->count = $items->count + $quantity / $unit[1]->quantity;
                        } else {
                            $items->count = $items->count + $quantity;
                        }
                    } elseif ($index == 1) {
                        if (count($unit) > 2) {
                            $items->count = $items->count + $quantity / $unit[2]->quantity;
                        } else {
                            $items->count = $items->count + $quantity;
                        }
                    } else {
                        $items->count = $items->count + $quantity;
                    }
                    if($items->count + $items->start !=0){

                        $items->costprodect = $items->countSaller / ($items->count + $items->start);

                    }else{
                        $items->costprodect =$unit[$index]->price;
                    }

                    $items->save();
                }
            }
        }
    }
}

function UiteAllAddStart($index, $prodect, $price1, $quantity1, $dept)
{
    $price = (float) $price1;
    $quantity = (float) $quantity1;
    $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();

    if (count($unit) <= 0) {
        $unituu = ProdUnit::where('prodID', $prodect)->get();
        foreach ($unituu as $item) {
            $punit = new ProdUnit();
            $punit->prodID = $item->prodID;
            $punit->unitID = $item->unitID;
            $punit->unitname = $item->unitname;
            $punit->quantity = $item->quantity;
            $punit->price = $item->price;
            $punit->sales = $item->sales;
            $punit->purchase = $item->purchase;
            $punit->report = $item->report;
            $punit->compon = $item->compon;
            $punit->count = 0;
            $punit->costprodect = 0;
            $punit->saller = 0;
            $punit->countSaller = 0;
            $punit->orgID = auth()->user()->orgID;
            $punit->StoreId = $dept;
            $punit->start = 0;
            $punit->Tainted = 0;
            $punit->save();
        }
    }

    if ($index == 0) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    $items->countSaller = (float) $items->countSaller + ($price / $unit[0]->quantity) * $quantity;
                    if ($index == 2) {
                        $items->start = $items->start + $items->quantity * $quantity * $unit[1]->quantity;
                    } else {
                        $items->start = $items->start + $items->quantity * $quantity;
                    }
                    $items->costprodect = $items->countSaller / ($items->start + $items->count);
                    $items->save();
                }
            }
        }
    } elseif ($index == 1) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    $items->countSaller = $items->countSaller + ($price / $unit[0]->quantity) * $quantity;

                    if ($index == 0) {
                        if (count($unit) > 1) {
                            $items->start = $items->start + ($items->quantity * $quantity) / $unit[1]->quantity;
                        } else {
                            $items->start = $items->start + $items->quantity * $quantity;
                        }
                    } elseif ($index == 2) {
                        if (count($unit) > 1) {
                            $items->start = $items->start + $items->quantity * $quantity;
                        } else {
                            $items->start = $items->start + $items->quantity * $quantity;
                        }
                    } else {
                        $items->start = $items->start + $quantity;
                    }

                    $items->costprodect = $items->countSaller / ($items->start + $items->count);
                    $items->save();
                }
            }
        }
    } else {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    $items->countSaller = $items->countSaller + ($price / $unit[0]->quantity) * $quantity;
                    if ($index == 0) {
                        if (count($unit) > 2) {
                            $items->start = $items->start + $quantity / ($unit[1]->quantity * $unit[2]->quantity);
                        } elseif (count($unit) > 1) {
                            $items->start = $items->start + $quantity / $unit[1]->quantity;
                        } else {
                            $items->start = $items->start + $quantity;
                        }
                    } elseif ($index == 1) {
                        if (count($unit) > 2) {
                            $items->start = $items->start + $quantity / $unit[2]->quantity;
                        } else {
                            $items->start = $items->start + $quantity;
                        }
                    } else {
                        $items->start = $items->start + $quantity;
                    }
                    $items->costprodect = $items->countSaller / ($items->start + $items->count);
                    $items->save();
                }
            }
        }
    }
}

/*     *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 */



function UiteAllReturned($indexm, $prodect, $price1, $quantity1, $dept)
{
    $index = (float) $indexm;
    $price = (float) $price1;
    $quantity = (float) $quantity1;
    $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();

    if (count($unit) <= 0) {
        $unituu = ProdUnit::where('prodID', $prodect)->get();
        foreach ($unituu as $item) {
            $punit = new ProdUnit();
            $punit->prodID = $item->prodID;
            $punit->unitID = $item->unitID;
            $punit->unitname = $item->unitname;
            $punit->quantity = $item->quantity;
            $punit->price = $item->price;
            $punit->sales = $item->sales;
            $punit->purchase = $item->purchase;
            $punit->report = $item->report;
            $punit->compon = $item->compon;
            $punit->count = 0;
            $punit->costprodect = 0;
            $punit->saller = 0;
            $punit->countSaller = 0;
            $punit->orgID = auth()->user()->orgID;
            $punit->StoreId = $dept;
            $punit->start = 0;
            $punit->Tainted = 0;
            $punit->save();
        }
    }

    if ($index == 0) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    $items->countSaller = $items->countSaller - ($price / $unit[0]->quantity) * $quantity;
                    if ($index == 2) {
                        $items->count = $items->count - $items->quantity * $quantity * $unit[1]->quantity;
                    } else {
                        $items->count = $items->count - $items->quantity * $quantity;
                    }
                    if($items->count !=0){

                        $items->costprodect = $items->countSaller / ($items->count + $items->start);

                    }else{
                        $items->costprodect =$unit[$index]->price;
                    }

                    $items->save();
                }
            }
        }
    } elseif ($index == 1) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    $items->countSaller = $items->countSaller - ($price / $unit[0]->quantity) * $quantity;

                    if ($index == 0) {
                        if (count($unit) > 1) {
                            $items->count = $items->count - ($items->quantity * $quantity) / $unit[1]->quantity;
                        } else {
                            $items->count = $items->count - $items->quantity * $quantity;
                        }
                    } elseif ($index == 2) {
                        if (count($unit) > 1) {
                            $items->count = $items->count - $items->quantity * $quantity;
                        } else {
                            $items->count = $items->count - $items->quantity * $quantity;
                        }
                    } else {
                        $items->count = $items->count - $quantity;
                    }
                    if($items->count !=0){

                        $items->costprodect = $items->countSaller / ($items->count + $items->start);

                    }else{
                        $items->costprodect =$unit[$index]->	price;
                    }


                    $items->save();
                }
            }
        }
    } else {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    $items->countSaller = $items->countSaller - ($price / $unit[0]->quantity) * $quantity;
                    if ($index == 0) {
                        if (count($unit) > 2) {
                            $items->count = $items->count - $quantity / ($unit[1]->quantity * $unit[2]->quantity);
                        } elseif (count($unit) > 1) {
                            $items->count = $items->count - $quantity / $unit[1]->quantity;
                        } else {
                            $items->count = $items->count - $quantity;
                        }
                    } elseif ($index == 1) {
                        if (count($unit) > 2) {
                            $items->count = $items->count - $quantity / $unit[2]->quantity;
                        } else {
                            $items->count = $items->count - $quantity;
                        }
                    } else {
                        $items->count = $items->count - $quantity;
                    }

                    if($items->count !=0){

                        $items->costprodect = $items->countSaller / ($items->count + $items->start);

                    }else{
                        $items->costprodect =$unit[$index]->	price;
                    }

                    $items->save();
                }
            }
        }
    }
}
function UiteAllSub($indexm, $prodect, $price1, $quantity1, $dept)
{
    $index = (float) $indexm;
    $price = (float) $price1;
    $quantity = (float) $quantity1;
    $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();

    if (count($unit) <= 0) {
        $unituu = ProdUnit::where('prodID', $prodect)->get();
        foreach ($unituu as $item) {
            $punit = new ProdUnit();
            $punit->prodID = $item->prodID;
            $punit->unitID = $item->unitID;
            $punit->unitname = $item->unitname;
            $punit->quantity = $item->quantity;
            $punit->price = $item->price;
            $punit->sales = $item->sales;
            $punit->purchase = $item->purchase;
            $punit->report = $item->report;
            $punit->compon = $item->compon;
            $punit->count = 0;
            $punit->costprodect = 0;
            $punit->saller = 0;
            $punit->countSaller = 0;
            $punit->orgID = auth()->user()->orgID;
            $punit->StoreId = $dept;
            $punit->start = 0;
            $punit->Tainted = 0;
            $punit->save();
        }
    }

    if ($index == 0) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    $items->countSaller = $items->countSaller - ($price / $unit[0]->quantity) * $quantity;
                    if ($index == 2) {
                        $items->count = $items->count - $items->quantity * $quantity * $unit[1]->quantity;
                    } else {
                        $items->count = $items->count - $items->quantity * $quantity;
                    }
                    if($items->count !=0){

                        $items->costprodect = $items->countSaller / ($items->count + $items->start);

                    }else{
                        $items->costprodect =$unit[$index]->	price;
                    }

                    $items->save();
                }
            }
        }
    } elseif ($index == 1) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    $items->countSaller = $items->countSaller - ($price / $unit[0]->quantity) * $quantity;

                    if ($index == 0) {
                        if (count($unit) > 1) {
                            $items->count = $items->count - ($items->quantity * $quantity) / $unit[1]->quantity;
                        } else {
                            $items->count = $items->count - $items->quantity * $quantity;
                        }
                    } elseif ($index == 2) {
                        if (count($unit) > 1) {
                            $items->count = $items->count - $items->quantity * $quantity;
                        } else {
                            $items->count = $items->count - $items->quantity * $quantity;
                        }
                    } else {
                        $items->count = $items->count - $quantity;
                    }
                    if($items->count !=0){

                        $items->costprodect = $items->countSaller / ($items->count + $items->start);

                    }else{
                        $items->costprodect =$unit[$index]->	price;
                    }


                    $items->save();
                }
            }
        }
    } else {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    $items->countSaller = $items->countSaller - ($price / $unit[0]->quantity) * $quantity;
                    if ($index == 0) {
                        if (count($unit) > 2) {
                            $items->count = $items->count - $quantity / ($unit[1]->quantity * $unit[2]->quantity);
                        } elseif (count($unit) > 1) {
                            $items->count = $items->count - $quantity / $unit[1]->quantity;
                        } else {
                            $items->count = $items->count - $quantity;
                        }
                    } elseif ($index == 1) {
                        if (count($unit) > 2) {
                            $items->count = $items->count - $quantity / $unit[2]->quantity;
                        } else {
                            $items->count = $items->count - $quantity;
                        }
                    } else {
                        $items->count = $items->count - $quantity;
                    }

                    if($items->count !=0){

                        $items->costprodect = $items->countSaller / ($items->count + $items->start);

                    }else{
                        $items->costprodect =$unit[$index]->	price;
                    }

                    $items->save();
                }
            }
        }
    }
}

/*     *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 */

function UiteAllSeller($prodect, $quantity1, $dept)
{
    $quantity = (float) $quantity1;

    $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->orderBy('id', 'DESC')->get();
    if (count($unit) > 0) {
        $count1 = 1;
        $count2 = 1;
        foreach ($unit as $index => $items) {
            if ($items->unitID != null) {
                if ($index == 0) {
                    $items->saller = $items->saller + $quantity;
                    $count1 = $items->quantity;
                } elseif ($index == 1) {
                    $items->saller = $items->saller + $quantity / $count1;
                    $count2 = $items->quantity;
                } else {
                    $items->saller = $items->saller + $quantity / ($count1 * $count2);
                }

                $items->save();
            }
        }
    }
}

function TaintedUnite($index, $prodect, $quantity1, $dept)
{
    $quantity = (float) $quantity1;
    if ($index == 0) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    if ($index == 2) {
                        $items->Tainted = $items->Tainted + $items->quantity * $quantity * $unit[1]->quantity;
                    } else {
                        $items->Tainted = $items->Tainted + $items->quantity * $quantity;
                    }

                    $items->save();
                }
            }
        }
    } elseif ($index == 1) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    if ($index == 0) {
                        if (count($unit) > 1) {
                            $items->Tainted = $items->Tainted + ($items->quantity * $quantity) / $unit[1]->quantity;
                        } else {
                            $items->Tainted = $items->Tainted + $items->quantity * $quantity;
                        }
                    } elseif ($index == 2) {
                        if (count($unit) > 1) {
                            $items->Tainted = $items->Tainted + $items->quantity * $quantity;
                        } else {
                            $items->Tainted = $items->Tainted + $items->quantity * $quantity;
                        }
                    } else {
                        $items->Tainted = $items->Tainted + $quantity;
                    }

                    $items->save();
                }
            }
        }
    } else {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    if ($index == 0) {
                        if (count($unit) > 2) {
                            $items->Tainted = $items->Tainted + $quantity / ($unit[1]->quantity * $unit[2]->quantity);
                        } elseif (count($unit) > 1) {
                            $items->Tainted = $items->Tainted + $quantity / $unit[1]->quantity;
                        } else {
                            $items->Tainted = $items->Tainted + $quantity;
                        }
                    } elseif ($index == 1) {
                        if (count($unit) > 2) {
                            $items->Tainted = $items->Tainted + $quantity / $unit[2]->quantity;
                        } else {
                            $items->Tainted = $items->Tainted + $quantity;
                        }
                    } else {
                        $items->Tainted = $items->Tainted + $quantity;
                    }

                    $items->save();
                }
            }
        }
    }
}

/*     *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 */

function UiteAllSellersub($prodect, $quantity1, $dept)
{
    $quantity = (float) $quantity1;
    $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->orderBy('id', 'DESC')->get();
    if (count($unit) > 0) {
        $count1 = 1;
        $count2 = 1;
        foreach ($unit as $index => $items) {
            if ($items->unitID != null) {
                if ($index == 0) {
                    $items->saller = $items->saller - $quantity;
                    $count1 = $items->quantity;
                } elseif ($index == 1) {
                    $items->saller = $items->saller - $quantity / $count1;
                    $count2 = $items->quantity;
                } else {
                    $items->saller = $items->saller - $quantity / ($count1 * $count2);
                }

                $items->save();
            }
        }
    }
}

/*     *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 */

function UiteAllSellerArrangement($prodect, $quantity1, $dept, $flage)
{
    $quantity = (float) $quantity1;
    $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->orderBy('id', 'DESC')->get();
    if (count($unit) > 0) {
        $count1 = 1;
        $count2 = 1;
        foreach ($unit as $index => $items) {
            if ($items->unitID != null) {
                if ($index == 0) {
                    if ($flage == 0) {
                        $items->count = $quantity;
                    } else {
                        $items->countSaller = $quantity * $items->costprodect;
                        $items->count = $quantity;
                    }

                    $count1 = $items->quantity;
                } elseif ($index == 1) {
                    if ($index == 0) {
                        $items->count = $quantity / $count1;
                    } else {
                        $items->countSaller = ($quantity / $count1) * $items->costprodect;
                        $items->count = $quantity / $count1;
                    }
                    $count2 = $items->quantity;
                } else {
                    if ($index == 0) {
                        $items->count = $quantity / ($count1 * $count2);
                    } else {
                        $items->countSaller = ($quantity / ($count1 * $count2)) * $items->costprodect;
                        $items->count = $quantity / ($count1 * $count2);
                    }
                }

                $items->save();
            }
        }
    }
}

function Arrangementunit($index, $prodect, $Countitems, $quantity1, $dept, $flage, $price1)
{
    $price = (float) $quantity1 * (float) $price1;
    $quantity = (float) $Countitems - (float) $quantity1;
    $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();

    if (count($unit) <= 0) {
        $unituu = ProdUnit::where('prodID', $prodect)->get();
        foreach ($unituu as $item) {
            $punit = new ProdUnit();
            $punit->prodID = $item->prodID;
            $punit->unitID = $item->unitID;
            $punit->unitname = $item->unitname;
            $punit->quantity = $item->quantity;
            $punit->price = $item->price;
            $punit->sales = $item->sales;
            $punit->purchase = $item->purchase;
            $punit->report = $item->report;
            $punit->compon = $item->compon;
            $punit->count = 0;
            $punit->costprodect = 0;
            $punit->saller = 0;
            $punit->countSaller = 0;
            $punit->orgID = auth()->user()->orgID;
            $punit->StoreId = $dept;
            $punit->start = 0;
            $punit->Tainted = 0;
            $punit->save();
        }
    }

    if ($index == 0) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    if ($flage == 1) {
                        $items->countSaller = $price;
                    }

                    if ($index == 2) {
                        $items->count = $items->count - $items->quantity * $quantity * $unit[1]->quantity;
                    } else {
                        $items->count = $items->count - $items->quantity * $quantity;
                    }
                    //   $items->costprodect = $items->countSaller / ($items->count +$items->start);
                    $items->save();
                }
            }
        }
    } elseif ($index == 1) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    if ($flage == 1) {
                        $items->countSaller = $price;
                    }
                    //  $items->countSaller =  $items->countSaller -   ($price /   $unit[0]->quantity) *$quantity ;

                    if ($index == 0) {
                        if (count($unit) > 1) {
                            $items->count = $items->count - ($items->quantity * $quantity) / $unit[1]->quantity;
                        } else {
                            $items->count = $items->count - $items->quantity * $quantity;
                        }
                    } elseif ($index == 2) {
                        if (count($unit) > 1) {
                            $items->count = $items->count - $items->quantity * $quantity;
                        } else {
                            $items->count = $items->count - $items->quantity * $quantity;
                        }
                    } else {
                        $items->count = $items->count - $quantity;
                    }

                    //  $items->costprodect = $items->countSaller / ($items->count +$items->start);
                    $items->save();
                }
            }
        }
    } else {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    if ($flage == 1) {
                        $items->countSaller = $price;
                    }
                    //  $items->countSaller =  $items->countSaller -   ($price /   $unit[0]->quantity) *$quantity;
                    if ($index == 0) {
                        if (count($unit) > 2) {
                            $items->count = $items->count - $quantity / ($unit[1]->quantity * $unit[2]->quantity);
                        } elseif (count($unit) > 1) {
                            $items->count = $items->count - $quantity / $unit[1]->quantity;
                        } else {
                            $items->count = $items->count - $quantity;
                        }
                    } elseif ($index == 1) {
                        if (count($unit) > 2) {
                            $items->count = $items->count - $quantity / $unit[2]->quantity;
                        } else {
                            $items->count = $items->count - $quantity;
                        }
                    } else {
                        $items->count = $items->count - $quantity;
                    }
                    //$items->costprodect = $items->countSaller / ($items->count +$items->start);
                    $items->save();
                }
            }
        }
    }
}

/*     *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 */

function UiteAllSellerStoreConversionsub($index, $prodect, $quantity1, $dept)
{
    $quantity = (float) $quantity1;
    $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();

    if (count($unit) <= 0) {
        $unituu = ProdUnit::where('prodID', $prodect)->get();
        foreach ($unituu as $item) {
            $punit = new ProdUnit();
            $punit->prodID = $item->prodID;
            $punit->unitID = $item->unitID;
            $punit->unitname = $item->unitname;
            $punit->quantity = $item->quantity;
            $punit->price = $item->price;
            $punit->sales = $item->sales;
            $punit->purchase = $item->purchase;
            $punit->report = $item->report;
            $punit->compon = $item->compon;
            $punit->count = 0;
            $punit->costprodect = 0;
            $punit->saller = 0;
            $punit->countSaller = 0;
            $punit->orgID = auth()->user()->orgID;
            $punit->StoreId = $dept;
            $punit->start = 0;
            $punit->Tainted = 0;

            $punit->save();
        }
    }

    if ($index == 0) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    if ($index == 2) {
                        $items->ComeOut = $items->ComeOut + $items->quantity * $quantity * $unit[1]->quantity;
                    } else {
                        $items->ComeOut = $items->ComeOut + $items->quantity * $quantity;
                    }

                    $items->save();
                }
            }
        }
    } elseif ($index == 1) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    if ($index == 0) {
                        if (count($unit) > 1) {
                            $items->ComeOut = $items->ComeOut + ($items->quantity * $quantity) / $unit[1]->quantity;
                        } else {
                            $items->ComeOut = $items->ComeOut + $items->quantity * $quantity;
                        }
                    } elseif ($index == 2) {
                        if (count($unit) > 1) {
                            $items->ComeOut = $items->ComeOut + $items->quantity * $quantity;
                        } else {
                            $items->ComeOut = $items->ComeOut + $items->quantity * $quantity;
                        }
                    } else {
                        $items->ComeOut = $items->ComeOut + $quantity;
                    }

                    $items->save();
                }
            }
        }
    } else {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    if ($index == 0) {
                        if (count($unit) > 2) {
                            $items->ComeOut = $items->ComeOut + $quantity / ($unit[1]->quantity * $unit[2]->quantity);
                        } elseif (count($unit) > 1) {
                            $items->ComeOut = $items->ComeOut + $quantity / $unit[1]->quantity;
                        } else {
                            $items->ComeOut = $items->ComeOut + $quantity;
                        }
                    } elseif ($index == 1) {
                        if (count($unit) > 2) {
                            $items->ComeOut = $items->ComeOut + $quantity / $unit[2]->quantity;
                        } else {
                            $items->ComeOut = $items->ComeOut + $quantity;
                        }
                    } else {
                        $items->ComeOut = $items->ComeOut + $quantity;
                    }
                    $items->save();
                }
            }
        }
    }
}

/*     *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 */

function UiteAllSellerStoreConversionadd($index, $prodect, $quantity1, $dept)
{
    $quantity = (float) $quantity1;
    $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();

    if (count($unit) <= 0) {
        $unituu = ProdUnit::where('prodID', $prodect)->get();
        foreach ($unituu as $item) {
            $punit = new ProdUnit();
            $punit->prodID = $item->prodID;
            $punit->unitID = $item->unitID;
            $punit->unitname = $item->unitname;
            $punit->quantity = $item->quantity;
            $punit->price = $item->price;
            $punit->sales = $item->sales;
            $punit->purchase = $item->purchase;
            $punit->report = $item->report;
            $punit->compon = $item->compon;
            $punit->count = 0;
            $punit->costprodect = 0;
            $punit->saller = 0;
            $punit->countSaller = 0;
            $punit->orgID = auth()->user()->orgID;
            $punit->StoreId = $dept;
            $punit->start = 0;
            $punit->Tainted = 0;

            $punit->save();
        }
    }

    if ($index == 0) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    if ($index == 2) {
                        $items->comeIn = $items->comeIn + $items->quantity * $quantity * $unit[1]->quantity;
                    } else {
                        $items->comeIn = $items->comeIn + $items->quantity * $quantity;
                    }

                    $items->save();
                }
            }
        }
    } elseif ($index == 1) {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    if ($index == 0) {
                        if (count($unit) > 1) {
                            $items->comeIn = $items->comeIn + ($items->quantity * $quantity) / $unit[1]->quantity;
                        } else {
                            $items->comeIn = $items->comeIn + $items->quantity * $quantity;
                        }
                    } elseif ($index == 2) {
                        if (count($unit) > 1) {
                            $items->comeIn = $items->comeIn + $items->quantity * $quantity;
                        } else {
                            $items->comeIn = $items->comeIn + $items->quantity * $quantity;
                        }
                    } else {
                        $items->comeIn = $items->comeIn + $quantity;
                    }

                    $items->save();
                }
            }
        }
    } else {
        $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->get();
        if (count($unit) > 0) {
            foreach ($unit as $index => $items) {
                if ($items->unitID != null) {
                    if ($index == 0) {
                        if (count($unit) > 2) {
                            $items->comeIn = $items->comeIn + $quantity / ($unit[1]->quantity * $unit[2]->quantity);
                        } elseif (count($unit) > 1) {
                            $items->comeIn = $items->comeIn + $quantity / $unit[1]->quantity;
                        } else {
                            $items->comeIn = $items->comeIn + $quantity;
                        }
                    } elseif ($index == 1) {
                        if (count($unit) > 2) {
                            $items->comeIn = $items->comeIn + $quantity / $unit[2]->quantity;
                        } else {
                            $items->comeIn = $items->comeIn + $quantity;
                        }
                    } else {
                        $items->comeIn = $items->comeIn + $quantity;
                    }
                    $items->save();
                }
            }
        }
    }
}

/*     *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 *************************************************************
 */

function UniteVolume($prodect, $quantity1, $dept)
{
    $quantity = (float) $quantity1;
    $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->orderBy('id', 'DESC')->get();
    if (count($unit) > 0) {
        $count1 = 1;
        $count2 = 1;
        foreach ($unit as $index => $items) {
            if ($items->unitID != null) {
                if ($index == 0) {
                    $items->costprodect = $quantity;
                } elseif ($index == 1) {
                    $items->costprodect = $quantity * $unit[1]->quantity;
                } else {
                    $items->costprodect = $quantity * $unit[1]->quantity * $unit[0]->quantity;
                }

                $items->save();
            }
        }
    }
}

function Manufacturunit($prodect, $quantity1, $dept)
{
    $quantity = (float) $quantity1;
    $unit = ProdUnit::where('prodID', $prodect)->where('StoreId', $dept)->orderBy('id', 'DESC')->get();
    if (count($unit) > 0) {
        $count1 = 1;
        $count2 = 1;
        foreach ($unit as $index => $items) {
            if ($items->unitID != null) {
                if ($index == 0) {
                    $items->count = $items->count + $quantity;
                    $count1 = $items->quantity;
                } elseif ($index == 1) {
                    $items->count = $items->count + $quantity / $count1;
                    $count2 = $items->quantity;
                } else {
                    $items->count = $items->count + $quantity / ($count1 * $count2);
                }

                $items->save();
            }
        }
    }
}

function AccountAllData()
{
    $arr = [
        ['id' => '1', 'source' => 0, 'type' => 0, 'name' => 'الاصول', 'father' => '0', 'val0' => 'Assets', 'main' => 'الميزانية العمومية', 'status' => '0'],
        ['id' => '2', 'source' => 0, 'type' => 1, 'name' => 'الخصوم', 'father' => '0', 'val0' => 'Liabilities', 'main' => 'الميزانية العمومية', 'status' => '0'],
        ['id' => '3', 'source' => 0, 'type' => 1, 'name' => '  حقوق الملكية', 'father' => '0', 'val0' => 'Property Rights', 'main' => 'الميزانية العمومية', 'status' => '0'],
        ['id' => '4', 'source' => 0, 'type' => 1, 'name' => 'الايرادات', 'father' => '0', 'val0' => 'Revenues', 'main' => 'الميزانية العمومية', 'status' => '0'],
        ['id' => '5', 'source' => 0, 'type' => 0, 'name' => 'المصروفات', 'father' => '0', 'val0' => 'Expenses', 'main' => 'الميزانية العمومية', 'status' => '0'],

        // الاصول
        ['id' => '11', 'source' => 1, 'type' => 0, 'name' => ' الاصول الثابتة', 'val0' => 'Fixed Assets', 'father' => '1', 'main' => 'الاصول', 'status' => '0'],
        ['id' => '12', 'source' => 1, 'type' => 0, 'name' => ' الاصول المتداولة', 'val0' => 'Current Assets', 'father' => '1', 'main' => 'الاصول', 'status' => '0'],

        // الاصول الثابتة
        ['id' => '111', 'source' => 7, 'type' => 0, 'name' => 'الاجهزة والمعدات', 'val0' => 'Equipment ', 'father' => '11', 'main' => 'الاصول الثابتة', 'status' => '0'],
        ['id' => '112', 'source' => 7, 'type' => 0, 'name' => 'وسائل النقل', 'father' => '11', 'val0' => 'Vehicles', 'main' => 'الاصول الثابتة', 'status' => '0'],

        // الاصول المتداولة
        ['id' => '121', 'source' => 7, 'type' => 0, 'name' => 'الصندوق', 'val0' => 'Treasury', 'father' => '12', 'main' => 'الاصول المتداولة', 'status' => '0'],
        ['id' => '122', 'source' => 7, 'type' => 0, 'name' => 'البنك', 'val0' => 'Bank', 'father' => '12', 'main' => 'الاصول المتداولة', 'status' => '0'],
        ['id' => '123', 'source' => 7, 'type' => 0, 'name' => 'عهد الموظفين', 'val0' => 'Petty Cash ', 'father' => '12', 'main' => 'الاصول المتداولة', 'status' => '0'],
        ['id' => '124', 'source' => 7, 'type' => 0, 'name' => 'العملاء', 'father' => '12', 'val0' => 'Customers', 'main' => 'الاصول المتداولة', 'status' => '0'],
        ['id' => '125', 'source' => 7, 'type' => 0, 'name' => 'المخزن', 'father' => '12', 'val0' => 'Inventory', 'main' => 'الاصول المتداولة', 'status' => '0'],
        ['id' => '126', 'source' => 7, 'type' => 0, 'name' => 'مصروفات مدفوعة مقدما', 'val0' => 'Expenses paid in advance', 'father' => '12', 'main' => 'الاصول المتداولة', 'status' => '0'],

        ['id' => '122001', 'source' => 7, 'type' => 0, 'name' => 'بنك افتراضي', 'val0' => 'Virtual Bank', 'father' => '122', 'main' => ' البنك', 'status' => '1'],
        ['id' => '121001', 'source' => 7, 'type' => 0, 'name' => 'صندوق افتراضي', 'val0' => 'Virtual Treasury', 'father' => '121', 'main' => ' الصندوق', 'status' => '1'],
        ['id' => '125001', 'source' => 7, 'type' => 0, 'name' => 'المستودع الرئيسي ', 'val0' => 'Main Repository', 'father' => '125', 'main' => ' المخزن', 'status' => '1'],

        // خصوم
        ['id' => '21', 'source' => 0, 'type' => 1, 'name' => 'خصوم متداولة', 'val0' => 'Current Liabilities ', 'father' => '2', 'main' => 'خصوم', 'status' => '0'],
        ['id' => '22', 'source' => 0, 'type' => 1, 'name' => 'خصوم طويلة الاجل', 'val0' => 'Long-term Liabilities', 'father' => '2', 'main' => 'خصوم', 'status' => '0'],

        // خصوم متداولة
        ['id' => '221', 'source' => 12, 'type' => 1, 'name' => 'الموردين ', 'val0' => 'Suppliers', 'father' => '21', 'main' => 'خصوم متداولة', 'status' => '0'],
        ['id' => '222', 'source' => 12, 'type' => 1, 'name' => 'أوراق الدفع ', 'val0' => 'Notes Payable ', 'father' => '21', 'main' => 'خصوم متداولة', 'status' => '0'],
        ['id' => '223', 'source' => 12, 'type' => 1, 'name' => ' قروض قصيرة لاجل ', 'val0' => 'Short-term Liabilities', 'father' => '21', 'main' => 'خصوم متداولة', 'status' => '0'],

        // حقوق الملكية
        ['id' => '31', 'source' => 3, 'type' => 1, 'name' => 'راس المال', 'father' => '3', 'val0' => 'Profits For The Current Year', 'main' => 'راس المال وحقوق الملكية', 'status' => '0'],
        ['id' => '32', 'source' => 3, 'type' => 1, 'name' => 'ارباح السنة الجارية', 'father' => '3', 'val0' => 'Stage Profits And Losses', 'main' => 'راس المال وحقوق الملكية', 'status' => '0'],
        ['id' => '34', 'source' => 3, 'type' => 1, 'name' => ' حساب مال الشريك', 'father' => '3', 'val0' => "Partner's Money Account", 'main' => 'راس المال وحقوق الملكية', 'status' => '0'],

        //يرادات
        ['id' => '41', 'source' => 4, 'type' => 1, 'name' => ' ايرادات مبيعات', 'val0' => 'Sales Revenue', 'father' => '4', 'main' => 'الايرادات', 'status' => '0'],
        ['id' => '42', 'source' => 4, 'type' => 1, 'name' => 'ايرادات اخرى', 'father' => '4', 'val0' => 'Other Income', 'main' => 'الايرادات', 'status' => '0'],
        ['id' => '43', 'source' => 4, 'type' => 1, 'name' => ' اربح وخسائر', 'father' => '4', 'val0' => 'Profit And Loss', 'main' => 'الايرادات', 'status' => '0'],

        ['id' => '411', 'source' => 4, 'type' => 1, 'name' => 'مبيعات', 'father' => '41', 'val0' => 'Sales', 'main' => 'مبيعات الايرادات', 'status' => '0'],
        ['id' => '412', 'source' => 4, 'type' => 1, 'name' => 'مرتجع مبيعات', 'father' => '41', 'val0' => 'Sales Returns', 'main' => 'مبيعات الايرادات', 'status' => '0'],

        ['id' => '421', 'source' => 4, 'type' => 1, 'name' => ' ايرادات ايجار', 'father' => '42', 'val0' => 'Rental Income', 'main' => 'ايرادات اخرى', 'status' => '0'],
        ['id' => '422', 'source' => 4, 'type' => 1, 'name' => ' ايرادات استثمار', 'father' => '42', 'val0' => 'Investment Income', 'main' => 'ايرادات اخرى', 'status' => '0'],

        // مصروفات
        ['id' => '51', 'source' => 5, 'type' => 0, 'name' => 'تكلفة مبيعات ', 'father' => '5', 'val0' => 'Cost of Sales', 'main' => 'مصروفات', 'status' => '0'],
        ['id' => '52', 'source' => 5, 'type' => 0, 'name' => 'مصروفات اداره', 'father' => '5', 'val0' => 'Management Expenses', 'main' => 'مصروفات', 'status' => '0'],
        ['id' => '53', 'source' => 5, 'type' => 0, 'name' => 'مصروفات اهلاك', 'father' => '5', 'val0' => 'Depreciation Expenses', 'main' => 'مصروفات', 'status' => '0'],
        ['id' => '54', 'source' => 5, 'type' => 0, 'name' => 'مصروفات اخرى', 'father' => '5', 'val0' => 'Other Expenses', 'main' => 'مصروفات', 'status' => '0'],

        ['id' => '511', 'source' => 5, 'type' => 0, 'name' => ' مشتريات ', 'father' => '51', 'val0' => 'Purchases', 'main' => 'تكلفة مبيعات ', 'status' => '0'],
        ['id' => '512', 'source' => 5, 'type' => 0, 'name' => 'مرتجع مشتريات ', 'father' => '51', 'val0' => 'Purchase Returns', 'main' => 'تكلفة مبيعات ', 'status' => '0'],
    ];

    return $arr;
}

function currency()
{
    $currency = [
        'ALL' => 'ريال سعودي',
        'AFN' => 'دولار امريكي ',
        'wds' => 'يورو',
        'eew' => 'ين صيني',
    ];

    return $currency;
}
