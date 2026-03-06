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
    <div class="max-w-6xl mx-auto px-4">
        <div class="overflow-x-auto">
    <h2 class="text-2xl xl:text-5xl font-bold mt-10 xl:mt-32">Supplier List</h2>
            <a href="{{route('supplier.create')}}" class="text-xl xl:text-2xl text-blue-800 hover:text-blue-300">create new supplier</a>
    <table class="min-w-full border mt-4 xl:mt-6">
        <thead class="text-xl xl:text-3xl bg-gray-400 ">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Adress</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        @foreach($suppliers as $supplier)
        <tbody class="text-center text-base xl:text-xl">
        <tr>
            <td>{{$supplier->id}}</td>
            <td>{{$supplier->name}}</td>
            <td>{{$supplier->address}}</td>
            <td>{{$supplier->phone}}</td>
            <td>{{$supplier->email}}</td>
            <td>
                <a href="{{route('supplier.edit',$supplier->id)}}" class="text-blue-800 hover:text-blue-300">Edit</a> |
                <form action="{{route('supplier.destroy',$supplier->id)}}" method="POST" style="display:inline">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="text-red-800 hover:text-red-300">Delete</button>
                </form>
            </td>
        </tr>
        </tbody>
        @endforeach
    </table>
    </div>
</div>
@endsection
</body>
</html>