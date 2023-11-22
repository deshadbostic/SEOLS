<x-app-layout>
    @auth
        <div class="pt-5 text-center justify-center min-h-screen bg-gray-900 grid-cols-14">
            <h2 class="m-3 font-semibold text-xl text-white leading-tight">
                    {{ __('Create Room') }}
            </h2>
            <form id="form" method="POST" action="{{ route('room.store') }}">
            @csrf
                <x-input-label for="room_name" class="" :value="__('Room Name')" />
            <div class="justify-start">
                <x-text-input class="m-3 text-center" id="room_name" name="room_name" :value="old('room_name')"/>
            </div>
            <x-primary-button>
                {{__('Create')}}
            </x-primary-button>
        </div>
    @endauth
</x-app-layout>