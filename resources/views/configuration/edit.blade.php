<x-app-layout>
    @auth
        <form action="{{route('configuration.update', $configuration) }}" method="POST" class="mt-4">
        @csrf
        @method('PATCH')
            <div class="flex flex-col items-center space-y-4">
                <!-- Solar Panel -->
                <div class="flex space-x-8">
                    <!-- Solar Panel Model -->
                    <div>
                        <x-input-label for="solar_panel_id" :value="__('Solar Panel')" />
                        <select class="mt-1 text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm price_calc" name="solar_panel_id" id="solar_panel_id">
                            @foreach($solar_panels as $solar_panel)
                                <option value="{{$solar_panel->id.'---'.$solar_panel->Price.'---'.$solar_panel->Attribute_value}}" {{$solar_panel->id === $configuration->solar_panel_id ? "selected" : ""}}>{{$solar_panel->Name.', '.$solar_panel->Attribute_value}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('solar_panel_id')" class="mt-2" />
                    </div>

                    <!-- Solar Panel Quantity -->
                    <div>
                        <x-input-label for="solar_panel_count" :value="__('Quantity')" />
                        <x-text-input id="solar_panel_count" class="count_calc block mt-1 w-full" type="text" name="solar_panel_count" value=" {{(null === old('solar_panel_count')) ? $configuration->solar_panel_count : old('solar_panel_count')}} " autocomplete="solar_panel_count" />
                        <x-input-error :messages="$errors->get('solar_panel_count')" class="mt-2" />
                    </div>
                </div>
                <!-- Inverters -->
                <div class="flex space-x-8">
                    <!-- Inverter Model -->
                    <div>
                        <x-input-label for="inverter" :value="__('Inverter')" />
                        <select class="mt-1 text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm price_calc" name="inverter_id" id="inverter_id">
                            @foreach($inverters as $inverter)
                                <option value="{{$inverter->id.'---'.$inverter->Price.'---'.$inverter->Attribute_value}}" {{$inverter->id === $configuration->inverter_id ? "selected" : ""}} >{{$inverter->Name.', '.$inverter->Attribute_value}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('inverter_id')" class="mt-2" />
                    </div>

                    <!-- Inverter Quantity -->
                    <div>
                        <x-input-label for="inverter_count" :value="__('Quantity')" />
                        <x-text-input id="inverter_count" class="count_calc block mt-1 w-full" type="text" name="inverter_count" value="{{(null === old('inverter_count')) ? $configuration->inverter_count : old('inverter_count')}}" />
                        <x-input-error :messages="$errors->get('inverter_count')" class="mt-2" />
                    </div>
                </div>
                <!-- BATTERIES -->
                <div class="flex space-x-8">
                    <!-- Battery Model -->
                    <div>
                        <x-input-label for="battery_id" :value="__('Battery')" />
                        <select class="mt-1 text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm price_calc" name="battery_id" id="battery_id">
                            @foreach ($batteries as $battery)
                                <option value="{{$battery->id.'---'.$battery->Price.'---'.$battery->Attribute_value}}"{{$battery->id === $configuration->battery_id ? "selected" : ""}} >{{$battery->Name.', '.$battery->Attribute_value}}</option>
                            @endforeach
                            <option value="" >No Battery</option>
                        </select>
                        <x-input-error :messages="$errors->get('fName')" class="mt-2" />
                    </div>

                    <!-- Battery Quantity -->
                    <div>
                        <x-input-label for="battery_count" :value="__('Quantity')" />
                        <x-text-input id="battery_count" class="count_calc block mt-1 w-full" type="text" name="battery_count" value="{{(null === old('battery_count')) ? $configuration->battery_count : old('battery_count')}}" autocomplete="battery_count" />
                        <x-input-error :messages="$errors->get('battery_count')" class="mt-2" />
                    </div>
                </div>
                <!-- Wires -->
                <div class="flex space-x-8">
                    <!-- Wire Model -->
                    <div>
                        <x-input-label for="wire_id" :value="__('Wire')" />
                        <select class="mt-1 text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm price_calc" name="wire_id" id="wire_id">
                            @foreach($wires as $wire)
                                <option value="{{$wire->id.'---'.$wire->Price.'---'.$wire->Attribute_value}}" {{$wire->id === $configuration->wire_id ? "selected" : ""}} >{{$wire->Name.', '.$wire->Attribute_value}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('wire_id')" class="mt-2" />
                    </div>

                    <!-- Wire Quantity -->
                    <div>
                        <x-input-label for="wire_count" :value="__('Quantity')" />
                        <x-text-input id="wire_count" class="count_calc block mt-1 w-full" type="text" name="wire_count" value="{{(null === old('wire_count')) ? $configuration->wire_count : old('wire_count')}}" autocomplete="wire_count" />
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
                <!-- Config Info -->
                <div class="flex space-x-6">
                    <!-- Config Cost  -->
                    <div>
                        <x-input-label class="mt-3" for="config_cost" :value="__('Estimated Cost:')" />
                        <x-text-input readonly id="config_cost"  name="config_cost" :value="old('config_cost')"/>
                        <x-input-error :messages="$errors->get('config_cost')" class="mt-2" />
                    </div>
                    
                    <!--Energy Generated -->
                    <div>
                        <x-input-label class="mt-3" for="energy_generated" :value="__('Energy Generated:')" />
                        <x-text-input readonly id="energy_generated"  name="energy_generated" :value="old('energy_generated')"/>
                        <x-input-error :messages="$errors->get('energy_generated')" class="mt-2" />
                    </div>
                </div>
                <x-primary-button>
                    {{__('Edit')}}
                </x-primary-button>
            </div>
        </form>
    @endauth
</x-app-layout>
<script>
    let energy_field = document.getElementById('energy_generated')
    let cost_field = document.getElementById('config_cost')
    let product_prices = document.querySelectorAll('.price_calc');
    let product_counts = document.querySelectorAll('.count_calc');
    let solar_panel_id_field = document.getElementById('solar_panel_id')
    let solar_panel_count_field = document.getElementById('solar_panel_count')

    function addEvents() {
        product_prices.forEach((product) => {
            product.addEventListener('change', updateConfigPrice)
        })
        product_counts.forEach((count) => {
            count.addEventListener('input', updateConfigPrice)
        })
        solar_panel_id_field.addEventListener('change', updateConfigEnergy)
        solar_panel_count_field.addEventListener('input', updateConfigEnergy)
    }
    
    function updateConfigPrice() {
        let amount = 0
        product_prices.forEach((price,i) => {
            if(price.value !== '' && product_counts[i].value !== '') {
                amount += (parseFloat(price.value.split('---')[1])*parseInt(product_counts[i].value))
            }
        })
        console.log(amount)
        cost_field.value = '$'+(parseInt(amount))
    }

    function updateConfigEnergy() {
        let solar_panel_energy = document.getElementById('solar_panel_id').value.split("---")[2]
        let solar_panel_count = document.getElementById('solar_panel_count').value
        let amount = ((parseInt(solar_panel_energy) * solar_panel_count)*5)
        energy_field.value = parseInt(amount) + ' W' 
    } 
    addEvents()
    updateConfigPrice()
    updateConfigEnergy()
</script>