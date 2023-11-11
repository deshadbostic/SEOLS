<x-app-layout>
    @auth
        <div class="pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('Edit Appliance') }}
            </h2>
            <x-input-label for="appliance_name" :value="__('Edit your appliance's name')" />
            <div class="flex pt-5 justify-start bg-gray-900 grid-cols-14">
                <h3 class="font-semibold text-xl text-white leading-tight">
                    {{'Appliance: '. $appliance->name}}
                </h3>
            </div>
            <div class="justify-start">
                <x-input-label for="new_appliance_name" class="text-xl" :value="__('New Appliance Name')" />
            </div>
            <div class="justify-start">
                <x-text-input id="new_appliance_name"  name="new_appliance_name" :value="old('new_appliance_name')"/>
            </div>
            <div class="justify-start">
                <x-input-label for="new_appliance_wattage" class="text-xl" :value="__('New Appliance Wattage')" />
            </div>
            <div class="justify-start">
                <x-text-input id="new_appliance_wattage"  name="new_appliance_wattage" :value="old('new_appliance_wattage')"/>
            </div>
            <div class="justify-start">
                <x-primary-button>
                    {{__('Save')}}
                </x-primary-button>
            </div>
        </div>
    @endauth
</x-app-layout>