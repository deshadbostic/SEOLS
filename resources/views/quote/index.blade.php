<head>
    <meta charset="utf-8">
    <title>PV System Quotation</title>
    <script>
        let sysPrice;
        let labourPrice;
        let setupPrice;
        let installPrice;
        let taxIncentive;
        let totalPrice;

        let systemName;
        let systemSize;
        let systemInverter;
        let systemBattery;

        function loadSysInfo(sysTier) {
            switch (sysTier) {
                case 'low':
                    sysPrice = 14000;
                    labourPrice = 1200;
                    setupPrice = 60;
                    systemName = "Low Tier System";
                    systemSize = "System Size: 4kW";
                    systemInverter = "String Inverter";
                    systemBattery = "No Solar Battery";
                break;

                case 'medium':
                    sysPrice = 20000;
                    labourPrice = 1800;
                    setupPrice = 85;
                    systemName = "Medium Tier System";
                    systemSize = "System Size: 6kW";
                    systemInverter = "String Inverter";
                    systemBattery = "No Solar Battery";
                break;

                case 'high':
                    sysPrice = 44000;
                    labourPrice = 3000;
                    setupPrice = 165;
                    systemName = "High Tier System";
                    systemSize = "System Size: 10kW";
                    systemInverter = "String Inverter / Micro Inverters";
                    systemBattery = "5kWh Solar Battery";
                break;

                case 'industrial':
                    sysPrice = 64000;
                    labourPrice = 3600;
                    setupPrice = 200;
                    systemName = "Industrial Tier System";
                    systemSize = "System Size: 12kW+";
                    systemInverter = "String Inverter/ Micro Inverters";
                    systemBattery = "10kWh+ Solar Battery";
                break;
            }

            taxIncentive = calcualteIncentive(sysPrice);
            installPrice = setupPrice + labourPrice;
            totalPrice = sysPrice + installPrice;

            displaySysInfo();
        }

        function displaySysInfo() {
            document.getElementById('sysTierName').innerHTML = systemName;
            document.getElementById('sysDetails_size').innerHTML = systemSize;
            document.getElementById('sysDetails_inverter').innerHTML = systemInverter;
            document.getElementById('sysDetails_battery').innerHTML = systemBattery;
            document.getElementById('sysPrice').innerHTML = "Purchase Price: $" + sysPrice;
            document.getElementById('taxCredit').innerHTML = "Tax Credit: $" + taxIncentive;
            document.getElementById('installPrice').innerHTML = "Installation Cost: $" + installPrice;
            document.getElementById('sysTotal').innerHTML = "Total Cost: $" + totalPrice;

            document.getElementById('sysInfo').style.display = "inline-flex"; //Showing the Flex-Box.
        }

        function calcualteIncentive(total) {
            const taxIncentiveRate = 0.3;
            let taxIncentive = total * 0.3;
            return taxIncentive;
        }
    </script>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('PV System Quotation') }}
            </h2>
        </x-slot>

        <div class="text-white">
            <!-- Form for selecting System Tier -->
            <form onsubmit="loadSysInfo(document.getElementById('system_tier').value); return false">
                <div class="flex flex-col items-center space-y-4">
                    <div>
                        <label for="system_tier"> Select a PV System and see how low the price can be!</label>
                    </div>
                    <div>
                        <select id="system_tier" name="system_tier" class="text-black">
                            <option value="low">Low Tier</option>
                            <option value="medium" selected>Medium Tier</option>
                            <option value="high">High Tier</option>
                            <option value="industrial">Industrial Tier</option>
                        </select>
                    </div>

                    <div>
                        <x-primary-button class="ml-4">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>

        <div id="sysInfo" class="hidden flex items-center justify-center w-screen">
            <div class="max-w-2xl flex items- space-x-8 text-white border rounded-lg text-lg">
                <div id="sysDetails" class="p-4">
                    <h2 class="text-center text-2xl underline"> System Details</h2>
                    <p id="sysTierName"></p>
                    <p id="sysDetails_size"></p>
                    <p id="sysDetails_inverter"></p>
                    <p id="sysDetails_battery"></p>
                </div>

                <div id="sysCosts" class="p-4">
                    <h2 class="text-center text-2xl underline"> System Costs</h2>
                    <p id="sysPrice"></p>
                    <p id="taxIncentive">Tax Incentive: 30%</p>
                    <p id="taxCredit"></p>
                    <p id="installPrice"></p>
                    <p id="sysTotal"></p>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>