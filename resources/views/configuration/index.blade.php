<x-app-layout>
    @auth
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('My Configurations') }}
        </h2>
    </x-slot>
        <div class="flex pt-5 justify-start bg-gray-900 grid-cols-14">
            <h2 class="text-2x font-bold mt-1 text-white text-stone-300">New Configuration</h2>
            <form action="{{ route('configuration.create') }}" method="GET">
            @csrf
                <x-primary-button class="ml-4">
                    {{ __('Create') }}
                </x-primary-button>
            </form>
        </div>
        
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                
                <div class="overflow-auto lg:overflow-visible ">
                    @if(isset($configurations[0]->id))
                        <!-- Table for Configurations -->
                        <table class="table text-gray-400 border-separate space-y-6 text-sm">
                            <!-- maybe do an if to check if the user has any configurations if not, have a create config button -->

                            <!-- Table Header -->
                            <!-- <h2 class="text-2xl font-bold mb-2 text-white text-stone-300">Configurations</h2> -->
                            <thead class="bg-gray-800 text-gray-500">
                                <tr>
                                    <!-- Column Headers -->
                                    <th class="p-3 text-neutral-300">Configuration #</th>
                                    <th class="p-3 text-neutral-300">Energy Generated</th>
                                    <th class="p-3 text-neutral-300">Total Cost</th>
                                    <th class="p-3 text-neutral-300">Show</th>
                                    <th class="p-3 text-neutral-300">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop through Configurations -->
                                @foreach($configurations as $key => $config) 
                                    <tr class="bg-gray-800 hover:bg-opacity-60">
                                        <!-- Configuration Details -->
                                        <td class="p-3 text-center">{{$key+1}}</td>
                                        <td class="p-3 text-center">{{$config->energy_generated.' W'}}</td>
                                        <td class="p-3 text-center">{{'$'.$config->equipment_cost+$config->installation_cost}}</td>
                                        <td class="px-2 py-1 text-center">
                                            <form action="{{ route('configuration.show', $config) }}" method="GET">
                                                <x-primary-button>{{__('Show') }}</x-primary-button>
                                            </form>
                                        </td>    
                                        <td class="px-2 py-1 text-center">
                                            <form action="{{ route('configuration.destroy', $config) }}" method="GET">
                                                <x-primary-button>{{__('Delete') }}</x-primary-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <h2 class="text-2x font-bold mb-2 text-white text-stone-300">You currently have no configurations</h2>
                    @endif

                </div>
            </div>
        </div>
    @endauth
</x-app-layout>