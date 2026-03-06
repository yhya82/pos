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
    <div class="mt-10 xl:mt-32">
    <form action="{{route('categorys.store')}}" method="POST" class="max-w-6xl mx-auto">
         

        @csrf
        
        <h2 class= "text-xl xl:text-5xl font-bold text-center">Category</h2>
        <a href="{{route('categorys.index')}}" class=" text-xl xl:text-3xl 2xl:text-4xl   text-blue-700 rounded-3xl mb-2 xl:mb-4 hover:text-blue-200" >view categories</a><br>
        <label class="text-xl xl:text-3xl">Name</label><br>
        <input type="text" name="name" placeholder="Enter Category" class="w-1/2 h-16"><br>
        
        <button type='submit' class="bg-blue-800 p-3 xl:p-6 rounded-full text-1g md:text-2xl xl:text-3xl text-white font-bold mt-4 xl:mt-6 hover:bg-blue-500">Add Category</button>
    </form>
    </div>
@endsection
</body>
</html>