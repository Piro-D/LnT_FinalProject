<?php 
namespace App\Http\Controllers;

use App\Models\inventory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $inventory = inventory::all(); // Get inventory data
        return view('welcome', compact('inventory'));
    }
}
