<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('supplier.store')}}" method="POST">
        @csrf
        <label>Name</label><br>
        <input type="text" name="name" placeholder="Enter name"><br>
        <label>Address</label><br>
        <input type="text" name="address" placeholder="Enter address"><br>
        <label>Phone</label><br>
        <input type="text" name="phone" placeholder="Enter phone"><br>
        <label>Email</label><br>
        <input type="email" name="email" placeholder="Enter email"><br>

        <button type="submit">Add Supplier</button>


    </form>
</body>
</html>