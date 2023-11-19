<x-app-layout>
    @auth    
    <div class="mx-auto max-w-xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        <div class="relative">
        <a href="{{ route('pv_system.index') }}" class="absolute left-100 top-100 text-blue-600 hover:text-blue-400 focus-within:text-blue-400 active:text-blue-400 font-semibold text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back
        </a>
        </div>
        <h1 class=" text-2xl font-bold text-center my-3">Create New PV System Model</h1>
        <!-- Form -->
        <form method="POST" action="{{ route('pv_system.store') }}">
        @csrf
        <table class="table-auto w-full text-sm">
            <tbody class="">
                <tr>
                    <td class="p-4 pl-8 text-slate-500 dark:text-slate-400">Product</td>
                    <td class="p-4 text-slate-500 dark:text-slate-400">Product name</td>
                    <td class="p-4 pr-8 text-slate-500 dark:text-slate-400">count</td>
                </tr>
                <tr>
                    <td class="p-4 pl-8 text-slate-500 dark:text-slate-400">
                            <div>
                                <x-input-label class="mt-3" for="energy_generated" :value="__('Energy Generated:')" />
                                <x-text-input readonly id="energy_generated"  name="energy_generated" :value="old('energy_generated')"/>
                                <x-input-error :messages="$errors->get('energy_generated')" class="mt-2" />
                            </div>
                    </td>
                    <td class="p-4 text-slate-500 dark:text-slate-400">
                        <div>
                            <x-input-label class="mt-3" for="price" :value="__('Estimated price:')" /> 
                            <x-text-input id="price" class="block mt-1 w-full" type="text" maxlength="5" name="price" value="{{ old('template_price', $template_price) }}" required autofocus autocomplete="price" />
                            <x-input-error :messages="$errors->get('template_price')" class="mt-2" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-4 pl-8 text-slate-500 dark:text-slate-400">
                                <div>
                                    <x-input-label class="mt-3" for="energy_requirement" :value="__('Energy Requirement:')" />
                                    <x-text-input readonly id="energy_requirement"  name="energy_requirement" :value="old('energy_requirement')"/>
                                    <x-input-error :messages="$errors->get('energy_requirement')" class="mt-2" />
                                </div>
                        </td>
                        <td class="p-4 text-slate-500 dark:text-slate-400">
                            <div>
                                <x-input-label class="mt-3" for="budget" :value="__('My Budget:')" /> 
                                <x-text-input id="budget" class="block mt-1 w-full" type="text" maxlength="5" name="budget" value="{{ old('user->budget', $user->budget) }}" required autofocus autocomplete="budget" />
                                <x-input-error :messages="$errors->get('budget')" class="mt-2" />
                            </div>
                        </td>
                </tr>
            </tbody>
        </table>
    </form>
   
    </div>
    @endauth
</x-app-layout>