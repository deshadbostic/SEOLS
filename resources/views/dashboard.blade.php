<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <!-- Links to Product, Customer, and Schedule Pages -->
                    <div class="mt-4">
                        <a href="{{ route('product.index') }}" class="text-blue-500 hover:underline">View Products</a>
                        <br>
                        <a href="{{ route('customer.index') }}" class="text-blue-500 hover:underline">View Customers</a>
                        <br>
                        <a href="{{ route('schedule.index') }}" class="text-blue-500 hover:underline">View Schedules</a>
                        <br>
                        <a href="{{ route('houseinfo.index') }}" class="text-blue-500 hover:underline">View Housing Info</a>
                        <br>
                        <a href="{{ route('houseinfo.create') }}" class="text-blue-500 hover:underline">Add Housing Info</a>
                        <br>
                        <a href="{{ route('quote.index') }}" class="text-blue-500 hover:underline">System Quotations</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
