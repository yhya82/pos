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
    <div class="px-4 lg:px-16 mt-16">
        <div class="overflow-x-auto ">
    <h2 class="text-4xl lg:text-6xl font-bold">Product List</h2>
    <a href="{{route('products.create')}}" class="text-base lg:text-xl  mt-2 xl:mt-6 text-blue-800 font-semibold hover:text-blue-300">Create new product</a>
    <table class="min-w-max border border-gray-700 text-sm text-left mt-4 xl:mt-6">
        <thead class="text-2xl lg:text-4xl bg-gray-400 uppercase p-3 xl:p-5 gap-2 lg:gap-5 border border-gray-700 ">
        <tr>
            <th class="p-2 lg:p-4">ID</th>
            <th class="p-2 lg:p-4">Name</th>
            <th class="p-2 lg:p-4">Price</th>
            <th class="p-2 lg:p-4">quantity </th>
            <th class="p-2 lg:p-4">Category</th>
            <th class="p-2 lg:p-4">Supplier</th>
            <th class="p-2 lg:p-4">Actions</th>
        </tr>
        </thead>
        <tbody id="table-body" class="text-center text-xl lg:text-2xl border border-gray-500 ">

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