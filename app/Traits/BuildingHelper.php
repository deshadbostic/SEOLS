<?php namespace App\Traits;

trait BuildingHelper
{
	public function newCalcPowerConsumption()
	{
		$rooms = $this->room;
		$totalPower = 0;
		
		foreach ($rooms as $room)
		{
			$totalPower += $room->appliance->sum('powerConsumption');
		}
		return $totalPower; 
		//return 10000;
		// try collect
	}
}