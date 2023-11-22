<x-app-layout>
    @auth
    <div class="relative">
            <a href="javascript:history.back()" class="absolute left-100 top-100 text-blue-600 hover:text-blue-400 focus-within:text-blue-400 active:text-blue-400 font-semibold text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('My Rooms') }}
        </h2>
    </x-slot>
        <div class="flex mt-7 pt-5 justify-start bg-gray-900 grid-cols-14">
        <form action="{{ route('building.index') }}" method="GET">
            @csrf
                <x-primary-button class="ml-4">
                    {{ __('Show Building') }}
                </x-primary-button>
            </form>
            <form action="{{ route('room.create') }}" method="GET">
            @csrf
                <x-primary-button class="ml-4">
                    {{ __('Create Room') }}
                </x-primary-button>
            </form>
        </div>
        
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                
                <div class="overflow-auto lg:overflow-visible ">
                    @if(null !== $rooms)
                        <!-- Table for Configurations -->
                        <table class="table text-gray-400 border-separate space-y-6 text-sm">
                            <!-- maybe do an if to check if the user has any configurations if not, have a create config button -->

                            <!-- Table Header -->
                            <!-- <h2 class="text-2xl font-bold mb-2 text-white text-stone-300">Configurations</h2> -->
                            <thead class="bg-gray-800 text-gray-500">
                                <tr>
                                    <!-- Column Headers -->
                                    <th class="p-3 text-neutral-300">Room Name #</th>
                                    <th class="p-3 text-neutral-300">Room Power</th>
                                    <th class="p-3 text-neutral-300">Edit</th>
                                    <th class="p-3 text-neutral-300">Show</th>
                                    <th class="p-3 text-neutral-300">Delete</th>
                                    <th class="p-3 text-neutral-300">Appliance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop through Configurations -->
                                @foreach($rooms as $key => $room) 
                                    <tr class="bg-gray-800 hover:bg-opacity-60">
                                        <!-- Configuration Details -->
                                        <td class="p-3 text-center">{{$room->name}}</td>
                                        <td class="p-3 text-center">{{$roomPowers[$room->id].'W'}}</td>
                                        <td class="px-2 py-1 text-center">
                                            <form action="{{ route('room.edit', $room) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                                <x-primary-button>{{__('Edit') }}</x-primary-button>
                                            </form>
                                        </td>
                                        <td class="px-2 py-1 text-center">
                                            <form action="{{ route('room.show', $room) }}" method="GET">
                                            @csrf
                                                <x-primary-button>{{__('Show') }}</x-primary-button>
                                            </form>
                                        </td>    
                                        <td class="px-2 py-1 text-center">
                                            <form method="POST" action="{{ route('room.destroy', $room) }}">
                                            @csrf
                                            @method('DELETE')
                                                <x-primary-button>{{__('Delete') }}</x-primary-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <h2 class="text-2x font-bold mb-2 text-white text-stone-300">You currently have no Rooms.</h2>
                    @endif

                </div>
            </div>
        </div>
    @endauth
</x-app-layout>