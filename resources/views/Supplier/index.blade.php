<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Supplier List</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Adress</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        @foreach($suppliers as $supplier)
        <tr>
            <td>{{$supplier->id}}</td>
            <td>{{$supplier->name}}</td>
            <td>{{$supplier->address}}</td>
            <td>{{$supplier->phone}}</td>
            <td>{{$supplier->email}}</td>
            <td>
                <a href="{{route('supplier.edit',$supplier->id)}}">Edit</a> |
                <form action="{{route('supplier.destroy',$supplier->id)}}" method="POST" style="display:inline">
                     @csrf
                     @method('DELETE')
                     <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</body>
</html>