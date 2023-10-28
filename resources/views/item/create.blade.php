<x-app-layout>
    <form method="POST" action="{{ route('item.store') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
		
		<!-- Description -->
		<div>
			<x-input-label for="description" :value="__('Description')" />
			<textarea
				name="description"
				class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
			></textarea>
			<x-input-error :messages="$errors->get('description')" class="mt-2" />
		<div>

        <!-- Price -->
        <div>
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>
		
		<div>
			<x-primary-button class="ml-4">
                {{ __('Create') }}
            </x-primary-button>
		</div>		
    </form>
</x-app-layout>