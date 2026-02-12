<?php

namespace App\Http\Controllers;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

    return view('dashboard',[
        'totalsales'=> Sale::sum('total'),
        'todaysales'=> Sale::whereDate('created_at',today())->sum('total'),
        'productsCount'=> Product::count(),
        'lowstock'=>Product::where('quantity','<', 5)->get(),
        'categoryCount'=>Category::count(),
        'userCount' => User::count(),

    ]);
    }
}
