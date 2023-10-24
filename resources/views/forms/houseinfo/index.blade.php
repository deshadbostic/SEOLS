<head>
    <title>Customer House Information</title>
</head>

<x-app-layout>
    @auth
    <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
        <div class="col-span-12">
            <div class="overflow-auto lg:overflow-visible ">
                <!-- Table for Customers -->
                <table class="table text-gray-400 border-separate space-y-6 text-sm">
                    <!-- Table Header -->
                    <h2 class="text-2xl font-bold mb-2 text-white text-stone-300">Customer House Information</h2>
                    <thead class="bg-gray-800 text-gray-500">
                        <tr>
                            <!-- Column Headers -->
                            <th class="p-3 text-neutral-300">First Name</th>
                            <th class="p-3 text-neutral-300">Last Name</th>
                            <th class="p-3 text-neutral-300">Electricity Usage (kWh)</th>
                            <th class="p-3 text-neutral-300">Roof Size (sq ft)</th>
                            <th class="p-3 text-neutral-300">Roof Slope (Degrees)</th>
                            <th class="p-3 text-neutral-300">Roof Age (Years)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through House Info -->
                        @foreach($house_info as $house)
                        <tr class="bg-gray-800 hover:bg-opacity-60">
                            <!-- House Info Details -->
                            <td class="p-3">{{$house->customer_fName}}</td>
                            <td class="p-3 text-center">{{$house->customer_lName}}</td>
                            <td class="p-3 text-center">{{$house->electricity_usage}}</td>
                            <td class="p-3 text-center">{{$house->roof_size}}</td>
                            <td class="p-3 text-center">{{$house->roof_slope}}</td>
                            <td class="p-3 text-center">{{$house->roof_age}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endauth
</x-app-layout>