<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApplianceHelper;
use App\Models\Room;
use App\Models\Building;
use App\Models\Appliance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApplianceController extends Controller
{
    use ApplianceHelper;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $buildings = Building::whereBelongsTo($user)->get();
        $rooms = Room::whereBelongsTo($buildings[0])->get();
        $appliances = Appliance::whereBelongsTo($rooms[0])->get();
        return view('appliance.index')->with(['buildings' => $buildings, 'rooms' => $rooms, 'appliances' => $appliances]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('appliance.index')->with('batteries', 'f');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $room = Room::find($request->room_id);

            $validated = $request->validate([
                'name' => 'required',
                'wattage' => 'required|numeric',
            ]);

            $room->appliance()->create($validated);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            //error handling
        }
        return redirect(route('appliance.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $appliance = Appliance::where("id", $request->applianceid)->get();

        return view('appliance.edit')->with('appliance', $appliance);
    }
    public function dedit(Request $request)
    {
        return redirect(route('appliance.edit'));
    }

    public function delete(Request $request)
    {
        return redirect(route('appliance.delete'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $appliance=Appliance::where("id",$request->applianceid)->get();
        $appliance->delete();
        return view('appliance.index')->with('appliance', $appliance);  
    }
}
