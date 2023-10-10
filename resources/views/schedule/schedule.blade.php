
<x-app-layout>
@auth
<link
	href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
	rel="stylesheet">

<div class="flex items-center justify-center min-h-screen bg-gray-900">
	<div class="col-span-12">
		<div class="overflow-auto lg:overflow-visible ">
<table class="table text-gray-400 border-seperate space-y-6 text-sm">
    <thead class="bg-gray-800 text-gray-500">
        <tr>

                        <th class="p-3 text-left text-neutral-300">Customer id</th>
                        <th class="p-3 text-left text-neutral-300">Name</th>
                        <th class="p-3 text-left text-neutral-300">Address</th>
                        <th class="p-3 text-left text-neutral-300">DOA</th>
        </tr>
    </thead>
    <tbody>
         @foreach ($schedules as $schedule)
         <tr class="bg-gray-800">
                        <td class="p-3 text-center">{{ $schedule->id }}</td>
                            <td class="p-3 text-center">{{ $schedule->name }}</td>
                            <td class="p-3 text-center"> {{ $schedule->address }}</td>
                            <td class="p-3 text-center">{{ $schedule->DOA }}</td>
@endforeach
         </tr>
</tbody>


</table>
@endauth
        </div>
    </div>
</div>
</x-app-layout>