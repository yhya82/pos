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
    <h2 class="text-xl xl:text-4xl font-bold text-center mt-10 xl:mt-32">Supplier form</h2>
    <form action="{{route('supplier.store')}}" method="POST" class="max-w-6xl mx-auto">
        @csrf
        <a href="{{route('supplier.index')}}" class=" text-xl xl:text-3xl 2xl:text-4xl   text-blue-700 rounded-3xl mb-2 xl:mb-4 hover:text-blue-200">view supliers</a><br>
        <label class="text-1g xl:text-3xl">Name</label><br>
        <input type="text" name="name" placeholder="Enter name" class="w-1/2 h-8 xl:h-16"><br>
        <label class="text-1g xl:text-3xl">Address</label><br>
        <input type="text" name="address" placeholder="Enter address" class="w-1/2 h-8 xl:h-16"><br>
        <label class="text-1g xl:text-3xl">Phone</label><br>
        <input type="text" name="phone" placeholder="Enter phone" class="w-1/2 h-8 xl:h-16"><br>
        <label class="text-1g xl:text-3xl">Email</label><br>
        <input type="email" name="email" placeholder="Enter email" class="w-1/2 h-8 xl:h-16"><br>

        <button type="submit" class="bg-blue-800 p-3 xl:p-6 rounded-full text-1g md:text-2xl xl:text-4xl text-white font-bold mt-6 xl:mt-10 hover:bg-blue-500">Add Supplier</button>


    
    </form>

    @endsection
</body>
</html>