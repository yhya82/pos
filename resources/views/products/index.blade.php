<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Product List</h2>
    <a href="{{route('products.create')}}">Create new product</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>quantity </th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Actions</th>
        </tr>
        <tbody id="table-body">

        </tbody>
      
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
                            <a href="/products/${product.id}/edit">Edit</a>
                        <button onclick="deleteProduct(${product.id})">Delete</button>
                        
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