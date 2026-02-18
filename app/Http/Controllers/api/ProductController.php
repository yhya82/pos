<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with(['category','supplier'])->get();

        return response()->json([
            'data'=>$products
        ]);
    }

    public function show(Product $product){
        
        $product->load(['category','supplier']);

        return response()->json([
            'data'=>$product
        ]);
    }

    public function store(Request $request){

         $validated = $request->validate([
            'name'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'category_id'=>'required|exists:categories,id',
            'supplier_id'=>'required|exists:suppliers,id',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'message'=>'Product created',
            'data'=>$product
        ],201);

    }

    public function update(Request $request, Product $product){
        
         $validated = $request->validate([
            'name'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'category_id'=>'required|exists:categories,id',
            'supplier_id'=>'required|exists:suppliers,id',
        ]);

        $product->update($validated);

        return response()->json([
            'message'=>'Product updated',
            'data'=>$product
        ]);
    }

    public function destroy(Product $product){
        $product->delete();
        return response()->json([
            'message'=>'product deleted',
        ],200);
    }
}
