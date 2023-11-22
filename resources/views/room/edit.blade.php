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
        <div>
        <form class="mt-10" action="{{ route('building.index') }}" method="GET">
            @csrf
                <x-primary-button class="ml-4">
                    {{ __('Show Building') }}
                </x-primary-button>
            </form>
        </div>
        <div class="pt-5 text-center justify-center min-h-screen bg-gray-900 grid-cols-14">
        <h1 class="text-center font-semibold text-xl text-white leading-tight">
                {{'Room: '. $room->name}}
        </h1>
            <h2 class="m-3 font-semibold text-xl text-white leading-tight">
                    {{ __('Edit Room') }}
            </h2>
            <form id="form" method="POST" action="{{ route('room.update', $room) }}">
            @csrf
            @method('PATCH')
                <x-input-label for="new_room_name" class="" :value="__('New Room Name')" />
            <div class="justify-start">
                <x-text-input class="m-3 text-center"  id="new_room_name" placeholder="{{$room->name}}" name="new_room_name" :value="old('new_room_name')" required/>
            </div>
            <x-primary-button>
                {{__('Save')}}
            </x-primary-button>
        </div>
    @endauth
</x-app-layout>