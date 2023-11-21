<x-app-layout>
    @auth
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible ">
                @if(null === $building)
                <h2 class="text-2x font-bold mb-2 text-white text-stone-300">Please create your building.</h2>
                <div class="flex pt-5 justify-start bg-gray-900 grid-cols-14">
                <form action="{{route('building.store')}}" method="POST">
                    @csrf
                    <x-input-label for="building" :value="__('Building Name')" />
                    <x-text-input name="name" class="block mt-1 mb-5 w-full" type="text" :value="old('name')" required autofocus autocomplete="name" /> 
                        <x-primary-button>
                        {{__('Add Building')}}
                        </x-primary-button>
                    </form>
                </div>
                @else
                <h2 class="text-2xl text-center font-bold mb-2 text-white text-stone-300">Building Information</h2>
                <table class="table text-gray-400 border-separate space-y-6 text-sm">
                    <thead class="bg-gray-800 text-gray-500">
                        <tr>
                            <!-- Column Headers -->
                            <th class="p-3 text-neutral-300">Building Name</th>
                            <th class="p-3 text-neutral-300">Total Power</th>
                            <th class="p-3 text-neutral-300">Edit</th>
                            <th class="p-3 text-neutral-300">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-gray-800 hover:bg-opacity-60">
                            <!-- Configuration Details -->
                            <td class="p-3 text-center">{{$building->name}}</td>
                            <td class="p-3 text-center">{{$totalPower}}</td>
                            <td class="px-2 py-1 text-center">
                                <form action="{{ route('building.edit', $building) }}" method="GET">
                                @csrf
                                    <x-primary-button>{{__('Edit') }}</x-primary-button>
                                </form>
                            </td>
                            <td class="px-2 py-1 text-center">
                                <form method="POST" action="{{ route('building.destroy', $building) }}">
                                @csrf
                                @method('DELETE')
                                    <x-primary-button>{{__('Delete') }}</x-primary-button>
                                </form>
                            </td>
                        </tr>    

                    </tbody>
                </table>
                @endif

    @endauth
</x-app-layout>