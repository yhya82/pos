<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('users.store')}}" method="POST">
        @csrf
        <h2>Create User</h2>
        <a href="{{route('users.index')}}">View users</a>
        <label>Name</label><br>
        <input type="text" name="name" placeholder="Enter name"><br>
        <label>email</label><br>
        <input type="email" name="email" placeholder="Enter email"><br>
        <label>Password</label><br>
        <input type="text" name="password" placeholder="Enter password"><br>
        <select name="role" >
            <option value="">Select role</option>
            <option value="admin">admin</option>
            <option value="cashier">cashier</option>
        </select>
        <button type="submit">Add User</button>
    </form>
</body>
</html>