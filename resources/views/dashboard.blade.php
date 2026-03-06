
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

    @extends('layouts.app')

    @section('content')
    
        <div class="flex justify-between items-center  bg-white p-4">
            
        <button id="togglebtn" class="xl:hidden p-2 text-3xl font-bold ">☰</button>
        <h2 class=" text-base 1g:text-4xl xl:text-6xl p-2 xl:p-5 font-serif">Admin dashboard</h2>
        <form action="{{route('logout')}}" method="POST">
            @csrf
        <button type="submit" class="text-base xl:text-3xl text-white bg-red-700 rounded-2xl mt-2 xl:mt-4 p-2 xl:p-4 hover:text-black hover:bg-red-400">Logout</button>
        </form>
        </div>
    <div class="  grid grid-cols-2 xl:grid-cols-4 2xl:grid-cols-5 gap-2 xl:gap-10 mt-2 xl:mt-10 mx-2 xl:mx-10">
        <div class="bg-white rounded-3xl shadow-md hover:shadow-xl transition duration-300">
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
        
            <div class="bg-white rounded-3xl ">
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
        <div class="bg-white rounded-3xl">
            <p class="text-center text-base xl:text-4xl mt-2 xl:mt-8 font-semibold">Active Users</p>
                <ul id="online-users">
                    
                </ul>
        </div>

       
    </div>
    <h2 class="mx-2 xl:mx-10 mt-2 xl:mt-10 text-xl xl:text-5xl 2xl:text-6xl font-serif">Reports</h2>
     <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 xl:gap-10 mt-2 xl:mt-10 mx-2 xl:mx-10">
            <div class="bg-white">
                <p>tt</p>
            </div>
            <div class="bg-white ">
                <p>tt</p>
            </div>
             

        </div>
       
    

    
        
   
   @endsection
<script type="module">
    function loaddashboard(){
        
        fetch('api/dashboard',{
            headers:{'Accept' : 'application/json'}
        })
        .then(res => res.json())
        .then(data => {

              
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

    // function for presence channel
     function updateOnlineUsers(users){
        const list = document.getElementById('online-users')
        if(!list)return;

        list.innerHTML="";
        users.forEach(user =>{
            list.innerHTML += `
            <li id="user-${user.id}"> ${user.name} 🟢</li>
            `;
        });
     }

     function addUser(user){
         const list = document.getElementById('online-users')
        if(!list)return;

            
    if (document.getElementById(`user-${user.id}`)) return;
            
            li.id =`user-${user.id}`;
            li.textContent = `${user.name} 🟢`;
            list.appendChild(li);
            
        
     }

     function removeUser(userID){
        const el = document.getElementById(`user-${userID}`);
          if(el) el.remove();
     }



</script>
</body>
</html>