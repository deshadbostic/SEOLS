<x-app-layout>
    @auth
        <div class="pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('Edit Building') }}
            </h2>
            <x-input-label for="building_name" :value="__('Edit your building's name')" />
            <div class="flex pt-5 justify-start bg-gray-900 grid-cols-14">
                <h3 class="font-semibold text-xl text-white leading-tight">
                    {{'Building: '. $building->name}}
                </h3>
            </div>
            <div class="justify-start">
                <x-input-label for="new_building_name" class="text-xl" :value="__('New Building Name')" />
            </div>
            <div class="justify-start">
                <x-text-input id="new_building_name"  name="new_building_name" :value="old('new_building_name')"/>
            </div>
            <x-primary-button>
                {{__('Edit')}}
            </x-primary-button>
        </div>
    @endauth
</x-app-layout>