<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'price'=> 'required',
            'quantity'=>'required',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('Success',  'Product updated Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('products.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=> 'required',
            'price'=> 'required',
            'quantity'=>'required',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('succes','product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success','product deleted successfully');
        
    }
}
