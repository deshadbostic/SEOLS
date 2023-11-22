<head>
    <meta charset="utf-8">
    <title>Calculate Returns</title>

</head>

<body>
    @auth
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Calculate Returns') }}
            </h2>
        </x-slot>
        <div class="text-left">
            <a href="javascript:history.back()" class="text-blue-500 hover:text-blue-600 font-semibold text-lg inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>
        <div class="text-white">
            <!-- Form for selecting System Tier -->
            <!-- <form id="form" method="POST"> -->
            <div class="flex flex-col items-center space-y-4">
                <div>
                    <label for="system_tier"> Select a PV System: </label>
                </div>
                <div>
                    <select id="system_tier" name="system_tier" class="text-black">
                        @foreach($pv_systems as $key => $pv_system)
                        <option value="{{$pv_system->energy_generated.'---'.$pv_system->equipment_cost}}">{{'PV System '.$key+1}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Years Field -->
                <div>
                    <x-input-label for="numYears" :value="__('Number of Years:')" />
                    <x-text-input oninput="this.value = this.value.replace(/[^1-9]/g, '');" id="numYears" class="block mt-1 w-full" type="text" name="numYears" :value="old('numYears')" required autofocus autocomplete="numYears" />
                    <x-input-error :messages="$errors->get('numYears')" class="mt-2" />
                </div>
            </div>
            <!-- </form> -->
        </div>

        <div id="sysInfo" class="mt-5 hidden flex items-center justify-center w-screen">
            <div class="max-w-2xl flex items- space-x-8 text-white border rounded-lg text-lg">
                <div id="invReturnDiv" class="p-4">
                    <p id="invReturn"></p>
                </div>
                <div id="monthReturnDiv" class="p-4">
                    <p id="monthReturn"></p>
                </div>
            </div>


    </x-app-layout>
    @endauth
</body>

<script>
    function addEvents() {
        const system = document.getElementById('system_tier')
        system.addEventListener('change', addInfo)

        const numYears = document.getElementById('numYears')
        numYears.addEventListener('input', addInfo)
    }
    addEvents()

    function addInfo() {
        const system = document.getElementById('system_tier')
        let sysEnergy = system.value.split('---')[0]
        let sysPrice = system.value.split('---')[1]
        let numYears = document.getElementById('numYears').value

        console.log(sysEnergy)
        console.log(sysPrice)

        let convDollar = 0.4275;
        let invReturn = (numYears * (convDollar) * sysEnergy) - (sysPrice / 3);
        let monthReturn = (convDollar * sysEnergy) / 12;

        if (numYears != "") {
            document.getElementById('invReturn').innerText = "The return on investment for the selected  system after " + numYears + " years is: $" + invReturn.toFixed(2);

            document.getElementById('monthReturn').innerText = "Amount earned monthly when selling all electricity generated back to the grid: $" + monthReturn.toFixed(2);

            document.getElementById('sysInfo').style.display = "inline-flex";
        }

    }

    let sysEnergy;
    let sysPrice;
    let convDollar;
    let invReturn;
    let numYears;

    function loadSysInfo(sysTier) {
        const systemTier = document.getElementById('system_tier')
        console.log(sysTier.value)
        switch (sysTier) {
            case 'low':
                sysEnergy = 400;
                sysPrice = 14000;
                break;

            case 'medium':
                sysEnergy = 700;
                sysPrice = 20000;
                break;

            case 'high':
                sysEnergy = 1000;
                sysPrice = 44000;
                break;

            case 'industrial':
                sysEnergy = 3000;
                sysPrice = 8000;
                break;
        }

        convDollar = 0.4275;
        invReturn = (numYears * 365 * convDollar * sysEnergy) - sysPrice;
        monthReturn = (30 * convDollar * sysEnergy);


        document.getElementById('invReturn').innerHTML = "The return on investment for the selected  system after " + numYears + "number of years is: $" + invReturn;

        document.getElementById('monthReturn').innerHTML = "The amount you will earn monthly when selling back to the grid is : $"
        monthReturn;

        document.getElementById('sysInfo').style.display = "inline-flex";
    }
</script>