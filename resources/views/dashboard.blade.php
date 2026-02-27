
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    



     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

   <div class="grid grid-cols-3 xl:grid-cols-3 bg-gray-200">
    <div class="bg-blue-800 w-3/4 h-screen py-2 xl:py-16">
        <h2 class=" text-center text-yellow-500 text-base xl:text-8xl font-bold">PayPoint</h2>
        <aside>
            <nav>
                <ul class=" text-center text-white text-base xl:text-5xl mt-2 xl:mt-32">
                    <li class=" hover:text-blue-200"><a href="{{route('products.create')}}"><i class="fa-solid fa-cart-shopping text-base xl:text-4xl text-yellow-300"></i> Products</a> </li>
                    <li class="mt-2 xl:mt-6  hover:text-blue-200"><a href="{{route('categorys.create')}}"><i class="fa-solid fa-layer-group text-base xl:text-4xl text-yellow-300"></i> Categories</a></li>
                    <li class="mt-2 xl:mt-6 hover:text-blue-200" ><a href="{{route('supplier.create')}}"><i class="fa-solid fa-truck-fast text-base xl:text-4xl text-yellow-300"></i> Suppliers</a></li>
                    <li class="mt-2 xl:mt-6 hover:text-blue-200"><a href="{{route('users.create')}}"><i class="fa-solid fa-users text-base xl:text-4xl text-yellow-300"></i> Users</a></li>
                    <li class="mt-2 xl:mt-6 hover:text-blue-200"><a href="{{route('sale.pos')}}"><i class="fa-solid fa-dollar-sign text-base xl:text-4xl text-yellow-300"></i> Sales</a></li>

                </ul>
            </nav>
        </aside>

    </div>
    <div class="col-span-2" >
        <div class="flex justify-center gap-2 xl:gap-32">
        <h2 class="text-center text-base 1g:text-4xl xl:text-6xl p-2 xl:p-5 font-bold">Welcome to the Admin dashboard</h2>
        <form action="{{route('logout')}}" method="POST">
            @csrf
        <button type="submit" class="text-base xl:text-3xl text-white bg-red-700 rounded-2xl mt-2 xl:mt-4 p-2 xl:p-4 hover:text-black hover:bg-red-400">Logout</button>
        </form>
        </div>
    <div class=" grid grid-cols-2 xl:grid-cols-3 gap-2 xl:gap-10 mt-2 xl:mt-10 mx-2 xl:mx-10">
        <div class="bg-white rounded-3xl h-32 xl:h-60">
            <p class="text-center text-base xl:text-4xl mt-2 xl:mt-8 font-semibold">Total Revenue</p>
            <p id="totalsales" class="text-center text-base xl:text-2xl mt-2 xl:mt-6 font-bold"> </p>
        </div>
        <div class="bg-white rounded-3xl ">
            <p class="text-yellow-600 text-center text-base xl:text-4xl mt-2 xl:mt-8 font-semibold">Total Sales</p>
            <p id="todaysales" class="text-center text-base xl:text-2xl mt-2 xl:mt-6 font-bold"></p>
        </div>
        <div class="bg-white rounded-3xl ">
            <p class="text-center text-base xl:text-4xl  mt-2 xl:mt-8 font-semibold ">Categories</p>
            <p id="categorycount" class="text-center text-base xl:text-2xl mt-2 xl:mt-6 font-bold"></p>
        </div>
        

       
    </div>

    <div class="grid grid-cols-2 xl:grid-cols-3 gap-2 xl:gap-10 mt-2 xl:mt-10 mx-2 xl:mx-10">
         <div class="bg-white rounded-3xl h-32 xl:h-60">
             <p class="text-center text-base xl:text-4xl  mt-2 xl:mt-8 font-semibold">Products</p>
            <p id="productscount" class="text-center text-base xl:text-2xl mt-2 xl:mt-6 font-bold"></p>
        </div>
        <div  class="bg-white rounded-3xl ">
             <p class="text-center text-base xl:text-4xl mt-2 xl:mt-8 font-semibold">Lowstock</p>
             <div id="lowstock">
             @foreach($lowstock as $product)
            <p  class="text-center text-base xl:text-2xl mt-2 xl:mt-6 font-bold">{{$product->name}} {{$product->quantity}}</p>
            @endforeach
             </div>
        </div>
        <div class="bg-white rounded-3xl ">
             <p class="text-center text-base xl:text-4xl mt-2 xl:mt-8 font-semibold">Users</p>
            <p id="userscount" class="text-center text-base xl:text-2xl mt-2 xl:mt-6 font-bold"></p>
        </div>
    </div>
    
   </div>
   </div>
<script type="module">
    function loaddashboard(){
        
        fetch('api/dashboard',{
            headers:{'Accept' : 'application/json'}
        })
        .then(res => res.json())
        .then(data => {

                console.log('API RESPONSE', data);
            document.getElementById('totalsales').textContent = 'D' + data.totalsales;
            document.getElementById('todaysales').textContent = 'D'+ data.todaysales;
            document.getElementById('categorycount').textContent = data.categorycount;
            document.getElementById('productscount').textContent = data.productscount;
            
            document.getElementById('userscount').textContent = data.usercount;

            const lowStockDiv = document.getElementById('lowstock');
             if (lowStockDiv) {
            lowStockDiv.innerHTML = ''; // clear previous
            data.lowstock.forEach(product => {
                const p = document.createElement('p');
                p.className = 'text-center text-base xl:text-2xl mt-2 xl:mt-6 font-bold';
                p.textContent = `${product.name} ${product.quantity}`;
                lowStockDiv.appendChild(p);
            });
        }
        })
    
        .catch(error => {
            console.log('error loading dashboard',error);
        });
    }
    loaddashboard();

    Echo.private('sales')
    .listen('SaleCreated', e =>{
       loaddashboard();
    })
    .listen('SaleItemRemoved', e => {
        loaddashboard();
    })
    .listen('SaleCompleted', e => {
        loaddashboard();
    });

</script>
</body>
</html>