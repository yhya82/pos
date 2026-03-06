<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>
<body>
    @extends('layouts.app')

    @section('content')
    
    <h2 class="text-1g xl:text-6xl text-center font-bold mt-6 xl:mt-10">Product Form</h2>
    <form id="product-form" class="max-w-6xl space-y-2 mt-24 mx-auto " >
        @csrf
        <a href="{{route('products.index')}}" class=" text-xl xl:text-3xl 2xl:text-4xl   text-blue-700 rounded-3xl mb-2 xl:mb-4 hover:text-blue-200">view products</a>
        
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
            <div>
        <label class="text-1g md:text-4xl">Name</label><br>
        <input type="text" name="name" placeholder="Enter name" class="w-full xl:h-16"><br>
        </div>
        <div>
        <label class="text-1g md:text-4xl">Price</label><br>
        <input type="text" name="price" placeholder="Enter price" class="w-full xl:h-16"  ><br>
        </div>
        </div>
        <div>
        <label class="text-1g md:text-4xl">Quantity</label><br>
        <input type="text" name="quantity" placeholder="Enter quantity" class="w-full h-16"><br>
        </div>
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
        <div>
        <select name="category_id" class="w-full h-16" >
            <option value="">Select Category</option>
                @foreach($categorys as $category)
                <option value="{{$category->id}}">
                    {{$category->name}}
                </option>
                @endforeach
        </select>
        </div>
        <div>
        <select name="supplier_id"  class="w-full h-16">
            <option value="" class="text-1g xl:text-4xl">select supplier</option>
             @foreach ($suppliers as $supplier)
             <option value="{{$supplier->id}}">
                {{$supplier->name}}
             </option>
             @endforeach
        </select>
        </div>
    </div>
    <div class="flex justify-start">
        <button type="submit" class="bg-blue-800 p-3 xl:p-6 rounded-full text-1g md:text-2xl xl:text-4xl text-white font-bold mt-6 xl:mt-10 hover:bg-blue-500">Add product</button>
        </div>
    </form>
@endsection
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
</body>
</html>