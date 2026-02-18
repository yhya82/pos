<?php

namespace App\Http\Controllers\Api;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;
use App\Services\SalesService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    protected SalesService $saleService;
    
    public function __construct (SalesService $saleService){

    $this->saleService = $saleService;
    }

    public function addItem(Request $request){
        $validated = $request->validate([
            'product_id'=> 'required',
            'quantity' => 'required',
        ]);
        try{
                $saleItem = $this->saleService->addItem(
                auth()->id() ?? 1,
                $validated['product_id'],
                $validated['quantity']

            );

            return response()->json([
                'message' => 'product added',
                'data' => $saleItem->load('product')
            ],201);

        } catch(\Exception $e){
                return response()->json([
                    'message'=> $e->getMessage()
                ],400);
        }
    }

    public function pos(Request $request){
          $categorys = Category::all();

        $products = Product::when($request->category, function ($query) use ($request) {
            $query->where('category_id', $request->category);
             })->when($request->search, function ($query) use ($request){
                $query->where('name','like','%'.$request->search.'%');
             })->get();
         


        $sale = $this->saleService->getOrCreateSale(auth()->id());

            return response()->json([
                'products' => $products,
                'categories'=> $categorys,
                'sale'=> $sale->load('items.product')
            ]);
            

    }

    public function completeSale(Request $request){

        $validated = $request->validate([
            'payment_method' => 'required',
        ]);
        
        try{
            
            $sale = $this->saleService->completeSale(
                auth()->id() ,
                $validated['payment_method']
            );

            return response()->json([
                'message'=>'sale completed',
                'data'=> $sale
            ]);

        }catch(\Exception $e){
            return response()->json([
                'message'=> $e->getMessage()
            ]);
        }
    }

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

        return response()->json([
            'message' => 'Saleitem removed',
            
        ]);
    }

    public function index(){
        $user = auth()->user();
        if($user->role == 'admin'){
            $sales = Sale::with(['user','items.product'])->orderby('created_at','desc')->get();
        }else{
            $sales = Sale::with(['items.product'])->where('user_id',$user->id)->orderby('created_at','desc')->get();
        }

        return response()->json([
            'data' => $sales
        ]);
    }
}
