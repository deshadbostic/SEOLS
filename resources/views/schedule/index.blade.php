<head>
    <meta charset="utf-8">
    <title>Appointment List</title>
</head>

<x-app-layout>
    @if(Auth::user()->role == "Operations Manager")
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible ">
                    <!-- Table for Appointments -->
                    <table class="table text-gray-400 border-separate space-y-6 text-sm">
                        <!-- Table Header -->
                        <h2 class="text-2xl font-bold mb-2 text-white text-stone-300">All Appointments</h2>
                        <thead class="bg-gray-800 text-gray-500">
                            <tr>
                                <!-- Column Headers -->
                                <th class="p-3 text-neutral-300">Customer ID</th>
                                <th class="p-3 text-neutral-300">First Name</th>
                                <th class="p-3 text-neutral-300">Last Name</th>
                                <th class="p-3 text-neutral-300">Address</th>
                                <th class="p-3 text-neutral-300">DOA</th>
                                <th class="p-3 text-neutral-300">Time</th>
                                <th class="p-3 text-neutral-300">Directions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through Appointments -->
                            @foreach($schedules as $schedule)
                                <tr class="bg-gray-800 hover:bg-opacity-60">
                                    <!-- Appointment Details -->
                                    <td class="p-3">{{$schedule->id}}</td>
                                    <td class="p-3 text-center">{{$schedule->fName}}</td>
                                    <td class="p-3 text-center">{{$schedule->lName}}</td>
                                    <td class="p-3 text-center">{{$schedule->address}}</td>
                                    <td class="p-3 text-center">{{$schedule->DOA}}</td>
                                    <td class="p-3 text-center">{{$schedule->time}}</td>
                                    <td class="p-3 text-center">{{$schedule->directions}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    @if(Auth::user()->role == "Customer")
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible ">
                    <!-- Table for Appointments -->
                    <table class="table text-gray-400 border-separate space-y-6 text-sm">
                        <!-- Table Header -->
                        <h2 class="text-2xl font-bold mb-2 text-white text-stone-300">Your Appointment</h2>
                        <thead class="bg-gray-800 text-gray-500">
                            <tr>
                                <!-- Column Headers -->    
                                <th class="p-3 text-neutral-300">Address</th>
                                <th class="p-3 text-neutral-300">DOA</th>
                                <th class="p-3 text-neutral-300">Time</th>
                                <th class="p-3 text-neutral-300">Directions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through Appointments -->
                            @foreach($schedules as $schedule)
                                @if(Auth::user()->id == $schedule->id)
                                <tr class="bg-gray-800 hover:bg-opacity-60">
                                    <!-- Appointment Details -->
                                    <td class="p-3 text-center">{{$schedule->address}}</td>
                                    <td class="p-3 text-center">{{$schedule->DOA}}</td>
                                    <td class="p-3 text-center">{{$schedule->time}}</td>
                                    <td class="p-3 text-center">{{$schedule->directions}}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>