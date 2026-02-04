<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
     @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <section class="h-screen xl:h-[100vh] bg-gray-100 ">
         
        <div class="grid grid-cols xl:grid-cols-3 ">

            <div class=" bg-gray-100 col-span-2 py-2 xl:py-10" >
                <h2 class="text-3xl xl:text-7xl text-center  font-bold ">PayPoint</h2>

                <div class="flex justify-end mx-2 xl:mx-16 xl:mt-10  gap-10"><!-- nav bar for categories -->
                    <div class="mx-2 xl:mx-6"><!--search button -->
                        <form action="{{route('sale.pos')}}" method="GET" >
                            <input class="w-80 p-5 rounded-2xl" type="text" name="search" value="{{request('search')}}" placeholder="Search Products">

                            @if(request('category'))
                            <input type="hidden" name="category" value="{{request('category')}}">
                            @endif

                            <button class="bg-blue-700 text-sm xl:text-2xl text-gray-200 rounded-xl p-4"  type="submit" style="display:inline">Search</button>
                        </form>
                       </div>

                    <div><!--category -->
                    <a href="{{route('sale.pos')}}" class="text-base xl:text-3xl text-white bg-blue-700 p-4 xl:p-4 rounded-2xl font-semibold hover:bg-blue-400">All</a>
                     @foreach ($categorys as $category)
                    <a href="{{route('sale.pos',['category' => $category->id])}}"  class="{{request('category')== $category->id}} text-base xl:text-3xl text-white bg-blue-700 p-4 xl:p-4 rounded-2xl font-semibold  hover:bg-blue-400"> {{$category->name}}</a>
                       @endforeach
                       </div>
                       
                </div>


                <div class="grid grid-cols-2 1g:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 gap-5 mx-2 xl:mx-6 mt-2 xl:mt-8"><!-- for cards -->
                    @foreach ($products as $product)
                    <div class="shadow-lg rounded-2xl p-4 flex flex-col justify-between bg-white" > 
                   
                    <p class="text-base xl:text-3xl text-center font-semibold">{{$product->name}}</p>
                    <p class="text-base xl:text-2xl text-center font-semibold mt-1 xl:mt-2" >  D{{ number_format($product->price,2)}}</p>
                    
                    <form action="{{route('sales.additem')}}" method="POST" class="">
                    @csrf
                    
                    <input type="hidden" name="sale_id" value="{{$sale->id}}">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    
                    <input type="hidden" name="quantity" value="1" min="1">
                    <button class="bg-green-700 text-sm xl:text-xl mx-2 xl:mx-8 p-2 rounded-xl text-white font-semibold mt-2 xl:mt-4 hover:bg-green-500" type="submit">Add item</button>
                    </form>
                </div>
                
                 @endforeach
                </div>
            </div>

            <div class="bg-gray-200 h-screen px-10 w-full py-2 xl:py-10"><!-- cart -->
                
                <h2 class="text-3xl xl:text-5xl text-center mt-2 xl:mb-5 font-bold ">Current Sale</h2>
                 <a href="{{route('sale.index')}}" class="text-base xl:text-3xl italic hover:text-blue-300">View Sales History</a>
                <table class="border border-gray w-full cellpadding='5' mt-2 xl:mt-6">
                    <thead class="bg-gray-400 text-base xl:text-3xl p-1 xl:p-5">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    @foreach($sale->items as $item)
                     <tbody class="odd:bg-white even:bg-gray-200 text-center text-sm xl:text-2xl">
                    <tr>
                       
                        <td>{{$item->product->name}}</td>
                        <td>{{number_format($item->product->price,2)}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{number_format($item->subtotal,2)}}</td>
                        <td>
                            <form action="{{route('sales.removeitem', $item->id)}}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 font-semibold hover:text-red-300">Remove</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                    @endforeach
                </table>
                <form action="{{route('sales.completesale')}}" method="POST">
                    @csrf

                    <select class="mt-2 xl:mt-8 w-1/2 text-sm xl:text-2xl" name="payment_method" >
                        <option class="text-sm xl:text-base" value="">Select Payment Method</option>
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                        <option value="transfer">Transfer</option>
                    </select>
                    <button type ="submit" class="text-sm xl:text-xl p-2 xl:p-4 bg-green-700 text-white rounded-xl w-1/4 mx-2 xl:mx-8 hover:bg-green-400">Complete Sale</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>