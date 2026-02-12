<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <form id ="edit-form">
        @csrf
        <h2>update form <h2>
        <input type="hidden" id='product_id'>
        <label>Name</label><br>
        <input type="text" id="name" ><br>
        <label>Price</label><br>
        <input type="text" id="price" ><br>
        <label>Quantity</label><br>
        <input type="text" id='quantity'><br>
        <select name="category_id" >
            <option value="">Select Category</option>
            @foreach($categorys as $category)
            <option value="{{$category->id}}">
                {{$category->name}}
            </option>
            @endforeach
        </select><br>
        <select name="supplier_id" >
            <option value="">Select Supplier</option>
            @foreach($suppliers as $supplier)
            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
            @endforeach
        </select><br>
        <button type="submit">Update Product</button>
    </form>
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