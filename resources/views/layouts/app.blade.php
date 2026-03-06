<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

    <div class="flex bg-gray-200  ">
 
    <div id ="sidebar" class="  bg-blue-900 w-64 xl:w-96 2xl:w-96 h-screen py-2 xl:py-16 fixed  -translate-x-full xl:translate-x-0 transition-transform duration-300 ">
        <h2 class=" text-center text-white text-base md:text-3xl xl:text-7xl 2xl:text-7xl font-sans">PayPoint</h2>
        
        <aside>
        <aside>
            <nav >
                <ul class=" text-center items-center text-white text-xl xl:text-5xl mt-2 xl:mt-48">
                    <li class="block hover:text-blue-200">
                        <a href="{{route('dashboard')}}"><i class="fa-solid fa-house text-base xl:text-4xl text-gray-300"></i> Dashboard</a> </li>
                    <li class="block mt-2 xl:mt-6"><a href="{{route('products.create')}}"><i class="fa-solid fa-cart-shopping text-base xl:text-4xl text-gray-300"></i> Products</a> </li>
                    <li class="block mt-2 xl:mt-6  hover:text-blue-200"><a href="{{route('categorys.create')}}"><i class="fa-solid fa-layer-group text-base xl:text-4xl text-gray-300"></i> Categories</a></li>
                    <li class="block mt-2 xl:mt-6 hover:text-blue-200" ><a href="{{route('supplier.create')}}"><i class="fa-solid fa-truck-fast text-base xl:text-4xl text-gray-300"></i> Suppliers</a></li>
                    <li class="block mt-2 xl:mt-6 hover:text-blue-200"><a href="{{route('users.create')}}"><i class="fa-solid fa-users text-base xl:text-4xl text-gray-300 "></i> Users</a></li>
                    <li class="block mt-2 xl:mt-6 hover:text-blue-200"><a href="{{route('sale.pos')}}"><i class="fa-solid fa-dollar-sign text-base xl:text-4xl text-gray-300 font-thin"></i> Sales</a></li>

                </ul>
            </nav>
        </aside>
        </div>
    

    <div class="flex-1 justify-center ml-0 xl:ml-96  h-screen bg-gray-100">
        @yield('content')
    </div>

</div>



        <!-- check anyones that login to broadcast it -->
        @if(auth()->check())
<script>
    // Add yourself immediately
    const me = { id: {{ auth()->id() }}, name: "{{ auth()->user()->name }}" };
    addUser(me);

    window.Echo.join('system-online')
        .here((users) => {
            console.log('online-users', users);
            updateOnlineUsers(users);
        })
        .joining((user) => {
            console.log(user.name + ' logged in');
            addUser(user);
        })
        .leaving((user) => {
            console.log(user.name + ' went offline');
            removeUser(user.id);
        });

       


     ///toggle
     const sidebar = document.getElementById('sidebar');
     const togglebtn = document.getElementById('togglebtn');

     let sidebarOpen = false;

     togglebtn.addEventListener('click', () => {
        sidebarOpen = !sidebarOpen;
        if(sidebarOpen){
            sidebar.classList.remove('-translate-x-full'); //hidden 
            sidebar.classList.add('translate-x-0');       //visible
        }
        else{
            sidebar.classList.remove('translate-x-0');// visible
            sidebar.classList.add('-translate-x-full'); //hidden
        }
     });
</script>
@endif

    </body>
</html>
