<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <section class="py-2 xl:py-10">
        <div class="grid grid-cols xl:grid-cols-2">
            <div>
                <!-- nav bar for categories -->
                
                <!-- for cards -->
                <h2 class="text-4xl ">Pos system</h2>
                <a href="{{route('sale.index')}}">View Sales History</a>
                <form action="{{route('sales.additem')}}" method="POST">
                    @csrf
                    
                    <input type="hidden" name="sale_id" value="{{$sale->id}}">
                    <label>Product</label>
                    <select name="product_id">
                        <option value="">Select Products</option>
                        @foreach ($products as $product)
                        <option value="{{$product->id}}">
                            {{$product->name}}
                        </option>
                            
                        @endforeach

                    </select>
                    <label >Quantity</label>
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit">Add item</button>
                </form>

            </div>
            <div>
                <!-- cart -->
                <h2>Current Sale</h2>
                <table border="1" cellpadding='5'>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>

                    @foreach($sale->items as $item)
                    <tr>
                        <td>{{$item->product->name}}</td>
                        <td>{{number_format($item->product->price,2)}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{number_format($item->subtotal,2)}}</td>
                        <td>
                            <form action="{{route('sales.removeitem', $item->id)}}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <form action="{{route('sales.completesale')}}" method="POST">
                    @csrf

                    <select name="payment_method" >
                        <option value="">Select Payment Method</option>
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                        <option value="transfer">Transfer</option>
                    </select>
                    <button type ="submit">Complete Sale</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>