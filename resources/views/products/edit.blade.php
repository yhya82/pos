<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <form action="{{route ('products.update',$product->id)}}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Name</label><br>
        <input type="text" name="name" value="{{$product->name}}" placeholder="Enter name"><br>
        <label>Price</label><br>
        <input type="text" name="price" value="{{$product->price}}" placeholder="Enter price"><br>
        <label>Quantity</label><br>
        <input type="text" name="quantity" value="{{$product->quantity}}" placeholder="Enter quantity"><br>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>