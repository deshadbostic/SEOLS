<x-app-layout>
    <div class="container mx-auto flex flex-col items-center text-white">
        <div class="flex gap-10">
            <h1 class="text-2xl font-semibold mt-4">Edit Solar Panel to piDSS</h1>
            <div class="relative">
                <a href="{{ route('products.index') }}" class="absolute left-100 top-100 text-blue-500 hover:text-blue-600 font-semibold text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
            </div>
        </div>

        <form action="{{ route('solarpanel.update' , $solarpanel) }}" method="POST" class="mt-4">
            @csrf
            @method('patch')

            <div class="mt-4">
                <label for="Model" class="text-lg text-white">Model:</label>
                <input type="text" name="Model" class="w-full border p-2 rounded text-black" value="{{$solarpanel->Model}}">
            </div>

            <div class="mt-4">
                <label for="Warranty" class="text-lg text-white">Warranty:</label>
                <input type="text" name="Warranty" class="w-full border p-2 rounded text-black" value="{{$solarpanel->Warranty}}">
            </div>

            <div class="mt-4">
                <label for="Durability" class="text-lg text-white">Durability:</label>
                <input type="text" name="Durability" class="w-full border p-2 rounded text-black" value="{{$solarpanel->Durability }}">
            </div>
            <div class="mt-4">
                <label for="Cost" class="text-lg text-white">Cost:</label>
                <input type="text" name="Cost" class="w-full border p-2 rounded text-black" value="{{$solarpanel->Cost}}">
            </div>

            <div class="mt-4 flex flex-row justify-between">
                <div class="mr-4">
                    <label for="EnergyOutputWatts" class="text-lg text-white">EnergyOutputWatts:</label>
                    <input type="text" name="EnergyOutputWatts" class="w-full border p-2 rounded text-black" value="{{$solarpanel->EnergyOutputWatts}}">
                </div>
                <div>
                    <label for="DimensionsInches" class="text-lg text-white">DimensionsInches:</label>
                    <input type="text" name="DimensionsInches" class="w-full border p-2 rounded text-black" value="{{$solarpanel->DimensionsInches}}">
                </div>
            </div>


            <div class="flex gap-2 items-baseline my-3">
                <form action="{{ route('solarpanel.update' , $solarpanel) }}" method="POST" class="mt-4">
                    @csrf
                    @method('patch')
                    <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">Update</button>
                </form>
                <form method="POST" action="{{ route('solarpanel.destroy', $solarpanel) }}" class=" block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">Delete</button>
                </form>
            </div>
    </div>
    </form>
    </div>
</x-app-layout>