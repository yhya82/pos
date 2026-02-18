<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
     @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <section class="h-screen xl:h-[100vh] bg-gray-100 ">
         
        <div class="grid grid-cols xl:grid-cols-3 ">

            <div class=" bg-gray-100 col-span-2 py-2 xl:py-10" >
                

                <div class="flex justify-end px-2 xl:px-10 gap-2 xl:gap-4">
              <input class="w-80 p-5 rounded-2xl" type="text" id="search" value="{{request('search')}}" placeholder="Search Products">

                <select  id="category">
                    <option value="">All</option>
                    @foreach($categorys as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                   </select>
                   </div>    
                
                <!-- for cards -->
                    <div id="product-container" class="grid grid-cols-2 xl:grid-cols-4 gap-2 l:gap-4 px-2 xl:px-4 py-2 xl:py-8" ></div>
                 
            </div>

            <div class="bg-gray-200 h-[100vh] py-2 xl:py-20 w-full px-2 xl:px-4"><!-- cart -->
                <h2 class="text-3xl xl:text-7xl text-center  font-bold py-2 xl:py-10 ">PayPoint</h2>
                <h2 class="text-3xl xl:text-5xl text-center mt-2 xl:mt-12 xl:mb-5 font-bold italic">Current Sale</h2>
                 <a href="{{route('sale.index')}}" class="text-base xl:text-3xl font-bold text-blue-800  hover:text-blue-300">View Sales History</a>
                <table class="border border-black w-full mt-2 xl:mt-6">
                    <thead class="bg-gray-400 text-base xl:text-3xl p-1 xl:p-5">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    
                     <tbody id="sales-table" class="odd:bg-white even:bg-gray-300 text-center text-sm xl:text-2xl">
                   
                    </tbody>
                    
                </table>
                <form action="{{route('sales.completesale')}}" method="POST">
                    @csrf

                    <select class="mt-2 xl:mt-8 w-1/2 text-sm xl:text-2xl" name="payment_method" >
                        <option class="text-sm xl:text-base" value="">Select Payment Method</option>
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                        <option value="transfer">Transfer</option>
                    </select>
                    <button type ="submit" class="text-sm xl:text-xl p-2 xl:p-4 bg-green-700 text-white rounded-xl w-1/4 mx-2 xl:mx-8 hover:bg-green-400">Complete Sale</button>
                </form>
            </div>
        </div>
    </section>
    <script>
        const csrftoken = '{{csrf_token()}}';

        document.addEventListener('DOMContentLoaded', function(){

     const SearchInput = document.getElementById('search');
    const categorySelect = document.getElementById('category');
    const container = document.getElementById('product-container');

    function loadProducts(){

        const search = SearchInput.value;
        const category = categorySelect.value;

        fetch(`/api/sale/pos?search=${search}&category=${category}`)
        .then(res => res.json())
        .then(data => {

            const products = data.products;
            container.innerHTML = "";

            if(products.length === 0){
                container.innerHTML = "<p>No product found</p>";
                return;
            }

            products.forEach(product => {

                const card = document.createElement('div');
                card.classList.add("bg-white","p-4","rounded-xl","shadow");

                card.innerHTML = `
                    <p class="font-bold text-sm xl:text-3xl">${product.name}</p>
                    <p class="text-sm xl:text-xl">D${product.price}</p>
                    <button onclick="addtoCart(${product.id})"
                        class="bg-blue-500 text-white px-3 py-1 rounded mt-2">
                        Add to Cart
                    </button>
                `;

                container.appendChild(card);
            });
        });
    }

    loadProducts();
    loadSales();

    SearchInput.addEventListener('keyup', loadProducts);
    categorySelect.addEventListener('change', loadProducts);
});


function addtoCart(productId){

    fetch(`/api/sale/add-item`, {
        method: "POST",
        headers: {
            'Content-Type':'application/json',
            'X-CSRF-TOKEN': csrftoken,
            credentials:'same-origin'
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        

        loadSales();
    });
}


    //fetching items belonging sales
        async function loadSales(){
            
            try{
                const response = await fetch(`/api/sale/pos`);
                const results = await response.json();
               
                const sale = results.sale;
                
                const items = sale.items;

                    
                const tbody = document.getElementById('sales-table');
                tbody.innerHTML="";

                

                items.forEach(item =>{
                    const tr = document.createElement('tr');
                    tr.innerHTML=`
                         <td class="border border-black">${item.product.name}</td>
                        <td class="border border-black">${item.product.price}</td>
                        <td class="border border-black">${item.quantity}</td>
                        <td class="border border-black">${item.subtotal}</td>
                        <td class="border border-black">
                             
                            <button onclick="deleteSale(${item.id})" class="text-red-700 font-bold" >Remove</button>
                         </td> `;
                           
                         
                    
                    tbody.appendChild(tr);

                });
                

            }catch(error){
                console.log('Error loading Sales',error);
            }

            
        }

        function deleteSale(id){
               if(!confirm("Remove this item")) return;

               fetch(`/api/sale/removeItem/${id}`,{
                     method:'DELETE',
                     headers:{'Accept':'application/json',
                            'X-CSRF-TOKEN': csrftoken }
               })
               .then(res => res.json())
               .then( data =>{
                alert(data.message)

                loadSales();

               })
               .catch(error =>{
                    console.error('Error:',error);
                    alert('Delete failed')
                });

            }

    </script>
</body>
</html>