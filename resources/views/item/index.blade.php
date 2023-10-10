<x-app-layout>
@auth
<table class="table text-gray-400 border-seperate space-y-6 text-sm">
    <thead class="bg-gray-800 text-gray-500">
        <tr>
        <th class="p-3 text-neutral-300">Battery</th>
                        <th class="p-3 text-left text-neutral-300">Size (Ah)</th>
                        <th class="p-3 text-left text-neutral-300">Voltage (V)</th>
                        <th class="p-3 text-left text-neutral-300">Rating (Wh)</th>
                        <th class="p-3 text-left text-neutral-300">Weight (lbs)</th>
                        <th class="p-3 text-left text-neutral-300">Cost</th>
        </tr>
    </thead>
    <tbody>
         @foreach ($items as $item)
         <tr class="bg-gray-800">
                            <td class="p-3 text-center">{{ $battery->CapacityAh }}</td>
                            <td class="p-3 text-center">{{ $battery->VoltageV }}</td>
                            <td class="p-3 text-center">{{ $battery->RatingWh}}</td>
                            <td class="p-3 text-center">{{ $battery->WeightLbs }}</td>
                            <td class="p-3 text-center">{{ $battery->Cost }}</td>
<div>{{ $item->name }}, {{ $item->description }},
{{ $item->price }}
</div>
@endforeach
         </tr>
</tbody>


</table>
@endauth

<
</x-app-layout>