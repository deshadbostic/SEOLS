<x-app-layout>
    @auth
    <div class="mt-6">
        @if(Auth::user()->role != "Customer")
        <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">
            <a href="{{ route('battery.create') }}" class="text-white-500">Create Battery</a>
        </button>

        <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">
            <a href="{{ route('inverter.create') }}" class="text-white-500">Create Inverter</a>
        </button>

        <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">
            <a href="{{ route('solarpanel.create') }}" class="text-white-500">Create Solar Panel</a>
        </button>
        @endif
    </div>
    <div class="grid grid-cols-autoLayout my-8 gap-4 w-full  dark:bg-gray-900">

        @foreach ($inverters as $inverter)
        <div class=" text-gray-200 block max-w-sm text-center mx-auto w-full rounded-md border-[1px] px-3 py-4 border-gray-300 bg-slate-800">
            <p>Model: {{ $inverter->Model }}</p>
            <p>Cost: ${{ $inverter->Cost }}</p>
            <form method="GET" action="{{ route('inverter.show', $inverter) }}">
                @csrf
                <x-primary-button class="mt-4">{{ __('View') }}
                </x-primary-button>
            </form>
            @if(Auth::user()->role != "Customer")
            <form method="GET" action="{{ route('inverter.edit', $inverter) }}">
                @csrf
                <x-primary-button class="mt-4">{{ __('Edit') }}
                </x-primary-button>
            </form>
            @endif
        </div>
        @endforeach
        @foreach ($batteries as $battery)
        <div class=" text-gray-200 block max-w-sm text-center mx-auto w-full rounded-md border-[1px] px-3 py-4 border-gray-300 bg-slate-800">
            <p>Model: {{ $battery->Model }}</p>
            <p>Cost: ${{ $battery->Cost }}</p>
            <form method="GET" action="{{ route('battery.show', $battery) }}">
                @csrf
                <x-primary-button class="mt-4">{{ __('View') }}
                </x-primary-button>
            </form>
            @if(Auth::user()->role != "Customer")
            <form method="GET" action="{{ route('battery.edit', $battery) }}">
                @csrf
                <x-primary-button class="mt-4">{{ __('Edit') }}
                </x-primary-button>
            </form>
            @endif
        </div>
        @endforeach
        @foreach ($solar_panels as $solar_panel)
        <div class=" text-gray-200 block max-w-sm text-center mx-auto w-full rounded-md border-[1px] px-3 py-4 border-gray-300 bg-slate-800">
            <p>Model: {{ $solar_panel->Model }}</p>
            <p>Cost: ${{ $solar_panel->Cost }}</p>
            <form method="GET" action="{{ route('solarpanel.show', $solar_panel) }}">
                @csrf
                <x-primary-button class="mt-4">{{ __('View') }}
                </x-primary-button>
            </form>
            @if(Auth::user()->role != "Customer")
            <form method="GET" action="{{ route('solarpanel.edit', $solar_panel) }}">
                @csrf
                <x-primary-button class="mt-4">{{ __('Edit') }}
                </x-primary-button>
            </form>
            @endif
        </div>
        @endforeach
    </div>
    @endauth
</x-app-layout>