<head>
    <meta charset="utf-8">
    <title>Schedule an Appointment</title>
    <script>
        function setMinDate() {
            let currDate = new Date();
            currDate.setDate((currDate.getDate()) + 1);
            let dateString = currDate.toLocaleDateString('fr-ca');
            document.getElementById("date").setAttribute('min', dateString);
        } 

        window.addEventListener("DOMContentLoaded", (event) => {
            const picker = document.getElementById("date");
            picker.addEventListener('input', function(e) {
                var day = new Date(this.value).getUTCDay();
                if([6,0].includes(day)) {
                    e.preventDefault();
                    this.value = '';
                    alert('Weekends not allowed');
                }
            });
        });
    </script>
</head>

<body onload="setMinDate();">
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a href="javascript:history.back()" class="  text-blue-500 hover:text-blue-600 font-semibold text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
                <div class="bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white">
                        <p>Please fill out the form below to apply for a home / building visit appoinment.<br>
                            Home visit appointments are only available Mondays to Fridays, from 9:00A.M. to 3:00P.M. by the hour.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-6 text-center text-white">
            <p>Fields marked with * must be filled.</p>
        </div>
        <form method="POST" action="{{ route('schedule.store') }}">
            @csrf
            <div class="flex flex-col items-center space-y-4">
                <div class="flex space-x-8">
                    <!-- Date Field -->
                    <div>
                        <x-input-label for="date" :value="__('Date *')" />
                        <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required autofocus autocomplete="date" />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <!-- Time Field -->
                    <div>
                        <x-input-label for="time" :value="__('Time *')" />
                        <x-text-input id="time" class="block mt-1 w-full" type="time" step="3600" min="09:00" max="15:00" name="time" :value="old('time')" required autofocus autocomplete="time" />
                        <x-input-error :messages="$errors->get('time')" class="mt-2" />
                    </div>
                </div>

                <div class="flex space-x-8">
                    <!-- Address Field -->
                    <div>
                        <x-input-label for="address" :value="__('Address *')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                </div>

                <div class="flex space-x-8">
                    <!-- Directions Field (Optional) -->
                    <div>
                        <x-input-label for="directions" :value="__('Directions')" />
                        <x-text-input id="directions" class="block mt-1 w-full" type="text" name="directions" :value="old('directions')" autofocus autocomplete="directions" />
                        <x-input-error :messages="$errors->get('directions')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-primary-button class="ml-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </x-app-layout>
</body>
