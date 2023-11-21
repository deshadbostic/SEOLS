<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use App\Traits\BuildingHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{

    use BuildingHelper;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user= Auth::user();
        $building = Building::whereBelongsTo($user)->first();
        if(!isset($building->id)) {
            $building = null;
            return view('building.index',['building' => $building]);
        } else {
              return view('building.index')->with('building', $building)->with('totalPower',$building->newCalcPowerConsumption());
        }
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('building.create')->with('batteries', 'f');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try
		{
			$validated = $request->validate([
				'name' => 'required',
			]);
			
			$request->user()->building()->create($validated);	
		}
		catch (\Exception)
		{
			//error handling
		}
		
		return redirect(route('building.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

     public function dedit(Request $request)
     {
         return redirect(route('building.edit'));
     }
 
     public function delete(Request $request)
     {
         return redirect(route('room.delete'));
     }
    public function edit(Building $building)
    {
        //
        //$room=Building::where("id",$request->buildingid)->get();
        return view('building.edit')->with('building', $building);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Building $building)
    {
        $building->update(['name' => $request->new_building_name]);
        return view('building.index')->with('building', $building)->with('totalPower',$building->newCalcPowerConsumption());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building)
    {
        //
        $building->delete();
        return view('building.index',['building' => null]);
    }
}
