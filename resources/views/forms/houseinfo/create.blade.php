<head>
    <meta charset="utf-8">
    <title>House Information Form</title>
</head>

<body>
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white">
                        <h2>Please fill out the form below to submit your house information to the piDSS.</h2>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('houseinfo.store') }}">
            @csrf
            <div class="flex flex-col items-center space-y-4">
                <div class="flex space-x-8">
                    <!-- User First Name -->
                    <div>
                        <x-input-label for="fName" :value="__('First Name')" />
                        <x-text-input id="fName" class="block mt-1 w-full" type="text" name="fName" :value="old('fName')" required autofocus autocomplete="fName" />
                        <x-input-error :messages="$errors->get('fName')" class="mt-2" />
                    </div>

                    <!-- User Last Name -->
                    <div>
                        <x-input-label for="lName" :value="__('Last Name')" />
                        <x-text-input id="lName" class="block mt-1 w-full" type="text" name="lName" :value="old('lName')" required autofocus autocomplete="lName" />
                        <x-input-error :messages="$errors->get('lName')" class="mt-2" />
                    </div>
                </div>

                <div class="flex space-x-8">
                    <!-- Electricity Usage -->
                    <div>
                        <x-input-label for="electricity" :value="__('Electricity Usage (kWh)')" />
                        <x-text-input id="electricity" class="block mt-1 w-full" type="number" name="electricity" :value="old('electricity')" required autofocus autocomplete="electricity" />
                        <x-input-error :messages="$errors->get('electricity')" class="mt-2" />
                    </div>

                    <!-- Roof Size -->
                    <div>
                        <x-input-label for="roof_size" :value="__('Roof Size (sq ft)')" />
                        <x-text-input id="roof_size" class="block mt-1 w-full" type="number" name="roof_size" :value="old('roof_size')" required autofocus autocomplete="roof_size" />
                        <x-input-error :messages="$errors->get('roof_size')" class="mt-2" />
                    </div>
                </div>

                <div class="flex space-x-8">

                    <!-- Roof Slope -->
                    <div>
                        <x-input-label for="roof_slope" :value="__('Roof Slope (Degrees)')" />
                        <x-text-input id="roof_slope" class="block mt-1 w-full" type="number" name="roof_slope" :value="old('roof_slope')" required autofocus autocomplete="roof_slope" />
                        <x-input-error :messages="$errors->get('roof_slope')" class="mt-2" />
                    </div>

                    <!-- Roof Age -->
                    <div>
                        <x-input-label for="roof_age" :value="__('Roof Age (Years)')" />
                        <x-text-input id="roof_age" class="block mt-1 w-full" type="number" name="roof_age" :value="old('roof_age')" required autofocus autocomplete="roof_age" />
                        <x-input-error :messages="$errors->get('roof_age')" class="mt-2" />
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