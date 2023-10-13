<x-app-layout>
<link
	href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
	rel="stylesheet">

<div class="flex items-center justify-center min-h-screen bg-gray-900">
	<div class="col-span-12">
		<div class="overflow-auto lg:overflow-visible ">

            <!-- Table for Inverters -->
            <table class="table text-gray-400 border-separate space-y-6 text-sm">
                <!-- Table Header -->
                <h2 class="text-2xl font-bold mb-2 text-stone-300">Inverters</h2>
                <thead class="bg-gray-800 text-gray-500">
                    <tr>
                        <!-- Column Headers -->
                        <th class="p-3 text-neutral-300">Inverter</th>
                        <th class="p-3 text-left text-neutral-300">Input Power (Watts)</th>
                        <th class="p-3 text-left text-neutral-300">Output Power (Watts)</th>
                        <th class="p-3 text-left text-neutral-300">Size (Inches)</th>
                        <th class="p-3 text-left text-neutral-300">Frequency (Hz)</th>
                        <th class="p-3 text-left text-neutral-300">Efficiency</th>
                        <th class="p-3 text-left text-neutral-300">Cost</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through Inverter Data -->
                    @foreach($inverters as $inverter)
                        <tr class="bg-gray-800">
                            <!-- Inverter Details -->
                            <td class="p-3">{{ $inverter->Model }}</td>
                            <td class="p-3 text-center">{{ $inverter->InputPowerWatts }}</td>
                            <td class="p-3 text-center">{{ $inverter->OutputPowerWatts }}</td>
                            <td class="p-3 text-center">{{ $inverter->SizeInches }}</td>
                            <td class="p-3 text-center">{{ $inverter->FrequencyHz }}</td>
                            <td class="p-3 text-center">{{ $inverter->Efficiency }}</td>
                            <td class="p-3">{{ $inverter->Cost }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Table for Solar Panels -->
            <table class="table text-gray-400 border-separate space-y-6 text-sm">
                <!-- Table Header -->
                <h2 class="text-2xl font-bold mb-2 text-white text-stone-300">Solar Panels</h2>

                <thead class="bg-gray-800 text-gray-500">
                    <tr>
                        <!-- Column Headers -->
                        <th class="p-3 text-neutral-300">Solar Panel</th>
                        <th class="p-3 text-left text-neutral-300">Warranty</th>
                        <th class="p-3 text-left text-neutral-300">Durability</th>
                        <th class="p-3 text-left text-neutral-300">EnergyOutputWatts</th>
                        <th class="p-3 text-left text-neutral-300">DimensionsInches</th>
                        <th class="p-3 text-left text-neutral-300">Cost</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through Solar Panel Data -->
                    @foreach($solarPanels as $solarPanel)
                        <tr class="bg-gray-800">
                            <!-- Solar Panel Details -->
                            <td class="p-3">{{ $solarPanel->Model }}</td>
                            <td class="p-3 text-center">{{ $solarPanel->Warranty }}</td>
                            <td class="p-3 text-center">{{ $solarPanel->Durability }}</td>
                            <td class="p-3 text-center">{{ $solarPanel->EnergyOutputWatts}}</td>
                            <td class="p-3 text-center">{{ $solarPanel->DimensionsInches }}</td>
                            <td class="p-3">{{ $solarPanel->Cost }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Table for Battery -->
            <table class="table text-gray-400 border-separate space-y-6 text-sm">
                <!-- Table Header -->
                <h2 class="text-2xl font-bold mb-2 text-white text-stone-300">Battery</h2>
                <thead class="bg-gray-800 text-gray-500">
                    <tr>
                        <!-- Column Headers -->
                        <th class="p-3 text-neutral-300">Battery</th>
                        <th class="p-3 text-left text-neutral-300">Capacity (Ah)</th>
                        <th class="p-3 text-left text-neutral-300">Voltage (V)</th>
                        <th class="p-3 text-left text-neutral-300">Rating (Wh)</th>
                        <th class="p-3 text-left text-neutral-300">Weight (lbs)</th>
                        <th class="p-3 text-left text-neutral-300">Cost</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through Battery -->
                    @foreach($batteries as $battery)
                        <tr class="bg-gray-800">
                            <!-- Battery Details -->
                            <td class="p-3">{{ $battery->Model }}</td>
                            <td class="p-3 text-center">{{ $battery->CapacityAh }}</td>
                            <td class="p-3 text-center">{{ $battery->VoltageV }}</td>
                            <td class="p-3 text-center">{{ $battery->RatingWh}}</td>
                            <td class="p-3 text-center">{{ $battery->WeightLbs }}</td>
                            <td class="p-3 text-center">{{ $battery->Cost }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


		</div>
	</div>
</div>

<!-- <style>
	.table {
		border-spacing: 0 15px;
	}

	i {
		font-size: 1rem !important;
	}

	.table tr {
		border-radius: 20px;
	}

	tr td:nth-child(n+5),
	tr th:nth-child(n+5) {
		border-radius: 0 .625rem .625rem 0;
	}

	tr td:nth-child(1),
	tr th:nth-child(1) {
		border-radius: .625rem 0 0 .625rem;
	}
</style> -->
</x-app-layout>