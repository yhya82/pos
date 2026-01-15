<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('supplier.update',$supplier->id)}}" method="POST">
        @csrf
        @method('PUT')
        <label>Name</label>
        <input type="text" name="name" value="{{$supplier->name}}">
        <label>Address</label>
        <input type="text" name="address" value="{{$supplier->address}}">
        <label>Phone</label>
        <input type="text" name="phone" value="{{$supplier->phone}}">
        <label>Email</label>
        <input type="email" name="email" value="{{$supplier->email}}">
        
        <button type="submit">Update Supplier</button>


    </form>
</body>
</html>