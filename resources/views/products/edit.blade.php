<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
      <h2 class="text-1g xl:text-6xl text-center font-bold mt-6 xl:mt-10">update form <h2>
     <form id ="edit-form" class="max-w-6xl mx-auto mt-24 space-y-2">
        @csrf
      <div  class="grid grid-cols-1 xl:grid-cols-2 gap-5">
        <div>
        <input type="hidden" id='product_id'>
        <label class="text-1g md:text-4xl">Name</label><br>
        <input type="text" id="name" class="w-full xl:h-16" ><br>
        </div>
        <div> 
        <label class="text-1g md:text-4xl">Price</label><br>
         <input type="text" id="price"  class="w-full xl:h-16"><br>
        </div>
        </div>
       
        <label class="text-1g md:text-4xl">Quantity</label><br>
        <input type="text" id='quantity' class="w-full xl:h-16"><br>
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
            <div>
        <select name="category_id" class="w-full xl:h-16">
            <option value="">Select Category</option>
            @foreach($categorys as $category)
            <option value="{{$category->id}}">
                {{$category->name}}
            </option>
            @endforeach
        </select><br>
        </div>
        <div>
        <select name="supplier_id" class="w-full xl:h-16">
            <option value="">Select Supplier</option>
            @foreach($suppliers as $supplier)
            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
            @endforeach
        </select><br>
        </div>
    </div>
    <div class="flex justify-center xl:justify-start">
        <button type="submit" class="bg-blue-800 p-3 xl:p-6 rounded-full text-1g md:text-2xl xl:text-4xl text-white font-bold mt-6 xl:mt-10 hover:bg-blue-500">Update Product</button>
    </div>
    </form>
    @endsection
</body>
<script>
    //loading the product into form
    document.addEventListener('DOMContentLoaded', function(){
        const pathSegments = window.location.pathname.split('/');
        const id = pathSegments[2];

        fetch(`/api/products/${id}`)
            .then(res => res.json())
            .then(result => {

                const product = result.data;
                document.getElementById('product_id').value = product.id;
                document.getElementById('name').value = product.name;
                document.getElementById('price').value = product.price;
                document.getElementById('quantity').value = product.quantity;
                document.querySelector('select[name="category_id"]').value = product.category_id;
                document.querySelector('select[name="supplier_id"]').value = product.supplier_id;

            });
        
    });

    //updating the product
    document.getElementById('edit-form').addEventListener('submit',function(e){
        e.preventDefault();

        const id = document.getElementById('product_id').value;

        fetch(`/api/products/${id}`,{
            method:'PUT',
            headers:{'Accept':'application/json',
                    'Content-type':'application/json'
            },
            body: JSON.stringify({
                name:document.getElementById('name').value,
                price:document.getElementById('price').value,
                quantity:document.getElementById('quantity').value,
                category_id:document.querySelector('select[name="category_id"]').value,
                supplier_id:document.querySelector('select[name="supplier_id"]').value
            })
        })
            .then( async res=>{
                const data = await res.json();
                if(!res.ok) throw data;
                return data;
            })
            .then(data => {
                alert(data.message || 'Product updated');
                window.location.href ='/products';

            })
       
            .catch(error => {
                if(error.errors){
                    console.log('validation errors');
                }else{
                    console.log('something went wrong');
                }
            });
    });
</script>
</html>