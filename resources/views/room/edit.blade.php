<x-app-layout>
    @auth
        <div class="pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('Edit Room') }}
            </h2>
            <x-input-label for="room_name" :value="__('Edit your rooms name')" />
            <div class="flex pt-5 justify-start bg-gray-900 grid-cols-14">
                <h3 class="font-semibold text-xl text-white leading-tight">
                    {{'Room: '. $room[0]->name}}
                </h3>
            </div>
            <div class="justify-start">
                <x-input-label for="new_room_name" class="text-xl" :value="__('New Room Name')" />
            </div>
            <div class="justify-start">
                <x-text-input id="new_room_name"  name="new_room_name" :value="old('new_room_name')"/>
            </div>
            <div class="justify-start">
                <x-primary-button>
                    {{__('Save')}}
                </x-primary-button>
            </div>
        </div>
    @endauth
</x-app-layout>