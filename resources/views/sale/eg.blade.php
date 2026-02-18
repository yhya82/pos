<!-- <form action="{{route('sales.additem')}}" method="POST">
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
                </div> -->

                <!--  <div><!--category -->
                    <a href="{{route('sale.pos')}}" class="text-base xl:text-3xl text-white bg-blue-700 p-4 xl:p-4 rounded-2xl font-semibold hover:bg-blue-400">All</a>
                     @foreach ($categorys as $category)
                     <select id="category">
                        <li><a href="{{route('sale.pos',['category' => $category->id])}}"  class="{{request('category')== $category->id}} text-base xl:text-3xl text-white bg-blue-700 p-4 xl:p-4 rounded-2xl font-semibold  hover:bg-blue-400"> {{$category->name}}</a><li>
                        @endforeach
                        </select>
                       </div>

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
                       