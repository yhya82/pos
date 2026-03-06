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
    <div class="max-w-6xl mx-auto mt-10 xl:mt-32">
        <div class="overflown-x-auto">
    <h2 class="text-2xl xl:text-5xl font-bold">Category List</h2>
    <a href="{{route('categorys.create')}}" class="text-xl xl:text-2xl font-semibold text-blue-800 hover:text-blue-400 mt-4 ">create new category</a>
    <table class="min-w-full border mt-3 xl:mt-5">
        <thead class="text-xl xl:text-4xl bg-gray-400">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        @foreach ($categorys as $category)
            <tbody class="text-center text-base xl:text-2xl">
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>
                    <a href="{{route('categorys.edit',$category->id)}}" class="text-blue-700 hover:text-blue-300">Edit</a> |
                    <form action="{{route('categorys.destroy',$category->id)}}" Method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-700 hover:text-red-300">Delete</button>
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