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
    <h2 class="text-xl xl:text-5xl font-bold mt-10 xl:mt-32">Update Supplier</h2>
    <form action="{{route('supplier.update',$supplier->id)}}" method="POST" class="max-w-6xl mx-auto">
        @csrf
        @method('PUT')
        <a href="{{route('suplier.index')}}" class="text-base xl:text-2xl font-semibold text-blue-800 hover:text-blue-300">view suppliers</a><br>
        <label>Name</label>
        <input type="text" name="name" value="{{$supplier->name}}" class="w-12 h-8 xl:h-16">
        <label>Address</label>
        <input type="text" name="address" value="{{$supplier->address}}" class="w-12 h-8 xl:h-16">
        <label>Phone</label>
        <input type="text" name="phone" value="{{$supplier->phone}}" class="w-12 h-8 xl:h-16">
        <label>Email</label>
        <input type="email" name="email" value="{{$supplier->email}}" class="w-12 h-8 xl:h-16">
        
        <button type="submit" class="bg-blue-800 p-3 xl:p-6 rounded-full text-1g md:text-2xl xl:text-4xl text-white font-bold mt-6 xl:mt-10 hover:bg-blue-500">Update Supplier</button>


    </form>
    @endsection
</body>
</html>