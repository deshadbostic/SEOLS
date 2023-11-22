<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use App\Models\Building;
use App\Models\Room; 

trait RoomHelper
{
	public function newCalcPowerConsumption()
	{
		
		$appliances = $this->appliance;
		$totalPower = 0;

		foreach ($appliances as $appliance) {
			$totalPower += $appliance->wattage;
		}
		return $totalPower;
	}

	public function calcPowerForRoom()
	{
		return 50;
	}

	public function getIndexInfo() {
		$user= Auth::user();
        $building = Building::whereBelongsTo($user)->first();
        if(!isset($building->id)) {
            $building = null;
            return ['rooms' => null];
        } else {
            $rooms=Room::whereBelongsTo($building)->get();
            if(!isset($rooms[0])) {
                return ['rooms' => null];
            } else {
                $roomPowers = [];
                foreach($rooms as $room) {
                    $roomPowers[$room->id] = $room->newCalcPowerConsumption();
                }//end foreach
                return ['rooms' => $rooms, 'roomPowers' => $roomPowers];
            }//end if-else
        }//end if-else
	}
}
