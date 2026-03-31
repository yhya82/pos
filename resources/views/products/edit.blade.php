
    @extends('layouts.app')

    @section('content')
    <div class="flex flex-col mt-16 px-4 lg:px-16">
        <h2 class="text-4xl lg:text-6xl font-bold ">Update form <h2>
    </div>

      
     <form id ="edit-form" class="px-4 lg:px-16  mt-10 lg:mt-16">
        @csrf
      <div  class="flex flex-col  gap-2 lg:gap-5">
            <div class="flex flex-col">
                <input type="hidden" id='product_id'>
                <label class="text-2xl lg:text-4xl">Name</label><br>
                 <input type="text" id="name" class="w-1/2 lg:w-1/4 xl:h-16">
            </div>
            <div class="flex flex-col"> 
                <label class="text-2xl lg:text-4xl">Price</label>
                <input type="text" id="price"  class="w-1/2 lg:w-1/4 xl:h-16">
            </div>
        
            <div class="flex flex-col">
                <label class="text-2xl lg:text-4xl">Quantity</label><br>
                <input type="text" id='quantity' class="w-1/2 lg:w-1/4 xl:h-16">
            </div>
             <div class="flex flex-col">
                 <label class="text-2xl lg:text-4xl">Category</label><br>
                    <select name="category_id" class="w-1/2 lg:w-1/4 xl:h-16">
                        <option value="">Select Category</option>
                        @foreach($categorys as $category)
                         <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                         @endforeach
                    </select>
            </div>
            <div class="flex flex-col">
                <label class="text-2xl lg:text-4xl">Supplier</label>
                <select name="supplier_id" class="w-1/2 lg:w-1/4 xl:h-16 ">
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                 <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                 @endforeach
                </select>
             </div>
    </div>
    <div class="flex justify-center xl:justify-start">
        <button type="submit" class="bg-blue-800 p-3 xl:p-6 rounded-2xl text-2xl lg:text-4xl  text-white font-bold mt-4 xl:mt-6 hover:bg-blue-500">Update Product</button>
    </div>
    </form>
    @endsection
@section('script')
<script>
    //loading the product into form
    document.addEventListener('DOMContentLoaded', function(){
        const pathSegments = window.location.pathname.split('/');
        const id = pathSegments[2];

        fetch(`/api/products/${id}`)
            .then(res => res.json())
            .then(result => {

                const product = result.data;
                document.getElementById('product_id').value = product.id;
                document.getElementById('name').value = product.name;
                document.getElementById('price').value = product.price;
                document.getElementById('quantity').value = product.quantity;
                document.querySelector('select[name="category_id"]').value = product.category_id;
                document.querySelector('select[name="supplier_id"]').value = product.supplier_id;

            });
        
    });

    //updating the product
    document.getElementById('edit-form').addEventListener('submit',function(e){
        e.preventDefault();

        const id = document.getElementById('product_id').value;

        fetch(`/api/products/${id}`,{
            method:'PUT',
            headers:{'Accept':'application/json',
                    'Content-type':'application/json'
            },
            body: JSON.stringify({
                name:document.getElementById('name').value,
                price:document.getElementById('price').value,
                quantity:document.getElementById('quantity').value,
                category_id:document.querySelector('select[name="category_id"]').value,
                supplier_id:document.querySelector('select[name="supplier_id"]').value
            })
        })
            .then( async res=>{
                const data = await res.json();
                if(!res.ok) throw data;
                return data;
            })
            .then(data => {
                alert(data.message || 'Product updated');
                window.location.href ='/products';

            })
       
            .catch(error => {
                if(error.errors){
                    console.log('validation errors');
                }else{
                    console.log('something went wrong');
                }
            });
    });
</script>
@endsection