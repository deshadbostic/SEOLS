<x-app-layout>
    @auth
    <div class="relative">
            <a href="{{ route('building.index') }}" class="absolute left-100 top-100 text-blue-600 hover:text-blue-400 focus-within:text-blue-400 active:text-blue-400 font-semibold text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                @if(!isset($rooms[0]))
                    <div class="overflow-auto lg:overflow-visible ">
                    <h2 class="text-2x font-bold mb-2 text-white text-stone-300">You currently have no rooms.</h2>
                @else
                <h2 class="text-2xl text-center font-bold mb-2 text-white text-stone-300">{{'Building: '.$building->name}}</h2>
                <h2 class="text-2x font-bold mb-2 text-white text-stone-300">{{'Your '. count($rooms). ' room(s) are listed below.'}}</h2>
                <table class="table text-gray-400 border-separate space-y-6 text-sm">
                    <thead class="bg-gray-800 text-gray-500">
                        <tr>
                            <!-- Column Headers -->
                            <th class="p-3 text-neutral-300">Room Name</th>
                            <th class="p-3 text-neutral-300">Power</th>
                            <th class="p-3 text-neutral-300">Edit</th>
                            <th class="p-3 text-neutral-300">Delete</th>
                            <th class="p-3 text-neutral-300">Show</th>
                            <th class="p-3 text-neutral-300">Appliance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                        <tr class="bg-gray-800 hover:bg-opacity-60">
                            <!-- Configuration Details -->
                            <td class="p-3 text-center">{{$room->name}}</td>
                            <td class="p-3 text-center">{{$roomPower[$room->id]}}</td>
                            <td class="px-2 py-1 text-center">
                                <form action="{{ route('room.edit', $room) }}" method="GET">
                                @csrf
                                    <x-primary-button>{{__('Edit') }}</x-primary-button>
                                </form>
                            </td>
                            <td class="px-2 py-1 text-center">
                                <form method="POST" action="{{ route('room.destroy', $room) }}">
                                @csrf
                                @method('DELETE')
                                    <x-primary-button>{{__('Delete') }}</x-primary-button>
                                </form>
                            </td>
                            <td class="px-2 py-1 text-center">
                                <form method="GET" action="{{ route('room.show', $room) }}">
                                @csrf
                                    <x-primary-button>{{__('Show') }}</x-primary-button>
                                </form>
                            </td>
                            <td class="px-2 py-1 text-center">
                                <form method="GET" action="{{ route('appliance.create', $room) }}">
                                @csrf
                                    <x-primary-button>{{__('Add') }}</x-primary-button>
                                </form>
                            </td>
                        </tr>    
                        @endforeach
                    </tbody>
                </table>
                
                @endif
                <div class="flex pt-5 justify-start bg-gray-900 grid-cols-14">
                    <form action="{{ route('room.create') }}" method="GET">
                    @csrf
                        <x-primary-button class="ml-4">
                            {{ __('Create Room') }}
                        </x-primary-button>
                    </form>
                </div>
        </div>
        </div>
        </div>
    @endauth
</x-app-layout>