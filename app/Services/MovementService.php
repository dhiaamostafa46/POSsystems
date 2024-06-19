<?php

namespace App\Services;

use App\Models\Movement;

class MovementService
{
    public function MovementStore($name, $branchID, $type, $total_mov, $available_balance, $create_by)
    {
        $movement = new Movement();
        $movement->name = $name;
        $movement->branchID = $branchID;
        $movement->type = $type;
        $movement->total_mov = $total_mov;
        $movement->available_balance = $available_balance;
        $movement->create_by = $create_by;
        $movement->save();
        return $movement;

    }
}
