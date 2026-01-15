<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('categorys.store')}}" method="POST" >
         

        @csrf
        
        <h2>Catgory</h2>
        <label >Name</label><br>
        <input type="text" name="name" placeholder="Enter Category"><br>
        
        <button type='submit'>Add Category</button>
    </form>

</body>
</html>