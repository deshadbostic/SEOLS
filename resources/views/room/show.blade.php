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
        <div class="ms=1">
        <form class="mt-10" action="{{ route('building.index') }}" method="GET">
            @csrf
                <x-primary-button class="ml-4">
                    {{ __('Show Building') }}
                </x-primary-button>
            </form>
        </div>

        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
            <h2 class="text-2xl text-center font-bold mb-2 text-white text-stone-300">{{'Room: '.$room->name}}</h2>
                @if(!isset($appliances[0]))
                    <div class="overflow-auto lg:overflow-visible ">
                    <h2 class="text-2x font-bold mb-2 text-white text-stone-300">You currently have no appliances.</h2>
                @else
                
                <h2 class="text-2x font-bold mb-2 text-white text-stone-300">{{'Your '. count($appliances). ' appliances(s) are listed below.'}}</h2>
                <table class="table text-gray-400 border-separate space-y-6 text-sm">
                    <thead class="bg-gray-800 text-gray-500">
                        <tr>
                            <!-- Column Headers -->
                            <th class="p-3 text-neutral-300">Appliance Name</th>
                            <th class="p-3 text-neutral-300">Wattage</th>
                            <th class="p-3 text-neutral-300">Edit</th>
                            <th class="p-3 text-neutral-300">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appliances as $appliance)
                        <tr class="bg-gray-800 hover:bg-opacity-60">
                            <!-- Configuration Details -->
                            <td class="p-3 text-center">{{$appliance->name}}</td>
                            <td class="p-3 text-center">{{$appliance->wattage.'W'}}</td>
                            <td class="px-2 py-1 text-center">
                                <form action="{{ route('appliance.edit', $appliance) }}" method="GET">
                                @csrf
                                    <x-primary-button>{{__('Edit') }}</x-primary-button>
                                </form>
                            </td>
                            <td class="px-2 py-1 text-center">
                                <form method="POST" action="{{ route('appliance.destroy', $appliance) }}">
                                @csrf
                                @method('DELETE')
                                    <x-primary-button>{{__('Delete') }}</x-primary-button>
                                </form>
                            </td>
                        </tr>    
                        @endforeach
                    </tbody>
                </table>
                
                @endif
                <div class="flex pt-5 justify-start bg-gray-900 grid-cols-14">
                    <form action="{{ route('appliance.create') }}" method="GET">
                    @csrf
                        <x-primary-button class="ml-4">
                            {{ __('Create Apppliance') }}
                        </x-primary-button>
                    </form>
                </div>
        </div>
        </div>
        </div>
    @endauth
</x-app-layout>