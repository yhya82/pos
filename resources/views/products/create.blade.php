<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="{{route ('products.store')}}" method="POST">
        @csrf
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
             @foreach($suppliers as $supplier)
             <option value="{{$supplier->id}}">
                {{$supplier->name}}
             </option>
             @endforeach
        </select><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>