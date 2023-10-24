<section>
    <header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Personal Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's personal information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        

        <!-- First and Last Name -->
        <div class="mt-4">
            <div class="columns-2">
                <div>
                    <x-input-label for="firstName" :value="__('First Name')" />
                    <x-text-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('fname', $user->fname)" required autocomplete="given-name" />
                </div>
                <div>
                    <x-input-label for="lastName" :value="__('Last Name')" />
                    <x-text-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('lname', $user->lname)" required autocomplete="family-name" />
                </div>
            </div>
            <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="phoneNumber" :value="__('Phone Number')" />
            <x-text-input id="phoneNumber" name="phoneNumber" type="text" class="mt-1 block w-full" :value="old('phoneNumber', $user->phone)" required autocomplete="tel" />
            <label for="phoneNumber" class="text-gray-700 dark:text-gray-300 text-sm opacity-60">Format: +1 (123) 456-7890</label>
            <x-input-error class="mt-2" :messages="$errors->get('phoneNumber')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" required autocomplete="address-line1" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="budget" :value="__('Budget')" />
            <x-text-input id="budget" name="budget" type="text" class="mt-1 block w-full" :value="old('budget', $user->budget)" required autocomplete="" />
            <x-input-error class="mt-2" :messages="$errors->get('budget')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>