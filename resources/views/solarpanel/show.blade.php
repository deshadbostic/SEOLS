<x-app-layout>
    @auth
    <div class="container mx-auto flex flex-col items-center text-white">
        <div class="flex gap-10">
            <h1 class="text-2xl font-semibold mt-4">View Solar Panel to piDSS</h1>
            <div class="relative">
                <a href="{{ route('products.index') }}" class="absolute left-100 top-100 text-blue-500 hover:text-blue-600 font-semibold text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
            </div>
        </div>
        @csrf
        <div class="my-8">
            <div class="flex flex-col gap-4">
                <div class="text-lg text-white">Model: {{$solarpanel->Model}}</div>
                <div class="text-lg text-white">Warranty: {{$solarpanel->Warranty}}</div>
                <div class="text-lg text-white">Durability: {{$solarpanel->Durability}}</div>
                <div class="text-lg text-white">Cost: {{$solarpanel->Cost}}</div>
                <div class="text-lg text-white">EnergyOutputWatts : {{$solarpanel->EnergyOutputWatts }}</div>
                <div class="text-lg text-white">DimensionsInches : ${{$solarpanel->DimensionsInches }}</div>
            </div>
            <div class="flex gap-2 items-baseline">

                <div class="mt-6">
                    <a href="{{ route('solarpanel.edit', $solarpanel) }}">
                        <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">Edit Solar Panel</button>
                    </a>
                </div>
                <form method="POST" action="{{ route('solarpanel.destroy', $solarpanel) }}" class=" block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">Delete Solar Panel</button>
                </form>
            </div>
        </div>

        <!-- <div class="mt-4">
            <label for="Efficiency" class="text-lg text-white">Efficiency:</label>
            <input type="text" name="Efficiency" class="w-full border p-2 rounded text-black">
        </div>

        <div class="mt-4">
            <label for="Cost" class="text-lg text-white">Cost:</label>
            <input type="text" name="Cost" class="w-full border p-2 rounded text-black">
        </div>

        <div class="mt-4 flex flex-row justify-between">
            <div class="mr-4">
                <label for="FrequencyHz" class="text-lg text-white">Frequency (Hz):</label>
                <input type="text" name="FrequencyHz" class="w-full border p-2 rounded text-black">
            </div>
            <div>
                <label for="InputPowerWatts" class="text-lg text-white">Input Power (Watts):</label>
                <input type="text" name="InputPowerWatts" class="w-full border p-2 rounded text-black">
            </div>
        </div>

        <div class="mt-4 flex flex-row justify-between">
            <div class="mr-4">
                <label for="OutputPowerWatts" class="text-lg text-white">Output Power (Watts):</label>
                <input type="text" name="OutputPowerWatts" class="w-full border p-2 rounded text-black">
            </div>
            <div>
                <label for="SizeInches" class="text-lg text-white">Size (Inches):</label>
                <input type="text" name="SizeInches" class="w-full border p-2 rounded text-black">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">Add Inverter</button>
        </div> -->
    </div>
    @endauth
</x-app-layout>