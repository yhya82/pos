
   

    @extends('layouts.app')

    @section('content')
    
        <div class="flex justify-between items-center  bg-white p-4 mt-12 rounded-xl">
            
        
        <h2 class="text-4xl lg:text-6xl p-2 xl:p-5 font-serif">Admin dashboard</h2>
       
        </div>
    <div class=" grid grid-cols-2 xl:grid-cols-4 2xl:grid-cols-5 gap-2 xl:gap-6 mt-4 xl:mt-10 ">

        <div class=" flex flex-col items-center bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 p-3 lg:p-5">
            <p class=" text-2xl xl:text-4xl text-blue-400 font-thin">Total Revenue</p>
            <p id="totalsales" class=" text-base lg:text-2xl mt-2 xl:mt-6 font-bold"> </p>
        </div>
        <div class="flex flex-col items-center bg-white rounded-xl p-3 lg:p-5">
            <p class="text-yellow-600 text-center text-2xl xl:text-4xl  font-thin">Total Sales</p>
            <p id="todaysales" class="text-center text-base xl:text-2xl mt-2 xl:mt-6 font-bold"></p>
        </div>
        <div class=" flex flex-col items-center bg-white rounded-xl p-2 lg:p-5">
            <p class="text-center text-base xl:text-4xl  font-thin ">Categories</p>
            <p id="categorycount" class="text-center text-base xl:text-2xl mt-2 xl:mt-6 font-bold"></p>
        </div>
        
            <div class=" flex flex-col items-center bg-white rounded-xl p-3 lg:p-5 ">
             <p class="text-center text-base xl:text-4xl  font-thin">Products</p>
            <p id="productscount" class="text-center text-base xl:text-2xl mt-2 xl:mt-6 font-bold"></p>
        </div>
        <div  class="flex flex-col items-center bg-white rounded-xl p-3 lg:p-5 ">
             <p class="text-center text-base xl:text-4xl  font-thin">Lowstock</p>
             <div id="lowstock">
             @foreach($lowstock as $product)
            <p  class="text-center text-base xl:text-2xl mt-2 xl:mt-6 font-bold">{{$product->name}} {{$product->quantity}}</p>
            @endforeach
             </div>
        </div>
        <div class="flex flex-col items-center bg-white rounded-xl p-3 lg:p-5 ">
             <p class="text-center text-base xl:text-4xl font-thin">Users</p>
            <p id="userscount" class="text-center text-base xl:text-2xl mt-2 xl:mt-6 font-bold"></p>
        </div>
        <div class=" flex flex-col items-center bg-white rounded-xl p-3 lg:p-5">
            <p class="text-center text-base xl:text-4xl  font-thin">Active Users</p>
                <ul id="online-users">
                    
                </ul>
        </div>

       
    </div>
    <div>
    
     <div class="flex flex-col-reverse lg:flex-row  gap-2 lg:gap-6 mt-2 xl:mt-10 ">
            <div class="flex flex-col lg:w-3/4 mt-2 lg:mt-6">
                <h2 class=" text-2xl lg:text-4xl font-semibold">Reports</h2>
                <div class="bg-white mt-2">
                <canvas id="myChart" ></canvas>
                </div>
            </div>
            <div class="flex flex-col lg:w-1/4 mt-2 lg:mt-6">
                 <h2 class="text-2xl lg:text-4xl font-semibold">Quick Actions</h2>
                <div class=" flex flex-col gap-2  bg-white mt-2">
                    <button class="bg-red-800 text-white text-2xl lg:text-3xl p-1 lg:p-2 font-semibold hover:bg-red-500"><a href="">Create Sale</a></button>
                    <button class="bg-blue-900 text-white text-2xl lg:text-3xl p-1 lg:p-2 font-semibold hover:bg-blue-500"><a href="">Add Product</a></button>
                    <button class="bg-yellow-500 text-white text-2xl lg:text-3xl p-1 lg:p-2 font-semibold hover:bg-yellow-200"><a href="">Add User</a></button>
                 </div>
             </div>

        </div>
       
    </div>

    
        
   
   @endsection

   @section('script')
    <script>

     
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
            
            const li = document.createElement('li');
            li.id =`user-${user.id}`;
            li.textContent = `${user.name} 🟢`;
            list.appendChild(li);
            
        
     }

     function removeUser(userID){
        const el = document.getElementById(`user-${userID}`);
          if(el) el.remove();
     }



</script>

@endsection