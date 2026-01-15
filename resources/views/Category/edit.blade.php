<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <form action="{{route('categorys.update',$category->id)}}" Method="POST">
        @csrf
        @method('PUT')
        <label >Name</label><br>
        <input type="text" name="name" value="{{$category->name}}"><br>
        
        <button type='submit'>Update Category</button>
    </form>
</body>
</html>