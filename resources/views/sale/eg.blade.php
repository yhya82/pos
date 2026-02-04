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