<x-app-layout>
   <div class="grid grid-cols-2 xl:grid-cols-3">
    <div class="bg-blue-800 w-3/4 h-screen py-2 xl:py-16">
        <aside>
            <nav>
                <ul class=" text-center text-white text-base xl:text-5xl">
                    <li class=" hover:text-blue-200"><a href="{{route('products.create')}}"><i class="fa-solid fa-cart-shopping"></i> Products</a> </li>
                    <li class="mt-2 xl:mt-6  hover:text-blue-200"><a href="{{route('categorys.create')}}"> Categories</a></li>
                    <li class="mt-2 xl:mt-6 hover:text-blue-200" ><a href="{{route('supplier.create')}}"><i class="fa-solid fa-truck-fast"></i> Suppliers</a></li>
                    <li class="mt-2 xl:mt-6 hover:text-blue-200"><a href="{{route('users.create')}}"><i class="fa-solid fa-users"></i> Users</a></li>
                    <li class="mt-2 xl:mt-6 hover:text-blue-200"><a href="{{route('sale.pos')}}"><i class="fa-solid fa-dollar-sign"></i> Sales</a></li>

                </ul>
            </nav>
        </aside>

    </div>
    <div class="col-span-2" >
    <div class=" grid grid-cols-2 xl:grid-cols-3 gap-2 xl:gap-10 mt-2 xl:mt-10 mx-2 xl:mx-10">
        <div class="bg-white rounded-3xl ">
            <p class="text-center text-base xl:text-5xl mt-2 xl:mt-8 font-semibold">Total Revenue</p>
            <p  class="text-center text-base xl:text-2xl mt-2 xl:mt-6"> D {{$totalsales}}</p>
        </div>
        <div class="bg-white rounded-3xl ">
            <p class="text-center text-base xl:text-5xl mt-2 xl:mt-8 font-semibold">Total Sales</p>
            <p class="text-center text-base xl:text-2xl mt-2 xl:mt-6">D {{$todaysales}}</p>
        </div>
        <div class="bg-white rounded-3xl ">
            <p class="text-center text-base xl:text-5xl mt-2 xl:mt-8 font-semibold ">Categories</p>
            <p class="text-center text-base xl:text-2xl mt-2 xl:mt-6">{{$categoryCount}}</p>
        </div>
        

       
    </div>

    <div class="grid grid-cols-2 xl:grid-cols-3 gap-2 xl:gap-10 mt-2 xl:mt-10 mx-2 xl:mx-10">
         <div class="bg-white rounded-3xl ">
             <p class="text-center text-base xl:text-5xl mt-2 xl:mt-8 font-semibold">Products</p>
            <p  class="text-center text-base xl:text-2xl mt-2 xl:mt-6">{{$productsCount}}</p>
        </div>
        <div class="bg-white rounded-3xl ">
             <p class="text-center text-base xl:text-5xl mt-2 xl:mt-8 font-semibold">Lowstock</p>
             @foreach($lowstock as $product)
            <p  class="text-center text-base xl:text-2xl mt-2 xl:mt-6">{{$product->name}} {{$product->quantity}}</p>
            @endforeach
        </div>
        <div class="bg-white rounded-3xl ">
             <p class="text-center text-base xl:text-5xl mt-2 xl:mt-8 font-semibold">Users</p>
            <p  class="text-center text-base xl:text-2xl mt-2 xl:mt-6">{{$userCount}}</p>
        </div>
    </div>
    
   </div>
   </div>
</x-app-layout>
