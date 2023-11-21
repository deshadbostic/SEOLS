<x-app-layout>
    @auth
        <div class="pt-5 text-center justify-center min-h-screen bg-gray-900 grid-cols-14">
        <h1 class="text-center font-semibold text-xl text-white leading-tight">
                {{'Building: '. $building->name}}
        </h1>
            <h2 class="m-3 font-semibold text-xl text-white leading-tight">
                    {{ __('Edit Building') }}
            </h2>
            
            
            
            <form id="form" method="POST" action="{{ route('building.update', $building) }}">
            @csrf
            @method('PATCH')
                <x-input-label for="new_building_name" class="" :value="__('New Building Name')" />
            <div class="justify-start">
                <x-text-input class="m-3 text-center"  id="new_building_name" placeholder="{{$building->name}}" name="new_building_name" :value="old('new_building_name')"/>
            </div>
            <x-primary-button>
                {{__('Edit')}}
            </x-primary-button>
        </div>
    @endauth
</x-app-layout>