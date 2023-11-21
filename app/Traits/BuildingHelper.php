<?php namespace App\Traits;

trait BuildingHelper
{
	public function newCalcPowerConsumption()
	{
		$rooms = $this->room;
		$totalPower = 0;
		foreach ($rooms as $room)
		{
			//echo $room->appliance->wattage
			$totalPower += $room->appliance->sum('wattage');
		}
		return $totalPower; 
		//return 10000;
		// try collect
	}
}