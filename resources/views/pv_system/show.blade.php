<x-app-layout>
    @auth
    <div class="container mx-auto flex flex-col items-center text-white">
        <h1 class="text-2xl font-semibold mt-4">View PV System Model</h1>
        <div class="text-lg  my-3 text-white">
            <div class="grid-cols-10 grid gap-4 mt-4">
                <p class="col-span-2">Category</p>
                <p class="col-span-2">Product Name</p>
                <p class="col-span-2">Product count</p>
                <p class="col-span-2">Price</p>
            </div>
            <hr>
            @foreach($products as $key => $product)
            <!-- {{gettype($product)}} -->
                
                <div class="grid-cols-10 grid gap-4 mt-4">
                    <p class="col-span-2">{{ucfirst($product->Category)}}</p>
                    <p class="col-span-2">{{ucfirst($product->Name)}}</p>
                    <p class="col-span-2">{{ucfirst($product->product_count)}}</p>
                    <p class="col-span-2">${{ucfirst($product->Price)}}</p>
                    <form method="GET" action="{{ route('product.show', $product) }}" class="inline">
                        @csrf
                        <x-primary-button class="justify-center">
                            {{ __('View') }}
                        </x-primary-button>
                    </form>
                </div>
            @endforeach
            <!-- {{print_r($products[0])}} -->
        </div>
    </div>
    @endauth
</x-app-layout>