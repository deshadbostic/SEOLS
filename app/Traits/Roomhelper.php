<?php namespace App\Traits;

trait RoomHelper
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


    public function calcPowerForRoom()
	{
		return 50;
	}
}