<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\inventory;
use App\Models\category;

class UserInventoryController extends Controller
{
    public function dashboard(){
        $inventory = inventory::where('amount', '>', 0)->with('category')->get();
        return view ('user.dashboard', compact('inventory'));
    }
}
