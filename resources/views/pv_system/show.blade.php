<x-app-layout>
    @auth
    <div class="container mx-auto flex flex-col text-white">
        <div class="relative">
            <a href="{{ route('pv_system.index') }}" class="absolute left-100 top-100 text-blue-600 hover:text-blue-400 focus-within:text-blue-400 active:text-blue-400 font-semibold text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>
        <h1 class="text-2xl text-center font-semibold mt-4">View PV System Model</h1>

        <div class="text-lg  my-3 text-white">
            <div id="headers" class="grid-cols-8 grid gap-4 mt-4">
                <p class="col-span-2">Category</p>
                <p class="col-span-2">Product Name</p>
                <p class="col-span-2">Product count</p>
                <p id="price-each-header" class="col-span-2 hidden">Price (Each)</p>
                <p id="price-total-header" class="col-span-2 hidden">Price (Total)</p>
                <div></div>
            </div>
            <hr>
            @php
                $totalPrice = 0;
            @endphp
            @foreach($productInfo as $key => $prodInfo)
                <div class="grid-cols-8 grid gap-4 mt-4 row">
                    <p class="col-span-2">{{ucfirst($prodInfo->Category)}}</p>
                    <p class="col-span-2">{{ucfirst($prodInfo->Name)}}</p>
                    <p class="col-span-2">{{ucfirst($prodInfo->product_count)}}</p>
                    <p class="col-span-2 hidden price-each">${{ucfirst(number_format($prodInfo->Price,2))}}</p>
                    <p class="col-span-2 hidden price-total">${{number_format($prodInfo->Price * $prodInfo->product_count,2)}}</p>
                    <form method="GET" class="inline" action="{{ route('product.show', $products[$key]) }}">
                        @csrf
                        <x-primary-button class="justify-center">
                            {{ __('View') }}
                        </x-primary-button>
                    </form>
                </div>
                @php
                    $totalPrice += $prodInfo->Price * $prodInfo->product_count;
                @endphp
            @endforeach
        </div>
        <a href="#" onclick="breakdown()">
                <x-primary-button id="breakdownButton" class="justify-center">
                    {{ __('Show Price Breakdown') }}
                </x-primary-button>
            </a>

            <div class="breakdown" id="breakdown" hidden="hidden">
            <h2 class="text-2xl font-semibold mt-4">Break Down</h2>
        
        </div>
        <div class="mt-4">
    <p>Total PV System Price: ${{$totalPrice}}</p>
    <br><p>Total Labour Price: ${{$totalPrice*0.1}}</p>
</div>
    </div>
    @endauth
</x-app-layout>
<script>

function breakdown()
{
    var breakdown = document.getElementById("breakdown");
    var button = document.getElementById("breakdownButton");

    document.querySelector("#price-total-header").classList.toggle("hidden")

    $headers = document.querySelector("#headers")
    $headers.classList.toggle("grid-cols-12")
    $headers.classList.toggle("grid-cols-10")

    $rows = document.querySelectorAll(".row")
    $rows.forEach(function ($row)
    {
        $row.classList.toggle("grid-cols-12")
        $row.classList.toggle("grid-cols-10")
    })

    $priceTotals = document.querySelectorAll(".price-total")
    $priceTotals.forEach(function ($priceTotal)
    {
        $priceTotal.classList.toggle("hidden")
    })

    // Remove the 'hidden' attribute to unhide the div
    if (breakdown.hasAttribute('hidden')) {
        breakdown.removeAttribute('hidden');
        button.innerText = 'Hide Breakdown';
    }else{
        breakdown.setAttribute('hidden', 'hidden'); // Hide the div
        button.innerText = 'Show Breakdown';
    }
}

function breakdown_old(){
    var breakdown = document.getElementById("breakdown");
    var button = document.getElementById("breakdownButton");
    if (breakdown && button) {
            // Remove the 'hidden' attribute to unhide the div
            if (breakdown.hasAttribute('hidden')) {
                breakdown.removeAttribute('hidden');
                button.innerText = 'Hide Breakdown';
            }else{
                breakdown.setAttribute('hidden', 'hidden'); // Hide the div
                button.innerText = 'Show Breakdown';
            }
        }
}
</script>