<?php

namespace App\Http\Controllers\Api;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

    return response()->json([
        'totalsales' => Sale::sum('total'),
        'todaysales' => Sale::whereDate('created_at',today())->sum('total'),
        'productscount' => Product::count(),
        'lowstock' => Product::where('quantity','<',5)->get(),
        'categorycount' => Category::count(),
        'usercount' => User::count()

    ]);

    }
}
