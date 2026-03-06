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
    <div class="max-w-6xl xl:max-w-7xl mx-auto px-4 mt-10 xl:mt-32">
        <div class="overflow-x-auto ">
    <h2 class="text-xl xl:text-5xl 2xl:text-6xl font-bold">Product List</h2>
    <a href="{{route('products.create')}}" class="text-base xl:text-xl 2xl:text-2xl mt-2 xl:mt-6 text-blue-800 font-semibold hover:text-blue-300">Create new product</a>
    <table class="min-w-full text-sm text-left border mt-4 xl:mt-6">
        <thead class="text-xl xl:text-4xl 2xl:text-6xl bg-gray-400 uppercase p-3 xl:p-5 space-x-10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>quantity </th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="table-body" class="text-center text-base xl:text-2xl 2xl:text-3xl">

        </tbody>
        </div>
    </div>
      @endsection
    </table>
    <script>
        const csrfToken = '{{ csrf_token() }}';

        async function loadProducts(){
            try{
            const response = await fetch(`/api/products`);
            const result = await response.json();
            const products = result.data;

            const tbody = document.getElementById('table-body');
            tbody.innerHTML="";

            products.forEach(product=> {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                        <td>${product.id}</td>
                         <td>${product.name}</td>
                         <td>${product.price}</td>
                         <td>${product.quantity}</td>
                         <td>${product.category ? product.category.name : 'N/A'}</td>
                        <td>${product.supplier ? product.supplier.name : 'N/A'}</td>
                        <td>  
                            <a class="text-blue-800 hover:text-blue-400" href="/products/${product.id}/edit">Edit</a>
                        <button class="text-red-800 hover:text-red-300" onclick="deleteProduct(${product.id})">Delete</button>
                        
                             </td> `;

                tbody.appendChild(tr);
            });


            }catch(error) {
                console.error('error loading products',error);
            }   
        }

         //function to delete product
            function deleteProduct(id){
                if(!confirm('Delete this product')) return;

                fetch(`/api/products/${id}`,{
                    method:'DELETE',
                    headers:{'Accept':'application/json',
                            'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(res => res.json())
                .then(data =>{
                    alert(data.message);

                    loadProducts();
                })
                .catch(error =>{
                    console.error('Error:',error);
                    alert('Delete failed')
                });
            }
            window.addEventListener('DOMContentLoaded', loadProducts);
    </script>
</body>
</html>