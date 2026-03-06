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
    <form action="{{route('users.store')}}" method="POST">
        @csrf
        <h2 class=" text-2xl xl:text-5xl text-center">Create User</h2><br>
        <a href="{{route('users.index')}}">View users</a><br>
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
    @endsection
</body>
</html>