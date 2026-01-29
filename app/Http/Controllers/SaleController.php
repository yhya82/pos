<?php

namespace App\Http\Controllers;

use App\Services\SalesService;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    protected SalesService $saleService;

    public function __construct(SalesService $saleService)
    {
        $this->saleService = $saleService;
    }
    //function to add item in the cart
    public function addItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        try {

            $saleItem = $this->saleService->addItem(
                auth()->id(),
                
                $request->product_id,
                $request->quantity
            );

            $sale = $saleItem->sale;

            return redirect()->route('sale.pos')->with('success','item added');
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
    // function to show the pos page with the products and pasing the sale id to the blade
    public function pos()
    {
        $products = Product::all();

        $sale = $this->saleService->getOrCreateSale(auth()->id());
        
        return view('sale.pos',compact('products','sale'));
    }

    // function to complete sale
    public function completeSale(Request $request)
    {
        $request->validate([
            'payment_method'=>'required',
        ]);
        try{
            $sale = $this->saleService->completeSale(
                auth()->id(),
                $request->payment_method,
            );

            return redirect()->route('sale.index')->with('success','sale completed');
            
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }

    }

    // function to remove sale items
    public function removeItem(SaleItem $saleItem){
        DB::transaction(function() use($saleItem)  {

             $sale = Sale::where('id',$saleItem->sale_id)->lockForUpdate()->first();
           $product = $saleItem->product;

           if (!$sale || $sale->status !== 'pending') {
                abort(403, 'Cannot modify completed sale');
            }

           //restore product
           $product->increment('quantity',$saleItem->quantity);

           //update total
           $sale->decrement('total',$saleItem->price * $saleItem->quantity);

           // delete the items
           $saleItem->delete();

        });

        return back()->with('success','items deleted'); 

    }

    // function to show all sales(sales history)
    public function index(){

        $user = auth()->user();

        if($user->role === 'admin'){

        $sales = Sale::with(['items','user'])->orderby('createad_at','desc')->get();
        }else {
             $sales = Sale::with(['items'])->where('user_id',$user->id)->orderby('createad_at','desc')->get();
        }
        
        return view('sale.index',compact('sales'));

    }

}
