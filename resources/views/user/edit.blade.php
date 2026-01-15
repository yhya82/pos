<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <form action="{{route('users.update',$user->id)}}" method="POST" >
        @csrf
        @method('PUT')
        
        <label>Name</label><br>
        <input type="text" name="name" value="{{$user->name}}"><br>
        <label>email</label><br>
        <input type="email" name="email" value="{{$user->email}}"><br>
        <label>Password</label><br>
        <input type="text" name="password" value="{{$user->password}}"><br>
        <select name="role" >
            <option value="">Select role</option>
            <option value="admin" {{$user->role == 'admin' ? 'selected' : ''}}>admin</option>
            <option value="cashier " {{$user->role =='cashier' ? 'selected': ''}}>cashier</option>
        </select>
        <button type="submit">Update User</button>
    </form>
</body>
</html>