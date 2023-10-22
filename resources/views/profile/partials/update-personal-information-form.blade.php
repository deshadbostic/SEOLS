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

        <div>
            <x-input-label for="fname" :value="__('First Name')" />
            <x-text-input id="fname" name="fname" type="text" class="mt-1 block w-full" :value="old('fname', $user->fname)" required autocomplete="given-name" />
            <x-input-error class="mt-2" :messages="$errors->get('fname')" />
        </div>

        <div>
            <x-input-label for="lname" :value="__('Last Name')" />
            <x-text-input id="lname" name="lname" type="text" class="mt-1 block w-full" :value="old('lname', $user->lname)" required autocomplete="family-name" />
            <x-input-error class="mt-2" :messages="$errors->get('lname')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
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