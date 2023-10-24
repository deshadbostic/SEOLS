<x-app-layout>
    <div class="container mx-auto flex flex-col items-center text-white">
        <h1 class="text-2xl font-semibold mt-4">Add Battery to piDSS</h1>
        <div class="relative">
            <a href="{{ route('dashboard') }}" class="absolute left-100 top-100 text-blue-500 hover:text-blue-600 font-semibold text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>

        <form action="{{ route('batteries.store') }}" method="post" class="mt-4">
            @csrf

            <div class="mt-4">
                <label for="Model" class="text-lg text-white">Model:</label>
                <input type="text" name="model" class="w-full border p-2 rounded">
            </div>

            <div class="mt-4">
                <label for="VoltageV" class="text-lg text-white">Voltage (V):</label>
                <input type="text" name="voltageV" class="w-full border p-2 rounded">
            </div>

            <div class="mt-4 flex flex-row justify-between">
                <div class="mr-4">
                    <label for="RatingWh" class="text-lg text-white">Rating (Wh):</label>
                    <input type="text" name="ratingWh" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label for="CapacityAh" class="text-lg text-white">Capacity (Ah):</label>
                    <input type="text" name="capacityAh" class="w-full border p-2 rounded">
                </div>
            </div>

            <div class="mt-4 flex flex-row justify-between">
                <div class="mr-4">
                    <label for="WeightLbs" class="text-lg text-white">Weight (lbs):</label>
                    <input type="text" name="weightLbs" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label for="Cost" class="text-lg text-white">Cost:</label>
                    <input type="text" name="cost" class="w-full border p-2 rounded">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">Add Battery</button>
            </div>
        </form>
    </div>
</x-app-layout>









