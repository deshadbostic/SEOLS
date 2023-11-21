<?php

namespace App\Traits;

trait RoomHelper
{
	public function newCalcPowerConsumption()
	{
		$appliances = $this->appliance;
		$totalPower = 0;

		foreach ($appliances as $appliance) {
			$totalPower += $appliance->sum('wattage');
		}
		return $totalPower;
		//return 10000;
		// try collect
	}

	public function calcPowerForRoom()
	{
		return 50;
	}
}
