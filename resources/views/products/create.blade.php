<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form id="product-form" >
        @csrf
        <a href="{{route('products.index')}}">view products</a>
        <h2>Product Form</h2>
        <label>Name</label><br>
        <input type="text" name="name" placeholder="Enter name"><br>
        <label>Price</label><br>
        <input type="text" name="price" placeholder="Enter price"><br>
        <label>Quantity</label><br>
        <input type="text" name="quantity" placeholder="Enter quantity"><br>
        <select name="category_id" >
            <option value="">Select Category</option>
                @foreach($categorys as $category)
                <option value="{{$category->id}}">
                    {{$category->name}}
                </option>
                @endforeach
        </select><br>
        <select name="supplier_id" >
            <option value="">select supplier</option>
             @foreach ($suppliers as $supplier)
             <option value="{{$supplier->id}}">
                {{$supplier->name}}
             </option>
             @endforeach
        </select><br>
        <button type="submit">Add product</button>
    </form>

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