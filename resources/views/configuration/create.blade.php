<x-app-layout>
    @auth
        <form action="{{route('configuration.store') }}" method="POST" class="mt-4">
        @csrf
            <div class="flex flex-col items-center space-y-4">
                <!-- Solar Panel -->
                <div class="flex space-x-8">
                    <!-- Solar Panel Model -->
                    <div>
                        <x-input-label for="solar_panel_id" :value="__('Solar Panel')" />
                        <select class="mt-1 text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="solar_panel_id" id="solar_panel_id">
                            <option value="" selected>Choose Solar Panel</option>
                            @foreach($solar_panels as $solar_panel)
                                <option value="{{$solar_panel->id}}">{{$solar_panel->Name.', '.$solar_panel->Attribute_value}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('solar_panel_id')" class="mt-2" />
                    </div>

                    <!-- Solar Panel Quantity -->
                    <div>
                        <x-input-label for="solar_panel_count" :value="__('Quantity')" />
                        <x-text-input id="solar_panel_count" class="block mt-1 w-full" type="text" name="solar_panel_count" :value="old('solar_panel_count')" autocomplete="solar_panel_count" />
                        <x-input-error :messages="$errors->get('solar_panel_count')" class="mt-2" />
                    </div>
                </div>
                <!-- Inverters -->
                <div class="flex space-x-8">
                    <!-- Inverter Model -->
                    <div>
                        <x-input-label for="inverter" :value="__('Inverter')" />
                        <select class="mt-1 text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="inverter_id" id="inverter_id">
                            <option value="" selected>Choose Inverter</option>
                            @foreach($inverters as $inverter)
                                <option value="{{$inverter->id}}">{{$inverter->Name.', '.$inverter->Attribute_value}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('inverter_id')" class="mt-2" />
                    </div>

                    <!-- Inverter Quantity -->
                    <div>
                        <x-input-label for="inverter_count" :value="__('Quantity')" />
                        <x-text-input id="inverter_count" class="block mt-1 w-full" type="text" name="inverter_count" :value="old('inverter_count')" autocomplete="inverter_count" />
                        <x-input-error :messages="$errors->get('inverter_count')" class="mt-2" />
                    </div>
                </div>
                <!-- BATTERIES -->
                <div class="flex space-x-8">
                    <!-- Battery Model -->
                    <div>
                        <x-input-label for="battery_id" :value="__('Battery')" />
                        <select class="mt-1 text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="battery_id" id="battery_id">
                            <option value="" selected>Choose Battery</option>
                            <option value="0">No Battery</option>
                            @foreach ($batteries as $battery)
                                <option value="{{$battery->id}}">{{$battery->Name.', '.$battery->Attribute_value}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('fName')" class="mt-2" />
                    </div>

                    <!-- Battery Quantity -->
                    <div>
                        <x-input-label for="battery_count" :value="__('Quantity')" />
                        <x-text-input id="battery_count" class="block mt-1 w-full" type="text" name="battery_count" :value="old('battery_count')" autocomplete="battery_count" />
                        <x-input-error :messages="$errors->get('battery_count')" class="mt-2" />
                    </div>
                </div>
                <!-- Wires -->
                <div class="flex space-x-8">
                    <!-- Wire Model -->
                    <div>
                        <x-input-label for="wire_id" :value="__('Wire')" />
                        <select class="mt-1 text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="wire_id" id="wire_id">
                            <option value="" selected>Choose Wire</option>
                            @foreach($wires as $wire)
                                <option value="{{$wire->id}}">{{$wire->Name.', '.$wire->Attribute_value}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('wire_id')" class="mt-2" />
                    </div>

                    <!-- Wire Quantity -->
                    <div>
                        <x-input-label for="wire_count" :value="__('Quantity')" />
                        <x-text-input id="wire_count" class="block mt-1 w-full" type="text" name="wire_count" :value="old('wire_count')" autocomplete="wire_count" />
                        <x-input-error :messages="$errors->get('wire_count')" class="mt-2" />
                    </div>
                </div>
                <!-- Costs -->
                <div class="flex space-x-6">
                    <!-- Budget Info -->
                    <div>
                        <x-input-label class="mt-3" for="budget" :value="__('My Budget:')" />
                        <x-text-input readonly id="budget"  name="budget" :value="old('budget', $user->budget)"/>
                        <x-input-error :messages="$errors->get('budget')" class="mt-2" />
                    </div>
                    
                    <!-- Energy Requirement Info -->
                    <div>
                        <x-input-label class="mt-3" for="energy_requirement" :value="__('My Energy Requirement:')" />
                        <x-text-input readonly id="energy_requirement"  name="energy_requirement" :value="old('energy_requirement')"/>
                        <x-input-error :messages="$errors->get('energy_requirement')" class="mt-2" />
                    </div>
                </div>
                <x-primary-button>
                    {{__('Save')}}
                </x-primary-button>
            </div>
        </form>
    @endauth
</x-app-layout>