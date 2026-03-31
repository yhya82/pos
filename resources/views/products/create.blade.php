
    @extends('layouts.app')

    @section('content')
    <div class="flex flex-col  mt-16 px-4 lg:px-16">
        <h2 class="text-4xl lg:text-6xl  font-bold ">Product Form</h2>
        <a href="{{route('products.index')}}" class=" text-xl lg:text-3xl   text-blue-700 rounded-3xl  hover:text-blue-200">view products</a>
    </div>

    <form id="product-form" class="px-4 lg:px-16 mt-2 lg:mt-6" >
        @csrf
        
        <div class="flex flex-col gap-2 lg:gap-5">

            <div class="flex flex-col">
                <label class="text-2xl lg:text-4xl">Name</label><br>
                 <input type="text" name="name" placeholder="Enter name" class="w-1/2 lg:w-1/4 xl:h-16 placeholder:text-xl placeholder:lg:text-2xl">
            </div>
            <div class="flex flex-col">
                <label class="text-2xl lg:text-4xl">Price</label><br>
                <input type="text" name="price" placeholder="Enter price" class="w-1/2 lg:w-1/4 xl:h-16 placeholder:text-xl placeholder:lg:text-2xl">
            </div>
        
            <div class="flex flex-col">
                <label class="text-2xl lg:text-4xl">Quantity</label><br>
                <input type="text" name="quantity" placeholder="Enter quantity" class="w-1/2 lg:w-1/4 h-16 placeholder:text-xl placeholder:lg:text-2xl">
            </div>
            <div class="flex flex-col">
                <label class="text-2xl lg:text-4xl">Category</label>
                <select name="category_id" class="w-1/2 lg:w-1/4 h-16 text-xl lg:text-2xl" >
                    <option value="">Select Category</option>
                     @foreach($categorys as $category)
                    <option value="{{$category->id}}">
                    {{$category->name}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col">
                <label class="text-2xl lg:text-4xl">Supplier</label>
                <select name="supplier_id"  class="w-1/2 lg:w-1/4 h-16 text-xl lg:text-2xl">
                    <option value="" class="text-2xl lg:text-4xl">select supplier</option>
                     @foreach ($suppliers as $supplier)
                    <option value="{{$supplier->id}}">
                         {{$supplier->name}}
                    </option>
                    @endforeach
                </select>
             </div>
           
            <div class="flex justify-start">
                <button type="submit" class="bg-blue-800 p-3 xl:p-6 rounded-2xl text-2xl lg:text-4xl text-white font-bold mt-4 lg:mt-6 hover:bg-blue-500">Add product</button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>

        document.getElementById('product-form').addEventListener('submit', async function(e){
            e.preventDefault();

            let formData = new FormData(this);
            let data = Object.fromEntries(formData.entries());
        
            try{
                let response = await fetch('/api/products',{
                    method : 'POST',
                    headers : {'Content-Type':'application/json',
                                'Accept':'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token()}}'
                    },
                    credentials: 'same-origin',
                    body:JSON.stringify(data)
                });

                if(!response.ok){
                    if(response.status ===422){
                        let errors = await response.json();
                        console.log(errors.errors);
                        alert('validation error check console');
                        return;
                    }
                    throw new Error('server error');
                }
                let result = await response.json();
                alert(result.message);
                console.log(result.data);
                this.reset();

                window.location.href='/products';

            } catch(err){
                console.log(err);
                alert('somethig went wrong');
            }
        });
    </script>
    @endsection

