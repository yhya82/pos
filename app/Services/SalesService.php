<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Events\SaleCreated;

use Illuminate\Support\Facades\DB;

class SalesService
{
    public function getOrCreateSale(int $userId ):Sale
    {
        return $sale = Sale::firstOrCreate(
                ['user_id' => $userId, 'status' => 'pending'],
                ['total' => 0]
        );
    }

    public function addItem(int $userId, int $productId, int $quantity): SaleItem
    {
        return DB::transaction(function () use ($userId, $productId, $quantity) {
            // get or create a new sale
            $sale = $this->getOrCreateSale($userId);
            

            // apply business rules and check product
            $product = Product::findOrFail($productId);
            if ($product->quantity < $quantity) {
                throw new \Exception ('Insufficient stock for ' . $product->name);
            }

            // add or update sale item
            $saleItem = SaleItem::firstOrNew([
                'sale_id' => $sale->id,
                'product_id' => $productId,
            ]);

            $saleItem->price = $product->price;
            $saleItem->quantity = ($saleItem->quantity ?? 0) + $quantity;
            $saleItem->subtotal = ($saleItem->subtotal ?? 0) + ($product->price * $quantity);
            $saleItem->save();

            // decrement product stock
            $product->quantity -= $quantity;
            $product->save();

            // update sale total
            $sale->total = $sale->items()->sum('subtotal');
            
            $sale->save();

            // fire event here
            event(new SaleCreated($sale));

            return $saleItem;
        });
    }

    public function completeSale(int $userId, string $paymentMethod ): Sale 
    {
        
     return DB::transaction(function () use($userId, $paymentMethod) {

        $sale = Sale::where('user_id', $userId)->where('status', 'pending')->with('items')->firstOrFail();


        if($sale->items->isEmpty()){
            throw new \Exception('cannot complete an empty sale');
        }
        
          
         $sale->payment_method = $paymentMethod;
         $sale->status = 'completed';
         $sale->save();
        

        return $sale;
        
       

     });
     
    }
}
