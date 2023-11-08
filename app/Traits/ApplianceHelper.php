<?php namespace App\Traits;
use App\Models\Appliance;

trait ApplianceHelper
{

    public function setApplianceWatts(Appliance $appliance,float $newvalue){
        Appliance::updateOrCreate(
            ['id' => $appliance->id],
            [
                'name' => $appliance->name,
                'wattage' => $newvalue
            ]);

    }
    public function getPowerConsumption(Appliance $appliance)
	{
        //returns only 1 appliance power consump[tion]
		return $appliance->wattage;
	}
}