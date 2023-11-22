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
        <div class="pt-5 text-center justify-center min-h-screen bg-gray-900 grid-cols-14">
        <h2 class="m-3 font-semibold text-xl text-white leading-tight">
                    {{ __('Create Appliance') }}
            </h2>
        <form id="form" method="POST" action="{{ route('appliance.store') }}">
        @csrf
        <select class="text-center mb-4 py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm category_select" name="room" id="room">
            @foreach ($rooms as $room)
                <option value="{{$room->id}}">{{$room->name}}</option>
            @endforeach
        </select>
            
            @csrf
            <x-input-label for="name" class="" :value="__('Appliance Name')" />
            <div class="justify-start">
                <x-text-input class="m-3 text-center" id="name" name="name" :value="old('name')" required/>
            </div>
            <x-input-label for="wattage" class="" :value="__('Appliance wattage')" />
            <div class="justify-start">
                <x-text-input class="m-3 text-center" id="wattage" name="wattage" :value="old('wattage')" required/>
            </div>
            <x-primary-button>
                {{__('Create')}}
            </x-primary-button>
        </div>
    @endauth
</x-app-layout>