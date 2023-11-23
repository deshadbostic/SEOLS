<x-app-layout>
    <x-slot name="header" id="restytesty">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(Auth::user()->role != "Customer")
                    {{ __("You're logged in as ". Auth::user()->role) ."!!" }}
                    @else
                    {{ __("Welcome ". Auth::user()->role .", ". Auth::user()->username . "!!") }}
                    @endif
                    <!-- Links to Product, Customer, and Schedule Pages -->
                    <div class="mt-4">
                        <a href="{{ route('product.index') }}" class="text-blue-500 hover:underline">View Products</a>
                        <br>        
                        <a href="{{ route('schedule.index') }}" class="text-blue-500 hover:underline">View Schedules</a>
                        <br>
                        <a href="{{ route('houseinfo.index') }}" class="text-blue-500 hover:underline">View Housing Info</a>
                        <br>
                        <a href="{{ route('houseinfo.create') }}" class="text-blue-500 hover:underline">Add Housing Info</a>
                        <br>
                        <a href="{{ route('quote.index') }}" class="text-blue-500 hover:underline">System Quotations</a>
                        <br>
                        <a href="{{ route('pv_system.index') }}" class="text-blue-500 hover:underline">PV System Models</a>
                        <br>
                        <a href="{{ route('building.index') }}" class="text-blue-500 hover:underline">Building Modelling</a>
                        <br>
                        <a href="{{ route('investment.index') }}" class="text-blue-500 hover:underline">Return on Investment</a>
                        <br>
                        <a href="{{ route('FAQs.index') }}" class="text-blue-500 hover:underline">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
