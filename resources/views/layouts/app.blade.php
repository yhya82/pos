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
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

    <div class="flex bg-gray-200  ">
 
    
        <div>
        <aside id ="sidebar" class=" p-4 lg:p-8 overflow-y-scroll bg-gray-100 w-80 h-screen z-30 inset-y-0 left-0 fixed lg:relative transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ">
            <div class="flex flex-col mt-16">
                <h2 class=" text-5xl lg:text-6xl font-serif">PayPoint</h2>
                <p class="mt-2 text-base lg:text-xl text-blue-800">Pos Management System</p>
        
            </div>

            
                <ul class=" flex flex-col gap-2 lg:gap-4 mt-8 lg:mt-24">
                    <!-- ui permissions for admin -->
                    @if(optional(auth()->user())->role =='admin')
                        <div class="flex space-x-2 lg:space-x-4 hover:bg-blue-800 hover:p-2 hover:lg:p-4 hover:rounded-2xl">
                        <i class="fa-solid fa-house text-2xl lg:text-3xl text-gray-500 hover:text-white"> </i>
                        <a href="{{route('dashboard')}}" class="text-2xl lg:text-4xl hover:text-white">Dashboard</a>
                        </div>
                        <div class="flex space-x-2 lg:space-x-4 hover:bg-blue-800 hover:p-2 hover:lg:p-4 hover:rounded-2xl">
                        <i class="fa-solid fa-shopping-cart text-2xl lg:text-3xl text-gray-500 hover:text-white"> </i>
                        <a href="{{route('products.create')}}" class="text-2xl lg:text-4xl hover:text-white">Products</a>
                        </div>
                        <div class="flex space-x-2 lg:space-x-4  hover:bg-blue-800 hover:p-2 hover:lg:p-4 hover:rounded-2xl">
                        <i class="fa-solid fa-layer-group text-2xl lg:text-3xl text-gray-500 hover:text-white"> </i>
                        <a href="{{route('categorys.create')}}" class="text-2xl lg:text-4xl hover:text-white">Category</a>
                        </div>
                        <div class="flex space-x-2 lg:space-x-4  hover:bg-blue-800 hover:p-2 hover:lg:p-4 hover:rounded-2xl">
                        <i class="fa-solid fa-truck-fast text-2xl lg:text-3xl text-gray-500 hover:text-white"> </i>
                        <a href="{{route('supplier.create')}}" class="text-2xl lg:text-4xl hover:text-white">Supplier</a>
                        </div>
                        <div class="flex space-x-2 lg:space-x-4  hover:bg-blue-800 hover:p-2 hover:lg:p-4 hover:rounded-2xl">
                        <i class="fa-solid fa-users text-2xl lg:text-3xl text-gray-500 hover:text-white"> </i>
                        <a href="{{route('users.create')}}" class="text-2xl lg:text-4xl hover:text-white">Users</a>
                        </div>
                     @endif
                        <div class="flex space-x-2 lg:space-x-4  hover:bg-blue-800 hover:p-2 hover:lg:p-4 hover:rounded-2xl">
                        <i class="fa-solid fa-dollar-sign text-2xl lg:text-3xl text-gray-500 hover:text-white"> </i>
                        <a href="{{route('sale.pos')}}" class="text-2xl lg:text-4xl hover:text-white">Sale</a>
                        </div>
                        
                        
                        <div class="flex justify-center fixed bottom-5 bg-red-700 rounded-xl  hover:bg-red-400 p-3 lg:p-5">
                             <form action="{{route('logout')}}" method="POST">
                              @csrf
                            <button type="submit" class="text-2xl lg:text-4xl text-white ">Logout</button>
                            </form>
                        </div>
                </ul>
            
        </aside>

        <button id="btn" class=" lg:hidden absolute top-2 left-2 z-40"><i class="fa-solid fa-bars text-3xl"></i></button>
        </div>
    


    <div class="overflow-y-auto flex-1   h-screen bg-gray-200 px-4 lg:px-16">
        @yield('content')
        
        @yield('script')
    </div>

</div>



        <!-- check anyones that login to broadcast it -->
        
<script>
    

       


     ///toggle
     const sidebar = document.getElementById('sidebar');
     const button = document.getElementById('btn');

     button.addEventListener('click', () =>{
        sidebar.classList.toggle('-translate-x-full')
     });

     
</script>


    </body>
</html>
