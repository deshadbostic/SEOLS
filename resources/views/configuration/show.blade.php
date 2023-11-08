<x-app-layout>
    @auth
    <div class="container mx-auto flex flex-col items-center text-white">
        <h1 class="text-2xl font-semibold mt-4">View Configuration</h1>
        <div class="text-lg  my-3 text-white">
            Solar Panel: {{$solar_panel->Name.' - '.$configuration->solar_panel_count }}
            <form method="GET" action="{{ route('product.show', $solar_panel) }}" class="inline">
                @csrf
                <x-primary-button class="justify-center">
                    {{ __('View') }}
                </x-primary-button>
            </form>
        </div>
        <div class="text-lg my-3 text-white">
            Inverter: {{ucfirst($inverter->Name).' - '.$configuration->inverter_count}}
            <form method="GET" action="{{ route('product.show', $inverter) }}" class="inline">
                @csrf
                <x-primary-button class="justify-center">
                    {{ __('View') }}
                </x-primary-button>
            </form>
        </div>
        <div class="text-lg my-3 text-white">
            Wire: {{ucfirst($wire->Name).' - '.$configuration->wire_count}}
            <form method="GET" action="{{ route('product.show', $wire) }}" class="inline">
                @csrf
                <x-primary-button class="justify-center">
                    {{ __('View') }}
                </x-primary-button>
            </form>
        </div>
        <div class="text-lg my-3 text-white">
            Battery: {{$battery !== '' ? ucfirst($battery->Name).' - '.$configuration->battery_count : 'N/A'}}
            @if($battery !== '')
            <form method="GET" action="{{ route('product.show', $battery) }}" class="inline">
                @csrf
                <x-primary-button class="justify-center">
                    {{ __('View') }}
                </x-primary-button>
            </form>
            @endif
        </div>
        <div class="text-lg my-3 text-white">Energy Generated (Month) : {{number_format($configuration->energy_generated*31).' W'}}</div>
        <div class="text-lg my-3 text-white">Equipment Cost: {{'$'.number_format($configuration->equipment_cost,2)}}</div>
        <div class="text-lg my-3 text-white">Installation Cost: {{'$'.number_format($configuration->installation_cost,2)}}</div>
        <div class="text-lg my-3 text-white">Total: {{'$'.number_format($configuration->installation_cost+$configuration->equipment_cost,2)}}</div>
        <div class="flex space-x-4">
            <a href="{{ route('configuration.index') }}">
                <x-primary-button class="justify-center">
                    {{ __('Return') }}
                </x-primary-button>
            </a>
            <form method="GET" action="{{ route('configuration.edit', $configuration) }}" class="inline-block">
                @csrf
                <x-primary-button class="justify-center">
                {{ __('Edit Configuration') }}
                </x-primary-button>
            </form>
        </div>
    </div>
    @endauth
</x-app-layout>